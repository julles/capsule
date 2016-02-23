@extends('oblagio.layouts.auth')
@section('content')
<div class="login-box-body">
  <p class="login-box-msg">Input Your Email</p>
  @include('oblagio.common.error_validation')
  @include('oblagio.common.info')
  <form  method="post">
    {!! csrf_field() !!}
    <div class="form-group has-feedback">
      <input type="text" value='{{ old('email') }}' name = 'email' class="form-control" placeholder="EMAIL"/>
      <span class="glyphicon glyphicon-email form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
      </div><!-- /.col -->
    </div>
  </form>


  <a href="{{ url('auth') }}">Back To Login</a><br>

</div><!-- /.login-box-body -->
@endsection