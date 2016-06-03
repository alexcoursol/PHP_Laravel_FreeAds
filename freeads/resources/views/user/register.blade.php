@extends('layout')

@section('css')
    <link href="{{ asset('css/mycss.css') }}" rel="stylesheet" type="text/css" >
@stop

@section('content')

{{ Form::open(['id' => 'sign-form', 'class' => 'myform']) }}
  <div class="input_sign_text">
    {{ Form::text('username', null, array('class' => 'input_jquery')) }}<span class="highlight"></span><span class="bar"></span>
    {{ Form::label(null, 'Username') }}
    <div class="error_sign">{{ $errors->first('username') }}</div>
  </div>
  <div class="input_sign_text">
    {{ Form::password('password', null, array('class' => 'input_jquery')) }}<span class="highlight"></span><span class="bar"></span>
    {{ Form::label(null, 'Password') }}
    <div class="error_sign">{{ $errors->first('password') }}</div>
  </div>
  <div class="input_sign_text">
    {{ Form::text('name', null, array('class' => 'input_jquery')) }}<span class="highlight"></span><span class="bar"></span>
    {{ Form::label(null, 'Name') }}
    <div class="error_sign">{{ $errors->first('name') }}</div>
  </div>
  <div class="input_sign_text">
    {{ Form::text('email', null, array('class' => 'input_jquery')) }}<span class="highlight"></span><span class="bar"></span>
    {{ Form::label(null, 'Email') }}
    <div class="error_sign">{{ $errors->first('email') }}</div>
  </div>
  {{ Form::submit('Register', ['class' => 'button buttonBlue']) }}
  <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
  {{ link_to('login', 'You already have an account', array('class' => 'link_user')) }}
{{ Form::close() }}

@stop