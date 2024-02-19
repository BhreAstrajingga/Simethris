// Search location

var searchInput = document.getElementById("search-input");
var searchButton = document.getElementById("search-button");

function handleSearch() {
	var query = searchInput.value;
	var url =
		"https://nominatim.openstreetmap.org/search?q=" +
		encodeURIComponent(query) +
		"&format=json&limit=1";

	fetch(url)
		.then((response) => response.json())
		.then((data) => {
			if (data.length > 0) {
				var latitude = data[0].lat;
				var longitude = data[0].lon;
				map.setView([latitude, longitude], 13);
			} else {
				alert("Lokasi: " + query + " yang Anda inginkan tidak ditemukan");
			}
		})
		.catch((error) => {
			alert("Error searching for location: " + error.message);
		});
}

searchButton.addEventListener("click", handleSearch);

button.addEventListener("click", function () {
	// Do something when button is clicked
});
