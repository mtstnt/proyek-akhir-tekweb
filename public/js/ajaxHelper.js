function ajax(url, method, data, header = []) {
	return new Promise( resolve => {
		const xhr = new XMLHttpRequest();
		xhr.open(method, url);
		xhr.onreadystatechange = function() {
			if (xhr.status == 200 && xhr.readyState == 4) {
				resolve(xhr.responseText);
			}
		}
		if (header != null) {
			for (let i of header) {
				xhr.setRequestHeader(i, header[i]);
			}
		}
		xhr.send(data);
	});
}