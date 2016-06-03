@extends('layout')

@section('css')
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')

<div id="posts_box">
    @forelse ($posts as $post)
        <ul class="post_list">
            <li>
                @if(file_exists(public_path('uploads' . DIRECTORY_SEPARATOR . $post->user_id . DIRECTORY_SEPARATOR . $post->id . DIRECTORY_SEPARATOR . $post->photos()->first()->filename)))
                <img alt="<?php echo 'post photo ' . $post->id . $post->photos()->first()->id ?>" class="post_photo" src="{{asset('uploads' . DIRECTORY_SEPARATOR . $post->user_id . DIRECTORY_SEPARATOR . $post->id . DIRECTORY_SEPARATOR . $post->photos()->first()->filename)}}">
                @endif
            </li>
            <li class="post_title">{{  link_to('post/' . $post->id, ucfirst($post->title)) }}</li>
            <li class="post_price">{{ $post->price . '€' }}</li>
            <li class="post_created_at">{{ $post->created_at }}</li>
        </ul>
    @empty
    <p>No posts</p>
    @endforelse
</div>

@endsection