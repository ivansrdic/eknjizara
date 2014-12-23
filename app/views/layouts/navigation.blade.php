<div class = "main navigation">
	<nav class = "container">
		<div class = "ten columns">
			<ul>
				<li><a href = "{{ URL::asset('') }}">Home</a></li>
				<li><a href = "{{ URL::route('search') }}">Search</a></li>
				<li><a href = "{{ URL::route('profile') }}">Profile</a></li>
				<li><a href = "">Logout</a></li><!-- If logged in -->
			</ul>
		</div>
		<div class = "two columns">
			<a href = ""><img src = "{{ URL::asset('images/logo.png') }}"></a>
		</div>
	</nav>
</div>