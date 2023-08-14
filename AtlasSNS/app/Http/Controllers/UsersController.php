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
    // 本人のプロフィール画面に遷移
    public function profile(){

        $auth = Auth::user();

        return view('users.profile',[ 'auth' => $auth ]);
    }

    // プロフィール編集
    public function profile_update(Request $request){

        $id = Auth::id();
        $auth = Auth::user();
        $data = $request->all();

        if ($request->file("images") != null) {

            //拡張子付きでファイル名を取得
            $filenameWithExt = $request->file("images")->getClientOriginalName();

            //ファイル名のみを取得
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //拡張子を取得
            $extension = $request->file("images")->getClientOriginalExtension();

            //保存のファイル名を構築
            $filenameToStore = $filename."_".time().".".$extension;

            $path = $request->file("images")->storeAs("public/user_images", $filenameToStore);
        }

        $up_username = $request->input('username');
        $up_mail = $request->input('mail');
        $up_password = $request->input('password');
        $up_bio = $request->input('bio');


        if (!isset( $up_bio ) && !isset( $filenameWithExt ) ){

            $validator = Validator::make($data,[
                'username' => 'required|string|min:2|max:12',
                'mail' => 'required|string|email|min:5|max:40|unique:users,mail,'.$id.',id',
                'password' => 'string|min:8|max:20|confirmed',
                'password_confirmation' => 'string|min:8|max: 20',
            ]);

            if ($validator->fails()) {
                    return redirect('/profile')
                    ->withErrors($validator)
                    ->withInput();
            }

            \DB::table('users')
            ->where('id', $id)
            ->update(
                    [
                        'username' => $up_username,
                        'mail' => $up_mail,
                        'password' => bcrypt($up_password),
                    ]
            );

        }


        elseif (!isset( $up_bio ) && isset( $filenameWithExt ) ){


            $validator = Validator::make($data,[
                'username' => 'required|string|min:2|max:12',
                'mail' => 'required|string|email|min:5|max:40|unique:users,mail,'.$id.',id',
                'password' => 'string|min:8|max:20|confirmed',
                'password_confirmation' => 'string|min:8|max: 20',
            ]);

            if ($validator->fails()) {
                    return redirect('/profile')
                    ->withErrors($validator)
                    ->withInput();
            }
            \DB::table('users')
            ->where('id', $id)
            ->update(
                    [
                        'username' => $up_username,
                        'mail' => $up_mail,
                        'password' => bcrypt($up_password),
                        'images' => $filenameToStore,
                    ]
            );
        }


        elseif (isset( $up_bio ) && !isset( $filenameWithExt ) ){


            $validator = Validator::make($data,[
                'username' => 'required|string|min:2|max:12',
                'mail' => 'required|string|email|min:5|max:40|unique:users,mail,'.$id.',id',
                'password' => 'string|min:8|max:20|confirmed',
                'password_confirmation' => 'string|min:8|max: 20',
                'bio' => 'max:150',
            ]);

            if ($validator->fails()) {
                    return redirect('/profile')
                    ->withErrors($validator)
                    ->withInput();
            }

            \DB::table('users')
            ->where('id', $id)
            ->update(
                    [
                        'username' => $up_username,
                        'mail' => $up_mail,
                        'password' => bcrypt($up_password),
                        'bio' => $up_bio,
                    ]
            );
        }


        elseif (isset( $up_bio ) && isset( $filenameWithExt ) ){

            $validator = Validator::make($data,[
                'username' => 'required|string|min:2|max:12',
                'mail' => 'required|string|email|min:5|max:40|unique:users,mail,'.$id.',id',
                'password' => 'string|min:8|max:20|confirmed',
                'password_confirmation' => 'string|min:8|max: 20',
                'bio' => 'max:150',
            ]);

            if ($validator->fails()) {
                    return redirect('/profile')
                    ->withErrors($validator)
                    ->withInput();
            }
            \DB::table('users')
            ->where('id', $id)
            ->update(
                    [
                        'username' => $up_username,
                        'mail' => $up_mail,
                        'password' => bcrypt($up_password),
                        'bio' => $up_bio,
                        'images' => $filenameToStore,
                    ]
            );
        }

        return redirect('/profile');
    }
    // プロフィールアップデート

    // user検索
    public function search(Request $request,User $user) {
        $search = $request->input('search');

        if(!empty($search)){
            $all_users = \DB::table('users')
            ->where('username', 'LIKE', "%{$search}%")
            ->get();
        }
        else{

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

    public function follow_list(User $user){

        // $all_posts = \DB::table('posts')->orderBy('created_at', 'DESC')->get();

        $all_users = $user->getAllUsers(auth()->user()->id);

        $all_posts = \DB::table('posts')
            ->select('users.id', 'users.username', 'users.images', 'posts.user_id', 'posts.post', 'posts.created_at')
            ->leftjoin('users', 'users.id', '=', 'posts.user_id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $all_follows = \DB::table('follows')
            ->Where('following_id', Auth::id())
            ->get('followed_id');

        return view('follows.followlist', [
            'all_users'  => $all_users,
            'all_posts'  => $all_posts,
            'all_follows'  => $all_follows,
        ]);
    }

    public function follower_list(User $user){

        $all_users = $user->getAllUsers(auth()->user()->id);

        $all_posts = \DB::table('posts')
            ->select('users.id', 'users.username', 'users.images', 'posts.user_id', 'posts.post', 'posts.created_at')
            ->leftjoin('users', 'users.id', '=', 'posts.user_id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $all_follows = \DB::table('follows')
            ->Where('following_id', Auth::id())
            ->get('followed_id');

        return view('follows.followerlist', [
            'all_users'  => $all_users,
            'all_posts'  => $all_posts,
            'all_follows'  => $all_follows,
        ]);
    }
}