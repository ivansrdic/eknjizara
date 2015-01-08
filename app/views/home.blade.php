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

					{{ Form::label('username', 'Korisničko ime') }}
					{{ Form::text('username', '', array('placeholder' => 'Korisničko ime')) }}

					{{ Form::label('password', 'Lozinka') }}
					{{ Form::password('password', array('placeholder' => 'Lozinka'))}}
					<br/>
					<input type="checkbox" name="remeber" id="remember">
					<label for="remember">Remember me</label>

					{{ Form::submit('Pošalji')}}

				{{ Form::close() }}
			</div>
			{{ Form::open(array('url' => route('account-create-post'), 'method' => 'POST', 'class' => 'no-margin')) }}
			<div class = "three columns offset-by-two">
			@if(Session::has('global'))
				<p>{{Session::get('global')}}</p>
			@endif

					{{ Form::label('name', 'Ime') }}
					{{ Form::text('name', '', array('placeholder' => 'Ime')) }}
					@if($errors->has('name'))
						{{ $errors->first('name') }}
					@endif

					{{ Form::label('lastname', 'Prezime') }}
					{{ Form::text('lastname', '', array('placeholder' => 'Prezime')) }}
					@if($errors->has('lastname'))
						{{ $errors->first('lastname') }}
					@endif

			</div>
			<div class = "three columns">

					{{ Form::label('email', 'Email adresa')}}
					{{ Form::email('email', '', array('placeholder' => 'Email adresa'))}}
					@if($errors->has('email'))
						{{ $errors->first('email') }}
					@endif

					{{ Form::label('username', 'Korisničko ime') }}
					{{ Form::text('username', '', array('placeholder' => 'Korisničko ime')) }}
					@if($errors->has('username'))
						{{ $errors->first('username') }}
					@endif

					{{ Form::label('password', 'Lozinka') }}
					{{ Form::password('password', array('placeholder' => 'Lozinka'))}}
					@if($errors->has('password'))
						{{ $errors->first('passwords') }}
					@endif

					{{ Form::Submit('Pošalji')}}
			</div>
			{{ Form::close() }}
		</div>

		<div class = "row">
			<h4>Najprodavanije</h4>
		</div>
		<div class = "row">
			@foreach($newest as $book)
			<a href = "{{route('book', $book['book_id'])}}" class = "three columns">
				<div class = "display-book">
					<img src="images/book-covers/1.jpg">
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
			@foreach($topSeller as $book)
			<a href = "{{route('book', $book['book_id'])}}" class = "three columns">
				<div class = "display-book">
					<img src="images/book-covers/1.jpg">
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