@extends('layouts.login')

@section('content')
    <div class="flex-box icon-area post-area">

        <div class="title follow-title">
            <P>Follower List</P>
        </div>

        <div class="follow-icon-list">
            @foreach ($all_users as $user)
                @if (auth()->user()->isFollowed($user->id))
                    <div class="followicon">
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
            <div class="area-browsing">
                <div class="area-user-icon">
                    <a href="{{ route('other',['userdata'=>$user->id]) }}">
                    <img src="{{ asset('storage/user_images/' .$post->images )}}" class="rounded-circle" width="50" height="50">
                    </a>
                </div>

                <div class="area-contents">
                    <div class="area-username">
                        <div class="area-username-name">
                            <P>{{ $post->username }}</P>
                        </div>

                        <div class="area-daytime">
                            <p>{{ $post->created_at }}</p>
                        </div>
                    </div>

                    <div class="area-post">
                        {{ $post->post }}
                    </div>
                </div>
            </div>
        @endif

    @endforeach

@endsection