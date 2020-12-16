@extends("layout/app")

@section("body")
<br>
<div class="container">
	<div class="row mb-3">
		<div class="col-12 text-center">
			<h1 class="display-4">Checkout</h1>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-5 col-12">
			<h3>Order Summary</h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Quantity</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody id="myItems"></tbody>
				<tfoot>
					<th colspan="3" class="align-middle text-right">Total</th>
					<th class="align-middle item-price" id="total-price"></th>
				</tfoot>
			</table>
		</div>
		<div class="col-lg-7 col-12">
			<h3>Shipping Fee</h3>
			<div class="shipping-fee">
				<label for="province">Choose province</label>
				<select class="custom-select my-2" name="province" id="province">
					<option value="-1" selected>Choose..</option>
					@foreach ($provinces as $p)
					<option value="{{ $p['province_id'] }}">{{ $p['province']}}</option>
					@endforeach
				</select>
				<label for="city">Choose city</label>
				<select class="custom-select my-2" name="city" id="city">
					<option value="-1">Choose..</option>
				</select>
				<h5 class="text-right">Shipping Cost : <span id="shipping-cost" class="item-price">0</span></h5>
			</div>
			<h3>Payment Method</h3>
			<h5 class="text-right">Total Cost : <span id="total-cost">0</span></h5>
			<select class="custom-select my-3" id="payment-options" name="payment-options">
				<option value="1">PayPal</option>
				<option value="2">Manual Payment</option>
			</select>
			<div id="payment-form">
				<div id="paypal-btn"></div>
				<div id="manual-payment" class="d-none">Sorry, manual payment is currently unavailable</div>
			</div>
		</div>
	</div>
</div>
</body>
@endsection

@section('after-body')
<script src="{{ url("js/ajaxHelper.js") }}"></script>
<script
	src="https://www.paypal.com/sdk/js?client-id=AbZn3M4gGpTXTrRc5zUFz31gnBvQLdPSjL6kptllfvvRQbvRq-TfTsJ7gfRMx9DPDmUyvvUpMpz1wVWR&disable-funding=credit,card">
</script>
<script>
	let totalPaidPrice;
	paypal.Buttons({
		createOrder: async function(data, actions) {
			const jsonResult = await ajax("{{ url('api/payment') }}", "POST", JSON.stringify({
				'shipping-cost': document.getElementById('shipping-cost').innerText
									.substring(3, document.getElementById('shipping-cost').innerText.length - 3).replaceAll('.', '')
			}), [
				{ hname: 'Authorization', hval: btoa( {{ Auth::user()->id }} ) },
				{ hname: 'X-Requested-With', hval: "XMLHttpRequest" }
			]);

			const result = JSON.parse(jsonResult);

			if (result['error'] != null) {
				alert("Error processing transaction!");
				return;
			}

			totalPaidPrice = document.getElementById('total-cost').innerText.substring(
				3,
				document.getElementById('total-cost').innerText.length - 3
			).replaceAll('.', '');
			
			return actions.order.create({
				purchase_units: [{
					amount: {
						value: result.data.total,
					}
				}]
			});
		},
		onApprove: function(data, actions) {
			return actions.order.capture()
				.then( details => {
					// Call API to save the data
					ajax("{{ url('api/savepayment') }}", "POST" , JSON.stringify({
						'details': details,
						'total-price': totalPaidPrice
					}), [
						{ hname: "Content-Type", hval: "application/json" },
						{ hname: "X-Requested-With", hval: "XMLHttpRequest" },
						{ hname: "Authorization", hval: btoa({{Auth::user()->id}}) }
					]).then(val => {
						if (JSON.parse(val)['success']) window.location = "{{ route("user/thankyou") }}";
						else alert("Payment failure!");
					});
				});
		}
	}).render("#paypal-btn");
</script>

<script>
	// Render script
	const tbody = document.getElementById('myItems');
	const totalPrice = document.getElementById("total-price");

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
					let i = 1;
					for (let d of response["data"]["items"]) {
						tbody.innerHTML += `
						<tr id="${d.id}">
							<td class="align-middle">${ i++ }</td>
							<td class="align-middle">${d.item_name}</td>
							<td class="align-middle">${d.count}</td>
							<td class="subtotal item-price align-middle">${d.subtotal}</td>
						</tr>
						`;
					}
					totalPrice.innerText = response["data"]["total"];
					updateTotalCost();
					convertToLocal();
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
			if (Number.isNaN(price)) return;
			el.innerText = "Rp " + price.toLocaleString('id-ID') + ",00";
		});
	}
	updateData();
</script>

<script>
	// Load options script
	const manualPayment = document.getElementById('manual-payment');
	const payPalPayment = document.getElementById('paypal-btn');

	document.getElementById("payment-options").addEventListener('change', ev => {
		if (ev.target.value == 1) {
			// Paypal
			payPalPayment.classList.remove("d-none");
			manualPayment.classList.add('d-none');
		}
		else {
			payPalPayment.classList.add('d-none');
			manualPayment.classList.remove('d-none');
		}
	});

	const province = document.getElementById('province');
	const city = document.getElementById('city');
	
	province.addEventListener('change', ev => {
		city.innerHTML = "";
		if (ev.target.value == -1) {
			return;
		}

		ajax("{{ url('city')}}" + '/' + ev.target.value, "GET", null, [
			{hname: "key", hval: "d938615fdd53e66c29aa7c3f474e237b"}
		]).then(val => {
			const data = JSON.parse(val);
			for (let i of data) {
				city.innerHTML += `
					<option value="${i['city_id']}">${i['city_name']}</option>
				`;
			}
		});
	});

	const shippingCost = document.getElementById('shipping-cost');

	city.addEventListener('change', ev => {
		shippingCost.innerText = "0";
		convertToLocal();

		if (ev.target.value == -1) {
			updateTotalCost();
			return;
		}

		ajax("{{ url('getshippingcost')}}" + '/444/' + ev.target.value + "/1000", "GET", null).then(val => {
			const data =  JSON.parse(val);
			shippingCost.innerText = data.results[0].costs[0].cost[0].value;

			convertToLocal();
			updateTotalCost();
		});
	});

	function updateTotalCost() {
		const totalCost = document.getElementById('total-cost');
		const shipCostRp = shippingCost.innerText.substring(3, shippingCost.innerText.length - 3).replaceAll('.', '');
		let totalPriceRp = 0;
		if (totalPrice.innerText.includes('Rp'))
			totalPriceRp =  totalPrice.innerText.substring(3, totalPrice.innerText.length - 3).replaceAll('.', '');
		else
			totalPriceRp =  totalPrice.innerText;

		console.log(shipCostRp);
		totalCost.innerText = "Rp " + (Number(shipCostRp) + Number(totalPriceRp)).toLocaleString('id-ID') + ",00";
	}
</script>
@endsection