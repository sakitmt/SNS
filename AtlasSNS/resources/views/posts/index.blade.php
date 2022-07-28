@extends('layouts.login')

@section('content')
<div class="post-area-top">
    <form class="post-area" action="{{ url('top') }}" method="POST">
    {{ csrf_field() }}
        <div class="user-icon-area">
            <img class="user-icon" src="images/icon1.png" alt="アイコン"> <!-- ユーザーアイコンはユーザーによって変わるように修正 -->
        </div>
        <div class="post-content-area">
            <input type="textarea" class="post-content" name="post_con" placeholder="投稿内容を入力してください。">
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
@foreach($posts as $post) <!-- @ fo-r-achは繰り返し処理を行う。@ end-fo-r-eachが必ず必要 -->
<form action="{{ url('top') }}" method="PUT">
    @method("PUT")
    @csrf
    <div class="area-browsing">
        <div class="area-user-icon"><!--    ユーザーアイコン    -->
           <img class="user-icon" src="images/icon1.png" alt="アイコン"> <!-- ユーザーアイコンはユーザーによって変わるように修正 -->
        </div>
        <div class="area-contents">
            <div class="area-username">
                <div class="area-username-name">
                    <!--    ユーザーネーム    -->
                    <tr>{{ $post -> user -> username }}</tr>
                </div>
                <div class="area-daytime">
                    <!--    投稿・編集日時    -->  <!-- 編集日時があれば編集日時を、なければ投稿日時を表示するように修正 -->
                    <tr>{{ $post -> created_at -> format('y-m-d H:i') }}</tr>
                </div>
            </div>
            <div class="area-post">
                <!--    投稿本文    -->
                <tr>{{ $post -> post }}</tr>
            </div>
            <div class="area-btn">
                <div>
                    <!--    編集アイコン    -->
                    <input class="edit_btn" type="image" src="images/edit.png" alt="送信ボタン">
                    <!-- 各投稿にIDが振られているので、そのIDで判別する。 -->
                    <!--    削除アイコン    -->
                    <input class="trash_btn" type="image" src="images/trash.png" alt="送信ボタン">
                </div>
            </div>
        </div>
    </div>
</form>
@endforeach

<div class="update_area">
    更新エリア
</div>

@endsection