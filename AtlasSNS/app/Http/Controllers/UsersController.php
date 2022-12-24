<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Follow;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }

    public function search(Request $request) {

        $keyword = $request->input('keyword');
        $query = User::query();
        if(!empty($keyword)){
            $query->where('username','like',"%{$keyword}%");
        }

        $data = $query->orderBy('username','asc')->get();
        return view('users.search', ['data'=>$data, 'keyword'=>$keyword]);
    }
    //　フォロー
    public function follows($id)
    {

        $follows = new Follow;
        $follows -> following_id = Auth::id();
        $follows -> followed_id = $id;
        $follows->save();

        return back();
    }
    //　フォロー解除
    public function nofollow($id)
    {
        \DB::table('follows')
            ->where('followed_id', $id)
            ->where('following_id', Auth::id())
            ->delete();
        return back();
    }

}
