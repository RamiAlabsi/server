<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySale;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\newsletter;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    function getSettings()
    {
        $settings = [];
        foreach (Setting::all() as $settings_obj)
            $settings[$settings_obj->key] = $settings_obj->value;
        return $settings;
    }

    function index()
    {
        ///////////////////////////////// INITIALIZING BLADE INPUT DATA ///////////////////////////////////////
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false
        ];

        ///////////////////////////////////////// CATEGORY SALES ///////////////////////////////////////////////
        // controlling the category sales section
        $category_sales_cnt = count(CategorySale::all());

        $index_sale_categories_section_on = Setting::where('key', 'index_sale_categories_section_on')->first();
        if ($category_sales_cnt < 4) {
            $index_sale_categories_section_on->value = 0;
        } else {
            $index_sale_categories_section_on->value = 1;
            $category_sales = CategorySale::orderBy("updated_at", "desc")->paginate(10);
            $input["category_sales"] = $category_sales;
        }
        $index_sale_categories_section_on->save();
        // controlling the category sales main banner in the top of the page
        $index_sale_categories_main_on = Setting::where('key', 'index_sale_categories_main_on')->first();
        if ($category_sales_cnt < 1) {
            $index_sale_categories_main_on->value = 0;
        } else {
            $index_sale_categories_main_on->value = 1;
            $latest_updated_category_sale = CategorySale::latest("updated_at")->first();
            $input["latest_updated_category_sale"] = $latest_updated_category_sale;
        }
        $index_sale_categories_main_on->save();

        ///////////////////////////////////////// CATEGORIES ///////////////////////////////////////////////
        $categories_cnt = count(Category::all());

        // loading the last updated category from the last updated product
        $index_category_section_on = Setting::where('key', 'index_category_section_on')->first();
        if ($categories_cnt < 1) {
            $index_category_section_on->value = 0;
        } else {
            $index_category_section_on->value = 1;
            $latest_updated_product = Product::latest('updated_at')->first();
            $latest_updated_product != null ? $input["last_updated_category"] = $latest_updated_product->categories[0] : $input["last_updated_category"] = null ;
        }
        $index_category_section_on->save();

        //loading the last updated 8 categories from the last updated products
        $index_categories_section_on = Setting::where('key', 'index_categories_section_on')->first();
        if ($categories_cnt < 4) {
            $index_categories_section_on->value = 0;
        } else {
            $index_categories_section_on->value = 1;

            $last_updated_categories = [];
            $products = Product::orderBy('updated_at', 'desc')->get();
            foreach ($products as $product) {
                foreach ($product->categories as $category) {
                    $last_updated_categories["$category->id"] = $category;
                }
                if (count($last_updated_categories) >= 8)
                    break;
            }
            $input["last_updated_categories"] = $last_updated_categories;
        }
        $index_categories_section_on->save();

        //////////////////////////////// LOADING THE NEWEST 5 PRODUCTS ///////////////////////////////////////
        $newest_products = Product::orderBy('created_at', 'desc')->paginate(5);
        $input["newest_products"] = $newest_products;

        ////////////////////////////////// LOADING WEBSITE SETTINGS ////////////////////////////////////////
        $input["settings"] = $this->getSettings();

        ////////////////////////////////// OFFERS OF TODAY ////////////////////////////////////////
        $yesterday = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d") - 1, date("Y")));
        $today = date('Y-m-d H:i:s');
        $today_offers_list = Product::whereBetween('updated_at', [$yesterday, $today])->where('discount_rate', '>', 0)->paginate(3);
        $input["today_offers_list"] = $today_offers_list;
        
        ////////////////////////////////// BEST SELLER ////////////////////////////////////////
        $best_seller_list = Product::orderBy('orders_cnt', 'desc')->paginate(8);
        $input["best_seller_list"] = $best_seller_list;
         $input["main"]=1;
        ///////////////////////////////////// RETURNING THE VIEW ////////////////////////////////////////////
        return view('website.index', $input);
    }
    function error()
    {
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false
        ];
        return view('website.generals.404', $input);
    }
    function blog()
    {
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false
        ];
        return view('website.blog', $input);
    } //"{{ URL::to('/') }}/image
    function my_account()
    {
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false
        ];
        return view('website.my_account', $input);
    }
    public function orders_show($id)
    {
        $order = Order::find($id);
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false,
            "order" => $order
        ];
        return view('website.orders.show', $input);
    }
    function wishlist()
    {
        $input = [
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false
        ];
        return view('website.shopping.wishlist', $input);
    }
    function chat()
    {
        return view('website.chat');
    }


    public function subscripe_newsletter(Request $request){
     
        newsletter::create([
            'email'=>$request['email']
        ]);
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' => __('lang.alert_congrats'),
            'text' => __('lang.alert_success')
        ]]);
    }
}
