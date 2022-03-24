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
use Carbon\Carbon;
use App;
use App\Models\UserFavourite;
use App\Models\UserAddresses;
class userController extends BaseController
{

    public function __construct()
    {
         $this->middleware('auth:api', ['except' => []]);
        $this->guard = "api";
        //echo dd(auth($this->guard));
    }
    
    public function profile(){
        $user=auth($this->guard)->user();
         $userr=[
         'id'=>$user->id,
         'name'=>$user->name,
         'email'=>$user->email,
         'country'=>$user->country?$user->Country->translation->name:'',
         ];
    
            return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>[
            'mainInfo'=>$userr,
            'addresses'=>auth($this->guard)->user()->addresses,
            ],
        ], 201);
    }
    
    //==================================user orders=======================
    
    public function userOrder(){
        $user=auth($this->guard)->user();
             $orders=[];
         foreach($user->orders as $order){
            $items=[];
            
            foreach($order->items as $item){
                $itemm=[
                'id'=>$item->id,
                'status'=>$item->status->translation->name ,
                'item'=>$item->translation->html
                ];
                array_push($items,$itemm);
            }
            $orderr=[
            'id'=>$order->id,
            'status'=>$order->status,
            'total'=>$order->total,
            "paid"=>$order->paid,
            "first_name"=> $order->first_name,
            "last_name"=>$order->last_name,
            "company_name"=> $order->company_name,
            "city_id"=> $order->city_id,
            "address"=>$order->address,
            "postcode"=> $order->postcode,
            "phone"=> $order->phone,
            "email"=>$order->email,
            "notes"=>$order->notes,
            "items"=>$items,
            ];
            array_push($orders,$orderr);
         }
         return response()->json([
         'status'=>true,
            'message' => 'success',
            'data' =>$orders,
        ], 201);
        
    }
    
    
    //==================================user update profile================
    public function update_profile(request $request){
         $user = auth($this->guard)->user();
        $validator = Validator::make($request->all(),[
            "new_name" => ["required"],
            "new_email" => ["required", "unique:users,email, " . auth($this->guard)->user()->id],
            "current_pass" => ["required"],
            "new_pass"=>["nullable", "min:8"]
        ]);
          if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
        if (Hash::check($request->current_pass, $user->password) == false) {
        return response()->json([
        'status'=>false,
            'message' => __("lang.wrong_password"),
         
        ], 201);
           
        }
        $user->name = $request->new_name;
        $user->email = $request->new_email;
        if(request()->filled('new_pass')){
            $user->password = Hash::make($request->new_pass);
        }
        $user->save();
          return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>['name'=>$user->name,'email'=>$user->email,'password'=>$user->password],
        ], 201);
    }
    //=============================user address========================================
    public function user_addresses(Request $request){
        $validator = Validator::make($request->all(),[
            "firstName" => ["required"],
            "lastName" => ["required"],
            "country" => ["required","exists:countries,id"],
            "state"=>["required","exists:states,id"],
            "city"=>["required","exists:cities,id"],
            "street"=>["required"],
            "location_type"=>["required"],
            "mobile"=>["required"],
        ]);
          if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
        $address=UserAddresses::create([
        'user_id'=>auth($this->guard)->user()->id,
        'firstName'=>$request['firstName'],
        'lastName'=>$request['lastName'],
        'city_id'=>$request['city'],
        'street'=>$request['street'],
        'building'=>$request['building'],
        'floor'=>$request['floor'],
        'Apartment'=>$request['Apartment'],
        'nearest landMark'=>$request['nearest landMark'],
        'location_type'=>$request['location_type'],
        'mobile'=>$request['mobile'],
        'landing_number'=>$request['landing_number'],
        'notes'=>$request['notes'],
        ]);
         return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>auth($this->guard)->user()->addresses,
        ], 201);
    }
    
public function edit_address(Request $request){
    $validator = Validator::make($request->all(),[
          "address_id"=>["required","exists:user_address,id"],
            "firstName" => ["required"],
            "lastName" => ["required"],
            "country" => ["required","exists:countries,id"],
            "state"=>["required","exists:states,id"],
            "city"=>["required","exists:cities,id"],
            "street"=>["required"],
            "location_type"=>["required"],
            "mobile"=>["required"],
          
        ]);
          if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
        $address=UserAddresses::find($request['address_id']);
        if($address->user_id==auth($this->guard)->user()->id){
        $address->update([
        'firstName'=>$request['firstName'],
        'lastName'=>$request['lastName'],
        'city_id'=>$request['city'],
        'street'=>$request['street'],
        'building'=>$request['building'],
        'floor'=>$request['floor'],
        'Apartment'=>$request['Apartment'],
        'nearest landMark'=>$request['nearest landMark'],
        'location_type'=>$request['location_type'],
        'mobile'=>$request['mobile'],
        'landing_number'=>$request['landing_number'],
        'notes'=>$request['notes'],
        ]);}else{
                return response()->json([
        'status'=>false,
            'message' => 'error',
            'data' =>auth($this->guard)->user()->addresses,
        ], 201);
        }
         return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>auth($this->guard)->user()->addresses,
        ], 201);
      }
      public function wishlist(){
          $products=[];
          
       foreach(auth($this->guard)->user()->Fav as $fav){
           if($fav->product){
           $p=[
               'product_id'=>$fav->product->id,
              'img_url'=>url("{$fav->product->images[0]->image_url}"),
                 'product_name'=>$fav->product->translation->name ,
                 'created_at'=>$fav->product->created_at
               ];
               array_push($products,$p);
           }
       }
         
            return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>$products,
        ], 201);
          
        //   return ;
      }
}

