@if(Session::has('deleteall'))
	<div class="alert-box success">
		<h2>{{ Session::get('deleteall') }}</h2>
	</div>
@endif

{{ Form::open(array('action' => 'HomeController@attach', 'files' => true)) }}
	{{ Form::file('attach') }}
	{{ Form::submit('Submit') }}
{{ Form::close() }}

<a href='<?php echo url(); ?>/deleteall'>delete all data in the database</a>