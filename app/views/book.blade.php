@extends('layouts.base')

@section('meta')
	{{-- expr --}}
@stop

@section('title')
	Potpuni opis knjige
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
					<h3 class="display-inline-block">Lord of the pigs&nbsp;</h3><h5 class="display-inline-block">(256 stranica)</h5>
				</div>
				<div class="row">
					<h5>Deni Munjas, Ivan Srdić</h5>
				</div>
				<div class="row">
					<div class = "one-half column">
						<h5>Ocijeni knjigu</h5>
						{{ Form::open(array('url' => 'test', 'method' => 'POST')) }}

							{{ Form::select('rating', array(
															'1' => '1',
															'2' => '2',
															'3' => '3',
															'4' => '4',
															'5' => '5'
															), '5') }}

							{{ Form::submit('Pošalji', array('style' => 'display: inline-block;'))}}

						{{ Form::close() }}
						{{ Form::open(array('url' => 'test', 'method' => 'POST')) }}
							{{ Form::hidden('bookId', '123') }}
							{{ Form::submit('Kupi knjigu')}}

						{{ Form::close() }}
					</div>
					<div class = "one-half column">
						<h5>Ocjena knjige</h5>
						<h5 class = "margin0020">5/5</h5>
						<h5>Stanje stoga</h5>
						<h5>10/10</h5>
					</div>
				</div>
			</div>
		</div>
		<div class = "row text-list">
			<div class = "twelve columns margin2000">
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>Spidey</h5>
						<h5>26/12/2014</h5>
					</div>
				</div>
				<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tempus tortor in accumsan pharetra. Nulla id lorem enim. Vivamus justo metus, lobortis sed lacus in, consectetur posuere nisl. Curabitur tincidunt lacus at imperdiet dignissim. Ut tristique nibh ac mi aliquet eleifend. Maecenas consequat finibus maximus. Praesent euismod mauris dolor, et porttitor ante iaculis quis. Etiam lobortis fringilla odio sit amet blandit.
				</p>
			</div>
			<div class = "twelve columns margin2000">
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>Spidey</h5>
						<h5>26/12/2014</h5>
					</div>
				</div>
				<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tempus tortor in accumsan pharetra. Nulla id lorem enim. Vivamus justo metus, lobortis sed lacus in, consectetur posuere nisl. Curabitur tincidunt lacus at imperdiet dignissim. Ut tristique nibh ac mi aliquet eleifend. Maecenas consequat finibus maximus. Praesent euismod mauris dolor, et porttitor ante iaculis quis. Etiam lobortis fringilla odio sit amet blandit.
				</p>
			</div>
			<div class = "twelve columns margin2000">
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>Spidey</h5>
						<h5>26/12/2014</h5>
					</div>
				</div>
				<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tempus tortor in accumsan pharetra. Nulla id lorem enim. Vivamus justo metus, lobortis sed lacus in, consectetur posuere nisl. Curabitur tincidunt lacus at imperdiet dignissim. Ut tristique nibh ac mi aliquet eleifend. Maecenas consequat finibus maximus. Praesent euismod mauris dolor, et porttitor ante iaculis quis. Etiam lobortis fringilla odio sit amet blandit.
				</p>
			</div>
	</main>
</div>

@stop