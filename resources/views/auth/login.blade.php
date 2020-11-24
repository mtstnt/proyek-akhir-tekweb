@extends('layout/app')

@section('body')
	<h1>Login</h1>
	<form action="{{ route('auth/checkLogin') }}" method="POST">
		<label for="input-email">Email</label>
		<input type="email" name="input-email" id="input-email">
		<label for="input-password">Password</label>
		<input type="password" name="input-password" id="input-password">
		<button type="submit">Submit</button>
		@csrf()
	</form>
@endsection