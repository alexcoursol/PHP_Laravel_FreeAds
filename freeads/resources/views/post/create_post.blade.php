@extends('layout')

@section('css')
    <link href="{{ asset('css/mycss.css') }}" rel="stylesheet" type="text/css" >
@stop

@section('content')

{{ Form::open(['id' => 'sign-form', 'class' => 'myform', 'files' => true]) }}
    <ul id="post_form">
        <li>
            <div id="post_form_1">
              <div class="input_sign_text">
                {{ Form::text('title', null, array('class' => 'input_jquery')) }}<span class="highlight"></span><span class="bar"></span>
                {{ Form::label(null, 'Title') }}
                <div class="error_sign">{{ $errors->first('title') }}</div>
              </div>
              <div class="input_sign_text">
                {{ Form::text('price', null, array('class' => 'input_jquery')) }}<span class="highlight"></span><span class="bar"></span>
                {{ Form::label(null, 'Price') }}
                <div class="error_sign">{{ $errors->first('price') }}</div>
              </div>
              <div class="input_sign_text">
                {{ Form::file('photo[]', array('multiple'=>'true', 'class' => 'input_jquery')) }}
                <span class="highlight"></span><span class="bar"></span>
                {{ Form::label(null, 'Photo') }}
                <div class="error_sign">{{ $errors->first('photo') }}</div>
              </div>
            </div>
        </li>
        <li>
            <div class="input_sign_text">
                {{ Form::textarea('content', null, array('class' => 'input_jquery', 'rows' => 10, 'cols' => 40)) }}<span class="highlight"></span><span class="bar"></span>
                {{ Form::label(null, 'Content') }}
                <div class="error_sign">{{ $errors->first('content') }}</div>
            </div>
            {{ Form::submit('Publish', ['class' => 'button buttonBlue', 'size' => '30x5']) }}
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </li>
{{ Form::close() }}

@stop