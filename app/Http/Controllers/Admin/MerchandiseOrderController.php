<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MerchandiseOrder;
use Illuminate\Http\Request;

class MerchandiseOrderController extends Controller
{
    public function index()
    {
        $orders = MerchandiseOrder::with('merchandise')
            ->latest()
            ->get();

        return view('admin.merchandise-orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, MerchandiseOrder $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,completed,cancelled',
        ]);

        $order->update($validated);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function destroy(MerchandiseOrder $order)
    {
        // Return stock if order is cancelled
        if ($order->status !== 'completed') {
            $order->merchandise->increment('stock', $order->quantity);
        }

        $order->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus');
    }
}
