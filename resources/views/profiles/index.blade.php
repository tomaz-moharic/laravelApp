@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-3 p-5">
        <img src='{{ $user->profile->profileImage() }}' style="width: 100%" class="rounded-circle">
    </div>
    <div class="col-9 pt-5">
        <div class="d-flex justify-content-between align-items-baseline">
            <div class="d-flex align-items-center pb-3">
                <div class='h4'>{{ $user->username }}</div>

                <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
            </div>
            @can('update', $user->profile)
                <a href="/p/create">Add a new post!</a>
            @endcan
        </div>
        @can('update', $user->profile)
            <a href="/profile/{{ $user->id}}/edit">Edit Profile</a>
        @endcan
        <div class="d-flex">
            <div class="pr-5"><strong>{{ $postsCount }}</strong> posts</div>
            <div class="pr-5"><strong>{{$followersCount}}</strong> followers</div>
            <div class="pr-5"><strong>{{$followingCount}}</strong> following</div>
        </div>
        <div class="pt-4 font-weight-bold">{{ $user->profile->title ?? 'wut' }}</div>
        <div>{{$user->profile->description ?? 'kek'}}</div>
        <div><a href="https://www.thetimes.co.uk/article/puppy-dog-eyes-show-whos-master-p8pcx5c8h">{{$user->profile->url ?? 'N\A'}}</a></div>
    </div>
   </div>
   <div class="row pt-5 ">
    @foreach($user->post as $post)
        <div class="col-4 pb-4"><a href="/p/{{ $post->id }}"><img src= '/storage/{{ $post->image }}' class="w-100"></a></div>
    @endforeach
    
   </div>
</div>
@endsection
