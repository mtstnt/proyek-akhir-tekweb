@extends('layout/app')

@section('after-head')
<style>
	body {
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
	}

	.card {
		margin: 22px;
	}
</style>
@endsection

@section('body')
<div class="container w-75">
	<div class="row mt-5 w-75 mx-auto">
		<div class="col-12 col-lg-6">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					@for ($i = 0; $i < count($item->variants); $i++)
						<li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"
							class="{{ $i == 0 ? "active" : "" }}"></li>
					@endfor
				</ol>
				<div class="carousel-inner">
					@for ($i = 0; $i < count($item->images); $i++)
						<div class="carousel-item">
							<img src="/storage/store/{{ $item->images[$i]->filename }}" class="d-block"
								style="width: 100%" alt="{{ $item->item_name }}">
						</div>
					@endfor
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<div class="col-12 col-lg-6 p-4">
			<h1 class="nameItem" style="font-family:Arial, Helvetica, sans-serif">{{ $item->item_name }}</h1>
			<p>{{ $item->item_description }}</p>
			<h4 class="item-price text-secondary">{{ $item->price }}</h4>
			<div class="input-group p-0 my-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="inputGroupSelect01">Size</label>
					<select class="custom-select w-75" id="inputGroupSelect01">
						<option selected>Choose...</option>
						@foreach ($item->variants as $variant)
						<option value="" {{ $variant->stock == 0 ? "disabled class='bg-dark'" : "" }}>
							{{ $variant->variant_name }} {{ $variant->stock == 0 ? "<Unavailable>" : "" }}
						</option>
						@endforeach
					</select>
				</div>
			</div>
			<button href="#" class="mx-0 w-75 btn btn-success">Add To Cart</button>
		</div>
	</div>
</div>
@endsection

@section('after-body')
<script src="{{url("js/toLocalePrice.js")}}"></script>
<script>
	const firstCarouselItem = document.querySelector('.carousel-item');
	firstCarouselItem.classList.add("active");
</script>
@endsection