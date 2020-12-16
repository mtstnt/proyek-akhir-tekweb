@extends('layout/app')

@section('body')
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-sm-12 m-auto">
			@if(session()->get('error') != null)
			<div class="alert alert-danger">
				{{ session()->get('error') }}
			</div>
			@endif
			@if(session()->get('success'))
			<div class="alert alert-success">
				{{ session()->get('success') }}
			</div>
			@endif
			<div class="card bg-white my-5 p-3" style="border-radius:25px">
				<div class="card-title my-3 bg-white">
					<h1 class="display-4 text-center text-dark">
						Register to Tokobaju</h1>
				</div>
				<div class="card-body text-center">
					<p>A member already? <a href="{{ route('auth/login') }}">Sign in!</a></p>
					<form method="POST" action="{{ route('auth/checkRegister') }}">
						@csrf
						<input type="text" name="input-fname" placeholder="First Name" class="form-control mb-3">
						<input type="text" name="input-lname" placeholder="Last Name" class="form-control mb-3">
						<input type="email" name="input-email" placeholder="Email" class="form-control mb-3">
						<input type="password" name="input-password" placeholder="Password" class="form-control mb-3">
						<input type="password" name="confirm-password" placeholder="Confirm Password"
							class="form-control mb-3">
						<button class="btn m-0 text-white bg-warning font-weight-bold mt-3 w-100"
							style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-size:20px"
							name="Register">Register</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- @include('layout/footer') --}}
@endsection