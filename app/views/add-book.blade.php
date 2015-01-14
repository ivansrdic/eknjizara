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
	<main class = "main content">
		<div class = "container margin2000">
			<div class = "row">
				<div class = "twelve columns">
					<h4>Dodaj knjigu</h4>
				</div>
			</div>
			@if(Session::has('global'))
				<div class = "row">
					<div class = "twelve columns">
						<h4 class="u-center u-error">{{Session::get('global')}}</h4>
					</div>
				</div>
			@endif
			{{ Form::open(array('url' => route('add-book'), 'files' => true, 'method' => 'POST', 'class' => 'no-margin')) }}
			<div class = "row">
				<div class = "three columns">

					{{ Form::label('book_title', 'Naslov knjige') }}
					{{ Form::text('book_title', '', array('placeholder' => 'Naslov knjige')) }}
					@if($errors->has('book_title'))
						<div class="u-error"> {{ $errors->first('book_title') }}</div>
					@endif

					{{ Form::label('authors', 'Autor knjige') }}
					{{ Form::text('authors', '', array('placeholder' => 'Autor knjige')) }}
					@if($errors->has('authors'))
						<div class="u-error"> {{ $errors->first('authors') }}</div>
					@endif

				</div>
				<div class = "three columns">
				
					{{ Form::label('genres', 'Žanr knjige') }}
					{{ Form::text('genres', '', array('placeholder' => 'Žanr knjige'))}}
					@if($errors->has('genres'))
						<div class="u-error"> {{ $errors->first('genres') }}</div>
					@endif

					{{ Form::label('publication_year', 'Godina izdanja') }}
					{{ Form::text('publication_year', '', array('placeholder' => 'Godina izdanja'))}}
					@if($errors->has('publication_year'))
						<div class="u-error"> {{ $errors->first('publication_year') }}</div>
					@endif

				</div>
				<div class = "three columns">

					{{ Form::label('price', 'Cijena knjige')}}
					{{ Form::text('price', '', array('placeholder' => 'Cijena knjige'))}}
					@if($errors->has('price'))
						<div class="u-error"> {{ $errors->first('price') }}</div>
					@endif

					{{ Form::label('pagenumber', 'Broj stranica') }}
					{{ Form::text('pagenumber', '', array('placeholder' => 'Broj stranica'))}}
					@if($errors->has('pagenumber'))
						<div class="u-error"> {{ $errors->first('pagenumber') }}</div>
					@endif

				</div>
			</div>
			<div class="row">
				<div class = "twelve columns">

					{{ Form::label('description', 'Opis knjige') }}
					{{ Form::textarea('description', '', array('placeholder' => 'Opis knjige')) }}
					@if($errors->has('description'))
						<div class="u-error"> {{ $errors->first('description') }}</div>
					@endif

				</div>	
			</div>
			<div class="row">
				<div class = "three columns">

					{{ Form::label('book_copy', 'Primjerak knjige') }}
					{{ Form::file('book_copy', array('placeholder' => 'Primjerak knjige'))}}
					@if($errors->has('book_copy'))
						<div class="u-error"> {{ $errors->first('book_copy') }}</div>
					@endif

					{{ Form::label('book_picture', 'Naslovnica knjige') }}
					{{ Form::file('book_picture', array('placeholder' => 'Naslovnica knjige'))}}
					@if($errors->has('book_picture'))
						<div class="u-error"> {{ $errors->first('book_picture') }}</div>
					@endif

					{{ Form::submit('Pošalji')}}

				</div>	
			</div>
			{{ Form::close() }}
		</div>
	</main>
@stop