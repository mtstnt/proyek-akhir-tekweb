@extends('layout/admin-app')

@section("body")
<!-- Page Wrapper -->
<div id="wrapper">
	<!-- Sidebar -->
	@include("admin/sidebar")
	<!-- End of Sidebar -->

	<!-- Content Wrapper -->
	<div id="content-wrapper" class="d-flex flex-column">

		<!-- Main Content -->
		<div id="content">

			@include ("admin/nav")
			<!-- Begin Page Content -->
			<div class="container-fluid">
				@if(session()->get('error') != null)
				<div class="alert alert-danger">
					{{ session()->get('error') }}
				</div>
				@endif
				@if(session()->get('success'))
				<div class="alert alert-success">
					{{ session()->get('success') }}
				</div>
				@endif
				<h1>Add Item Form</h1>
				<form action="{{ route('admin/list/send-add-item') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Item Name</span>
						</div>
						<input type="text" class="form-control input-" name="input-item-name">
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Price</span>
							<span class="input-group-text">Rp</span>
						</div>
						<input type="text" class="form-control input-" name="input-price">
						<span class="input-group-text">.00</span>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Description</span>
						</div>
						<textarea class="form-control input-" name="input-description"></textarea>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Number Of Images</span>
						</div>
						<input type="number" class="form-control input-" min="0" max="5" id="img-number" name="img-number">
					</div>

					<div id="img-uploads"></div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Number Of Variants</span>
						</div>
						<input type="number" class="form-control input-" min="0" max="10" id="variant-number" name="variant-number">
					</div>

					<div id="variant-inputs"></div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text" for="input-category">Categories</label>
						</div>
						<select class="custom-select" id="input-category" name="input-category">
							<option selected value="0">Choose...</option>
							<option value="1">Men</option>
							<option value="2">Women</option>
							<option value="3">Kids</option>
						</select>
					</div>



					<button class="btn btn-primary" id="submit-btn" type="submit">Add</button>
					<button class="btn btn-danger" type="reset">Clear</button>
				</form>
			</div>
		</div>
	</div>

	@endsection

	@section('after-body')
	<script src={{ url("vendor/jquery/jquery.min.js") }}></script>
	<script src={{ url("vendor/bootstrap/js/bootstrap.bundle.min.js") }}></script>

	<!-- Core plugin JavaScript-->
	<script src={{ url("vendor/jquery-easing/jquery.easing.min.js") }}></script>

	<!-- Custom scripts for all pages-->
	<script src={{ url("js/sb-admin-2.min.js") }}></script>

	<script>
		// Script untuk mengatur jumlah input secara otomatis
		const imgNumberInput = document.getElementById('img-number');
		const imgUploadInput = document.getElementById('img-uploads');
		imgNumberInput.addEventListener('input', event => {
			imgUploadInput.innerHTML = "";
			for (let i = 0; i < imgNumberInput.value; i++) {
				imgUploadInput.innerHTML += `
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Item Images</span>
						</div>
						<div class="custom-file">
							<input type="file" class="custom-file-input input-file" name="input-file-${i}" id="input-file-${i}">
							<label class="custom-file-label" id="label-input-file-${i}" for="input-file-${i}">Choose file</label>
						</div>
					</div>
				`;
			}

			const inputFile = document.querySelectorAll('.input-file');
			inputFile.forEach(el => {
				el.addEventListener('change', (e) => {
					document.getElementById('label-' + el.id).innerText = e.target.files[0].name;
				});
			});
		});

		const varNumberInput = document.getElementById('variant-number');
		const varDataInput = document.getElementById('variant-inputs');
		varNumberInput.addEventListener('input', event => {
			varDataInput.innerHTML = "";
			for (let i = 0; i < varNumberInput.value; i++) {
				varDataInput.innerHTML += `
					<div>
						<div class="input-group-prepend">
							<span class="input-group-text">Variant Data ${i + 1}:</span>
						</div>
						<input type="text" class="form-control mb-2 input-" placeholder="Variant name" name="variant-name-${i}" id="variant-name-${i}">
						<input type="number" class="form-control mb-2 input-" placeholder="Stock" min="0" id="variant-stock-${i}" name="variant-stock-${i}">
					</div>
				`;
			}
		});
	</script>
	@endsection