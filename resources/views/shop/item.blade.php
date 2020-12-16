@extends('layout/app')

@section('after-head')
<style>
	body {
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
	}

	.card {
		margin: 22px;
	}

	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}
</style>
@endsection

@section('body')
<div class="container-fluid p-0 w-75">
	<div class="row mt-5 col-12 col-lg-9 mx-auto mb-3">
		<div class="col-12 col-lg-6">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					@for ($i = 0; $i < count($item->images); $i++)
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
			<div class="input-group-prepend my-3">
				<label class="input-group-text" for="inputGroupSelect01">Size</label>
				<select class="custom-select" id="variant_id">
					<option selected value="0">Choose...</option>
					@foreach ($item->variants as $variant)
					<option class="{{ $variant->stock == 0 ? 'bg-secondary text-muted' : '' }}" value="{{ $variant->id }}" {{ $variant->stock == 0 ? "disabled class='bg-dark'" : '' }}>
						{{ $variant->variant_name }} {{ $variant->stock == 0 ? "<Unavailable>" : "" }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="input-group-prepend my-3">
				<input type="number" class="form-control" name="count" id="count" value="1" min="1">
				<label class="input-group-text" for="count">pcs</label>
			</div>
			<button class="mx-0 w-100 btn btn-success" id="add-to-cart">Add To Cart</button>
			<button class="mx-0 w-100 btn btn-danger">Cancel</button>
		</div>
	</div>
</div>
@endsection

@section('after-body')
<script src="{{url("js/toLocalePrice.js")}}"></script>
<script src="{{url("js/ajaxHelper.js")}}"></script>
<script>
    const firstCarouselItem = document.querySelector('.carousel-item');
	firstCarouselItem.classList.add("active");
</script>

@if (Auth::check())
<script>
    document.getElementById('add-to-cart').addEventListener('click', ev => {
		if (document.getElementById("variant_id").value == 0) {
			alert("Please pick a variant!");
			return;
		}

        ev.preventDefault();
        const xhr = new XMLHttpRequest();
        xhr.open("PUT", "{{ url('api/cart') }}");
        xhr.onreadystatechange = function() {
            if (xhr.status == 200 && xhr.readyState == 4) {
                alert(xhr.responseText);
            }
        }
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("Authorization", btoa("{{ Auth::user()->id }}"));
        xhr.send(JSON.stringify({
            item_id: "{{ $item->id }}",
            count: document.getElementById("count").value,
            variant_id: document.getElementById("variant_id").value
        }));
    });
</script>
@else
<script>
    document.getElementById('add-to-cart').addEventListener('click', ev => {
        ev.preventDefault();
        window.location.href = "{{ route('auth/login') }}";
    });    
</script>
@endif

@endsection
