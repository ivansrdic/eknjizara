@extends('layouts.base')

@section('meta')
	{{-- expr --}}
@stop

@section('title')
	Potpuni opis knjige
@stop

@section('head')
	{{-- expr --}}
@stop

@section('body')

<div class = "main content">
	<main class = "container margin2000">
		<div class="row margin0020">
			<!-- change form url, switch hardcoded data with controller data and check if there is a picture -->
			<div class = "one-third column">
				<img class = "book-cover-spec" src="{{ URL::asset($link_picture) }}">
			</div>
			<div class = "two-thirds column">
				<div class = "row">
					<h3 class="display-inline-block">{{$book_title}}&nbsp;</h3><h5 class="display-inline-block">({{$pagenumber}} stranica)</h5>
				</div>
				<div class="row">
					<h5>{{$authors}}</h5>
				</div>
				<div class="row">
					<div class = "one-half column">
						<h5>Ocijeni knjigu</h5>
						{{ Form::open(array('url' => route('book-post'), 'method' => 'POST')) }}

							{{ Form::select('rating', array(
															'1' => '1',
															'2' => '2',
															'3' => '3',
															'4' => '4',
															'5' => '5',
															'6' => '6',
															'7' => '7',
															'8' => '8',
															'9' => '9',
															'10' => '10'
															), '10') }}

							{{ Form::hidden('type', 'rate') }}
							{{ Form::hidden('book_id', $book_id) }}
							{{ Form::submit('Pošalji', array('style' => 'display: inline-block;'))}}

						{{ Form::close() }}

						<a href="{{route('buy-book', $book_id)}}"><button>Kupi knjigu</button></a>
					</div>
					<div class = "one-half column">
						<h5>Ocjena knjige</h5>
						<h5 class = "margin0020">{{$grade}}/10</h5>
						<h5>Stanje stoga</h5>
						<h5>{{$stack_rank}}/8</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			{{ Form::open(array('url' => route('book-post'), 'method' => 'POST')) }}

				{{ Form::textarea('comment', '', array('class' => 'u-full-width')) }}
				{{ Form::hidden('type', 'comment') }}
				{{ Form::hidden('book_id', $book_id) }}
				{{ Form::submit('Komentiraj', array('class' => 'u-pull-right'))}}

			{{ Form::close() }}
		</div>
		<div class = "row text-list">
			@foreach($comments as $comment)
				<div class = "twelve columns margin2000">
				<div class = "row border-bottom">
					<div class = "twelve columns">
						<h5>{{$comment['username']}}</h5>
						<h5>{{$comment['comment_time']}}</h5>
					</div>
				</div>
				<p>
				{{$comment['comment']}}
				</p>
			</div>
			@endforeach
		</div>
	</main>
</div>

@stop