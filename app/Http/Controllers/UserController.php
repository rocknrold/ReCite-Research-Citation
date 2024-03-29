<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function nameUpdate(Request $request)
    {
        // dd($request);
        if($request->has('name'))
        {
            $result = User::where('id', Auth::id())->update([
                                'name' => $request->name
                                ]);
            if($result){
                return response()->json(["msg"=>"success", "name"=>$request->name]);
            }
        }
    }
    public function emailUpdate(Request $request)
    {
        if($request->has('email'))
        {
            $result = User::where('id', Auth::id())->update([
                                'email' => $request->email
                                ]);
            if($result){
                return response()->json(["msg"=>"success", "email"=>$request->email]);
            }
        }
    }

    public function avatarUpload(Request $request)
    {
        // dd($request->avatar);
        // $user = User::find(Auth::id());
        if($request->has('avatar')){
            $user = User::where('id', Auth::id())->update(['poster' => $request->file('avatar')->store('uploads', 'public')]);
        }else{
            return redirect("/profile/view")->with('error', 'No avatar provided');
        }
        return redirect("/profile/view")->with('success', 'New Gift Added !');
    }
}
