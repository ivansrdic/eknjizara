@extends('layouts.base')

@section('meta')
	{{-- expr --}}
@stop

@section('title')
	Pretaži knjige
@stop

@section('head')
	{{-- expr --}}
@stop

@section('body')

<div class = "main content">
	<main class = "container margin2000">
		<div class = "row center margin0020">
			<!-- change form url, switch hardcoded data with foreach and check if there is a picture -->
			{{ Form::open(array('url' => 'search', 'method' => 'POST')) }}

				{{ Form::text('search', '', array(
												'placeholder' => 'Pretraži knjige',
												'style' => 'width: 288px;'))}}

				{{ Form::select('sort_by', array(
												'title' => 'Naslov',
												'author' => 'Autor',
												'genre' => 'Žanr',
												'year' => 'Godina izdanja'
												), 'title') }}

				{{ Form::submit('Pošalji', array('style' => 'display: inline-block;'))}}

			{{ Form::close() }}
		</div>

		<div class = "row margin0020">
			<a href = "{{ URL::asset('book/123') }}" class = "three columns">
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
		<div class = "row margin0020">
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