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
	<div class="d-flex justify-content-center my-4">
		<h1>Details of Order <b>{{$transactionInfo[0]->cart_id}}</b></h1>
	</div>
	<div class="d-flex justify-content-center my-4">
		<table class="table table-dark table-hover text-center">
			<thead>
				<tr>
					<th>#</th>
					<th>Items</th>
					<th>Count</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody id="myHistory">
				@php $i = 1 @endphp
				@foreach ($transactionInfo as $t)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{ $t->item_name }}</td>
					<td>{{ $t->count }}</td>
					<td class="item-price">{{ $t->count * $t->price }}</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<th colspan="3">Total</th>
				<th class="item-price">{{ $grandTotal }}</th>
			</tfoot>
		</table>
	</div>
	<button class="btn btn-danger" onclick="goBack()">Back</button>
</div>
@endsection

@section ('after-body')
<script src="{{ url('js/toLocalePrice.js') }}"></script>
<script>
	function goBack() {
		window.history.back();
	}
</script>
@endsection