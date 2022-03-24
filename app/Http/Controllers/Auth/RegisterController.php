<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Notifications\InvoiceNewVendor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        if($data['register_as_vendor'] == 1){
            $validate =  \Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'checkbox' => ['required', 'in:1'],
                'corporate_name' => ['required', 'string', 'max:199'],
                'tax_number' => ['required', 'numeric'],
                'iban' => ['required', 'numeric'],
            ]);
        }else{
            $validate = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'checkbox' => ['required', 'in:1'],
                'phone' => ['required','numeric','digits_between:9,12'],
                'country'=> ['required', 'string', 'max:199'],
                'city'=> ['required', 'string', 'max:199'],
                'street'=> ['required', 'string', 'max:199'],
                'building_number'=> ['required', 'numeric', 'max:199'],
                'postal_code'=> ['required', 'numeric'],
                
            ]);
                
        }
        
        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        }
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if($data['register_as_vendor'] == 1){
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'corporate_name'=>$data['corporate_name'],
            'tax_number'=>$data['tax_number'],
            'iban'=>$data['iban'],
        ]);
        }else{
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone'=>$data['phone'],
            'country'=>$data['country'],
            'city'=>$data['city'],
            'street'=>$data['street'],
            'building_num'=>$data['building_number'],
            'postal_code'=>$data['postal_code'],
        ]);
        }

        if ($data["register_as_vendor"])
            foreach (User::admins() as $admin)
                $admin->notify(new InvoiceNewVendor($user->id));

        return $user;
    }
}
