@extends('oblagio.layouts.auth')
@section('content')
<div class="login-box-body">
  <p class="login-box-msg">Sign in to start your session</p>
  @include('oblagio.common.error_validation')
  @include('oblagio.common.info')
  <form  method="post">
    {!! csrf_field() !!}
    <div class="form-group has-feedback">
      <input type="text" value='{{ old('username') }}' name = 'username' class="form-control" placeholder="USERNAME"/>
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" class="form-control" name = 'password' placeholder="PASSWORD"/>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
      </div><!-- /.col -->
    </div>
  </form>


  <a href="{{ url('auth/forgot-password') }}">I forgot my password</a><br>

</div><!-- /.login-box-body -->
@endsection