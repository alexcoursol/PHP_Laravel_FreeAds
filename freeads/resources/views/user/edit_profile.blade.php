@extends('layout')

@section('css')
    <link href="{{ asset('css/mycss.css') }}" rel="stylesheet" type="text/css" >
@stop

@section('content')

{{ Form::open(['id' => 'sign-form', 'class' => 'myform']) }}
  <div class="input_sign_text">
    {{ Form::text('username', Auth::user()->username, array('class' => 'input_jquery')) }}<span class="highlight"></span><span class="bar"></span>
    {{ Form::label('username', 'Username') }}
    <div class="error_sign">{{ $errors->first('username') }}</div>
  </div>
  <div class="input_sign_text">
    {{ Form::text('name', Auth::user()->name, array('class' => 'input_jquery')) }}<span class="highlight"></span><span class="bar"></span>
    {{ Form::label('name', 'Name') }}
    <div class="error_sign">{{ $errors->first('name') }}</div>
  </div>
  <div class="input_sign_text">
    {{ Form::text('email', Auth::user()->email, array('class' => 'input_jquery')) }}<span class="highlight"></span><span class="bar"></span>
    {{ Form::label('email', 'Email') }}
    <div class="error_sign">{{ $errors->first('email') }}</div>
  </div>
  {{ Form::submit('Update profile', ['class' => 'button buttonBlue']) }}
  <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
{{ Form::close() }}

@stop