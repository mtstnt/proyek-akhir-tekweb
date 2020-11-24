<nav>
	<a href="#">Ahay</a>

	@if (Auth::check())
		<a href="{{ route('auth/logout') }}">Logout</a>
	@else
		<a href="#">Login</a>
	@endif
	
</nav>