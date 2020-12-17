@extends('layout/app')

@section('after-head')
<script>
	$(document).ready(function() {
		$span1 = $('#priceValueMin')
		$span2 = $('#priceValueMax')
		$val1 = $('#rangeMin')
		$val2 = $('#rangeMax')
		$span1.html($val1.val())
		$span2.html($val2.val())
		$val1.on('input', () => {
			$span1.html("Rp " + Number($val1.val()).toLocaleString('id-ID') + ",00");
		});
		$val2.on('input', () => {
			$span2.html("Rp " + Number($val2.val()).toLocaleString('id-ID') + ",00");
		});
		$span1.html("Rp " + Number($val1.val()).toLocaleString('id-ID') + ",00");
		$span2.html("Rp " + Number($val2.val()).toLocaleString('id-ID') + ",00");
	});
</script>
<style>
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
	<h3 class="my-4 display-3">Welcome to <b>Tokobaju</b></h3>
	<p class="lead">Check out our edit of men, women, and kids’ new-in clothing for your weekly drop of the freshest
		styles. Browse what’s trending with Tokobaju’s range of everyday staples, featuring jeans, jumpers and
		T-shirts, or add something new to your workwear rotation with its offering of tailored suits and crisp
		shirts. </p>
</div>

<div class="container-fluid bg-dark">
	<div class="d-flex flex-wrap flex-row justify-content-center">
		<div class="col-12 col-lg-6 mx-auto">
			<select class="btn btn-outline-primary bg-secondary text-white dropdown-toggle w-100 m-0 my-3" type="button"
				style="width: 8rem" id="categoryFilter">Category
				<option value="0" selected>No filter</option>
				<option value="1">Men</option>
				<option value="2">Women</option>
				<option value="3">Kids</option>
			</select>
		</div>
		<div class="row text-light w-75 mx-auto my-3">
			<div class="col-lg-6 col-12">
				<input class="w-100" type="range" min="0" max="5000000" class="slider" id="rangeMin" value="0" step="100000">
				<h5>Min : <span id="priceValueMin">0</span></h5>
			</div>
			<div class="col-lg-6 col-12">
				<input class="w-100" type="range" min="0" max="5000000" class="slider" id="rangeMax" value="5000000" step="100000">
				<h5>Max : <span id="priceValueMax">0</span></h5>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid p-0 mt-4">
	<div class="row">
		<div class="col-lg-12 justify-content-center col-12 text-center d-flex flex-wrap">
			@foreach ($items as $item)
			<div class="card pt-0 item cat-{{ $item->category_id }}" style="width: 16rem;">
				@if (count($item->images) > 0)
				<img class="card-image-top" src="/storage/store/{{ $item->images[0]->filename }}" class="card-img-top"
					alt="..." style="max-width: 100%">
				@else
				<div class="bg-dark text-light" style="height: 300px;">Sample Image</div>
				@endif
				<div class="card-body">
					<h5 class="card-title">{{ $item->item_name }}</h5>
					<p class="item-price item-pricetag">{{ $item->price }}</p>
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
<script>
	var items = document.querySelectorAll('.item');
	var filterCategory = document.getElementById('categoryFilter');

	filterCategory.addEventListener('input', ev => {
		var val = ev.target.value;

		items.forEach(el => {
			if (ev.target.value == 0) {
				el.classList.remove('d-none');
				return;
			}
			if (el.classList.contains('cat-' + val)) {
				el.classList.remove("d-none");
			} else {
				el.classList.add("d-none");
			}
		});
	});

	var rangeMin = document.getElementById('rangeMin');
	var rangeMax = document.getElementById('rangeMax');

	[rangeMin, rangeMax].forEach( el => {
		el.addEventListener('input', ev => {
			var filterRangeMax = document.getElementById('rangeMax').value;
			var filterRangeMin = document.getElementById('rangeMin').value;

			items.forEach(el => {
				var price = getNumberFromCurrency(el.querySelector('.item-pricetag').innerText);

				if (price <= filterRangeMax && price >= filterRangeMin) {
					el.classList.remove("d-none");
				} else {
					el.classList.add("d-none");
				}
			});
		});
	});

	function getNumberFromCurrency(str) {
		return Number(str.substring(3, str.length - 3).replaceAll('.', ''));
	}

</script>
@endsection