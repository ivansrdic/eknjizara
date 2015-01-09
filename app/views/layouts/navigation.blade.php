<div class = "main navigation">
	<nav class = "container">
		<div class = "ten columns">
			<ul>
				<li><a href = "{{ route('home') }}">Home</a></li>
				<li><a href = "{{ route('search') }}">Search</a></li>
				<li><a href = "{{ route('profile') }}">Profile</a></li>
				@if(Auth::user())
					<li><a href = "{{ route('account-sign-out') }}">Logout</a></li>
				@endif
			</ul>
		</div>
		<div class = "two columns">
			<a href = ""><img src = "{{ URL::asset('images/logo.png') }}"></a>
		</div>
	</nav>
</div>