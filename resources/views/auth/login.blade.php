@extends('layout/app')

@section('after-head')
	<style>
		body {
			overflow:hidden;
		}

		.side-image {
			height: 100vh;
		}
	</style>
@endsection

@section('body')
	<div class="d-xl-none d-xs-block">
		<div class="row">
			<form class="col-8 mx-auto" action="{{ route('auth/checkLogin') }}" method="POST">
				<h1 class="display-4">Login</h1>
				<label for="input-email">Email</label>
				<input class="form-control" type="email" name="input-email" id="input-email">
				<label for="input-password">Password</label>
				<input class="form-control" type="password" name="input-password" id="input-password">
				<button type="submit">Submit</button>
				@csrf()
			</form>
		</div>
	</div>

	<div class="d-none d-xl-block">
		<div class="row">
			<div class="col-8 bg-primary side-image">
			</div>
			<form class="col-4 mx-auto p-5" action="{{ route('auth/checkLogin') }}" method="POST">
				<div class="col-12 mx-auto">
					<h1 class="font-weight-bold">Sign In</h1>
					<label for="input-email">Email</label>
					<input class="form-control" type="email" name="input-email" id="input-email">
					<label for="input-password">Password</label>
					<input class="form-control" type="password" name="input-password" id="input-password">
					<button class="btn btn-primary d-block w-100 my-3" type="submit">Submit</button>
					@csrf()
				</div>
			</form>
		</div>
	</div>
@endsection
