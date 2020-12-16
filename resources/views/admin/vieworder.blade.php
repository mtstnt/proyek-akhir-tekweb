@extends("layout/admin-app")

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
						<h2 class="m-0 font-weight-bold text-primary">All Items</h2>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>#</th>
										<th>Item Name</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody>
									@php $i = 1; @endphp
									@foreach ($items as $item)
									<tr>
										<td class="align-middle">{{ $i++ }}</td>
										<td class="align-middle">{{ $item->item_name }}</td>
										<td class="align-middle item-price">{{ $item->price }}</td>
										<td class="align-middle">{{ $item->count }}</td>
										<td class="align-middle item-price">{{ $item->count * $item->price }}</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<th colspan="4" class="text-right px-4">Total:</th>
									<th class="item-price">{{ $total }}</th>
								</tfoot>
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

@endsection