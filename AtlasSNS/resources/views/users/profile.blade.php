@extends('layouts.login')

@section('content')




{!! Form::open(['url' => 'profile','enctype' => 'multipart/form-data']) !!}
{{ csrf_field() }}



@if (isset( $errors ))
<div class="error-message">
    <div class="error-inner">
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
    </div>
</div>
@endif

<div class="flex-box">
  <div class="profile-center flex-box">

    <div class="user-icon">
        <img class="rounded-circle"  width="50" height="50" src="{{ asset('storage/user_images/' .auth()->user()->images )}}">
    </div>


    <div class="profile-header">
      {{ Form::label('user name') }}<br>
      {{ Form::label('mail adress') }}<br>
      {{ Form::label('password') }}<br>
      {{ Form::label('password comfirm') }}<br>
      {{ Form::label('bio') }}<br>
      {{ Form::label('icon image') }}<br>
    </div>

    <div class="profile-form">
      {{ Form::text('username',$auth->username,['class' => 'input']) }}<br>
      {{ Form::text('mail',$auth->mail,['class' => 'input']) }}<br>
      {{ Form::password('password',null,['class' => 'input']) }}<br>
      {{ Form::password('password_confirmation',null,['class' => 'input']) }}<br>
      {{ Form::text('bio',$auth->bio,['class' => 'input']) }}<br>
      {{Form::file('images', ['class'=>'profile-image','id'=>'fileImage'])}}<br>
    </div>


  </div>


</div>

<div class="update-btn">
  {{ Form::submit('更新',['class' => 'btn btn-danger']) }}
</div>


{!! Form::close() !!}

@endsection