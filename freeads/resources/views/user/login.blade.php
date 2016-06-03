@extends('layout')

@section('css')
    <link href="{{ asset('css/mycss.css') }}" rel="stylesheet" type="text/css" >
@stop

@section('content')

<?= Form::open(['id' => 'sign-form', 'class' => 'myform']);?>
  <div class="input_sign_text">
    <?= Form::text('username', null, array('id' => 'username_login')) ?><span class="highlight"></span><span class="bar"></span>
    <?= Form::label('username_login', 'Username') ?>
    <div class="error_sign">{{ $errors->first('username') }}</div>
  </div>
  <div class="input_sign_text">
    <?= Form::password('password', null, array('class' => 'password_login')) ?><span class="highlight"></span><span class="bar"></span>
    <?= Form::label('password_login', 'Password') ?>
    <div class="error_sign">{{ $errors->first('password') }}</div>
  </div>
  <input type="submit" class="button buttonBlue" value="Sign in">
    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
  <?= link_to('register', 'You are not registered', array('class' => 'link_user')) ?>
<?= Form::close() ?>

@stop