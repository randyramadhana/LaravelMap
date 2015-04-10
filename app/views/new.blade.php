{{ Form::open(array('action' => 'HomeController@attach', 'files' => true)) }}
	{{ Form::file('attach') }}
	{{ Form::submit('Submit') }}
{{ Form::close() }}