{{ Form::open(array('action' => 'HomeController@attach', 'files' => true)) }}
	{{ Form::file('attach') }}
	{{ Form::submit('Submit') }}
{{ Form::close() }}

{{ Form::open(array('route' => 'deleteall'))}}
	{{ Form::submit('delete all data in the database')}}
{{ Form::close() }}