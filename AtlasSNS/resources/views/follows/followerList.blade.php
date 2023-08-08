@extends('layouts.login')

@section('content')


    <div class="flex-box icon-area">

        <div class="follow-title">
            <P>Follower List</P>
        </div>

        <div class="icon-margin flex-box">
            @foreach ($all_users as $user)
            @if(auth()->user()->isFollowed($user->id))
                <div class="icon-space">
                    <div>
                        <a href="{{ route('other',['userdata'=>$user->id]) }}">
                            <img src="{{ asset('storage/user_images/' .$user->images )}}" class="rounded-circle" width="50" height="50">
                        </a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

    </div>



    @foreach ($all_posts as $post)
        @if(auth()->user()->isFollowed($post->user_id))
        <div class="tweet">
            <div class="flex-box">
                <div class="tweet-icon">
                    <img src="{{ asset('storage/user_images/' .$post->images )}}" class="rounded-circle" width="50" height="50">
                </div>

                <div class="tweet-data">

                    <div class="flex-box">
                        <div class="tweet-username">
                            <P>{{ $post->username }}</P>
                        </div>

                    </div>

                    <div>投稿：{{ $post->post }}</div>

                </div>
            </div>

            <div>
                <div class="tweet-time">
                    <div><p>{{ $post->created_at }}</p></div>
                </div>

            </div>
        </div>
        @endif

    @endforeach

@endsection