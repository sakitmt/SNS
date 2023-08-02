<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Post;
use App\Follow;

class UsersController extends Controller
{
    //
    public function profile(){

        $auth = Auth::user();

        return view('users.profile',[ 'auth' => $auth ]);
    }

    public function search(Request $request,User $user) {
        $search = $request->input('search');

        if(!empty($search)){
            $all_users = \DB::table('users')
            ->where('username', 'LIKE', "%{$search}%")
            ->get();
        }
        else{
            // $all_users = $user->getAllUsers(auth()->user()->id);
            // $this->Where('id', '<>', $user_id)->paginate(5);

            $all_users = \DB::table('users')
            ->where('id', '!=', auth()->user()->id)
            ->get();
        }

        return view('users.search', ['all_users'  => $all_users,'keyword'  => $search]);
    }

    //　フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    //　フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }
}