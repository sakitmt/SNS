@extends('layouts.login')

@section('content')
<!--  検索枠  -->
<form class="search-form" action="/search">
  {!! Form::open(['url' => '/search', 'method' => 'get']) !!}

  @csrf
  <div class="flex-box search-box">
      <div>

          {{ Form::text('search',null,['class' => 'input search-space', 'placeholder' => 'ユーザー名']) }}


      </div>


      <div class="search-user">
          {!! Form::button('<i class="fas fa-search test-icon"></i>', ['class' => "btn", 'type' => 'submit' ]) !!}
      </div>

      @if (isset( $search ))
          <div class="search-text">検索ワード:{{ $search }}</div>
      @endif

  </div>



{!! Form::close() !!}
</div>

<div>
@foreach($all_user as $user)
<div class="flex-box users-list">

  <div class="div">
      <img src="{{ asset('storage/user_images/' .$user->images )}}" class="rounded-circle" width="50" height="50">
  </div>



  <div class="search-username">
      <a href="{{ route('other',['userdata'=>$user->id]) }}" >{{ $user->username }}</a>
  </div>

@if (auth()->user()->isFollowing($user->id))
<form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}

  <button type="submit" class="btn btn-danger">フォロー解除</button>
</form>
@else
<form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
  {{ csrf_field() }}

  <button type="submit" class="btn btn-primary">フォローする</button>
</form>
@endif
</div>

</div>
@endforeach
</div>

@endsection