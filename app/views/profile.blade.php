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
				<h2 class = "no-margin">Spidey</h2>
				<a href="{{ URL::route('edit') }}"><h6>edit</h6></a>
			</div>
		</div>
		@if(!Auth::user()->isAdmin)
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
						<h5>200</h5>
					</div>
					<div class = "three columns">
						<h5>Ostvarene kupnje</h5>
						<h5>30000</h5>
					</div>
					<div class = "three columns">
						<h5>Zarada od kupnji</h5>
						<h5>1000</h5>
					</div>
					<div class = "three columns">
						<h5>Zarada od provizija</h5>
						<h5>20232</h5>
					</div>
				</div>
				<div class = "row margin2020">
					<div class = "one-third column">
						<a href="{{ route('add-book') }}" class = "center"><h5>Dodavanje nove knjige</h5></a>
					</div>
					<div class = "one-third column">
						<a href="{{ route('admin-book-list') }}" class = "center"><h5>Pregled dostupnih knjiga</h5></a>
					</div>
					<div class = "one-third column">
						<a href="{{ route('admin-registered-list')}}" class = "center"><h5>Popis registriranih klijenata</h5></a>
					</div>
				</div>
			</div>
		@endif

		<div class = "row text-list">
			<div class = "twelve columns margin2000">
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>Lord of the Rings and The Fellowship of The Ring - 200kn</h5>
						<h5>26/12/2014</h5>
					</div>
				</div>
				<div class = "row">
					<div class = "twelve columns">
						<div class = "twelve columns">
							<h6>Knjižara/Ime Prezime</h6>
							<a href=""><h6>Opis</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Certifikat</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Knjiga</h6></a>
						</div> <!-- To anyone reading this source..... GET FUCKED! -->
					</div>
				</div>
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>Lord of the Rings and The Fellowship of The Ring - 200kn</h5>
						<h5>26/12/2014</h5>
					</div>
				</div>
				<div class = "row">
					<div class = "twelve columns">
						<div class = "twelve columns">
							<h6>Knjižara/Ime Prezime</h6>
							<a href=""><h6>Opis</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Certifikat</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Knjiga</h6></a>
						</div> <!-- To anyone reading this source..... GET FUCKED! -->
					</div>
				</div>
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>Lord of the Rings and The Fellowship of The Ring - 200kn</h5>
						<h5>26/12/2014</h5>
					</div>
				</div>
				<div class = "row">
					<div class = "twelve columns">
						<div class = "twelve columns">
							<h6>Knjižara/Ime Prezime</h6>
							<a href=""><h6>Opis</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Certifikat</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Knjiga</h6></a>
						</div> <!-- To anyone reading this source..... GET FUCKED! -->
					</div>
				</div>
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>Lord of the Rings and The Fellowship of The Ring - 200kn</h5>
						<h5>26/12/2014</h5>
					</div>
				</div>
				<div class = "row">
					<div class = "twelve columns">
						<div class = "twelve columns">
							<h6>Knjižara/Ime Prezime</h6>
							<a href=""><h6>Opis</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Certifikat</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Knjiga</h6></a>
						</div> <!-- To anyone reading this source..... GET FUCKED! -->
					</div>
				</div>
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>Lord of the Rings and The Fellowship of The Ring - 200kn</h5>
						<h5>26/12/2014</h5>
					</div>
				</div>
				<div class = "row">
					<div class = "twelve columns">
						<div class = "twelve columns">
							<h6>Knjižara/Ime Prezime</h6>
							<a href=""><h6>Opis</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Certifikat</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Knjiga</h6></a>
						</div> <!-- To anyone reading this source..... GET FUCKED! -->
					</div>
				</div>
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>Lord of the Rings and The Fellowship of The Ring - 200kn</h5>
						<h5>26/12/2014</h5>
					</div>
				</div>
				<div class = "row">
					<div class = "twelve columns">
						<div class = "twelve columns">
							<h6>Knjižara/Ime Prezime</h6>
							<a href=""><h6>Opis</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Certifikat</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Knjiga</h6></a>
						</div> <!-- To anyone reading this source..... GET FUCKED! -->
					</div>
				</div>
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>Lord of the Rings and The Fellowship of The Ring - 200kn</h5>
						<h5>26/12/2014</h5>
					</div>
				</div>
				<div class = "row">
					<div class = "twelve columns">
						<div class = "twelve columns">
							<h6>Knjižara/Ime Prezime</h6>
							<a href=""><h6>Opis</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Certifikat</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Knjiga</h6></a>
						</div> <!-- To anyone reading this source..... GET FUCKED! -->
					</div>
				</div>
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>Lord of the Rings and The Fellowship of The Ring - 200kn</h5>
						<h5>26/12/2014</h5>
					</div>
				</div>
				<div class = "row">
					<div class = "twelve columns">
						<div class = "twelve columns">
							<h6>Knjižara/Ime Prezime</h6>
							<a href=""><h6>Opis</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Certifikat</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href=""><h6>Knjiga</h6></a>
						</div> <!-- To anyone reading this source..... GET FUCKED! -->
					</div>
				</div>
			</div>
	</main>
</div>

@stop