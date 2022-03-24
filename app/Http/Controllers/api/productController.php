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
use App\Models\Brand;
use App\Models\Cart;
use Carbon\Carbon;
use App;
use App\Models\UserFavourite;
class productController extends BaseController
{

    public function __construct()
    {
         $this->middleware('auth:api', ['except' => ['single_product','product_category','brand_product']]);
        $this->guard = "api";
        //echo dd(auth($this->guard));
    }

   //============================add commments========================
   public function addComments(Request $request){
        $validator = Validator::make($request->all(), [
          'comment' => 'required|string|max:255',
          'parent_id'=> 'exists:product_comments,id',
          'product_id' => 'required|exists:products,id',
           
          
        ]);
        if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
        $comment=Comment::create([
        'comment'=>$request['comment'],
        'parent_id'=>$request['parent_id'],
        'product_id'=>$request['product_id'],
        'user_id'=>auth($this->guard)->user()->id,
        ]);
        $product=Product::find($request['product_id']);
        $fav=$this->get_fav($product->id);
        $productt=[
                 'id'=>$product->id,
                 'img_url'=>url("{$product->images[0]->image_url}"),
                 'name'=>$product->translation->name ,
                 'final price'=>$product->final_price ,
                 'rate'=>round($product->total_rate),
                 'is_fav'=>$fav,
                 'images'=>$product->images,
                 'comments'=>$product->comments,
             ];
       
         return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>$productt,
        ], 201);
   }
   
   //=====================================single product====================================
   public function single_product(Request $request){
       $validator = Validator::make($request->all(), [
          'product_id' => 'required|exists:products,id',         
        ]);
        if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
        $id=$request['product_id'];
        $productt=Product::find($id);
    
           $fav=$this->get_fav($id);
              if (Auth::guard('api')->check()){
            $cart_item = Cart::where('user_id',Auth::guard('api')->user()->id)->where('product_id', $productt->id)->first();
                }else{
                    $cart_item=null;
                }
          $attributess=[];
           foreach($productt->attributes as $attr){
                $selected_allowed_value_id = $cart_item == null? 0 :
                            $cart_item->attribute_selections[$key]->selected_attribute_allowed_value->id;
                            $allows=[];
            foreach($attr->allowed_values as $allow){
                   $allowed=[
                   'id'=>$allow->id,
                   'value'=>$allow->translation->value,
                     'price'=>$allow->price,
                   
                   ];
                   array_push($allows,$allowed);
                   }  
             
            
            $att=[
            'id'=>$attr->id,
            'name'=>$attr->translation->name,
             'type'=>$attr->attribute_type->html_tag_name,
            'allowed values'=>$allows,
           
            ];
            array_push($attributess,$att);
           }
           //---------product comment----------
           $comments=[];
           foreach($productt->comments->where('parent_id',null) as $comment){
            $childs=[];
            foreach($comment->child as $childComment){
                            $childd=[
            'id'=>$childComment->id,
            'user_id'=>$childComment->user->id,
            'username'=>$childComment->user->name,
            'comment'=>$childComment->comment,
             'created_at'=>$childComment->created_at,
            ];
            array_push($childs,$childd);
            }
            $commentt=[
            'id'=>$comment->id,
            'user_id'=>$comment->user->id,
            'username'=>$comment->user->name,
            'comment'=>$comment->comment,
            'created_at'=>$comment->created_at,
            'child'=>$childs,
            ];
            array_push($comments,$commentt);
           }
           
           //------------reviews-------------------
           $reviews=[];
           
           foreach($productt->reviews as $review){
            $rr=[
            'id'=>$review->id,
            'user_id'=>$review->user_id,
            'username'=>$review->user->name,
            'rate'=>$review->rate,
            'text'=>$review->text,
            'created_at'=>$review->created_at,
            ];
            array_push($reviews,$rr);
           }
              if($productt->min_amount==null){
                        $min_amount=0;
                    }else{
                        $min_amount=$productt->min_amount;
                    }
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
                 'images'=>$productt->images,
                 'comments'=>$comments,
                 'reviews'=>$reviews,
                 'attribute'=>$attributess,
                   'count'=>$min_amount,
                 'type'=>'best',
             ];
             return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>$product,
        ], 201);
   }
   
   //======================add review=================
     public function leaveReview(Request $request)
    {
         $validator = Validator::make($request->all(), [
          'product_id' => 'required|exists:products,id',         
        ]);
        if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
        $product_id=$request['product_id'];
        $user =Auth::guard('api')->user();
        if ($user == null || Product::find($product_id) == null)
            return;
$review=Review::where('user_id', $user->id)->where('product_id', $product_id)->first();
if($review){
      $review->product_id = $product_id;
        $review->user_id = $user->id;
        $review->text = $request['text'];
        $review->rate = $request['rating'];
        $review->save();
}else{
       $review = new Review;
        $review->product_id = $product_id;
        $review->user_id = $user->id;
        $review->text = $request['text'];
        $review->rate = $request['rating'];
        $review->save();
}
     
        return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>$review,
        ], 201);
    }
    //=====================fav product==============================
        public function toggleFavorite(Request $request)
    {
        
           $validator = Validator::make($request->all(), [
          'product_id' => 'required|exists:products,id',         
        ]);
        if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
        $user = Auth::guard('api')->user();
      //
        if ($user == null)
                   return response()->json([
        'status'=>false,
            'message' => 'error',
            'data' =>0,
        ], 201);
          $product_id=$request['product_id'];
        $user_favourite = UserFavourite::where('user_id', $user->id)
            ->where('product_id', $product_id)
            ->first();
        if ($user_favourite != null) {
            $user_favourite->delete();
             return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>0,
        ], 201);
        }
        $user_favourite = new UserFavourite;
        $user_favourite->timestamps = false;
        $user_favourite->user_id = $user->id;
        $user_favourite->product_id = $product_id;
        $user_favourite->save();
         return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>1,
        ], 201);
    }
    //=======================category products=========================
    public function product_category(Request $request){
           $validator = Validator::make($request->all(), [
          'cat_id' => 'required|exists:categories,id',         
        ]);
        if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
        $catt=Category::find($request['cat_id']);
        $cats_product=[];
        if(!empty($cat->children)){
        foreach($catt->children as $cat){
                    $products=[];
           foreach($cat->products as $productt){
              $fav=$this->get_fav($productt->id);
               if($product->min_amount==null){
                        $min_amount=0;
                    }else{
                        $min_amount=$productt->min_amount;
                    }
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
                 'count'=>$min_amount,
                 'type'=>'best',
               
             ];
             array_push($products,$product);
           }
           array_push($cats_product,[
               'id'=>$cat->id,
               'name'=>$cat->translation->name,
               'img'=>url($cat->image_url),
               'products'=>$products,
               ]);
        }}
        else{
          $products=[];
            foreach($catt->products as $productt){
              $fav=$this->get_fav($productt->id);
               if($productt->min_amount==null){
                        $min_amount=0;
                    }else{
                        $min_amount=$productt->min_amount;
                    }
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
                   'count'=>$min_amount,
                 'type'=>'best',
               
             ];
             array_push($products,$product);
           }
               array_push($cats_product,[
               'id'=>$catt->id,
               'name'=>$catt->translation->name,
               'img'=>url($catt->image_url),
               'products'=>$products,
               ]);
        }
              return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>$cats_product,
        ], 201);
    }
    
    public function brand_product(Request $request){
         $validator = Validator::make($request->all(), [
          'brand_id' => 'required|exists:brands,id',         
        ]);
        if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
        $brand=Brand::find($request['brand_id']);

          $products=[];
        if(!empty($brand->products)){
            foreach($brand->products as $productt){
     
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
                  
             array_push($products,$product);
                
           }
        }
         
     
              return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>[     'id'=>$brand->id,
               'name'=>$brand->name,
               'url'=>$brand->url,
               'img'=>url($brand->logo),
               'products'=>$products,],
        ], 201);
    }
}