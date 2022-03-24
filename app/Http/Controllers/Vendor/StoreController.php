<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\controller;
use App\Models\Store;
use App\Models\Language;
use App\Models\StoreTranslation;
use App\Models\UserStore;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stores = Auth::user()->stores;
        $languages = Language::all();
        return view('vendor.stores.index',compact('stores','languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        return view('vendor.stores.create',compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "email" => ['required', 'unique:stores']
        ]);

        $store = new Store;
        $store->email = request('email');
        $store->phone = request('phone');
        $store->save();

        // category_translations table ////////////////////////////////////////
        foreach (Language::all() as $key => $language) {
            $store_translation = new StoreTranslation;
            $store_translation->store_id = $store->id;
            $store_translation->language_id = $language->id;
            $store_translation->name = request('name')[$key];
            $store_translation->description = request('description')[$key];
            $store_translation->save();
        }

        $store_owner = new UserStore;
        $store_owner->user_id = auth()->user()->id;
        $store_owner->store_id = $store->id;
        $store_owner->save();


        return redirect('vendor/stores')->with(['alert' => [
            'icon' => 'success',
            'title' => __('lang.alert_congrats'),
            'text' => __('lang.alert_success_add')
        ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = Store::find($id);
        $languages = Language::all();

        return view('vendor.stores.show', compact("languages","store"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);
        $languages = Language::all();

        return view('vendor.stores.edit', compact("languages","store"));
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
        $request->validate([
            "email" => ['required', 'unique:stores']
        ]);
        
        $store = Store::find($id);
        $store->email =$request->email;
        $store->phone =$request->phone;
        $store->save();
        foreach (Language::all() as $key => $language) {
            $store_translation = StoreTranslation::where('store_id', $store->id)->where('language_id', $language->id)->first();;
            $store_translation->name = request('name')[$key];
            $store_translation->description = request('description')[$key];
            $store_translation->save();
        }

        return redirect('vendor/stores')->with(['alert' => [
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
        $store = Store::find($id);
        $store->delete();
        return "deleted successfully";
    }
}
