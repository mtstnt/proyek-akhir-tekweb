@extends('layout/app')

@section('body')
<div class="container-fluid p-0">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="storage/carousel/z1.jpg" class="d-block w-100" alt="foto" style="height:600px;">
			</div>
			<div class="carousel-item">
				<img src="storage/carousel/z2.jpg" class="d-block w-100" alt="foto" style="height:600px;">
			</div>
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
	<div class="container mt-5">
		<div class="card-deck">
			<div class="card">
				<img src="storage/store/woman.jpeg" class="card-img-top" alt="..." style="height:450px">
				<div class="card-body">
					<h5 class="card-title">Shop Wanita</h5>
					<p class="card-text">This is a wider card with supporting text below as a natural lead-in to
						additional content. This content is a little bit longer.</p>
				</div>
				<div class="card-footer text-center">
					<button style='font-size:20px;' class="text-dark">Check it now <i
							class='fas fa-angle-double-right'></i></button>
				</div>
			</div>
			<div class="card">
				<img src="storage/store/men.jpeg" class="card-img-top" alt="..." style="height:450px">
				<div class="card-body">
					<h5 class="card-title">Shop Pria</h5>
					<p class="card-text">This card has supporting text below as a natural lead-in to additional content.
					</p>
				</div>
				<div class="card-footer text-center">
					<button style='font-size:20px;' class="text-dark">Check it now <i
							class='fas fa-angle-double-right'></i></button>
				</div>
			</div>
			<div class="card">
				<img src="storage/store/kids.jpg" class="card-img-top" alt="..." style="height:450px">
				<div class="card-body">
					<h5 class="card-title">Shop Anak-anak</h5>
					<p class="card-text">This is a wider card with supporting text below as a natural lead-in to
						additional content. This card has even longer content than the first to show that equal height
						action.</p>
				</div>
				<div class="card-footer text-center">
					<button style='font-size:20px;' class="text-dark">Check it now <i
							class='fas fa-angle-double-right'></i></button>
				</div>
			</div>
        </div>
    </div>
	<div class="container mt-5">
		<div class="row">
			<div class="span12">
				<h1 class="m-3"
					style="text-align: center;font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;font-size: 30px;">
					Belanja online di Matthew Shop</h1>
				<p
					style="text-align: justify; text-indent: 50px;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum fermentum imperdiet justo eget
					lacinia. Nulla at nisi magna. Nunc in nulla vitae nulla auctor pulvinar sed ut ex. Mauris a dictum
					orci. Aliquam vulputate nunc in maximus lacinia. Vestibulum facilisis at tortor pretium pharetra. In
					hac habitasse platea dictumst. Donec fermentum est tellus, non laoreet sem mollis ut. Vestibulum
					felis neque, commodo at urna vitae, vestibulum cursus nunc. Ut auctor mauris leo, non malesuada
					mauris hendrerit vitae. Integer non gravida nunc. Integer ut finibus urna, vel posuere turpis. Orci
					varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
				<p
					style="text-align: justify; text-indent: 50px;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
					Aliquam nunc urna, interdum quis nisi euismod, porta posuere massa. Vestibulum finibus sapien sem.
					Cras posuere est non est auctor consectetur. Ut fermentum nunc et orci maximus sodales. Quisque sed
					rutrum est. Maecenas pretium in mauris in finibus. Maecenas cursus metus eget sapien tincidunt
					porta. Nullam ligula diam, mattis ac luctus eu, suscipit sit amet dui. Phasellus imperdiet sed elit
					finibus sagittis. Vivamus placerat, quam eget viverra faucibus, velit libero pretium lacus, et
					tempor metus eros tempus tellus.</p>
			</div>
		</div>
	</div>
</div>
@include('layout/footer')
@endsection

@section('after-body')

@endsection
