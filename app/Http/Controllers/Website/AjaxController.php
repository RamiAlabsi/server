<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartAttributeSelection;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\UserFavourite;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function getProducts(Request $request)
    {
        /*
        request data:
            1. category_id
            2. category_id & discount_rate
            3. category_id & search_text
            4. pagination
            5. sortBy
        */

        $products = Product::all();

        ///////////////////////// IF THE USER IS SEARCHING WITH TEXT //////////////////////
        if ($request->search_text != null) {
            $product_translations = ProductTranslation::where('name', 'LIKE', "%" . request()->search_text . "%")->get();
            $category_id = request()->category_id;
            $products = [];
            if ($category_id != 0) {
                foreach ($product_translations as $key => $product_translation) {
                    $product = $product_translation->product;
                    if (in_array($category_id, $product->category_ids))
                        array_push($products, $product);
                }
            } else {
                foreach ($product_translations as $product_translation) {
                    array_push($products, $product_translation->product);
                }
            }
            $products = new Collection($products);
        } elseif ($request->discount_rate != null) {
            $category_id = request('category_id');
            $discount_rate = request('discount_rate');

            $products = [];
            $candidate_products = Product::where('discount_rate', '>=', $discount_rate)->get();
            foreach ($candidate_products as $key => $product) {
                if (in_array($category_id, $product->category_ids))
                    array_push($products, $product);
            }
            $products = new Collection($products);
        } elseif ($request->category_id != null) {
            $category = Category::find(request('category_id'));
            $products = $category == null ? new Collection([]) : $category->products;
        }

        //////////////////////////////// APPLYING PAGINATION AND SORTING /////////////////////////////////////
        $pagination = intval(request('pagination'));
        $sortBy = request('sortBy');
        $pages_cnt = intval(ceil(count($products) / $pagination));
        $page_num = request('page_num');

        $page_end = $page_num * $pagination;
        $page_st = $page_end - $pagination;

        if ($sortBy == 'default')
            $products = $products
                ->splice($page_st, $page_end);
        else if ($sortBy == 'date')
            $products = $products
                ->sortBy([['created_at', 'desc']])
                ->splice($page_st, $page_end);
        else if ($sortBy == 'price_asc')
            $products = $products
                ->sortBy([['price', 'asc']])
                ->splice($page_st, $page_end);
        else if ($sortBy == 'price_desc')
            $products = $products
                ->sortBy([['price', 'desc']])
                ->splice($page_st, $page_end);

        $user_favourites = UserFavourite::all();
        $user_favourite_products = array();
        foreach ($user_favourites as $user_favourite) {
            array_push($user_favourite_products, $user_favourite->product_id);
        }

        $input = array(
            "user_favourite_products" => $user_favourite_products,
            "products" => $products,
            "pages_cnt" => $pages_cnt,
            "page_num" => $page_num,
        );

        // return Auth::user()->id;

        return view('website.products.index_products_list', $input);
    }

    public function getCart()
    {
        $cart_items = Cart::where('user_id', Auth::user()->id)->get();
        $cart_total_price = 0;

        foreach ($cart_items as $cart_item) {
            $product = $cart_item->product;
            $cart_total_price += $product->price * $cart_item->quantity;
        }

        $data = [
            "htmlData" => view('website.shopping.cart_products_list', compact("cart_items"))->render(),
            "cart_total_price" =>  $cart_total_price
        ];
        // response()->json($result)
        return $data;
    }

    public function toggleCart()
    {
        $product = Product::find(request('product_id'));
        $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();
        if ($cart == null) {
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $product->id;
            $cart->quantity = request('quantity');
            $cart->save();

            ////////////// Try This Tommorow ///////////////////////////////////
            foreach ($product->attributes as $key => $attribute) {
                $cart_attribute_selection = new CartAttributeSelection;
                $cart_attribute_selection->cart_id = $cart->id;
                $cart_attribute_selection->product_attribute_allowed_value_id = request('attribute_values')[$key];
                $cart_attribute_selection->save();
            }
            //////////////////////////////////////////////////////////////////////

            return "added to cart";
        } else {
            $cart->delete();
            return "removed from cart";
        }
    }

    public function toggleFavorite()
    {
        $user = Auth::user();
        $product_id = request('product_id');
        if ($user == null)
            return "not_signed_in";

        $user_favourite = UserFavourite::where('user_id', $user->id)
            ->where('product_id', $product_id)
            ->first();
        if ($user_favourite != null) {
            $user_favourite->delete();
            return "removed_fav";
        }
        $user_favourite = new UserFavourite;
        $user_favourite->timestamps = false;
        $user_favourite->user_id = $user->id;
        $user_favourite->product_id = $product_id;
        $user_favourite->save();
        return "added_to_fav";
    }

    public function loadFavourites()
    {
        $user_favourites = UserFavourite::where('user_id', Auth::user()->id)->get();
        return view('website.shopping.wishlist_list', compact("user_favourites"));
    }
}
