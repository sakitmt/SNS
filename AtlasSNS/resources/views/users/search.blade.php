@extends('layouts.login')

@section('content')
<!--  検索枠  -->
<form class="search-form" action="/search">
    <div class="form-group">
        <input type="text" name="keyword"  class="search-form-place" placeholder="ユーザー名">
    </div>
    <input type="submit" value="検索" class="btn btn-info">
<!-- 検索ボタンが押されたら検索ワードを出す -->
</form>
<!-- 検索ボタン  -->

検索結果一覧

<div class="" >
  <div class="">
  {{ $data -> appends(Request::only('keyword')) }}
  </div>
</div>



@endsection