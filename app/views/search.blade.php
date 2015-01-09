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
		@foreach($books as $book)
			@if($countBooks % 4 == 0)
				</div>
				<div class = "row margin0020">
			@endif
			<?php $countBooks--; ?>

			<a href = "{{ URL::asset('book/123') }}" class = "three columns">
				<div class = "display-book">
					<img src="images/book-covers/1.jpg">
					<ul class="center no-margin">
						<li><h5 class="no-margin">{{ $book['book_title'] }}</h5></li>
						<li>{{ $book['authors'] }}</li>
					</ul>
				</div>
			</a>
		@endforeach
		</div>
	</main>
</div>

@stop