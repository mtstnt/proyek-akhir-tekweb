<nav>
	<a href="#">Ahay</a>

	@if (Auth::check())
		<a href="{{ route('auth/logout') }}">Logout</a>
		<h3>Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
	@else
		<a href="#">Login</a>
	@endif
	
</nav>