{{ Form::open(array('action' => 'HomeController@attach', 'files' => true)) }}
	{{ Form::file('attach') }}
	{{ Form::submit('Submit') }}
{{ Form::close() }}

<a href='<?php echo url(); ?>/deleteall'>delete all data in the database</a>