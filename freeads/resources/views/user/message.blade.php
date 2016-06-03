@extends('layout')

@section('css')
    <link href="{{ asset('css/mycss.css') }}" rel="stylesheet" type="text/css" >
@stop

@section('content')

{{ Form::open(['id' => 'sign-form', 'class' => 'myform']) }}
  <div class="input_sign_text">
    {{ Form::text('title', null, array('class' => 'input_jquery')) }}<span class="highlight"></span><span class="bar"></span>
    {{ Form::label('title', 'Title') }}
    <div class="error_sign">{{ $errors->first('title') }}</div>
  </div>
  <div class="input_sign_text">
    {{ Form::text('dest', null, array('class' => 'input_jquery')) }}<span class="highlight"></span><span class="bar"></span>
    {{ Form::label('dest', 'To') }}
    <div class="error_sign">{{ $errors->first('dest') }}</div>
  </div>
  <div class="input_sign_text">
      {{ Form::textarea('content', null, array('class' => 'input_jquery', 'rows' => 10, 'cols' => 40)) }}<span class="highlight"></span><span class="bar"></span>
      {{ Form::label('content', 'Content') }}
      <div class="error_sign">{{ $errors->first('content') }}</div>
  </div>
  {{ Form::submit('Send', ['class' => 'button buttonBlue']) }}
  <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
{{ Form::close() }}

@if(isset($messages))
<div id="posts_box">
    @forelse ($messages as $message)
        <div class="one_post">
            <ul class="post_list">
                <li class="post_title">{{  $message->title }}</li>
                <li class="post_price">{{ $message->content }}</li>
                <li class="post_created_at">{{ $message->created_at }}</li>
            </ul>
        </div>
    @empty
    <p>No messages</p>
    @endforelse
</div>
@endif

@stop