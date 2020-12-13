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

	h1:hover {
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
	<div class="d-flex justify-content-center my-4">
		<h1>History</h1>
	</div>
	<div class="d-flex justify-content-center my-4">
		<table class="table table-dark table-hover text-center">
			<thead>
				<tr>
					<th>Date and Time</th>
					<th>Items</th>
					<th>Total Price</th>
					<th>Time of Transaction</th>
				</tr>
			</thead>
			<tbody id="myHistory">
				<tr>
					<td><i>cart id1</i></td>
					<td>Black Shirt, White Shirt, Orange Shirt</td>
					<td>60 $</td>
					<td><i>time of transaction</i></td>
				</tr>
				<tr>
					<td><i>cart id2</i></td>
					<td>Blue Shirt, Grey Shirt, Green Shirt</td>
					<td>60 $</td>
					<td><i>time of transaction</i></td>
				</tr>
			</tbody>
		</table>
	</div>
	<br><br>
</div>
@endsection