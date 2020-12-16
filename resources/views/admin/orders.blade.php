@extends("layout/admin-app")

@section('after-head')
<meta name="csrf-token" content="{{ csrf_token() }}" />	
@endsection


@section("body")
<div id="wrapper">

	@include('admin/sidebar')

	<!-- Content Wrapper -->
	<div id="content-wrapper" class="d-flex flex-column">

		<!-- Main Content -->
		<div id="content">

			<!-- Topbar -->
			@include('admin/nav')

			<!-- Begin Page Content -->
			<div class="container-fluid">

				@include('admin/flash')
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h2 class="m-0 font-weight-bold text-primary">All Orders</h2>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>#</th>
										<th>Item Name</th>
										<th>Order ID</th>
										<th>Grand Total</th>
										<th>Date of Purchase</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@php $i = 1; @endphp
									@foreach ($transactions as $t)
									<tr id="{{ $t->id }}">
										<td class="align-middle">{{ $i++ }}</td>
										<td class="align-middle">{{ $t->first_name . " " . $t->last_name }}</td>
										<td class="align-middle cartid"><a href="{{ url('admin/orders') . "/" . $t->cart_id }}">{{ $t->cart_id }}</a></td>
										<td class="align-middle item-price">{{ $t->total_price }}</td>
										<td class="align-middle">{{ $t->transaction_time }}</td>
										<td class="align-middle order-status">{{ $t->status }}</td>
										<td class="align-middle">
											<button class="btn btn-success complete-btn">Complete</button>
											<button class="btn btn-danger cancel-btn">Cancel</button>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('after-body')
<script src={{url("vendor/jquery/jquery.min.js")}}></script>
<script src={{url("vendor/bootstrap/js/bootstrap.bundle.min.js")}}></script>
<script src={{url("vendor/jquery-easing/jquery.easing.min.js")}}></script>
<script src={{url("js/sb-admin-2.min.js")}}></script>
<script src={{url("vendor/datatables/jquery.dataTables.min.js")}}></script>
<script src={{url("vendor/datatables/dataTables.bootstrap4.min.js")}}></script>
<script src={{url("js/demo/datatables-demo.js")}}></script>
<script src="{{ url('js/toLocalePrice.js') }}"></script>
<script src="{{ url('js/ajaxHelper.js') }}"></script>

<script>
	const completeButtons = document.querySelectorAll('.complete-btn');
	const cancelButtons = document.querySelectorAll('.cancel-btn');

	completeButtons.forEach(el => el.addEventListener('click', ev => {
		const parent = ev.target.parentNode.parentNode;
		let id = parent.id;
		let cartID = parent.querySelector('.cartid').innerText;

		ajax("{{ route('admin/complete-order') }}", "POST", JSON.stringify({
			'id': id
		}), [
			{ hname: "Content-Type", hval: "application/json" },
			{ hname: "X-Requested-With", hval: "XMLHttpRequest" },
			{ hname: "Authorization", hval: btoa({{Auth::user()->id}}) },
			{ hname: "X-CSRF-TOKEN", hval: document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
		]).then(val => {
			if (val == "OK") {
				alert("Order number " + cartID + " has been set as Completed!");
				parent.querySelector('.order-status').innerText = "Completed";
				return;
			} else {
				alert("Failed to set " + cartID + " as Completed!");
				return;
			}
		});
	}));

	cancelButtons.forEach(el => el.addEventListener('click', ev => {
		const parent = ev.target.parentNode.parentNode;
		let id = parent.id;
		let cartID = parent.querySelector('.cartid').innerText;

		ajax("{{ route('admin/cancel-order') }}", "POST", JSON.stringify({
			'id': id
		}), [
			{ hname: "Content-Type", hval: "application/json" },
			{ hname: "X-Requested-With", hval: "XMLHttpRequest" },
			{ hname: "Authorization", hval: btoa({{Auth::user()->id}}) },
			{ hname: "X-CSRF-TOKEN", hval: document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
		]).then(val => {
			if (val == "OK") {
				alert("Order number " + cartID + " has been set as Cancelled!");
				parent.querySelector('.order-status').innerText = "Cancelled";
				return;
			} else {
				alert("Failed to set " + cartID + " as Cancelled!");
				return;
			}
		});
	}));
</script>

@endsection