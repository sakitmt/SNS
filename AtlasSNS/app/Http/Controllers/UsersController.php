<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

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
    public function follow(User $user)
    {
        return view('follows.followList');
    }


}
