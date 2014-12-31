@extends('layout.main')

@section('content')
	<form action="{{ URL::route('account-create-post') }}" method="post">
		
		<div class="field">
			Name: <input type="text" name="name" {{ (Input::old('name')) ? ' value="' .  e(Input::old('name')) . '"' : ''}}>
			@if($errors->has('name'))
				{{ $errors->first('name') }}
			@endif

			Lastname: <input type="text" name="lastname" {{ (Input::old('lastname')) ? ' value="' .  e(Input::old('lastname')) . '"' : ''}}>
			@if($errors->has('lastname'))
				{{ $errors->first('lastname') }}
			@endif
		</div>

		<div class="field">
			Email: <input type="text" name="email" {{ (Input::old('email')) ? ' value="' .  e(Input::old('email')) . '"' : ''}}>
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif
		</div>

		<div class="field">
			Username: <input type="text" name="username" {{ (Input::old('username')) ? ' value="' .  e(Input::old('username')) . '"' : ''}}>
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif
		</div>

		<div class="field">
			Password: <input type="password" name="password">
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>

		<div class="field">
			Password repeat: <input type="password" name="password_repeat">
			@if($errors->has('password_repeat'))
				{{ $errors->first('password_repeat') }}
			@endif
		</div>

		<input type="submit" value="Create account">
		{{ Form::token() }}
	</form>
@stop