<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Country;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeAllowedValue;
use App\Models\ProductAttributeAllowedValueTranslation;
use App\Models\ProductAttributeTranslation;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductStore;
use App\Models\ProductTranslation;
use App\Models\UserFavourite;
use App\Models\Comment;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Auth::user()->products_with_trashed;
        return view('vendor.products.index', compact("products"));
    }

    public function getCategoriesSelectOptions($category)
    {
        if ($category->hasChildren() == false)
            return "<option value='$category->id'>" . $category->translation->name . "</option>";

        $children = "";
        if ($category->translation != null)
            $children = "<option disabled>" . $category->translation->name . "</option>";
        foreach ($category->children as $child) {
            if ($child->id == $category->id)
                continue;
            $children .= $this->getCategoriesSelectOptions($child);
        }
        // if ($category->translation != null)
        //     $children .= "</optgroup>";
        return $children;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /// stores /////////////////////////////////////////////////
        $user_stores = Auth::user()->stores;

        /// categories /////////////////////////////////////////////////
        $categoriesSelectOptions = "";
        foreach (Category::whereColumn("id", "parent_id")->get() as $main_category) {
            $categoriesSelectOptions .= $this->getCategoriesSelectOptions($main_category);
        }

        /// filling the input and showing the view //////////////////////
        $input = [
            "categoriesSelectOptions" => $categoriesSelectOptions,
            "user_stores" => $user_stores,
            "languages" => Language::all(),
            "countries" => Country::all(),
        ];
        return view('vendor.products.create', $input);
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
            'name.*' => ['required', 'max:255'],
            'small_description.*' => ['required'],
            'description.*' => ['required'],
            
            "images" => ["required", "array", "min:1", "max:4"],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            
            'min_amount' => ['required','min:1'],
            
            'expire' => ['required','date','date_format:Y-m-d'],

            'stores' => ['required', "array", "min:1"],

            'price' => ['required'],

            'categories' => ['required', "array", "min:1"],

            'attribute_names.*.*' => ['required', 'max:255'],

            'allowed_values.*.*.*' => ['required', 'max:255'],
        ];
        $request->validate($rules);

        // PRODUCTS TABLE
        $product = new Product;
        $product->price = request('price');
        $product->expire_date = request('expire');
        $product->min_amount = request('min_amount');
        $product->made_in = request('made_in');
        $product->brand_id=request('brand');
        $product->save();

        // PRODUCT_TRANSLATIONS TABLE
        $all_languages = Language::all();
        foreach ($all_languages as $key => $language) {
            $product_translation = new ProductTranslation;
            $product_translation->product_id = $product->id;
            $product_translation->language_id = $language->id;
            $product_translation->name = request('name')[$key];
            $product_translation->small_description = request('small_description')[$key];
            $product_translation->description = request('description')[$key];
            $product_translation->save();
        }

        // PRODUCT_STORE TABLE
        foreach (request('stores') as $store_id) {
            $product_store = new ProductStore;
            $product_store->product_id = $product->id;
            $product_store->store_id = $store_id;
            $product_store->save();
        }

        // PRODUCT_IMAGES TABLE
        foreach (request('images') as $image) {
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path('storage/images_uploaded'), $imageName);
            $product_image = new ProductImage;
            $product_image->image_url = 'public/storage/images_uploaded/' . $imageName;
            $product_image->product_id = $product->id;
            $product_image->save();
        }

        // PRODUCT_CATEGORIES TABLE
        foreach (request('categories') as $category_id) {
            $product_category = new ProductCategory;
            $product_category->category_id = $category_id;
            $product_category->product_id = $product->id;
            $product_category->save();
        }

        // PRODUCT_ATTRIBUTES TABLE
        //   dd(request('options'));
        foreach (request('attribute_names') as $attribute_name_key => $attribute_name) {
         
            if(request('options')[$attribute_name_key]=='other'){
                $typee=3;
            }else{
                $typee=5;
            }
            $product_attribute = new ProductAttribute;
            $product_attribute->product_id = $product->id;
            $product_attribute->attribute_type_id = $typee;
            $product_attribute->save();

            // PRODUCT_ATTRIBUTE_TRANSLATIONS TABLE
            foreach ($all_languages as $language_key => $language) {
                $product_attribute_translation = new ProductAttributeTranslation;
                $product_attribute_translation->language_id = $language->id;
                $product_attribute_translation->product_attribute_id = $product_attribute->id;
                $product_attribute_translation->name = $attribute_name[$language_key];
                $product_attribute_translation->save();
            }

            // PRODUCT_ATTRIBUTE_ALLOWED_VALUES TABLE
            foreach (request('allowed_values')[$attribute_name_key] as $allowed_value) {


                $product_attribute_allowed_value = new ProductAttributeAllowedValue;
                $product_attribute_allowed_value->product_attribute_id = $product_attribute->id;
                $product_attribute_allowed_value->price = $allowed_value[count($all_languages)];
                $product_attribute_allowed_value->save();

                // PRODUCT_ATTRIBUTE_ALLOWED_VALUE_TRANSLATIONS TABLE
                foreach ($all_languages as $language_key => $language) {
                    $product_attribute_allowed_value_translation = new ProductAttributeAllowedValueTranslation;
                    $product_attribute_allowed_value_translation->product_attribute_allowed_value_id = $product_attribute_allowed_value->id;
                    $product_attribute_allowed_value_translation->language_id = $language->id;
                    $product_attribute_allowed_value_translation->value = $allowed_value[$language_key];
                    $product_attribute_allowed_value_translation->save();
                }
            }
        }

        return redirect("/vendor/products");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_favourites = UserFavourite::all();
        $user_favourite_products = array();
        foreach ($user_favourites as $user_favourite) {
            array_push($user_favourite_products, $user_favourite->product_id);
        }

        $input = array(
            "user_favourite_products" => $user_favourite_products,
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false,
            "product" => Product::find($id),
        );
        // dd(Product::find($id)->translation);
        return view('vendor.products.show', $input)->with(['alert' => [
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
        // loading this product data ///////////////////////////////////////////////
        $product = Product::withTrashed()->find($id);

        /// stores /////////////////////////////////////////////////
        $user_stores = Auth::user()->stores;
        // old stores
        $product_stores_list = [];
        foreach ($product->stores as $store)
            array_push($product_stores_list, $store->id);

        /// categories /////////////////////////////////////////////////
        $categoriesSelectOptions = "";
        foreach (Category::whereColumn("id", "parent_id")->get() as $main_category) {
            $categoriesSelectOptions .= $this->getCategoriesSelectOptions($main_category);
        }
        // old categories
        $product_categories_list = [];
        foreach ($product->categories as $category)
            array_push($product_categories_list, $category->id);

        /// filling the input and showing the view //////////////////////
        $input = [
            "categoriesSelectOptions" => $categoriesSelectOptions,
            "user_stores" => $user_stores,
            "languages" => Language::all(),
            "product" => $product,
            "product_stores_list" => $product_stores_list,
            "product_categories_list" => $product_categories_list,
            "countries" => Country::all(),
        ];
        return view('vendor.products.edit', $input);
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
            'name.*' => ['required', 'max:255'],
            'small_description.*' => ['required'],
            'description.*' => ['required'],

            "images" => ["array"],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],

            'min_amount' => ['required','min:1'],
            
            'expire' => ['required','date','date_format:Y-m-d'],

            'stores' => ['required', "array", "min:1"],

            'price' => ['required'],

            'categories' => ['required', "array", "min:1"],

            'attribute_names.*.*' => ['required', 'max:255'],

            'allowed_values.*.*.*' => ['required', 'max:255'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()->withErrors($validator->errors());
        }

        // PRODUCTS TABLE
        $product = Product::withTrashed()->find($id);
        $product->price = request('price');
        $product->expire_date = request('expire');
        $product->min_amount = request('min_amount');
        $product->made_in = request('made_in');
        $product->brand_id=request('brand');
        $product->save();

        // PRODUCT_TRANSLATIONS TABLE
        $all_languages = Language::all();
        foreach ($product->translations as $key => $product_translation) {
            $product_translation->name = request('name')[$key];
            $product_translation->small_description = request('small_description')[$key];
            $product_translation->description = request('description')[$key];
            $product_translation->save();
        }

        // PRODUCT_STORE TABLE
        // delete previous product stores
        foreach (ProductStore::where('product_id', $product->id)->get() as $product_store) {
            $product_store->delete();
        }
        // add new product stores
        foreach (request('stores') as $store_id) {
            $product_store = new ProductStore;
            $product_store->product_id = $product->id;
            $product_store->store_id = $store_id;
            $product_store->save();
        }

        // PRODUCT_IMAGES TABLE
        if (request()->hasFile('images')) {
            $product_old_images = $product->images;
            foreach (request('images') as $key => $image) {

                $imageName = time() . rand(10, 10000) . '.' . $image->extension();
                $image->move(public_path('storage/images_uploaded'), $imageName);

                if ($key >= count($product_old_images))
                    $product_image = new ProductImage;
                else {
                    $product_image = $product_old_images[$key];
                    // TODO: delete the previous image
                    // unlink()
                }
                $product_image->image_url = 'public/storage/images_uploaded/' . $imageName;
                $product_image->product_id = $product->id;
                $product_image->save();
            }
        }

        // PRODUCT_CATEGORIES TABLE
        // delete previous product categories
        foreach (ProductCategory::where('product_id', $product->id)->get() as $product_category) {
            $product_category->delete();
        }
        // add new product categories
        foreach (request('categories') as $category_id) {
            $product_category = new ProductCategory;
            $product_category->category_id = $category_id;
            $product_category->product_id = $product->id;
            $product_category->save();
        }

        // PRODUCT_ATTRIBUTES TABLE
        // delete all previous product_attributes
        foreach (ProductAttribute::where('product_id', $product->id)->get() as $product_attribute) {
            $product_attribute->delete();
        }

        // create new product_attributes
        //  dd(request('attribute_names'),request('options') );
        foreach (request('attribute_names') as $attribute_name_key => $attribute_name) {
              if(request('options')[$attribute_name_key]=='other'){
                $typee=3;
            }else{
                $typee=5;
            }
            $product_attribute = new ProductAttribute;
            $product_attribute->product_id = $product->id;
            $product_attribute->attribute_type_id = $typee;
            $product_attribute->save();

            // PRODUCT_ATTRIBUTE_TRANSLATIONS TABLE
            foreach ($all_languages as $language_key => $language) {
                $product_attribute_translation = new ProductAttributeTranslation;
                $product_attribute_translation->language_id = $language->id;
                $product_attribute_translation->product_attribute_id = $product_attribute->id;
                $product_attribute_translation->name = $attribute_name[$language_key];
                $product_attribute_translation->save();
            }

            // PRODUCT_ATTRIBUTE_ALLOWED_VALUES TABLE
            foreach (request('allowed_values')[$attribute_name_key] as $allowed_value) {


                $product_attribute_allowed_value = new ProductAttributeAllowedValue;
                $product_attribute_allowed_value->product_attribute_id = $product_attribute->id;
                $product_attribute_allowed_value->price = $allowed_value[count($all_languages)];
                $product_attribute_allowed_value->save();

                // PRODUCT_ATTRIBUTE_ALLOWED_VALUE_TRANSLATIONS TABLE
                foreach ($all_languages as $language_key => $language) {
                    $product_attribute_allowed_value_translation = new ProductAttributeAllowedValueTranslation;
                    $product_attribute_allowed_value_translation->product_attribute_allowed_value_id = $product_attribute_allowed_value->id;
                    $product_attribute_allowed_value_translation->language_id = $language->id;
                    $product_attribute_allowed_value_translation->value = $allowed_value[$language_key];
                    $product_attribute_allowed_value_translation->save();
                }
            }
        }

        return redirect("/vendor/products");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return "deleted successfully";
    }

    public function suspend($id)
    {
        $product = Product::find($id);
        foreach (Cart::where('product_id', $product->id)->get() as $cart_row) {
            $cart_row->delete();
        }
        $product->delete();
        return "suspended";
    }
    public function activate($id)
    {
        $product = Product::withTrashed()->find($id);
        $product->restore();
        return "activated";
    }

    public function changeDiscountRate($id){
        $product = Product::find($id);
        $product->discount_rate = request("discount_rate");
        $product->save();
        return true;
    }
      public function comments($id){
          $product=Product::find($id);
          $comments=$product->comments;
          return view('vendor.products.comments',compact('comments'));
    }
    public function comment_status($id){
        $comment=Comment::find($id);
        if($comment->status==1){
            $comment->status=0;
            $com="مخفى";
        }else{
            $comment->status=1;
              $com="ظاهر";
        }
        $comment->save();
        return $com;
    }
         public function reviews($id){
          $product=Product::find($id);
          $reviews=$product->reviews;
          return view('vendor.products.reviews',compact('reviews'));
       }
  
}
