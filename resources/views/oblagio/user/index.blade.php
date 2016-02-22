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
		                <th>Role</th>
		                <th>Username</th>
		                <th>Name</th>
		                <th>Email</th>
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
            { data: 'role_name', name: 'roles.name' },
            { data: 'username', name: 'username' },
            { data: 'users.name', name: 'users.name' },
            { data: 'email', name: 'email' },
            { data: 'action', name: 'action',"searchable": false ,'orderable' : false },
        ]
    });
});
</script>

@endsection