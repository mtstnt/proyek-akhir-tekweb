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
		<table class="table table-responsive-sm table-dark table-hover text-center table-bordered" id="main-table">
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
			</tbody>
			<tfoot>
				<th colspan="5">Total</th>
				<th class="total-price item-price"></th>
			</tfoot>
		</table>
	</div>
	@if($items != null)
	<div class="d-flex justify-content-center my-4">
		<a href="{{ route("user/checkout") }}" class="btn btn-primary w-75"
			class="btn btn-info btn-block font-weight-bolder" id="checkOut">Proceed to Check
			Out</a>
	</div>
	@endif
</div>

@endsection

@section("after-body")

<script src="{{ url("js/toLocalePrice.js") }}"></script>

<script>
	const totalPrice = document.querySelector(".total-price");
    const tbody = document.getElementById("myItems");
    const mainTable = document.getElementById("main-table");

	function deleteOnClick(ev) {
		ev.preventDefault();
		const cartItemID = ev.target.parentNode.parentNode.id;
		const xhr = new XMLHttpRequest();
		xhr.open("DELETE", "{{ url('api/cart') }}");
		xhr.onreadystatechange = () => {
			if (xhr.status == 200 && xhr.readyState == 4) {
				const response = JSON.parse(xhr.responseText);
				if (response["error"] != null) {
					alert("ERROR: " + response["error"]["message"]);
				} else {
					alert(response["data"]["message"]);
				}
				updateData();
			}
		}
		xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		xhr.setRequestHeader("Content-Type", "application/json");
		xhr.setRequestHeader("Authorization", btoa("{{ Auth::user()->id }}"));
		xhr.send(JSON.stringify({
			'cartitem_id': cartItemID
		}));
	}

    function updateData() {
		const xhr = new XMLHttpRequest();
		xhr.open("GET", "{{ url('api/cart') }}");
		xhr.onreadystatechange = () => {
			if (xhr.status == 200 && xhr.readyState == 4) {

				const response = JSON.parse(xhr.responseText);
				if (response["error"] != null) {
					alert("ERROR: " + response["error"]["message"]);
				} else {	
					tbody.innerHTML = "";
					if (response['data']['items'] != null) {
						for (let d of response["data"]["items"]) {
							let i = 1;
							tbody.innerHTML += `
							<tr id="${d.id}">
								<td class="align-middle">${i++}</td>
								<td class="align-middle"><img src="/storage/store/${d.image}" alt="" style="max-height: 200px"></td>
								<td class="align-middle">${d.item_name}</td>
								<td class="item-price align-middle">${d.price}</td>
								<td class="align-middle">${d.count}</td>
								<td class="subtotal item-price align-middle">${d.subtotal}</td>
								<td class="align-middle"><button class="btn btn-danger" onclick="deleteOnClick(event)">Delete</button></td>
							</tr>
							`;
						}
						totalPrice.innerText = response["data"]["total"];
						convertToLocal();
					}
				}
			}
		}
		xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		xhr.setRequestHeader("Content-Type", "application/json");
		xhr.setRequestHeader("Authorization", btoa("{{ Auth::user()->id }}"));
		xhr.send(null);
	}

	
	function convertToLocal() {
		const itemPrice = [...document.querySelectorAll('.item-price')];
		itemPrice.forEach(el => {
			let price = Number(el.innerText);
			el.innerText = "Rp " + price.toLocaleString('id-ID') + ",00";
		});
	}

	updateData();
</script>


@endsection