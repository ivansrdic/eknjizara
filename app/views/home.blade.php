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
				{{ Form::open(array('url' => 'test', 'method' => 'POST')) }}

					{{ Form::label('username', 'Korisničko ime') }}
					{{ Form::text('username', '', array('placeholder' => 'Korisničko ime')) }}

					{{ Form::label('password', 'Lozinka') }}
					{{ Form::password('password', array('placeholder' => 'Lozinka'))}}

					{{ Form::submit('Pošalji')}}

				{{ Form::close() }}
			</div>
			{{ Form::open(array('url' => 'test', 'method' => 'POST', 'class' => 'no-margin')) }}
			<div class = "three columns offset-by-two">

					{{ Form::label('name', 'Ime') }}
					{{ Form::text('name', '', array('placeholder' => 'Ime')) }}

					{{ Form::label('lastName', 'Prezime') }}
					{{ Form::text('lastName', '', array('placeholder' => 'Prezime')) }}

			</div>
			<div class = "three columns">

					{{ Form::label('email', 'Email adresa')}}
					{{ Form::email('email', '', array('placeholder' => 'Email adresa'))}}

					{{ Form::label('username', 'Korisničko ime') }}
					{{ Form::text('username', '', array('placeholder' => 'Korisničko ime')) }}

					{{ Form::label('password', 'Lozinka') }}
					{{ Form::password('password', array('placeholder' => 'Lozinka'))}}

					{{ Form::Submit('Pošalji')}}
			</div>
			{{ Form::close() }}
		</div>

		<div class = "row">
			<h4>Najprodavanije</h4>
		</div>
		<div class = "row">
			<a href = "" class = "three columns">
				<div class = "display-book">
					<img src="images/book-covers/1.jpg">
					<ul class="center no-margin">
						<li><h5 class="no-margin">Lord of the pigs</h5></li>
						<li>J. R. R. Tolkien</li>
					</ul>
				</div>
			</a>
			<a href = "" class = "three columns">
				<div class = "display-book">
					<img src="images/book-covers/2.jpg">
					<ul class="center no-margin">
						<li><h5 class="no-margin">Silmarilion</h5></li>
						<li>J. R. R. Tolkien</li>
					</ul>
				</div>
			</a>
			<a href = "" class = "three columns">
				<div class = "display-book">
					<img src="images/book-covers/3.jpg">
					<ul class="center no-margin">
						<li><h5 class="no-margin">Harry Potter And The Sorcerer's Stone</h5></li>
						<li>J. K. Rowling</li>
					</ul>
				</div>
			</a>
			<a href = "" class = "three columns">
				<div class = "display-book">
					<img src="images/book-covers/4.jpg">
					<ul class="center no-margin">
						<li><h5 class="no-margin">Harry Potter And The Deathly Hallows</h5></li>
						<li>J. K. Rowling</li>
					</ul>
				</div>
			</a>
		</div>

		<div class = "row">
			<h4>Najnovije</h4>
		</div>
		<div class = "row">
			<a href = "" class = "three columns">
				<div class = "display-book">
					<img src="images/book-covers/1.jpg">
					<ul class="center no-margin">
						<li><h5 class="no-margin">Lord of the pigs</h5></li>
						<li>J. R. R. Tolkien</li>
					</ul>
				</div>
			</a>
			<a href = "" class = "three columns">
				<div class = "display-book">
					<img src="images/book-covers/2.jpg">
					<ul class="center no-margin">
						<li><h5 class="no-margin">Silmarilion</h5></li>
						<li>J. R. R. Tolkien</li>
					</ul>
				</div>
			</a>
			<a href = "" class = "three columns">
				<div class = "display-book">
					<img src="images/book-covers/3.jpg">
					<ul class="center no-margin">
						<li><h5 class="no-margin">Harry Potter And The Sorcerer's Stone</h5></li>
						<li>J. K. Rowling</li>
					</ul>
				</div>
			</a>
			<a href = "" class = "three columns">
				<div class = "display-book">
					<img src="images/book-covers/4.jpg">
					<ul class="center no-margin">
						<li><h5 class="no-margin">Harry Potter And The Deathly Hallows</h5></li>
						<li>J. K. Rowling</li>
					</ul>
				</div>
			</a>
		</div>
	</main>
</div>

@stop