<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqTranslation;
use App\Models\Language;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        return view('admin.faq.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faq = new Faq;
        $faq->general_question = $request->general_question;
        $faq->save();

        foreach (Language::all() as $key => $language) {
            $faq_translation = new FaqTranslation;
            $faq_translation->faq_id = $faq->id;
            $faq_translation->question = $request->question[$key];
            $faq_translation->answer = $request->answer[$key];
            $faq_translation->language_id = $language->id;
            $faq_translation->save();
        }

        return redirect('admin/faq')->with(['alert' => [
            'icon' => 'success',
            'title' => __('lang.alert_congrats'),
            'text' => __('lang.alert_success')
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
        $faq = Faq::find($id);
        $languages = Language::all();
        return view('admin.faq.edit', compact('languages', 'faq'));
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
        $faq = Faq::find($id);
        $faq->general_question = $request->general_question;
        $faq->save();

        foreach (Language::all() as $key => $language) {
            $faq_translation = FaqTranslation::where('language_id', $language->id)
                ->where('faq_id', $faq->id)->get()[0];
            $faq_translation->question = $request->question[$key];
            $faq_translation->answer = $request->answer[$key];
            $faq_translation->save();
        }

        return redirect('admin/faq')->with(['alert' => [
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
        $faq = Faq::find($id);
        $faq->delete();
        return true;
    }
}
