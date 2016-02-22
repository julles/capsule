@if(Session::get('info'))
	<div class="alert alert-info">
		<p>{{ Session::get('info') }}</p>
	</div>
@endif