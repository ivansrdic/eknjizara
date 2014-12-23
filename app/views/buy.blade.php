@extends('layouts.base')

@section('meta')
	{{-- expr --}}
@stop

@section('title')
	Kupi knjigu
@stop

@section('head')
	{{-- expr --}}
@stop

@section('body')

<div class = "main content">
	<main class = "container margin2000">
		<div class="row">
			<!-- change form url, switch hardcoded data with controller data and check if there is a picture -->
			<div class = "one-third column">
				<img class = "book-cover-spec" src="{{ URL::asset('images/book-covers/1.jpg') }}">
			</div>
			<div class = "two-thirds column">
				<div class = "row">
					<h3>Lord of the pigs</h3>
				</div>
				<div class="row">
					<h5>Prodavač</h5>
				</div>
				<div class="row">
					<div class = "one-half column">
						<h5>Najniža cijena</h5>
						<h5 class="margin0020">3.14</h5>
						{{ Form::open(array('url' => 'test', 'method' => 'POST')) }}
							{{ Form::hidden('bookId', '123') }}
							{{ Form::submit('Kupi knjigu')}}

						{{ Form::close() }}
					</div>
					<div class = "one-half column">
						<h5>Broj postojećih kupnji</h5>
						<h5 class = "margin0020">3.14*10^9</h5>
						<h5>Stanje stoga</h5>
						<h5>10/10</h5>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>

@stop