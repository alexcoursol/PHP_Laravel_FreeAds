@extends('layout')

@section('css')
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')

@if(isset($post))
    @if($post->user_id == Auth::user()->id)

    <div id="post_show_box">
            {{ Form::open() }}
            {{ Form::hidden('update', $post->id) }}
            <ul class="post_show_list">
                <li class="post_show_title">{{ Form::text('title', $post->title) }}</li>
                <li class="post_show_price">{{ Form::text('price', $post->price) }} €</li>
                <li class="post_show_content">{{ Form::textarea('content', $post->content, array('rows' => 10, 'cols' => 80)) }}</li>
                <li class="post_show_created_at">Published {{ $post->created_at }}</li>
                <li class="button_list">{{ Form::submit('Update', ['class' => 'edit_button']) }}</li>
            </ul>
            {{ Form::close() }}
            <div>
                {{ Form::open() }}
                {{ Form::hidden('delete', $post->id) }}
                {{ Form::submit('Delete', ['class' => 'delete_button']) }}
                {{ Form::close() }}
            </div>
            <div>
                <?php $i = 0 ?>
                @foreach($post->photos()->get() as $photo)
                    <?php $i++; ?>
                    @if(file_exists(public_path('uploads' . DIRECTORY_SEPARATOR . $post->user_id . DIRECTORY_SEPARATOR . $post->id . DIRECTORY_SEPARATOR . $post->photos()->first()->filename)))
                    <img alt="<?php echo 'post photo' . $i; ?>" class="post_show_photo" src="{{ asset('uploads' . DIRECTORY_SEPARATOR . $post->user_id . DIRECTORY_SEPARATOR . $post->id . DIRECTORY_SEPARATOR . $photo->filename) }}">
                    @endif
                @endforeach
            </div>
    </div>

    @else

    <div id="post_show_box">
        <ul class="post_show_list">
            <li class="post_show_title">{{  link_to('post/' . $post->id, ucfirst($post->title)) }}</li>
            <li class="post_show_price">{{ $post->price . '€' }}</li>
            <li class="post_show_content">{{ $post->content }}</li>
            <li class="post_show_created_at">Published {{ $post->created_at }}</li>
            <li>
                <?php $i = 0 ?>
                @foreach($post->photos()->get() as $photo)
                    <?php $i++; ?>
                    @if(file_exists(public_path('uploads' . DIRECTORY_SEPARATOR . $post->user_id . DIRECTORY_SEPARATOR . $post->id . DIRECTORY_SEPARATOR . $post->photos()->first()->filename)))
                    <img alt="<?php echo 'post photo' . $i; ?>" class="post_show_photo" src="{{ asset('uploads' . DIRECTORY_SEPARATOR . $post->user_id . DIRECTORY_SEPARATOR . $post->id . DIRECTORY_SEPARATOR . $photo->filename) }}">
                    @endif
                @endforeach
            </li>
        </ul>
    </div>

    @endif
@endif
@endsection