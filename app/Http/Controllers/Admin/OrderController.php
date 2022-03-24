<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\State;
use App\Models\StateTranslation;
use App\Models\Country;
use App\Models\Language;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /*
        orders
            id
            user
            total
            paid
            first name
            last name
            company name
            city
            address
            postcode
            phone
            email
            notes
            status
            time
        order items:
            product
            quantity
            options
            price
            vendor
        */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        $countries = Country::all();
        return view('admin.orders.create', compact("languages", 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // states table ////////////////////////////////////////
        $state = new State;
        $state->code = request('code');
        $state->country_id = request('country_id');
        $state->save();

        // state_translations table ////////////////////////////////////////
        foreach (Language::all() as $key => $language) {
            $state_translation = new StateTranslation;
            $state_translation->state_id = $state->id;
            $state_translation->language_id = $language->id;
            $state_translation->name = request('name')[$key];
            $state_translation->save();
        }

        return redirect('admin/states')->with(['alert' => [
            'icon' => 'success',
            'title' => __('lang.alert_congrats'),
            'text' => __('lang.alert_success_add')
        ]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = State::find($id);
        $languages = Language::all();
        $countries = Country::all();

        return view('admin.orders.edit', compact("languages", "state", 'countries'));
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
        // states table ////////////////////////////////////////
        $state = State::find($id);
        $state->code = request('code');
        $state->country_id = request('country_id');
        $state->save();

        // state_translations table ////////////////////////////////////////
        foreach (Language::all() as $key => $language) {
            $state_translation = StateTranslation::where('state_id', $state->id)
                ->where('language_id', $language->id)->first();
            $state_translation->name = request('name')[$key];
            $state_translation->save();
        }

        return redirect('admin/states')->with(['alert' => [
            'icon' => 'success',
            'title' => __('lang.alert_congrats'),
            'text' => __('lang.alert_success_update')
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::find($id);
        $state->delete();
        return "deleted successfully";
    }
}
