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
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-sm-4 m-auto">
			<div class="card bg-white mt-5" style="border-radius:25px">
				<div class="card-title text-white mt-5">
					<h1 class="text-center py-3 text-dark font-weight-bold" ,
						style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-size:50px">
						Login Page</h1>
				</div>

				<?php
				if (@$_GET['Empty'] == true) {
				?>
				<div class="alert-white text-danger text-center py-3"><?php echo $_GET['Empty'] ?></div>
				<?php
				}
				?>


				<?php
				if (@$_GET['Invalid'] == true) {
				?>
				<div class="alert-white text-danger text-center py-3"><?php echo $_GET['Invalid'] ?></div>
				<?php
				}
				?>

				<div class="card-body text-center">
					<form action="process.php" method="post">
						<input type="text" name="e_mail" placeholder=" E-mail" class="form-control mb-3">
						<input type="password" name="Password" placeholder=" Password" class="form-control mb-3">
						<button class="btn text-white bg-warning mt-3 font-weight-bold"
							style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-size:20px"
							name="Login">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection