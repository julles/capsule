@extends('oblagio.layouts.layout')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
		
		{!! Form::model($model,['files'=>true]) !!}
        
          <div class="box-body">
	      
	        @include('oblagio.common.error_validation')
	      	
	        <div class="form-group">
              <label>Parent</label>
              {!! Form::select('parent_id',$parentLists , null,['class'=>'form-control']) !!}
            </div>

	        <div class="form-group">
              <label>Title</label>
              {!! Form::text('title',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label>Icon</label>
              {!! Form::text('icon',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label>Controller</label>
              {!! Form::text('controller',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label>Order</label>
              {!! Form::text('order',null,['class'=>'form-control']) !!}
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

