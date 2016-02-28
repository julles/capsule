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

		        	<tr class = 'alert alert-warning'>
		        		<td>This Parent</td>
		        		<td>{{ $parent->title }}</td>
		        		<td>{{ $parent->controller }}</td>
		        		<td>{{ $parent->permalink }}</td>
		        		<td><?php
		        			$actions = $parent->controller != '#' ?  ['update','delete','view'] : ['update','delete'];
		        				echo og()->links($parent->id,$actions);

		        			?></td>
		        	</tr>

		        		@foreach($model->childs($parent->id) as $child)
		        		<tr class = ''>
			        		<td>{{ $parent->title }}</td>
			        		<td>{{ $child->title }}</td>
			        		<td>{{ $child->controller }}</td>
			        		<td>{{ $child->permalink }}</td>
			        		<td>{!! og()->links($child->id) !!}</td>
			        	</tr>
		        		@endforeach

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
		$('#table').DataTable({ordering:false});
	});
</script>

@endsection