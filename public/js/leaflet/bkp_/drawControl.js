const drawControl = (
	map,
	markerLayer,
	polygonLayer,
	latitudeInput,
	longitudeInput,
	polygonInput,
	areaInput
) => {
	const drawOptions = {
		position: "topleft",
		draw: {
			marker: {
				icon: L.icon({
					iconUrl:
						"https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png",
					shadowUrl:
						"https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png",
					iconSize: [25, 41],
					iconAnchor: [12, 41],
				}),
			},
			polygon: {
				allowIntersection: false,
				drawError: {
					color: "#e1e100",
					message: "<strong>Oh snap!<strong> you can't draw that!",
				},
				shapeOptions: {
					color: "#ff0000",
				},
			},
			circle: false,
			rectangle: false,
			polyline: false,
		},
		edit: {
			featureGroup: markerLayer,
			remove: true,
		},
	};

	const drawControl = new L.Control.Draw(drawOptions);

	map.addControl(drawControl);

	// Event listener for when a marker is created
	map.on("draw:created", (e) => {
		const type = e.layerType;
		const layer = e.layer;

		if (type === "marker") {
			markerLayer.clearLayers();
			markerLayer.addLayer(layer);

			const latLng = layer.getLatLng();
			latitudeInput.value = latLng.lat.toFixed(6);
			longitudeInput.value = latLng.lng.toFixed(6);
		} else if (type === "polygon") {
			polygonLayer.clearLayers();
			polygonLayer.addLayer(layer);

			const latLngs = layer.getLatLngs();
			const polygon = [];

			for (let i = 0; i < latLngs.length; i++) {
				polygon.push([latLngs[i].lat.toFixed(6), latLngs[i].lng.toFixed(6)]);
			}

			polygonInput.value = JSON.stringify(polygon);
			areaInput.value = calculateArea(polygon).toFixed(2);
		}
	});

	// Event listener for when a marker is deleted
	map.on("draw:deleted", () => {
		markerLayer.clearLayers();
		latitudeInput.value = "";
		longitudeInput.value = "";
	});
};
