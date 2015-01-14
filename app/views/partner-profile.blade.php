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
			<div class = "twelve columns profile-name">
				<h2 class = "no-margin">{{ $user['username'] }} - {{ $user['email'] }}</h2>
			</div>
		</div>
		<div class = "row">
			<div class = "twelve columns">
				<h4>Broj kupljenih e-knjiga</h4>
			</div>
		</div>
		<div class = "row margin0020">
			<div class = "one-third column">
				<h5>Ukupno</h5>
				<h5 class = "no-margin">{{ $user['total_bought_books'] }}</h5>
			</div>
			<div class = "one-third column">
				<h5>Od knjižare</h5>
				<h5 class = "no-margin">{{ $user['total_bought_bookstore'] }}</h5>
			</div>
			<div class = "one-third column">
				<h5>Od klijenata</h5>
				<h5 class = "no-margin">{{ $user['total_bought_users'] }}</h5>
			</div>
		</div>
		<div class = "row">
			<div class = "twelve columns">
				<h4>Statistika</h4>
			</div>
		</div>
		<div class = "row">
			<div class = "one-third column">
				<h5>Ukupna cijena</h5>
				<h5>{{ $user['total_price_books'] }}</h5>
			</div>
			<div class = "one-third column">
				<h5>Broj partnera</h5>
				<h5>{{ $user['number_of_client_partners'] }}</h5>
			</div>
			<div class = "one-third column">
				<h5>Rang korisnika</h5>
				<h5>{{ $user['user_rank'] }}</h5>
			</div>
		</div>
	</main>
</div>

@stop