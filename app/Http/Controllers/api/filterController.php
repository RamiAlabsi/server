<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Language;
use App\Models\Product;
use App\Models\Review;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\Brand;
use App\Models\ProductTranslation;
use Carbon\Carbon;
use App;
use App\Models\UserFavourite;
class filterController extends BaseController
{

    public function __construct()
    {
        //  $this->middleware('auth:api', ['except' => []]);
        $this->guard = "api";
        //echo dd(auth($this->guard));
    }
    public function filter(Request $request){
            $validator = Validator::make($request->all(), [
          'cat_id'=> 'exists:categories,id',
          'brand_id' => 'exists:brands,id',
          
        ]);
           if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
     if($request->sort){
            if($request->sort==1){
                // sort by price
            $products=Product::orderBy('price','desc')->get();
            }elseif($request->sort==2){
                //sort by rating
             $products=Product::orderBy('total_rate','desc')->get();   
            }
            elseif($request->sort==3){
                //sort by best sell
                $products=Product::orderBy('orders_cnt', 'desc')->get();
            }
              elseif($request->sort==4){
                //sort by trending
                $products=Product::orderBy('total_rate', 'desc')->get();
            }
        }else{
        $products=Product::get();
        }
        if($request['brand_id']){
            $products=$products->where('brand_id',$request['brand_id']);
        }
          if($request['cat_id']){
              $cat=Category::find($request['cat_id']);
              $product_cat=ProductCategory::where('category_id',$request['cat_id'])->pluck('product_id')->toArray();
            $products=$products->whereIn('id',$product_cat);
        }
        if($request->min_price && $request->max_price){
            $products=$products->whereBetween('price', [$request->min_price , $request->max_price]);
        }
        $productss=[];
                 foreach($products as $productt){
     
              $fav=$this->get_fav($productt->id);
            
                  $product=[
                 'id'=>$productt->id,
                 'img_url'=>url("{$productt->images[0]->image_url}"),
                 'name'=>$productt->translation->name ,
                 'description'=>$productt->translation->description ,
                 'small description'=>$productt->translation->small_description ,
                 'final price'=>$productt->final_price ,
                 'price'=>$productt->price ,
                 'discount_rate'=>$productt->discount_rate,
                 'rate'=>round($productt->total_rate),
                 'is_fav'=>$fav,
               
             ];
                  
             array_push($productss,$product);
                
           }
        
         
     
              return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>$productss
            ], 201);
       
        
    }
    //========================filter with text===================
    public function search(Request $request){
         
            $productss=[];
            if($request->search_text){
                  $product_translations = ProductTranslation::where('name', 'LIKE', "%" . $request->search_text . "%")->get();
            
                 foreach($product_translations as $product_translation){
                $productt = $product_translation->product;
              $fav=$this->get_fav($productt->id);
            
                  $product=[
                 'id'=>$productt->id,
                 'img_url'=>url("{$productt->images[0]->image_url}"),
                 'name'=>$productt->translation->name ,
                 'description'=>$productt->translation->description ,
                 'small description'=>$productt->translation->small_description ,
                 'final price'=>$productt->final_price ,
                 'price'=>$productt->price ,
                 'discount_rate'=>$productt->discount_rate,
                 'rate'=>round($productt->total_rate),
                 'is_fav'=>$fav,
               
             ];
                  
             array_push($productss,$product);
                
           }}
        
            
     
              return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>$productss
            ], 201);
    }

}