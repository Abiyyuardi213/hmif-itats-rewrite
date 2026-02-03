<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use App\Models\MerchandiseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MerchandiseController extends Controller
{
    public function index()
    {
        $merchandises = Merchandise::where('is_available', true)
            ->where('stock', '>', 0)
            ->latest()
            ->get();

        return view('merchandise.index', compact('merchandises'));
    }

    public function show($slug)
    {
        $merchandise = Merchandise::where('slug', $slug)
            ->where('is_available', true)
            ->firstOrFail();

        return view('merchandise.show', compact('merchandise'));
    }

    public function createOrder($slug)
    {
        $merchandise = Merchandise::where('slug', $slug)
            ->where('is_available', true)
            ->firstOrFail();

        return view('merchandise.order', compact('merchandise'));
    }

    public function storeOrder(Request $request, $slug)
    {
        $merchandise = Merchandise::where('slug', $slug)
            ->where('is_available', true)
            ->firstOrFail();

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        if ($merchandise->stock < $validated['quantity']) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }

        $transaction_id = 'HMIF-' . strtoupper(Str::random(10));

        $order = MerchandiseOrder::create([
            'transaction_id' => $transaction_id,
            'merchandise_id' => $merchandise->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'quantity' => $validated['quantity'],
            'size' => $validated['size'],
            'total_price' => $merchandise->price * $validated['quantity'],
            'status' => 'pending',
            'notes' => $validated['notes'],
            'expires_at' => Carbon::now()->addMinutes(60),
        ]);

        return redirect()->route('merchandise.checkout', $transaction_id);
    }

    public function checkout($transaction_id)
    {
        $order = MerchandiseOrder::where('transaction_id', $transaction_id)->firstOrFail();

        // If expired and still pending
        if ($order->status == 'pending' && Carbon::now()->isAfter($order->expires_at)) {
            $order->update(['status' => 'cancelled']);
        }

        $paymentMethods = \App\Models\PaymentMethod::where('is_active', true)->get();

        return view('merchandise.checkout', compact('order', 'paymentMethods'));
    }

    public function uploadProof(Request $request, $transaction_id)
    {
        $order = MerchandiseOrder::where('transaction_id', $transaction_id)->firstOrFail();

        if ($order->status != 'pending') {
            return redirect()->back()->with('error', 'Pesanan ini tidak dapat menerima pembayaran.');
        }

        if (Carbon::now()->isAfter($order->expires_at)) {
            $order->update(['status' => 'cancelled']);
            return redirect()->back()->with('error', 'Waktu pembayaran telah habis.');
        }

        $request->validate([
            'payment_proof' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');

            $order->update([
                'payment_proof' => $path,
                'status' => 'confirmed', // Assuming "automatic" means system moves it to confirmed for now or at least "paid"
                'paid_at' => Carbon::now(),
            ]);

            // Reduce stock only after payment? Or during order? 
            // Usually during payment to avoid ghost reservations, 
            // but for simplicity here we do it now.
            $order->merchandise->decrement('stock', $order->quantity);

            return redirect()->route('merchandise.order_status', $transaction_id)->with('success', 'Bukti pembayaran berhasil diupload!');
        }

        return redirect()->back()->with('error', 'Gagal mengupload bukti pembayaran.');
    }

    public function orderStatus($transaction_id)
    {
        $order = MerchandiseOrder::where('transaction_id', $transaction_id)->with('merchandise')->firstOrFail();
        return view('merchandise.status', compact('order'));
    }
}
