const locationPicker = (map, markerLayer, latitudeInput, longitudeInput) => {
	let marker;

	// Add marker on map click
	map.on("click", (e) => {
		const latLng = e.latlng;

		if (!marker) {
			marker = L.marker(latLng, {
				icon: L.icon({
					iconUrl:
						"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/svgs/solid/map-marker-alt.svg",
					iconSize: [25, 41],
					iconAnchor: [12, 41],
					className: "text-danger fa-2x",
				}),
			}).addTo(markerLayer);
		} else {
			marker.setLatLng(latLng);
		}

		latitudeInput.value = latLng.lat.toFixed(6);
		longitudeInput.value = latLng.lng.toFixed(6);
	});

	// Event listener for when a marker is deleted
	map.on("draw:deleted", () => {
		markerLayer.clearLayers();
		latitudeInput.value = "";
		longitudeInput.value = "";
	});
};
