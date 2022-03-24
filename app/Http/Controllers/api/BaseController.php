<?php


namespace App\Http\Controllers\api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Auth;
use App\Models\UserFavourite;
class BaseController extends Controller
{
    
      public function __construct()
    {
        
        $this->guard = "api";
      
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'status' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 200)
    {
    	$response = [
            'status' => false,
        ];

        if(!empty($errorMessages)){
            $response['message'] = $errorMessages->first();
        }

        return response()->json($response, $code);
    }
     public function get_fav($product_id){
        if(Auth::guard('api')->check()){
            $x=Auth::guard('api')->user();
            $fav=UserFavourite::where('product_id',$product_id)->where('user_id',Auth::guard('api')->user()->id)->first();
            if($fav !=null){
                $fav=1;
            }
            else{
                $fav=0;
            }
        }else{
            $fav=0;
        }
        return $fav;
    }
}