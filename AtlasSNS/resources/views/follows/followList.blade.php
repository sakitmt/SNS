@extends('layouts.login')

@section('content')
    <div class="follow-list post-area"><!--flex①-->

        <div class="title follow-title"><!--①幅比率-->
            <P>Follow List</P>
        </div>

        <div class="follow-icon-list"><!--①幅比率--><!--flex②-->
            @foreach ($all_users as $user)
            @if (auth()->user()->isFollowing($user->id))
                <div class="followicon"><!--②幅比率？-->
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
        @if(auth()->user()->isFollowing($post->user_id))
        <div class="area-browsing">
            <div class="area-user-icon">
                <img src="{{ asset('storage/user_images/' .$post->images )}}" class="rounded-circle" width="50" height="50">
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
                <div class="area-post">{{ $post->post }}</div>
            </div>
        </div>
    @endif


@endforeach

@endsection