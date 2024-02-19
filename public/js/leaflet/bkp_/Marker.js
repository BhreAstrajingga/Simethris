// Marker.js

var Marker = (function () {
	var marker;
	var markerLayer = new L.LayerGroup();
	var latitudeField = document.getElementById("latitude"); // replace with your HTML input element ID
	var longitudeField = document.getElementById("longitude"); // replace with your HTML input element ID

	function addMarker(latlng) {
		// remove existing marker layer before adding new marker
		markerLayer.clearLayers();

		// create new marker and add to marker layer
		marker = L.marker(latlng, {
			icon: L.divIcon({
				className: "fas fa-map-marker-alt fa-2x text-danger",
				iconSize: [32, 32],
				iconAnchor: [16, 32],
			}),
		}).addTo(markerLayer);

		// add marker layer to map
		markerLayer.addTo(MyMap.getMap());

		// update input field values
		latitudeField.value = latlng.lat.toFixed(6);
		longitudeField.value = latlng.lng.toFixed(6);
	}

	function getMarker() {
		return marker;
	}

	return {
		addMarker: addMarker,
		getMarker: getMarker,
	};
})();
