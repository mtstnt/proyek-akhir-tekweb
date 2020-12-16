@extends("layout/admin-app")

@section("body")
<div id="wrapper">

	@include('admin/sidebar')
	<div id="content-wrapper" class="d-flex flex-column">
		<div id="content">
			@include('admin/nav')
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
										<th>Stock</th>
										<th>Variant</th>
										<th>Last Updated</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($items as $item)
									<tr id="{{ $item->id }}">
										<td class="align-middle">{{ ++$i }}</td>
										<td class="align-middle">{{ $item->item_name }}</td>
										<td class="align-middle item-price">{{ $item->price }}</td>
										<td class="align-middle">{{ $item->stock }}</td>
										<td class="align-middle">{{ $item->variant_name }}</td>
										<td class="align-middle">{{ $item->updated_at }}</td>
										<td class="align-middle">
											<button class="btn btn-danger delete-btn">Delete</button>
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
	const delButton = document.querySelectorAll('.delete-btn');

	delButton.forEach(el => {
		el.addEventListener('click', e => {
			const id = e.target.parentNode.parentNode.id;
			ajax( "{{ url('admin/list/delete') }}" + "/" + id, "GET", null)
			.then(val => {
					const jsonOfVal = JSON.parse(val);
					if (jsonOfVal['status'] == "success") {
						alert("Successfully deleted id " + id);
						window.location.reload();
					}
					else {
						alert("Failed deleting id " + id);
					}
				}); // then
			}); // addEventListener 
	});
</script>
@endsection