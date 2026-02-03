<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use App\Models\MerchandiseOrder;
use Illuminate\Http\Request;

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

    public function order(Request $request, Merchandise $merchandise)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Check stock
        if ($merchandise->stock < $validated['quantity']) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }

        $validated['merchandise_id'] = $merchandise->id;
        $validated['total_price'] = $merchandise->price * $validated['quantity'];
        $validated['status'] = 'pending';

        MerchandiseOrder::create($validated);

        // Reduce stock
        $merchandise->decrement('stock', $validated['quantity']);

        return redirect()->route('merchandise.index')->with('success', 'Pesanan berhasil dibuat! Kami akan menghubungi Anda segera.');
    }
}
