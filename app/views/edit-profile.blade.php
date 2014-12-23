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
	<main class = "container margin2000">
		<div class = "row border-bottom margin0020">
			<div class = "twelve columns">
				<h2 class = "no-margin">Spidey</h2>
			</div>
		</div>
		<div class = "row margin0020">
			<div class = "twelve columns">
				<h4 class = "no-margin">Ažuriranje podataka</h4>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">

				{{ Form::open(array('url' => 'test', 'method' => 'POST', 'class' => 'no-margin')) }}
				<div class = "three columns">

					{{ Form::label('name', 'Novo ime') }}
					{{ Form::text('name', '', array('placeholder' => 'Novo ime')) }}

					{{ Form::label('lastname', 'Novo prezime') }}
					{{ Form::text('lastname', '', array('placeholder' => 'Novo prezime')) }}

				</div>
				<div class = "three columns">

						{{ Form::label('email', 'Nova email adresa')}}
						{{ Form::email('email', '', array('placeholder' => 'Nova email adresa'))}}

						{{ Form::label('password', 'Nova lozinka') }}
						{{ Form::password('password', array('placeholder' => 'Nova lozinka'))}}

						{{ Form::submit('Pošalji')}}

				</div>
				{{ Form::close() }}

			</div>
		</div>
	</main>
</div>

@stop