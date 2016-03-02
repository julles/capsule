@extends('oblagio.layouts.layout')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">

		{!! Form::model($model,['files'=>true]) !!}

          <div class="box-body">

	        @include('oblagio.common.error_validation')

            <div class="form-group">
              <label>Role</label>
              {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label>Username</label>
              {!! Form::text('username',null,['class'=>'form-control']) !!}
            </div>

             <div class="form-group">
              <label>Email</label>
              {!! Form::text('email',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label>Name</label>
              {!! Form::text('name',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label>Avatar</label>
              {!! Form::file('avatar') !!}
              @if(!empty($model->avatar))
                <br/>Old Avatar<br/>
                <img src = "{{ og()->assetUrl.'contents/'.$model->avatar }}?dummy=8484744"/>
                <br/>
              @endif
            </div>

            <div class="form-group">
              <label>Password</label>
              {!! Form::password('password',['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label>Verify Password</label>
              {!! Form::password('verify_password',['class'=>'form-control']) !!}
            </div>

          </div><!-- /.box-body -->

          <div class="box-footer">
            <button class="btn btn-primary" type="submit">{{ !empty($model->id) ? 'Update' : 'Create' }}</button>
          </div>
        {!! Form::close() !!}

		</div>
	</div>
</div>


@endsection
