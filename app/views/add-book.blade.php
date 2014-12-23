@extends('layouts.base')

@section('meta')
	{{-- expr --}}
@stop

@section('title')
	Profile
@stop

@section('head')
	{{-- expr --}}
@stop

@section('body')
	<div class = "main content">
		<div class = "container margin2000">
			<div class = "row">
				<div class = "twelve columns">
					<h4>Popis registriranih klijenata</h4>
				</div>
			</div>
			{{ Form::open(array('url' => 'test', 'method' => 'POST', 'class' => 'no-margin')) }}
			<div class = "row">
				<div class = "three columns">

					{{ Form::label('title', 'Naslov knjige') }}
					{{ Form::text('title', '', array('placeholder' => 'Naslov knjige')) }}

					{{ Form::label('author', 'Autor knjige') }}
					{{ Form::text('author', '', array('placeholder' => 'Autor knjige')) }}

				</div>
				<div class = "three columns">
				
						{{ Form::label('genre', 'Žanr knjige') }}
						{{ Form::text('genre', '', array('placeholder' => 'Žanr knjige'))}}

						{{ Form::label('year-published', 'Godina izdanja') }}
						{{ Form::text('year-published', '', array('placeholder' => 'Godina izdanja'))}}

				</div>
				<div class = "three columns">

						{{ Form::label('price', 'Cijena knjige')}}
						{{ Form::text('price', '', array('placeholder' => 'Cijena knjige'))}}

						{{ Form::label('stack-state', 'Stanje stoga')}}
						{{ Form::email('stack-state', '', array('placeholder' => 'Stanje stoga'))}}

				</div>
			</div>
			<div class="row">
				<div class = "three columns">

						{{ Form::label('book-copy', 'Primjerak knjige') }}
						{{ Form::file('book-copy', array('placeholder' => 'Primjerak knjige'))}}

						{{ Form::submit('Pošalji')}}

				</div>	
			</div>
			{{ Form::close() }}
		</div>
	</div>
@stop