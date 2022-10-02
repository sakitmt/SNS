<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        $username = $query->get();
        return view('users.search', compact('username', 'keyword'));
    }

}
