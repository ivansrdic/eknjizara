{{ Form::open(array('url' => 'test', 'method' => 'POST')) }}
<div class="stars">

<?php 
$ratings = array('1', '2', '3', '4', '5');

foreach ($ratings as $rating): ?>
        <input type="radio" class="star-{{ $rating }}" id="{{ $rating }}" value="{{ $rating }}" class="radio" />
        <label class="star-{{ $rating }}" for="star-{{ $rating }}">{{ $rating }}</label>
<?php endforeach; ?>
        <span></span>
</div>
{{ Form::submit('Pošalji')}}
{{ Form::close() }}