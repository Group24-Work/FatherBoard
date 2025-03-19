<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\ReturnedOrder;

use Illuminate\Http\Request;

class ReturnedOrderController extends Controller
{

    public function create(Orders $order)
    {
        if ($order->order_status !== 'Pending') {
            return redirect()->route('orders.show', $order)->with('error', 'Order cannot be returned.');
        }

        return view('returns', compact('order'));
    }

    public function store(Request $request, Orders $order)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        ReturnedOrder::create([
            'order_id' => $order->id,
            'reason' => $request->reason,
        ]);

        $order->update([
            'order_status' => 'Returned',
        ]);

        return redirect()->route('orders.show', $order)->with('success', 'Order has been returned successfully.');
    }
}
