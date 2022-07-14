<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Auth;
use Dotenv\Validator as DotenvValidator;

class PostsController extends Controller
{
    //
    public function index(){
        $posts = Post::get();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    protected function validator(array $post){
        return Validator::make($post, [
            'post-con' => 'required|min:1|max:200', // 入力必須・１文字以上・200文字以内
        ]);
    }

    protected function store(array $posts){
        return User::create([
            'post' => $posts['Post'],
            'id' => $posts['id'],
            //'user_id' => $posts'user_id'->Auth::id(),
            'created_at' => $posts['created_at'],
            'updated_at' => $posts['updated_at'],
        ]);
        //$posts->save();
    }

    public function post(Request $request){
        if($request->all()){
            $posts = $request->input();
            $validate = $this->validator($posts);
            // バリデーション:エラー
            if ($validate->fails()) {
                return redirect('/top')
                    ->withInput()
                    ->withErrors($validate);
            } else {
                $request->input($posts);
            //$posts = new Post; // 投稿内容
            //$posts -> user_id = Auth::id();
            //$posts -> created_at = $request->created_at; // 投稿日次
            //$posts -> updated_at = $request->updated_at; // 変更日次
            //$posts->save();
            }
        }
        return view('posts.index'); // リクエスト送ったページに戻る（つまり、/topにリダイレクトする）
    }
}