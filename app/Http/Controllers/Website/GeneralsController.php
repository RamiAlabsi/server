<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Http\Request;

class GeneralsController extends Controller
{
    function getSettings(){
        $settings = [];
        foreach (Setting::all() as $settings_obj)
            $settings[$settings_obj->key] = $settings_obj->value;
        return $settings;
    }

    function about()
    {
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false,
            "settings" => $this->getSettings()
        ];
        return view('website.generals.about', $input);
    }
    function contact()
    {
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false
        ];
        return view('website.generals.contact', $input);
    }
    function faq()
    {
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false,
            "other_questions" => Faq::where("general_question", "0")->get(),
            "general_questions" => Faq::where("general_question", "1")->get()
        ];
        return view('website.generals.faq', $input);
    }
    function term_condition()
    {
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false
        ];
        return view('website.generals.term_condition', $input);
    }
}
