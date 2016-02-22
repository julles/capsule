@extends('oblagio.layouts.layout')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
		
		{!! Form::model($model,['files'=>true]) !!}
        
          <div class="box-body">
	      
	        @include('oblagio.common.error_validation')
	      
	        <div class="form-group">
              <label>Name</label>
              {!! Form::text('name',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label>Company</label>
              {!! Form::text('company',null,['class'=>'form-control']) !!}
            </div>
          	
            <div class="form-group">
              <label>Gender</label>
              {!! Form::select('gender',$gender,null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group" id = 'ogFileDiv'>
              <label>photo</label>
              {!! Form::file('photo' ,['id'=> 'photo']) !!}
              
              <br/>
              
              @if(!empty($model->photo))

                <img id = "imageOld" src = "{{ og()->assetUrl.'contents/thumbnails/'.$model->photo }}?dummy=8484744" width = "100" height = ""/>

              @endif
            
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

