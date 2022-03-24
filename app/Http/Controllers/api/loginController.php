<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\api\BaseController as BaseController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
class loginController extends Controller
{    private $provider;
    private $access_token;
    private $token;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->guard = "api";
        //echo dd(auth($this->guard));
    }
 
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
          $message_ar="تم تسجيل الدخول بنجاح";
       $message_en="check your email or passwoed";
        if (!$token = auth($this->guard)->attempt($credentials)) {
            return response()->json(['status' => false,
            'message'=>"تأكد من كلمه المرور او البريد الالكترونى",
            'data'=>[],
            ], 401);
        }
        
         $user=User::where('id',auth($this->guard)->user()->id)->select('id','name','email')->first();
                
        return response()->json([
        'status'=>true,
            'message' => 'success',
            'data' =>['token'=>$token,
            'user'=>$user,
            ] 
        ], 201);
    }

    
    
     /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth($this->guard)->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth($this->guard)->logout();
      
       $message="تم تسجيل الخروج بنجاح";
       $message_en="Successfully logged out";
        return response()->json(['status'=>true,
        'message' => $message_app()->getLocale(),
        'data'=>[],
        ]
        );
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth($this->guard)->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($this->guard)->factory()->getTTL() * 60
        ]);
    }
}