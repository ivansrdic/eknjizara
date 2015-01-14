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
				<h2 class = "no-margin">{{ Auth::user()->username }}</h2>
				<a href="{{ URL::route('edit') }}"><h6>edit</h6></a>
			</div>
		</div>
		@if(Auth::user()->isAdmin)
			<div class = "admin border-top">
				<div class = "row margin2000">
					<div class = "twelve columns">
						<h4>Statistika knjižare</h4>
					</div>
				</div>
				<div class = "row">
					<div class = "three columns">
						<h5>Broj naslova</h5>
						<h5>{{$bookstore['total_number_of_titles']}}</h5>
					</div>
					<div class = "three columns">
						<h5>Ostvarene kupnje</h5>
						<h5>{{$bookstore['total_number_of_sold_titles']}}</h5>
					</div>
					<div class = "three columns">
						<h5>Zarada od kupnji</h5>
						<h5>{{$bookstore['total_earnings']}}</h5>
					</div>
					<div class = "three columns">
						<h5>Zarada od provizija</h5>
						<h5>{{$bookstore['commission_earnings']}}</h5>
					</div>
				</div>
			</div>
		@else
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
		@endif

		<div class = "row margin2020">
			@if(Auth::user()->isAdmin)
				<div class = "one-third column">
					<a href="{{ route('add-book') }}" class = "center"><h5>Dodavanje nove knjige</h5></a>
				</div>
				<div class = "one-third column">
					<a href="{{ route('admin-book-list') }}" class = "center"><h5>Pregled dostupnih knjiga</h5></a>
				</div>
				<div class = "one-third column">
					<a href="{{ route('admin-registered-list')}}" class = "center"><h5>Popis registriranih klijenata</h5></a>
				</div>
			@else
				<div class = "twelve columns">
					<a href="{{ route('client-partner-list') }}" class = "center"><h5>Popis klijenata partnera</h5></a>
				</div>
			@endif
		</div>
		@if(!Auth::user()->isAdmin)
			<div class = "row">
				<div class = "twelve columns">
					<h4>Popis kupljenih e-knjiga</h4>
				</div>
			</div>
			<div class = "row text-list">
				<div class = "twelve columns margin2000">
					@foreach($books as $book)
						<div class = "row border-bottom">
							<div class = "twelve columns">
								<h5>{{$book['book_title']}} - {{$book['price']}}</h5>
								<h5>{{$book['date']}}</h5>
							</div>
						</div>
						<div class = "row">
							<div class = "twelve columns">
								<div class = "twelve columns">
									<h6>{{$book['seller']}}</h6>
									<a href="{{$book['book_description']}}"><h6>Opis</h6></a>
									<h6>&nbsp;/&nbsp;</h6>
									<a href="{{URL::asset($book['book_certificate'])}}"><h6>Certifikat</h6></a>
									<h6>&nbsp;/&nbsp;</h6>
									<a href="{{URL::asset($book['book_pdf'])}}"><h6>Knjiga</h6></a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endif
	</main>
</div>

@stop