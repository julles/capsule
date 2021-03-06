@extends('oblagio.layouts.layout')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
		
		{!! Form::model($model,['files'=>true]) !!}
        
          <div class="box-body">
	      
	        @include('oblagio.common.error_validation')
	      
	        <div class="form-group">
              <label>Code</label>
              {!! Form::text('code',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label>Label</label>
              {!! Form::text('label',null,['class'=>'form-control']) !!}
            </div>

          </div><!-- /.box-body -->

          <div class="box-footer">
            <button class="btn btn-primary" type="submit">{{ ucfirst(request()->segment(3)) }}</button>
          </div>
        {!! Form::close() !!}
		
		</div>	  
	</div>
</div>
    

@endsection

