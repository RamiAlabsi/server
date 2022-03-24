<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        $orders = [];
        foreach (Order::all() as $order)
            if (count($order->getMyItems()) > 0)
                array_push($orders, $order);
        return view('vendor.orders.index', compact('orders', "statuses"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $status_id = request("status_id");
        foreach ($order->getMyItems() as $item) {
            $item->status_id = $status_id;
            $item->save();
        }
        return true;
    }
}
