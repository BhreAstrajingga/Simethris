function link_parser() {
	// Get input fields
	var latitudeInput = document.getElementById("latitude");
	var longitudeInput = document.getElementById("longitude");
	var polygonInput = document.getElementById("polygon");

	// Create map options
	var mapOptions = {
		streetViewControl: false,
		mapTypeControl: true,
		clickableIcons: true,
		fullscreenControl: false,
	};

	// Create KML layer using the given map ID
	var map = new google.maps.Map(document.getElementById("myMap"), mapOptions);
	var mapId = document.getElementById("mapId").value;
	var kmlLayer = new google.maps.KmlLayer({
		url: "http://www.google.com/maps/d/u/0/kml?forcekml=1&mid=" + mapId,
		map: map,
	});

	// Add click event to markers and polygons
	google.maps.event.addListener(kmlLayer, "click", function (event) {
		// Update latitude and longitude input fields
		var latLng = event.latLng;
		latitudeInput.value = latLng.lat();
		longitudeInput.value = latLng.lng();

		// Clear polygon input field
		polygonInput.value = "";

		// Deselect previously selected polygon
		kmlLayer.setOptions({
			suppressInfoWindows: true,
			clickable: true,
		});

		// Add click event to selected marker
		event.feature.setOptions({
			title: "Marker",
		});

		// Add click event to selected polygon
		event.feature.setOptions({
			clickable: true,
			fillColor: "#00FF00",
			fillOpacity: 0.5,
			strokeColor: "#00FF00",
			strokeOpacity: 1.0,
			strokeWeight: 2,
		});

		// Update polygon input field
		var polygons = event.feature.getGeometry().getArray();
		var polygonCoords = [];
		for (var i = 0; i < polygons.length; i++) {
			var poly = polygons[i];
			var polyCoords = poly.getArray();
			var coords = [];
			for (var j = 0; j < polyCoords.length; j++) {
				var coord = polyCoords[j];
				coords.push(coord.lat() + "," + coord.lng());
			}
			polygonCoords.push(coords.join(" "));
		}
		polygonInput.value = polygonCoords.join(",");

		// Log polygon and marker click events to console
		console.log("Polygon clicked:", event.feature.getProperty("name"));
		console.log("Marker clicked:", event.latLng.toString());
	});
}
