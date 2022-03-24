<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySale;
use Illuminate\Http\Request;

class CategorySaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_sales = CategorySale::all();
        $categories = Category::all();
        return view('admin.category_sales.index', compact('category_sales', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.category_sales.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id' => ['required'],
            'discount_rate' => ['required']
        ];
        $request->validate($rules);

        $category_sale = new CategorySale;
        $category_sale->category_id =  intval(request('category_id'));
        $category_sale->discount_rate =  intval(request('discount_rate'));

        $category_sale->save();
        return redirect('admin/category_sales')->with(['alert' => [
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
        $category_sale = CategorySale::find($id);
        $categories = Category::all();
        return view('admin.category_sales.edit', compact('categories', 'category_sale'));
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
        $category_sale = CategorySale::find($id);

        if (request('category_id') != null)
            $category_sale->category_id =  intval(request('category_id'));
        if (request('discount_rate') != null)
            $category_sale->discount_rate =  intval(request('discount_rate'));

        $category_sale->save();

        return "updated successfully";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category_sale = CategorySale::find($id);
        $category_sale->delete();
        return "deleted successfully";
    }
}
