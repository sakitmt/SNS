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
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    //
    public function index(){
        //$posts = Post::get();
        $posts = Post::with('user')->get();
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    protected function validator(array $posts){
        return Validator::make($posts, [
            'post_con' => 'required|min:1|max:200', // 入力必須・１文字以上・200文字以内
        ]);
    }

    protected function create(Request $request){
        $post = new Post;// 投稿内容
        $post -> user_id = Auth::id();
        $post -> post = $request->post_con;
        $post->save();
    }

    public function post(Request $request){
        if($request->isMethod('post')){ // 送られてくるデータの型を確認する(isMethod)、('')の中の方と一致するかどうか
            $posts = $request->input(); // すべてのデータを取得(input())
            $validate = $this->validator($posts);
            // 以下バリデーション＝エラー
            if ($validate->fails()) {
                return redirect('/top')
                    ->withInput()
                    ->withErrors($validate);
            } else {//以下バリデーション＝クリア
                $this->create($request);
            }
        }
        return redirect('/top'); // リクエスト送ったページに戻る（つまり、/topにリダイレクトする）
    }

    public function update(){
        
    }
}