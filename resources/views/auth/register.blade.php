@extends('layout/app')

@section('body')
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-sm-12 m-auto">
			<div class="card bg-white mt-5 p-3" style="border-radius:25px">
				<div class="card-title bg-white mt-3">
					<h1 class="text-center py-3 text-dark" ,
						style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-size:50px">
						Register Page</h1>
				</div>
				<div class="card-body text-center">
					<form method="POST" action="{{ route('auth/checkRegister') }}">
						<input type="text" name="input-email" placeholder=" E-mail " class="form-control mb-3"></td>
						<input type="password" name="input-password" placeholder=" Password " class="form-control mb-3">
						</td>
						<button class="btn btn-warning text-white mt-3" name="register_btn">Register Now</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- @include('layout/footer') --}}
@endsection
