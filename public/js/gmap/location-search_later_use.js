// Define form submission handler function
function handleFormSubmit(event) {
	event.preventDefault();
	const searchBox = document.getElementById("searchBox");
	const searchLat = document.getElementById("searchLat");
	const searchLng = document.getElementById("searchLng");

	if (searchBox.value.trim() !== "") {
		// If searchBox is not empty, geocode using the location
		const location = searchBox.value;
		geocode(location);
	} else if (searchLat.value.trim() !== "" && searchLng.value.trim() !== "") {
		// If searchLat and searchLng are not empty, use them to center the map
		const lat = parseFloat(searchLat.value);
		const lng = parseFloat(searchLng.value);

		if (!isNaN(lat) && !isNaN(lng)) {
			centerMap(lat, lng, 12);
			addMarker(lat, lng);
		} else {
			alert("Please enter valid latitude and longitude");
		}
	} else {
		alert("Please enter a location or latitude and longitude");
	}
}

// Define map centering function
function centerMap(lat, lng) {
	const center = new google.maps.LatLng(lat, lng);
	myMap.setCenter(center);
	myMap.setZoom(18);
}

// Define function to add marker to the map
function addMarker(lat, lng) {
	const marker = new google.maps.Marker({
		position: { lat, lng },
		map: myMap,
		title: "Searched Location",
	});
}

// Add event listener to form
const form = document.getElementById("location-search-form");
form.addEventListener("submit", handleFormSubmit);
