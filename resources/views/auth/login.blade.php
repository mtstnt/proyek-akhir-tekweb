@extends('layout/app')

@section('after-head')
<style>
	body {
		overflow: hidden;
	}

	.side-image {
		height: 100vh;
	}
</style>
@endsection

@section('body')

<div class="modal fade" id="login-choice" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Pick a Mode</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-6">
						<button class="m-0 btn btn-dark text-light w-100" style="height: 300px"><i class="fa fa-users" style="font-size: 4rem"></i><br><a class="text-light" href="{{ url('auth/autologin/0') }}" >User</a></button>
					</div>
					<div class="col-6">
						<button class="m-0 btn btn-light text-dark w-100" style="height: 300px"><i class="fa fa-user" style="font-size: 4rem"></i><br><a class="text-dark" href="{{ url('auth/autologin/1') }}" >Admin</a></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-sm-12 m-auto">
			<div class="card bg-white mt-5 p-3" style="border-radius:25px">
				<div class="card-title text-white mt-3">
					<h1 class="text-center text-dark font-weight-bold" ,
						style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-size:50px">
						Login Page</h1>
				</div>
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

				<div class="card-body text-center">
					<form action="{{ route('auth/checkLogin') }}" method="post">
						@csrf
						<p>Not a member already? <a href="{{ route('auth/register') }}">Join us!</a></p>
						<input type="text" name="input-email" id="input-email" placeholder=" E-mail"
							class="form-control mb-3">
						<input type="password" name="input-password" id="input-password" placeholder=" Password"
							class="form-control mb-3">
						<button class="btn m-0 text-white bg-warning font-weight-bold mt-3 w-100"
							style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-size:20px"
							name="Login">Login</button>
						<button class="btn m-0 text-white bg-primary font-weight-bold mt-3 w-100" type="button"
							class="btn btn-primary" data-toggle="modal" data-target="#login-choice">
							Guest Login
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection