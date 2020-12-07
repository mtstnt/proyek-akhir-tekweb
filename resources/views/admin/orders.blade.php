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
				<h1>Ah mantap</h1>
			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- End of Main Content -->

	</div>
	<!-- End of Content Wrapper -->

</div>
@endsection

@section('after-body')
<script src={{url("vendor/jquery/jquery.min.js")}}></script>
<script src={{url("vendor/bootstrap/js/bootstrap.bundle.min.js")}}></script>

<!-- Core plugin JavaScript-->
<script src={{url("vendor/jquery-easing/jquery.easing.min.js")}}></script>

<!-- Custom scripts for all pages-->
<script src={{url("js/sb-admin-2.min.js")}}></script>

<!-- Page level plugins -->
<script src={{url("vendor/datatables/jquery.dataTables.min.js")}}></script>
<script src={{url("vendor/datatables/dataTables.bootstrap4.min.js")}}></script>

<!-- Page level custom scripts -->
<script src={{url("js/demo/datatables-demo.js")}}></script>
@endsection