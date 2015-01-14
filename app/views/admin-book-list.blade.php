@extends('layouts.base')

@section('meta')
	{{-- expr --}}
@stop

@section('title')
	Naslovna stranica
@stop

@section('head')
	{{-- expr --}}
@stop

@section('body')
<div class = "main content">
	<div class = "container margin2000">
		@if(Session::has('global'))
			<div class = "row">
				<div class = "twelve columns">
					<h4 class="u-center u-error">{{Session::get('global')}}</h4>
				</div>
			</div>
		@endif
		<div class = "row">
			<h4>Pregled dostupnih knjiga</h4>
		</div>
		<div class = "row text-list">
			@foreach($books as $book)
			<div class = "twelve columns margin2000"> <!-- START -->
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>{{$book['book_title']}} - {{round($book['price'], 2)}}</h5>
						<a href="{{route('delete-book', $book['book_id'])}}"><h6>X Ukloni</h6></a>
					</div>
				</div>
				<div class = "row">
					<div class = "twelve columns">
						<div class = "twelve columns">
							<h6>{{$book['authors']}}</h6>
							<a href="{{route('home')}}book/{{$book['book_id']}}"><h6>Opis</h6></a>
							<h6>&nbsp;/&nbsp;</h6>
							<a href="{{route('home')}}{{$book['link_to_PDF']}}"><h6>Knjiga</h6></a>
						</div>
					</div>
				</div>
			</div><!-- END -->
			@endforeach
		</div>
	</div>
</div>
@stop