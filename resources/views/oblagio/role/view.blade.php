@extends('oblagio.layouts.layout')
@section('content')
<div class="row">
	<div class="col-md-12">
	  <div class="box">
	    <div class="box-body">
	      	<hr/>
	      	@include('oblagio.common.all_flashes')
	      	<table class="table">
		        
		        	@foreach($parentMenus as $parent)

		        	<thead>
		        		<tr>
			        		<th>{{ $parent->title }}</th>
			        	</tr>
					</thead>
			        
						@foreach($menu->childs($parent->id) as $child)

							<tbody>
								@foreach($child->find($child->id)->actions as $action)
									<tr>
										<td><input value = '{{ $action->pivot->id }}' type = 'checkbox' />&nbsp;&nbsp;{{ $action->label.' '.$child->title }}</td>
									</tr>
								@endforeach
							</tbody>

						@endforeach

		        	@endforeach
		        
		    </table>
	    </div><!-- /.box-body -->
	  </div><!-- /.box -->

	  
	</div><!-- /.col -->
    
 </div>

@endsection
