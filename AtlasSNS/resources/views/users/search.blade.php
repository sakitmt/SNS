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
検索ワード：{{ $keyword }}

<!-- 検索結果一覧 -->


<div class="">
@foreach($data as $data)
@if(Auth::id() != $data->id)
<ul>
  <li>
  {{ $data-> username }}
  @if(Auth()->user()->isFollowing($data->id))
  <form action="{{ route('unFollow', ['id' => $data->id]) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}

    <a type="button" class="btn btn-primary" href="/follow/{{$data->id}}/unFollow">フォロー解除する</a>
  </form>

  @else
  <form action="{{ route('follow', ['id' => $data->id]) }}" method="POST">
    {{ csrf_field() }}

  <a type="button" class="btn btn-primary" href="/follow/{{$data->id}}/follows">フォローする</a>
  </form>
  @endif

</li>
</ul>

@endif
@endforeach
</div>
@endsection