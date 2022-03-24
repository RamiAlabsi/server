<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Language;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemTranslation;
use App\Models\Setting;

use App\Models\Product;
use App\Models\State;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingController extends Controller
{
    function order_completed()
    {
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false
        ];
        return view('website.shopping.order_completed', $input);
    }
    function cart()
    {
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false
        ];
        return view('website.shopping.cart', $input);
    }
    function checkout_create()
    {
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false
        ];
        // loading countries and states
        $countries = Country::all();
        $input["countries"] = $countries;
        $states = State::all();
        $input["states"] = $states;
        // loading user cart
        $cart_items = Cart::where('user_id', Auth::user()->id)->get();
        $input["cart_items"] = $cart_items;
        return view('website.shopping.checkout', $input);
    }
    function checkout_store(Request $request)
    {
        $rules = [
            "first_name" => ["required", "max:255"],
            "last_name" => ["required", "max:255"],
            "company_name" => ["sometimes", "nullable", "max:255"],
            "city_id" => ["required"],
            "address" => ["required", "max:255"],
            "postcode" => ["required", "max:255"],
            "phone" => ["required", "max:255"],
            "email" => ["email", "required"],
            "payment_option" => ["required"]
        ];
        $request->validate($rules);

        ///////////////////////////////////////  SAVING THE ORDER AND IT'S RELATIONS
        // saving the order
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->total = request('total_price');
        $order->first_name = request('first_name');
        $order->last_name = request('last_name');
        $order->company_name = request('company_name');
        $order->city_id = request('city_id');
        $order->address = request('address');
        $order->postcode = request('postcode');
        $order->phone = request('phone');
        $order->email = request('email');
        $order->notes = request('notes');
        $order->save();

        // getting the cart items to transfer them to orders
        $cart_items = Cart::where('user_id', Auth::user()->id)->get();
        if (count($cart_items) == 0) {
            return redirect()->back()->with(['alert' => [
                'icon' => 'error',
                'title' => __('lang.alert_error'),
                'text' => __('lang.alert_empty_cart')
            ]]);
        }
        foreach ($cart_items as $cart_item) {
            // saving order items
            $order_item = new OrderItem;
            $order_item->order_id = $order->id;
            $order_item->status_id = Status::$default_id;
            $order_item->store_id = $cart_item->product->store->id;
            $order_item->save();

            // saving the order item translations
            foreach (Language::all() as $language) {
                $order_item_translation = new OrderItemTranslation;
                $order_item_translation->language_id = $language->id;
                $order_item_translation->order_item_id = $order_item->id;
                $order_item_translation->html = view('website.orders.show_order_card', compact("language", "cart_item", "order_item"))->render();
                $order_item_translation->save();
            }

            // increasing the product order count
            $product = $cart_item->product;
            $product->orders_cnt = $product->orders_cnt + 1;
            $product->save();

            // removing the cart item
            $cart_item->delete();
        }
        if ($request->payment_option == 0)
            dd("waiting for Hyberpay credentials for deploying this page...");
        return redirect('/order_completed');
    }
}
