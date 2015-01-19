@extends('layouts.base')

@section('meta')
	{{-- expr --}}
@stop

@section('title')
	Naslovna stranica
@stop

@section('head')
	{{-- expr --}}
@stop

@section('body')
<div class = "main content">
	<main class = "container margin2000">
		@if(Session::has('global'))
			<div class = "row">
				<div class = "twelve columns">
					<h4 class="u-center u-error">{{Session::get('global')}}</h4>
				</div>
			</div>
		@endif
		@if(Auth::guest())
		<div class = "row">
			<div class = "four columns">
				<h2>Login</h2>
			</div>
			<div class = "six columns offset-by-two">
				<h2>Register</h2>
			</div>
		</div>

		<!-- change form url, switch hardcoded data with foreach and check if there is a picture -->
		<div class = "row">
			<div class = "four columns">
				{{ Form::open(array('url' => route('account-sign-in-post'), 'method' => 'POST')) }}

					{{ Form::label('usernameLogin', 'Korisničko ime') }}
					{{ Form::text('usernameLogin', '', array('placeholder' => 'Korisničko ime')) }}
					@if($errors->has('usernameLogin'))
						<div class="u-error"> {{ $errors->first('usernameLogin') }}</div>
					@endif

					{{ Form::label('password', 'Lozinka') }}
					{{ Form::password('password', array('placeholder' => 'Lozinka'))}}
					@if($errors->has('password'))
						<div class="u-error"> {{ $errors->first('password') }}</div>
					@endif

					{{ Form::submit('Pošalji')}}

				{{ Form::close() }}
			</div>
			{{ Form::open(array('url' => route('account-create-post'), 'method' => 'POST', 'class' => 'no-margin')) }}
			<div class = "three columns offset-by-two">

					{{ Form::label('name', 'Ime') }}
					{{ Form::text('name', '', array('placeholder' => 'Ime')) }}
					@if($errors->has('name'))
						<div class="u-error"> {{ $errors->first('name') }}</div>
					@endif

					{{ Form::label('lastname', 'Prezime') }}
					{{ Form::text('lastname', '', array('placeholder' => 'Prezime')) }}
					@if($errors->has('lastname'))
						<div class="u-error"> {{ $errors->first('lastname') }}</div>
					@endif

			</div>
			<div class = "three columns">

					{{ Form::label('email', 'Email adresa')}}
					{{ Form::email('email', '', array('placeholder' => 'Email adresa'))}}
					@if($errors->has('email'))
						<div class="u-error"> {{ $errors->first('email') }}</div>
					@endif

					{{ Form::label('username', 'Korisničko ime') }}
					{{ Form::text('username', '', array('placeholder' => 'Korisničko ime')) }}
					@if($errors->has('username'))
						<div class="u-error"> {{ $errors->first('username') }}</div>
					@endif

					{{ Form::label('password', 'Lozinka') }}
					{{ Form::password('password', array('placeholder' => 'Lozinka'))}}
					@if($errors->has('password'))
						<div class="u-error"> {{ $errors->first('passwords') }}</div>
					@endif

					{{ Form::Submit('Pošalji')}}
			</div>
			{{ Form::close() }}
		</div>
		@endif
		<div class = "row">
			<h4>Najprodavanije</h4>
		</div>
		<div class = "row">
			@foreach($topSeller as $book)
			<a href = "{{route('book', $book['book_id'])}}" class = "three columns">
				<div class = "display-book">
					<img src="{{ $book['link_picture']}}">
					<ul class="center no-margin">
						<li><h5 class="no-margin">{{$book['book_title']}}</h5></li>
						<li>{{$book['authors']}}</li>
					</ul>
				</div>
			</a>
			@endforeach
		</div>

		<div class = "row">
			<h4>Najnovije</h4>
		</div>
		<div class = "row">
			@foreach($newest as $book)
			<a href = "{{route('book', $book['book_id'])}}" class = "three columns">
				<div class = "display-book">
					<img src="{{ $book['link_picture']}}">
					<ul class="center no-margin">
						<li><h5 class="no-margin">{{$book['book_title']}}</h5></li>
						<li>{{$book['authors']}}</li>
					</ul>
				</div>
			</a>
			@endforeach
		</div>
	</main>
</div>

@stop