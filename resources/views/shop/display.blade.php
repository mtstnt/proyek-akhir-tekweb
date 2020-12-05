@extends('layout/app')

@section('body')
<div class="container-fluid p-0">
	
	<div class="col-12 col-lg-10 mx-auto my-3 bg-light p-3">
		<h5>FILTERS</h5>
		<label for="">Ah mantap</label>
		<input type="text" name="" id="">
	</div>

	<div class="col-12 d-flex justify-content-center flex-wrap">
		@foreach ($items as $item)
		<div class="card m-3" style="width: 300px; min-height: max-content">
			<div class="card-img-top">
				@if (count($item->images) > 0)
				<img style="width: 300px" src="/storage/store/{{ $item->images[0]->filename }}" alt="">
				{{-- {{$item->images[0]->filename}} --}}
				@else
				<div class="bg-dark text-white text-center" style="height: 350px">Sample Image</div>
				@endif
			</div>
			<div class="card-body">
				<h3 class="card-title">{{ $item->item_name }}</h3>
				<h5 class="item-price">{{ $item->price }}</h5>
				<div class="card-text">
					<p>{{ $item->item_description }}</p>
				</div>
				<div class="">
					<a class="btn btn-primary w-100 mx-0" href="#">Add To Cart</a>
					<a class="btn btn-warning w-100 mx-0" href="view/{{ $item->id }}">View Info</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>

</div>
@endsection

@section("after-body")
<script src="{{ url("js/toLocalePrice.js") }}"></script>
@endsection