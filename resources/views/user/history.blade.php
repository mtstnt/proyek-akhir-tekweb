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

	div {
		font-family: "Segoe UI, Tahoma, Geneva, Verdana, sans-serif";
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
	<div class="text-center my-3">
		<h1>History</h1>
		<h6>Click on the Order ID to see order details!</h6>
	</div>
	<div class="d-flex justify-content-center my-4">
		<table class="table table-responsive-sm table-dark table-hover text-center">
			<thead>
				<tr>
					<th>#</th>
					<th>Order ID</th>
					<th>Total Price</th>
					<th>Time of Transaction</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody id="myHistory">
				@php $i = 1 @endphp
				{{-- {{ dd($transactions)}} --}}
				@foreach ($transactions as $t)
				<tr id="{{ $t->id }}">
					<td class="align-middle">{{ $i++ }}</td>
					<td><a class="btn btn-light" href="{{ url("user/history/$t->id") }}">{{ $t->cart_id }}</a></td>
					<td class="item-price align-middle">{{ $t->total_price }}</td>
					<td class="align-middle">{{ $t->transaction_time }}</td>
					<td class="align-middle">{{ $t->status }}</td>
					<td class="align-middle"><a class="btn btn-danger {{ $t->status == "Completed" ? "disabled" : "" }}"
							href="{{ url("user/cancel") . "/" . $t->id }}">Cancel</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('after-body')
<script src="{{ url("js/toLocalePrice.js") }}"></script>
@endsection