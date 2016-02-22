@extends('oblagio.layouts.layout')
@section('content')
<div class="row">
	<div class="col-md-12">
	  <div class="box">
	    <div class="box-body">
	    
	    {!! og()->linkCreate() !!}
	    
	      	<hr/>
	      	@include('oblagio.common.success')
	      	<table class="table table-bordered" id="table">
		        <thead>
		            <tr>
		                <th>Id</th>
		                <th>Name</th>
		                <th>Gender</th>
		                <th>Action</th>
		            </tr>
		        </thead>
		    </table>
	    </div><!-- /.box-body -->
	  </div><!-- /.box -->

	  
	</div><!-- /.col -->
    
 </div>

@endsection

@section('script')

<script type="text/javascript">
	$(function() {
	$.fn.dataTable.ext.errMode = 'none';
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{og()->urlBackendAction("data")}}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'company', name: 'company' },
            { data: 'gender', name: 'gender' },
            { data: 'action', name: 'action',"searchable": false ,'orderable' : false },
        ]
    });
});
</script>

@endsection