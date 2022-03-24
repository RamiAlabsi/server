<?php

namespace App\Http\Controllers\Admin;

use App\DatabaseNotifications\UserDatabaseNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $users = User::all();
        if (request()->filled('notification_id')) {
            $notification = UserDatabaseNotification::find(request('notification_id'));
            $notification->markAsRead();
            $users = [$notification->candidate_vendor];
        }
        return view('admin.users', compact('users'));
    }
    public function update(Request $request)
    {
        $users = User::where('id', $request->id)->first();
        $users->role = $request->role;
        $users->save();
        return back()->with(['updated' => 'updated successfully']);
    }
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect()->back();
    }
}
