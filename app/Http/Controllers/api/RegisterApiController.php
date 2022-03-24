<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
class RegisterApiController extends BaseController
{
      public function __construct()
    {
        $this->guard = "api";
    }
    public function register(Request $request)
    {
        
       $today = Carbon::today();
        $validator = Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'email'=> 'required|email|unique:users',
          'password' => 'required|min:6|confirmed',
          'country'=>'required'
          
        ]);
        if($validator->fails())
        {
            $errorarr = array();
            return $this->sendError($errorarr, $validator->errors([0]));
        }
          $user = new User;
          $user->name = $request['name'];
          $user->email=$request['email'];
          $user->password=Hash::make($request['password']);
          $user->country=$request['country'];
           $user->save();
          $credentials = request(['email', 'password']);
         $token = auth($this->guard)->attempt($credentials);
        return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>['token'=>$token,
            'user'=>$user,
            ]
        ], 201);
    }
}