@extends("layout/app")

@section("body")
<br>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4 text-center">
			<a href="#" class="btn btn-secondary" role="button">return to store</a>
		</div>
		<div class="col-sm-4 text-center">
			<h2 class="font-weight-bolder">Matthew Store</h2>
		</div>
		<div class="col-sm-4"></div>
	</div>
	<br>
	<p class="bg-dark text-dark">test</p>
	<br>
	<div class="row">
		<div class="col-sm-4">
			<h3>Order Summary</h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Quantity</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody id="myItems"></tbody>
			</table>
		</div>
		<div class="col-sm-8">
			<h3>Payment Method</h3>
			<form action="#">
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" class="custom-control-input" id="customRadio1" name="example1">
					<label class="custom-control-label" for="customRadio1">VISA</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" class="custom-control-input" id="customRadio2" name="example1">
					<label class="custom-control-label" for="customRadio2">MasterCard</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" class="custom-control-input" id="customRadio3" name="example1">
					<label class="custom-control-label" for="customRadio3">PayPal</label>
				</div>
				<div class="form-group">
					<label for="email">CARD NUMBER:</label>
					<input type="email" class="form-control" id="email" placeholder="Enter your card number"
						name="email">
				</div>
				<div class="form-group">
					<label for="pwd">PASSWORD:</label>
					<input type="password" class="form-control" id="pwd" placeholder="Enter your password to verify"
						name="pswd">
				</div>
				<input type="submit" class="btn btn-warning btn-block" value="Order and Pay">
			</form>
		</div>
	</div>
</div>
</body>
@endsection