const itemPrice = [...document.querySelectorAll('.item-price')];

itemPrice.forEach(el => {
	let price = Number(el.innerText);
	el.innerText = "Rp " + price.toLocaleString('id-ID') + ",00";
});

