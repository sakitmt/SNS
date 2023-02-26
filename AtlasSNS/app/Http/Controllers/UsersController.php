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
        //oderBy- >第1引数にいれたカラムについて、第2引数にいれる順（降順または昇順など）で並び替える。
        $data = $query->orderBy('username','asc')->get();

        return view('users.search', ['data'=>$data, 'keyword'=>$keyword]);
    }
    //　フォロー
    public function follows(User $id){ //$idには検索結果で出てきた相手の情報が入っている？
        $follows = Auth::id()->get(); //$followsを呼んだらログインしているユーザーのIDを持ってくる

        \DB::table('follows')->insert([ //followsがブレードから呼ばれたら、以下の処理を行う
            'following_id'=> $follows,  //followsテーブルのfollowing_idカラムに$followsの値(ログインユーザーのID)を追加
            'followed_id'=> $id,        //followed_idカラムに$idの値(検索結果で出てきた相手の情報)を追加
        ]);

        return redirect('search') ->with (['id'=>$follows]);
    }

    //　フォロー解除
    public function unFollow($id){
        \DB::table('follows')
            ->where(['followed_id'=> $id, 'following_id'=> Auth::user()->id])
            ->delete();
        $users = $unFollows ->get();
        return redirect('search', ['id'=>$users]);
    }

}
