@extends("layout/app")

@section("after-head")
<style>
	ul .nav-link:hover {
		color: powderblue !important;
		font-weight: bold;
		font-size: 25px;
	}

	ul .nav-link {
		margin-right: 25px;
		font-size: 20px;
		font-family: "Segoe UI, Tahoma, Geneva, Verdana, sans-serif";
	}

	span {
		margin-right: 25px;
	}

	span:hover {
		color: powderblue !important;
	}
</style>
@endsection

@section("body")

@include("layout/nav")
<div class="container-fluid p-0">
	<div class="d-flex justify-content-center my-4">
	<h1>{{ Auth::user()->first_name . " " . Auth::user()->last_name }}'s Shopping Cart</h1>
	</div>
	<div class="d-flex justify-content-center my-4 col-lg-11 col-12 mx-auto">
		<table class="table table-dark table-hover text-center table-bordered">
			<thead>
                <tr>
                    <th>#</th>
					<th>Image</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody id="myItems">
				@if ($items == null)
					<tr><td colspan="999">You currently have no items in cart!<br>
						<a href="{{ route("main") }}">Shop something!</a></td></tr>
				@else
					@foreach ($items as $item)
                    <tr id="{{ $item->id }}">
                        <td class="align-middle">{{ $i++ }}</td>
                        <td class="align-middle"><img src="/storage/store/{{ $item->item->images[0]->filename }}" alt="" style="max-height: 200px"></td>
						<td class="align-middle">{{ $item->item->item_name }}</td>
						<td class="item-price align-middle">{{ $item->item->price }}</td>
						<td class="align-middle">{{ $item->count }}</td>
						<td class="subtotal item-price align-middle">{{ $item->item->price * $item->count }}</td>
						<td class="align-middle"><button class="btn btn-danger" id="delete-cart-item">Delete</button></td>
					</tr>
					@endforeach
				@endif
            </tbody>
            <tfoot>
                <th colspan="5">Total</th>
                <th class="total-price item-price"></th>
            </tfoot>
		</table>
	</div>
	@if($items != null)
	<div class="d-flex justify-content-center my-4">
		<button type="button" class="btn btn-info btn-block font-weight-bolder" id="checkOut">Proceed to Check
			Out</button>
	</div>
	@endif
</div>


@include("layout/footer")

@endsection

@section("after-body")

<script src="{{ url("js/toLocalePrice.js") }}"></script>
<script>
    const totalPrice = document.querySelector(".total-price");
    const tbody = document.getElementById("myItems");

	document.getElementById("delete-cart-item").addEventListener('click', ev => {
		ev.preventDefault();
		const itemID = ev.target.parentNode.id;
		alert(itemID);
	});

    function updateData() {
        let sum = 0;
        const rows = [...document.querySelectorAll("tbody tr")];
            rows.forEach( el => {
                const subtotal = el.querySelector(".subtotal");
                let data = subtotal.innerText;

                data = data.replaceAll(".", "");
                data = data.substring(3, data.length - 3);

                sum += Number(data);
        });

        totalPrice.innerText = "Rp " + sum.toLocaleString("id-ID") + ",00";
    }

//    getNumber(document.querySelector(".subtotal").innerText);

    updateData();
</script>

@endsection
