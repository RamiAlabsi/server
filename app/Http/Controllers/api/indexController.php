<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Category;
use App\Models\Country;
use App\Models\Language;
use App\Models\Product;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Setting;
use Carbon\Carbon;
use App;
use App\Models\UserFavourite;
class indexController extends BaseController
{

    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
        $this->guard = "api";
        //echo dd(auth($this->guard));
    }
// ==================get language==================
public function language(){
    $langs=[];
 $langs=  Language::all();
 return response()->json([
    'status'=>true,
        'message' => 'success',
        'data' =>$langs
    ], 200);
}

// ===================get countries=================
     public function countries(){
        $countries= Country::get();
        $coun=[];
        foreach($countries as $country){
            $states=[];
            foreach($country->states as $state){
                $cities=[];
                foreach($state->cities as $city){
                    $cityy=[
                    'id'=>$state->id,
                'name'=>$state->translation->name,
                'code'=>$state->code,
                    ];
                    array_push($cities,$cityy);
                }
                $state=[
                'id'=>$state->id,
                'name'=>$state->translation->name,
                'code'=>$state->code,
                'cities'=>$cities,
                ];
                array_push($states,$state);
            }
            array_push($coun,['id'=>$country->id,'name'=>$country->translation->name,'code'=>$country->code,'iso'=>$country->iso,'state'=>$states]);
        }
        return response()->json([
            'status'=>true,
                'message' => 'success',
                'data' =>$coun,
            ], 200);
     }
    public function index(Request $request){
        // ============get category==============
           $cats=Category::get();
           $catt=[];
           foreach($cats->where('special',0) as $cat){
               array_push($catt,['id'=>$cat->id,'name'=>$cat->translation->name,'img'=>url($cat->image_url)]);
           }
           $special=[];
           $i=0;
           foreach($cats->where('special',1) as $cat){
               $i+=1;
            array_push($special,['id'=>$cat->id,'name'=>$cat->translation->name,'img'=>url($cat->image_url),'sort'=>$i]);
        }
        
    //    ============brands==================
    $brands=Brand::get();
    
    //   ===========country===================
    $country=Country::where('iso',$request->header('country'))->first();  
      
        
        // ============get best seller=============
      
        $best_seller_list = Product::orderBy('orders_cnt', 'desc')->get();   
        $best_sell=[];
         foreach($best_seller_list as $product){
             
            $fav=$this->get_fav($product->id);
            if($request->header('country')){
                if( $product->stores[0]->country_id==$country->id){
                    if($product->min_amount==null){
                        $min_amount=0;
                    }else{
                        $min_amount=$product->min_amount;
                    }
             $bestt=[
                 'id'=>$product->id,
                 'img_url'=>url("{$product->images[0]->image_url}"),
                 'name'=>$product->translation->name ,
                 'final price'=>$product->final_price ,
                 'rate'=>round($product->total_rate),
                 'is_fav'=>$fav,
                 'store'=>$product->stores[0]->id,
                 'count'=>$min_amount,
                 'type'=>'best',
             ];
             array_push($best_sell,$bestt);
            }
        }
         }
             // ============get trending product (products where rate >=4)=============
        $trending = Product::orderBy('total_rate','desc')->get();
        $trend_product=[];
         foreach($trending as $trend){
            if($request->header('country')){
                if( $product->stores[0]->country_id==$country->id){
                    
             if(round($trend->total_rate)>=4){
                if($product->min_amount==null){
                    $min_amount=0;
                }else{
                    $min_amount=$product->min_amount;
                }
            $fav=$this->get_fav($trend->id);
             $bestt2=[
                 'id'=>$trend->id,
                 'img_url'=>url("{$trend->images[0]->image_url}"),
                 'name'=>$trend->translation->name ,
                 'final price'=>$trend->final_price ,
                 'rate'=>round($trend->total_rate),
                 'is_fav'=>$fav,
                 'store'=>$product->stores[0]->id,
                 'count'=>$min_amount,
                 'type'=>'trend',
             ];
             array_push($trend_product,$bestt2);
            }
        }
    }
         }

        
    

           return response()->json([
            'status'=>true,
                'message' => 'success',
                'data' =>[
                    'category'=>$catt,
                    'special_category'=>$special,
                    'brands'=>$brands,
                    'best_seller'=>$best_sell,
                    'trend'=>$trend_product,
                ],
            ], 201);
    }
    //---------------------setting-------------------------
    public function setting(){
        $settings = [];
        foreach (Setting::all() as $settings_obj)
            $settings[$settings_obj->key] = $settings_obj->value;
     return response()->json([
            'status'=>true,
                'message' => 'success',
                'data' =>$settings,
            ], 200);
    }
   
}