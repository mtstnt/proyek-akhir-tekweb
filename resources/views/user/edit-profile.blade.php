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
</style>
@endsection

@section('body')
<div class="container">
	@if(session()->get('error') != null)
	<div class="alert alert-danger my-4">
		{{ session()->get('error') }}
	</div>
	@endif
	@if(session()->get('success'))
	<div class="alert alert-success my-4">
		{{ session()->get('success') }}
	</div>
	@endif
	<div class="d-flex justify-content-center my-4" style="padding-top:15px">
		<h1>Edit Profile</h1>
	</div>
	<div class="container">
		<form action="{{ route("user/save-edit-profile") }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label for="fname">First Name:</label>
				<input type="text" class="form-control" id="edit-first-name" placeholder="Enter your first name"
					name="edit-first-name" value="{{ $user->first_name }}">
			</div>
			<div class="form-group">
				<label for="lname">Last Name:</label>
				<input type="text" class="form-control" id="edit-last-name" placeholder="Enter your last name"
					name="edit-last-name" value="{{ $user->last_name }}">
			</div>
			<div class="form-group">
				<label for="mail">Email:</label>
				<input type="email" class="form-control" id="edit-email" placeholder="Enter your email"
					name="edit-email" value="{{ $user->email }}">
			</div>
			<div class="form-group">
				<label for="pass">Old Password:</label>
				<input type="password" class="form-control" id="confirm-password" placeholder="Enter old password"
					name="confirm-password">
			</div>
			<div class="form-group">
				<label for="pass">New Password:</label>
				<input type="password" class="form-control" id="edit-password" placeholder="Enter new password"
					name="edit-password">
			</div>
			<div class="form-group">
				<div class="custom-file">
					<input type="file" class="custom-file-input input-file" name="edit-avatar" id="edit-avatar">
					<label class="custom-file-label" id="label-input-file" for="edit-avatar">Choose new avatar</label>
				</div>
			</div>
			<button type="submit" class="btn btn-primary btn-block font-weight-bolder" id="editProfile">Edit</button>
		</form>
	</div>
</div>
@endsection

@section('after-body')
<script>
	const inputFile = document.querySelectorAll('.input-file');
	inputFile.forEach(el => {
		el.addEventListener('change', (e) => {
			document.getElementById('label-input-file').innerText = e.target.files[0].name;
		});
	});
</script>
@endsection