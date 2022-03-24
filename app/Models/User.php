<?php
namespace App\Models;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\DatabaseNotifications\UserDatabaseNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JWTAuth;
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
        public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    // overriding the notifications function to use my custom class instead of the DatabaseNotification normal method
    public function notifications()
    {
        return $this->morphMany(UserDatabaseNotification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'corporate_name',
        'tax_number',
        'iban',
        'phone',
        'country',
        'city',
        'street',
        'building_num',
        'postal_code',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function stores(){
        return $this->belongsToMany('App\Models\Store', 'user_stores');
    }
    public function getProductsAttribute(){
        $products = [];
        foreach ($this->stores as $store) {
            foreach ($store->products as $product) {
                $products[$product->id] = $product;
            }
        }
        return $products;
    }
    public function getProductsWithTrashedAttribute(){
        $products = [];
        foreach ($this->stores as $store) {
            foreach ($store->products_with_trashed as $product) {
                $products[$product->id] = $product;
            }
        }
        return $products;
    }
    public function getIsAdminAttribute(){
        return $this->role == 0;
    }
    public function getIsVendorAttribute(){
        return $this->role == 1;
    }
    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
    public static function admins(){
        return self::where('role', 0)->get();
    }
    public static function vendors(){
        return self::where('role', 1)->get();
    }
    public function cart_items(){
        return $this->hasMany('App\Models\Cart');
    } 
    public function wishlist(){
        return $this->hasMany('App\Models\UserOffer','user_id');
    }
    public function Country(){
        return $this->belongsTo('App\Models\Country','country');
    }
    public function addresses(){
        return $this->hasMany('App\Models\UserAddresses','user_id');
    }
      public function reviews(){
        return $this->hasMany('App\Models\Review','user_id');
    }
    public function Fav(){
        return $this->hasMany('App\Models\UserFavourite','user_id');
    }
}