<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $brands=Brand::get();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $image = $request['logo'];
        $image_name = time() . rand(10, 10000) . '.' . $image->extension();
        $image->move(public_path('storage/images_uploaded'), $image_name);
        $logo = 'public/storage/images_uploaded/' . $image_name;
      
        $brand=Brand::create([
            'name'=>$request['name'],
            'url'=>$request['url'],
            'logo'=>$logo,
        ]);
        return redirect('admin/brands')->with(['alert' => [
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
        $brand=Brand::find($id);
        $brand->update([
            'name'=>$request['name'],
            'url'=>$request['url'],
            
        ]);
        if($request['logo']){
            $image = $request['logo'];
            $image_name = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path('storage/images_uploaded'), $image_name);
            $logo = 'public/storage/images_uploaded/' . $image_name;
            $brand->logo=$logo;
            $brand->save();
            }

        return redirect('admin/brands')->with(['alert' => [
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
        $brand =Brand::find($id)->delete();
       
        return "deleted successfully";
    }
}
