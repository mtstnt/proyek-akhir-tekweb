@extends('layout/app')

@section('after-head')
<style>
	#profile-pic {
		border-radius: 50%;
		margin: 0 auto;
		max-height: 250px;
		max-width: 250px;
	}
</style>
@endsection

@section('body')
<div class="container mt-5">
	<div class="row">
		<div class="col-sm-3">
			<div class="d-flex justify-content-center my-4" style="height:250px">
				<img src="/storage/avatars/{{ Auth::user()->avatar == null ? "default.png" : Auth::user()->avatar }}"
					id="avatar" alt="User Pic" style="height: 100%">
			</div>
		</div>
		<div class="col-sm-9">
			<div class="d-flex justify-content-center my-4">
				<table class="table table-dark table-hover text-justify">
					<tbody>
						<tr>
							<td class="idx">First Name</td>
							<td id="fname">{{ Auth::user()->first_name }}</td>
						</tr>
						<tr>
							<td class="idx">Last Name</td>
							<td id="lname">{{ Auth::user()->last_name }}</td>
						</tr>
						<tr>
							<td class="idx">Email</td>
							<td id="email">{{ Auth::user()->email }}</td>
						</tr>
						<tr>
							<td class="idx">Level</td>
							<td id="lvl">{{ Auth::user()->level }}</td>
						</tr>
						<tr>
							<td class="idx">Credit Points</td>
							<td id="cp">{{ Auth::user()->credit_points }}</td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
		<div class="row d-flex justify-content-center w-100">
			<a class="btn btn-primary w-25 mx-5" href="{{ route("user/history") }}">My Transaction History</a>
			<a class="btn btn-primary w-25 mx-5" href="{{ route("user/edit-profile") }}">Edit Profile</a>
		</div>
	</div>
</div>
@endsection