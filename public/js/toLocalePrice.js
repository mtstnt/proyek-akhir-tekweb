function convertToLocale() {
	const itemPrice = [...document.querySelectorAll('.item-price')];
	itemPrice.forEach(el => {
		let price = Number(el.innerText);
		el.innerText = "Rp " + price.toLocaleString('id-ID') + ",00";
	});
}


function getNumber(localeCurrencyString) {
	let number = localeCurrencyString.substring(3, localeCurrencyString.length - 3); 
    number.replaceAll(".", "");
    console.log(number);
    return number;
}

convertToLocale();