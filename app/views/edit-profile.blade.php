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
				<h2 class = "no-margin">{{ Auth::user()->username }}</h2>
			</div>
		</div>
		<div class = "row margin0020">
			<div class = "twelve columns">
				<h4 class = "no-margin">Promjena lozinke</h4>
			</div>
		</div>
		@if(Session::has('global'))
			<div class = "row">
				<div class = "twelve columns">
					<h4 class="u-center u-error">{{Session::get('global')}}</h4>
				</div>
			</div>
		@endif
		<div class="row">
			<div class="twelve columns">

				{{ Form::open(array('url' => route('edit'), 'method' => 'POST', 'class' => 'no-margin')) }}
				<div class = "three columns">

					{{ Form::label('old_password', 'Stara lozinka') }}
					{{ Form::password('old_password', array('placeholder' => 'Stara lozinka'))}}
					@if($errors->has('old_password'))
						<div class="u-error"> {{ $errors->first('old_password') }}</div>
					@endif

					{{ Form::label('password', 'Nova lozinka') }}
					{{ Form::password('password', array('placeholder' => 'Nova lozinka'))}}
					@if($errors->has('password'))
						<div class="u-error"> {{ $errors->first('password') }}</div>
					@endif

					{{ Form::submit('Pošalji')}}

				</div>
				{{ Form::close() }}

			</div>
		</div>
	</main>
</div>

@stop