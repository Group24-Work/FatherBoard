<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\ReturnedOrder;

use Illuminate\Http\Request;

class ReturnedOrderController extends Controller
{
    public function show(Orders $orders)
    {
        $customerId = AuthController::loggedIn();
                if ($orders->customer_id !== $customerId->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('returns', ['orders' => $orders]);
    }


    public function create(Orders $orders)
    {
        $customerId = AuthController::loggedIn();
                if ($orders->customer_id !== $customerId->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('returns', compact('orders'));
    }


    public function store(Request $request, Orders $orders)
    {
        $customerId = AuthController::loggedIn();
                if ($orders->customer_id !== $customerId->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        ReturnedOrder::create([
            'order_id' => $orders->id,
            'reason' => $request->reason,
        ]);

        $orders->update([
            'order_status' => 'Returned',
        ]);

        return redirect()->route('orders.show', ['orders' => $orders->id])
            ->with('success', 'Order has been returned successfully.');
    }
}
