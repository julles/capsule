@extends('oblagio.layouts.layout')
@section('content')
<div class="row">
	<div class="col-md-12">
	  <div class="box">
	    <div class="box-body">
	    
	    {!! og()->linkCreate() !!}
	    
	      	<hr/>
	      	@include('oblagio.common.all_flashes')
	      	<table class="table table-bordered" id="table">
		        <thead>
		            <tr>
		                <th width="">Parent</th>
		                <th width="">Title</th>
		                <th width="">Controller</th>
		                <th width="">Permalink</th>
		                <th width="">Action</th>
		            </tr>
		        </thead>
		        <tbody>
		        	@foreach($parents as $parent)

		        	<tr class = 'alert alert-default'>
		        		<td>This Parent</td>
		        		<td>{{ $parent->title }}</td>
		        		<td>{{ $parent->controller }}</td>
		        		<td>{{ $parent->permalink }}</td>
		        		<td>{!! og()->links($parent->id) !!}</td>
		        	</tr>

		        	@endforeach
		        </tbody>
		    </table>
	    </div><!-- /.box-body -->
	  </div><!-- /.box -->

	  
	</div><!-- /.col -->
    
 </div>

@endsection

@section('script')

<script type="text/javascript">
	$(function() {
		$('#table').DataTable();
	});
</script>

@endsection