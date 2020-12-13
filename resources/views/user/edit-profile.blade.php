@extends('layout/app')

@section('after-head')
<style>
	ul .nav-link:hover {
		color: powderblue !important;
		font-weight: bold;
		font-size: 25px;
	}

	ul .nav-link {
		margin-right: 25px;
		font-size: 20px;
		font-family: "Segoe UI, Tahoma, Geneva, Verdana, sans-serif";
	}

	span {
		margin-right: 25px;
	}

	h1:hover,
	label:hover {
		color: magenta !important;
	}

	span:hover {
		color: powderblue !important;
	}

	div {
		font-family: "Segoe UI, Tahoma, Geneva, Verdana, sans-serif";
	}
</style>
@endsection

@section('body')
<div class="container">
	<div class="d-flex justify-content-center my-4" style="padding-top:15px">
		<h1>Edit Profile</h1>
	</div>
	<div class="container">
		<form action="{{ route("user/save-edit-profile") }}" method="POST">
			<div class="form-group">
				<label for="fname">First Name:</label>
				<input type="text" class="form-control" id="fname" placeholder="Enter your first name" name="first">
			</div>
			<div class="form-group">
				<label for="lname">Last Name:</label>
				<input type="text" class="form-control" id="lname" placeholder="Enter your last name" name="last">
			</div>
			<div class="form-group">
				<label for="mail">Email:</label>
				<input type="email" class="form-control" id="mail" placeholder="Enter your email" name="email">
			</div>
			<div class="form-group">
				<label for="pass">Password:</label>
				<input type="password" class="form-control" id="pass" placeholder="Enter new password" name="pswd">
			</div>
			<button type="submit" class="btn btn-primary btn-block font-weight-bolder" id="editProfile">EDIT</button>
		</form>
	</div>
	<br><br>
</div>
@endsection