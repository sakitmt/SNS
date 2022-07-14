@extends('layouts.login')

@section('content')
<div class="post-area-top">
    <form class="post-area" action="{{ url('top') }}" method="POST">
    {{ csrf_field() }}
        <div class="user-icon-area">
        <img class="user-icon" src="images/icon1.png" alt="アイコン">
        </div>
        <div class="post-content-area">
            <input type="textarea" class="post-content" name="post-con" placeholder="投稿内容を入力してください。">
        </div>
        <div class="post-btn-area">
        <input class="post-btn" type="image" src="images/post.png" alt="送信ボタン">
        </div>
    </form>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (count($posts) > 0)
<div class="card-body">
    <div class="card-body">
        <table class="table table-striped task-table">
        <!-- テーブルヘッダ -->
            <thead>
                <th>投稿一覧</th>
                <th> </th>
            </thead>
            <!-- テーブル本体 -->
            <tbody>
                @foreach ($posts as $post)
                <tr>
                <!-- 投稿詳細 -->
                    <td class="table-text">
                        <div><!--{{ $post->post_content }}--></div>
                    </td>
                <!-- 投稿者名の表示 -->
                    <td class="table-text">
                        <div><!--{{ $post->user->name }}--></div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection