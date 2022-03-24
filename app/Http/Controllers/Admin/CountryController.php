<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CountryTranslation;
use App\Models\Language;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('admin.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();

        return view('admin.countries.create', compact("languages"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        


        // countries table ////////////////////////////////////////
        $country = new Country;
        $country->code = request('code');
        $country->iso = request('iso');
        $country->save();

        // country_translations table ////////////////////////////////////////
        foreach (Language::all() as $key => $language) {
            $country_translation = new CountryTranslation;
            $country_translation->country_id = $country->id;
            $country_translation->language_id = $language->id;
            $country_translation->name = request('name')[$key];
            $country_translation->save();
        }

        return redirect('admin/countries')->with(['alert' => [
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
        $country = Country::find($id);
        $languages = Language::all();

        return view('admin.countries.edit', compact("languages", "country"));
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
        // countries table ////////////////////////////////////////
        $country = Country::find($id);
        $country->code = request('code');
        $country->iso = request('iso');
        $country->save();

        // country_translations table ////////////////////////////////////////
        foreach (Language::all() as $key => $language) {
            $country_translation = CountryTranslation::where('country_id', $country->id)
                ->where('language_id', $language->id)->first();
            $country_translation->name = request('name')[$key];
            $country_translation->save();
        }

        return redirect('admin/countries')->with(['alert' => [
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
        $country = Country::find($id);
        $country->delete();
        return "deleted successfully";
    }
}
