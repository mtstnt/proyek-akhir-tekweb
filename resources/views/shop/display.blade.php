@extends('layout/app')

@section('body')
<div class="container-fluid p-0">
	<div class="col-12 card-group">
		{{-- {{dd($items[2]->images[0])}} --}}
		@foreach ($items as $item)
		<div class="card">
			<div class="card-img-top">
				@if(count($item->images) > 0)
				<img style="width: 250px" src="/storage/store/{{ $item->images[0]->filename }}" alt="">
				{{-- {{$item->images[0]->filename}} --}}
				@endif
			</div>
			<div class="card-body">
				<h3 class="card-title">{{ $item->item_name }}</h3>
				<h5>{{ $item->price }}</h5>
				<div class="card-text">
					<p>{{ $item->item_description }}</p>
				</div>
				<div class="">
					<button class="btn btn-primary" href="#">Add To Cart</button>
				</div>
			</div>
		</div>
		@endforeach
	</div>

</div>