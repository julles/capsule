@extends('oblagio.layouts.layout')
@section('content')
  <div class = "row">
    <div class = "col-md-12">
      <div class = "well"><h2>Welcome : {{ user()->name }}</h2></div>
    </div>
  </div>
@endsection
