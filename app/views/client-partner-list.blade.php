@extends('layouts.base')

@section('meta')
	{{-- expr --}}
@stop

@section('title')
	Popis klijenata partnera
@stop

@section('head')
	{{-- expr --}}
@stop

@section('body')

<div class = "main content">
	<main class = "container margin2000">
		<div class = "row">
			<div class = "twelve columns">
				<h4>Popis klijenata-partnera</h4>
			</div>
		</div>
		<div class = "row text-list">
			@foreach($partners as $partner)
				<div class = "twelve columns margin2000">
					<div class = "row">
						<div class = "twelve columns border-bottom">
							<h5>
								@if($partner['username'] == "MinGW Bookstore")
									{{ $partner['username'] }}
								@else
									<a href="{{ route('partner-profile') }}/{{ urlencode($partner['username']) }}">{{ $partner['username'] }}</a>
								@endif
							</h5>
							<h5>{{ $partner['sold/bought'] }}</h5>
						</div>
					</div>
					<div class = "row">
						<div class = "twelve columns">
							<div class = "twelve columns">
								<h6>{{ $partner['book_title'] }}</h6>
								<h6>{{ $partner['created_at'] }}</h6>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</main>
</div>

@stop