<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityTranslation;
use App\Models\State;
use App\Models\StateTranslation;
use App\Models\Language;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        $states = State::all();
        return view('admin.cities.create', compact("languages", 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // cities table ////////////////////////////////////////
        $city = new City;
        $city->code = request('code');
        $city->state_id = request('state_id');
        $city->save();

        // city_translations table ////////////////////////////////////////
        foreach (Language::all() as $key => $language) {
            $city_translation = new CityTranslation;
            $city_translation->city_id = $city->id;
            $city_translation->language_id = $language->id;
            $city_translation->name = request('name')[$key];
            $city_translation->save();
        }

        return redirect('admin/cities')->with(['alert' => [
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
        $city = City::find($id);
        $languages = Language::all();
        $states = State::all();

        return view('admin.cities.edit', compact("languages", "city", 'states'));
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
        // cities table ////////////////////////////////////////
        $city = City::find($id);
        $city->code = request('code');
        $city->state_id = request('state_id');
        $city->save();

        // city_translations table ////////////////////////////////////////
        foreach (Language::all() as $key => $language) {
            $city_translation = CityTranslation::where('city_id', $city->id)
                ->where('language_id', $language->id)->first();
            $city_translation->name = request('name')[$key];
            $city_translation->save();
        }

        return redirect('admin/cities')->with(['alert' => [
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
        $city = City::find($id);
        $city->delete();
        return "deleted successfully";
    }
}
