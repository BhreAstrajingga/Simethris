function initMap() {
	// Set default latitude and longitude
	var latitude = -2.548926;
	var longitude = 118.014863;
	var zoomLevel = 5;

	// Initialize map
	var map = L.map("map", {
		center: [latitude, longitude],
		zoom: zoomLevel,
	});

	// Add tile layer to the map
	L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
		attribution: "Map data © OpenStreetMap contributors",
		// maxZoom: 5,
	}).addTo(map);

	// Add drawn items layer to the map
	var drawnItems = new L.FeatureGroup();
	map.addLayer(drawnItems);

	// Add marker to the map
	var marker = L.marker([latitude, longitude], {
		draggable: true,
		icon: L.divIcon({
			className: "my-icon",
			html: '<i class="fas fa-map-marker-alt fa-2x text-danger"></i>',
		}),
	});

	// Add marker to the drawn items layer
	drawnItems.addLayer(marker);

	// Update the hidden input field with the latitude and longitude values
	function updateMarkerPosition() {
		var latitude = marker.getLatLng().lat;
		var longitude = marker.getLatLng().lng;
		document.getElementById("latitude").value = latitude;
		document.getElementById("longitude").value = longitude;
	}

	// Set marker position based on input values
	function setMarkerPosition() {
		var latitudeInput = document.getElementById("latitude");
		var longitudeInput = document.getElementById("longitude");
		var latitude = latitudeInput.value;
		var longitude = longitudeInput.value;
		var zoomLevel = 19;
		if (latitude && longitude) {
			marker.setLatLng([latitude, longitude]);
			map.setView([latitude, longitude], zoomLevel);
			updateMarkerPosition();
		}
	}

	// Disable manual input on latitude and longitude inputs
	document.getElementById("latitude").readOnly = true;
	document.getElementById("longitude").readOnly = true;

	// Update latitude and longitude inputs when marker is moved
	marker.on("dragend", updateMarkerPosition);

	// Add draw event handlers
	map.on("draw:created", function (e) {
		drawnItems.addLayer(e.layer);
	});

	map.on("draw:edited", function (e) {
		updateMarkerPosition();
	});

	map.on("draw:deleted", function (e) {
		updateMarkerPosition();
	});

	// Call setMarkerPosition() function when page is loaded
	setMarkerPosition();
}

// Call initMap() function when page is loaded
window.onload = function () {
	initMap();
};
