@extends('layout/app')

@section('after-head')
<style>
	img {
		max-width: 100%;
		max-height: 100%;
	}
</style>
@endsection

@section('body')
{{-- 
	Expects some params:
	- Item data as queried from ID
--}}

<div class="container-fluid p-0">
	<a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
	<div class="container w-50 mx-auto my-5">
		<div class="row">
			<div class="col-12 col-xl-8">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						@for ($i = 0; $i < count($item->images); $i++) :
						<div class="carousel-item">
							<img src="/storage/store/{{ $item->images[$i]->filename }}" class="d-block w-100" alt="...">
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
			<div class="col-12 col-xl-4">
				<h1>{{ $item->item_name }} </h1>
				<h3 class="item-price">{{ $item->price }}</h3>
				<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis culpa maiores vero commodi sit,
					ipsam placeat architecto quibusdam fuga beatae labore dolore odit dolores recusandae cum. Quos porro
					nisi veniam!</p>

				<button class="btn btn-success w-100 mx-0">Add To Cart</button>
				<button class="btn btn-secondary w-100 mx-0">Ask Seller</button>

			</div>
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