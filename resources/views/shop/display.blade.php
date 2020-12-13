@extends('layout/app')

@section('after-head')
<style>
	body {
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
	}

	.card {
		margin: 22px;
	}

	.input-group {
		width: auto;
		margin-left: 10px;
		margin-right: 10px;
	}
</style>
@endsection

@section('body')
<div class="container-fluid p-3 bg-dark text-white text-center">
	<h3>Welcome to Matthew Store</h3>
	<p style="font-size: 15px;">Check out our edit of men’s new-in clothing for your weekly drop of the freshest
		styles. Browse what’s trending with ASOS DESIGN’s range of everyday staples, featuring jeans, jumpers and
		T-shirts, or add something new to your workwear rotation with its offering of tailored suits and crisp
		shirts. </p>
</div>

<div class="container-fluid bg-dark">
	<div class="d-flex flex-wrap flex-row justify-content-center">
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<button class="btn btn-outline-primary bg-secondary text-white dropdown-toggle" type="button"
					data-toggle="dropdown" style="width: 8rem">Category</button>
				<div class="dropdown-menu">
					<span class="dropdown-item" href="#">Men</span>
					<span class="dropdown-item" href="#">Women</span>
					<span class="dropdown-item" href="#">Kids</span>
				</div>
			</div>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<button class="btn btn-outline-primary bg-secondary text-white dropdown-toggle" type="button"
					data-toggle="dropdown" style="width: 8rem">Type</button>
				<div class="dropdown-menu">
					<span class="dropdown-item" href="#">Upper</span>
					<span class="dropdown-item" href="#">Bottom</span>
					<span class="dropdown-item" href="#">Shoes</span>
				</div>
			</div>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<button class="btn btn-outline-primary bg-secondary text-white dropdown-toggle" type="button"
					data-toggle="dropdown" style="width: 8rem">Size</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#">XL</a>
					<a class="dropdown-item" href="#">L</a>
					<a class="dropdown-item" href="#">M</a>
					<a class="dropdown-item" href="#">S</a>
				</div>
			</div>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<button class="btn btn-outline-primary bg-secondary text-white dropdown-toggle" type="button"
					data-toggle="dropdown" style="width: 8rem">Price Range</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#">
						<div class="slidecontainer">
							<input type="range" min="0" max="10000000" value="0" class="slider" id="myRangeMin">
							<h5>Min : Rp.<span id="priceValueMin">0</span></h5>
							<input type="range" min="0" max="10000000" value="0" class="slider" id="myRangeMax">
							<h5>Max : Rp.<span id="priceValueMax">0</span></h5>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid p-0 mt-4">
	<div class="row">
		<div class="col-lg-12 justify-content-center col-12 text-center d-flex flex-wrap">
			@foreach ($items as $item)
			<div class="card pt-0" style="width: 16rem;">
				@if (count($item->images) > 0)
				<img class="card-image-top" src="/storage/store/{{ $item->images[0]->filename }}" class="card-img-top"
					alt="..." style="max-width: 100%">
				@else
				<div class="bg-dark text-light" style="height: 300px;">Sample Image</div>
				@endif
				<div class="card-body">
					<h5 class="card-title">{{ $item->item_name }}</h5>
					<p class="item-price">{{ $item->price }}</p>
					<a href="view/{{ $item->id }}" class="btn btn-primary align-center w-100">View Info</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection

@section("after-body")
<script src="{{ url("js/toLocalePrice.js") }}"></script>
@endsection