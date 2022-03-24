<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\UserOffer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_offers = array();
        foreach (UserOffer::all() as $user_offer)
            if ($user_offer->product->vendor->id == Auth::user()->id)
                array_push($user_offers, $user_offer);
        return view('vendor.user_offers.index', compact('user_offers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_offer = UserOffer::find($id);
        $user_offer->delete();
        return "deleted successfully";
    }
}
