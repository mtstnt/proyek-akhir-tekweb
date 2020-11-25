@extends('layout/app')

@section('body')
	<h1>Register</h1>
	@if (session()->flash('error') != null)
		<div class="alert alert-danger">
			{{ session()->flash('error') }}
		</div>
	@endif
	<form action="{{ route('auth/checkRegister') }}" method="POST">
		<label for="input-email">First Name</label>
		<input type="text" name="input-fname" id="input-fname">
		<label for="input-email">Last Name</label>
		<input type="text" name="input-lname" id="input-lname">
		<label for="input-email">Email</label>
		<input type="email" name="input-email" id="input-email">
		<label for="input-password">Password</label>
		<input type="password" name="input-password" id="input-password">
		<label for="input-password">Confirm Password</label>
		<input type="password" name="input-confirm" id="input-confirm">
		<button type="submit">Submit</button>
		@csrf()
	</form>
@endsection