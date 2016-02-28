@extends('oblagio.layouts.layout')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
		
		{!! Form::model($model,['files'=>true]) !!}
        
          <div class="box-body">
	      
	        @include('oblagio.common.error_validation')
	      	
	      	@foreach($actions as $row)
		        <div class="form-group">
	              <input type = 'checkbox' name = 'action_id[]' {{ !empty($checked($row->id)) ? 'checked' : '' }}  value = '{{ $row->id }}' /> {{ $row->label }}
	            </div>
	        @endforeach

          </div><!-- /.box-body -->

          <div class="box-footer">
            <button class="btn btn-primary" type="submit">Update</button>
          </div>
        {!! Form::close() !!}
		
		</div>	  
	</div>
</div>
    

@endsection

