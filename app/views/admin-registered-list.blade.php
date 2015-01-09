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
				<h4>Popis registriranih klijenata</h4>
			</div>
			<div class = "row text-list">
			@foreach($users as $user)
				<div class = "twelve columns margin2000"><!-- START-->
					<div class = "row border-bottom">
						<div class = "twelve columns">
							<h5>{{ $user['full_name'] }}</h5>
							<h5>{{ $user['username'] }}</h5>
						</div>
					</div>
					<div class = "row">
						<div class = "twelve columns">
							<div class = "twelve columns">
								<h6>{{ $user['email'] }}</h6>
								<h6></h6><!-- hackaround -->
							</div>
						</div>
					</div>
				</div><!-- END -->
			@endforeach
			</div>
		</div>
	</main>
@stop