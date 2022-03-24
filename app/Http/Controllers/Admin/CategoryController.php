<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\CategorySale;
use App\Models\CategoryTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        foreach ($categories as $key => $one_category)
            if ($one_category->hasParent())
                unset($categories[$key]);
        $category = null;
        $icons = self::$icons;
        return view('admin.categories.index', compact('categories', 'category','icons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $categories = $category->children;
        return view('admin.categories.index', compact('category', 'categories'));
    }

    public function create($level_category_id)
    {
        $languages = Language::all();
        $categories = Category::all();
        $icons = self::$icons;
        return view(
            'admin.categories.create',
            compact(
                "languages",
                "categories",
                'level_category_id','icons'
            )
        );
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
            'parent_category_id' => ['required'],
            'name.*' => ['required', 'max:254'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'special'=>['required'],
        ];
        $request->validate($rules);

        // categories table ////////////////////////////////////////
        $category = new Category;
        $category->special=$request['special'];
        $category->icon=$request['icon'];
        $parent_category_id = request('parent_category_id');
        if ($parent_category_id == 0) {
            // making the parent id = self_id if we are in the main category
            $statement = DB::select("SHOW TABLE STATUS LIKE 'categories'");
            $nextID = $statement[0]->Auto_increment;
            $category->parent_id = $nextID;
        } else
            $category->parent_id = $parent_category_id;

        $image = request('image');
        $image_name = time() . rand(10, 10000) . '.' . $image->extension();
        $image->move(public_path('storage/images_uploaded'), $image_name);
        $category->image_url = 'public/storage/images_uploaded/' . $image_name;

        $category->save();

        // category_translations table ////////////////////////////////////////
        foreach (Language::all() as $key => $language) {
            $category_translation = new CategoryTranslation;
            $category_translation->category_id = $category->id;
            $category_translation->language_id = $language->id;
            $category_translation->name = request('name')[$key];
            $category_translation->save();
        }

        return redirect('admin/categories')->with(['alert' => [
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
        $category = Category::find($id);
        $languages = Language::all();
        $all_categories = Category::all();
        $icons = self::$icons;
        return view('admin.categories.edit', compact(
            "category",
            "languages",
            "all_categories","icons"
        ));
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
        $rules = [
            'name.*' => ['required', 'max:254'],
            'image' => ['required', 'mimes:jpg,jpeg,png,svg,gif', 'max:2048'],
            'special'=>['required'],
        ];
        $request->validate($rules);
        // categories table ////////////////////////////////////////
        $category = Category::find($id);
        $category->special=$request['special'];
        $category->icon=$request['icon'];
        $image = request('image');
        $image_name = time() . rand(10, 10000) . '.' . $image->extension();
        $image->move(public_path('storage/images_uploaded'), $image_name);
        $category->image_url = 'public/storage/images_uploaded/' . $image_name;

        $category->save();

        // category_translations table ////////////////////////////////////////
        foreach (Language::all() as $key => $language) {
            $category_translation = CategoryTranslation::where('category_id', $category->id)
                ->where('language_id', $language->id)->first();
            $category_translation->name = request('name')[$key];
            $category_translation->save();
        }

        return redirect('admin/categories')->with(['alert' => [
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
        $category = Category::find($id);
        $category->delete();
        return "deleted successfully";
    }

    private static $icons = [
        "fad fa-female",
        "fad fa-male",
        "fal fa-phone",
        "fal fa-envelope",
        "fab fa-linkedin-in",
        "fab fa-facebook-f",
        "fab fa-twitter",
        "fab fa-instagram",
        "fab fa-snapchat-ghost",
        "fab fa-youtube",
        "fal fa-envelope",
    ];
}
