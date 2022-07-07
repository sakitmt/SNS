@extends('layouts.login')

@section('content')
<div class="post-area-top">
    <form class="post-area" action= "{{ route('posts') }}" method="POST">
        <div class="user-icon-area">
        <img class="user-icon" src="images/icon1.png" alt="アイコン">
        </div>
        <div class="post-content-area">
            <textarea class="post-content" name="content" placeholder="投稿内容を入力してください。"></textarea>
        </div>
        <div class="post-btn-area">
        <input class="post-btn" type="image" src="images/post.png" alt="送信ボタン">
        </div>
    </form>
</div>

@endsection