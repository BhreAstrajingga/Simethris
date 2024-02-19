//kml_parser.js
let marker;
let polygon;

function kml_parser() {
	// remove existing marker and polygon
	if (marker) {
		marker.setMap(null);
	}
	if (polygon) {
		polygon.setMap(null);
	}

	// get the uploaded KML file
	const kmlFile = document.getElementById("kml_file").files[0];

	// create a new file reader object
	const reader = new FileReader();

	// callback function for when file is loaded
	reader.onload = (event) => {
		// get the contents of the KML file
		const kmlData = event.target.result;

		// create a new KML parser object
		const parser = new DOMParser();

		// parse the KML data into an XML document
		const kmlXml = parser.parseFromString(kmlData, "application/xml");

		// extract the coordinates from the KML document
		const coordinates = kmlXml
			.getElementsByTagName("coordinates")[0]
			.textContent.trim()
			.split(/\s+/);

		// create an array of LatLng objects from the coordinates
		const latLngs = coordinates.map((coord) => {
			const [lng, lat] = coord.split(",");
			return new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
		});

		// extract the coordinates for each LinearRing in the KML file
		const linearRings = Array.from(kmlXml.getElementsByTagName("LinearRing"));
		const polygonPaths = linearRings.map((ring) => {
			const coordinates = ring
				.getElementsByTagName("coordinates")[0]
				.textContent.trim()
				.split(/\s+/);
			return coordinates.map((coord) => {
				const [lng, lat] = coord.split(",");
				return { lat: parseFloat(lat), lng: parseFloat(lng) };
			});
		});

		// create a new marker object
		marker = new google.maps.Marker({
			position: latLngs[0],
			map: myMap,
			draggable: true,
		});

		// add a click event listener to the marker
		marker.addListener("click", function () {
			//center the viewport to the marker
			myMap.setCenter(marker.getPosition());
			infowindow.open(map, marker);
			// myMap.setZoom(18);
			// update the value of the latitude and longitude input fields
			document.getElementById("latitude").value = marker.getPosition().lat();
			document.getElementById("longitude").value = marker.getPosition().lng();
		});

		// add a dragend event listener to the marker
		marker.addListener("dragend", function () {
			// update the value of the latitude and longitude input fields
			document.getElementById("latitude").value = marker.getPosition().lat();
			document.getElementById("longitude").value = marker.getPosition().lng();
		});

		// create a new polygon object
		polygon = new google.maps.Polygon({
			paths: polygonPaths,
			fillColor: "#fd3995",
			strokeColor: "#fd3995",
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillOpacity: 0.5,
			editable: true,
			draggable: true,
			map: myMap,
		});

		// fit the map viewport to the polygon bounds
		const bounds = new google.maps.LatLngBounds();
		latLngs.forEach((polygonPaths) => bounds.extend(polygonPaths));
		myMap.fitBounds(bounds);

		// update the value of the polygon input field
		document.getElementById("latitude").value = marker.getPosition().lat();
		document.getElementById("longitude").value = marker.getPosition().lng();
		document.getElementById("polygon").value = JSON.stringify(
			polygon.getPath().getArray()
		);
		var luas = google.maps.geometry.spherical.computeArea(polygon.getPath());
		document.getElementById("luas_kira").value = (luas / 10000).toFixed(2);

		// add a listener for when the polygon is clicked, and update the input field
		google.maps.event.addListener(polygon, "click", function () {
			document.getElementById("polygon").value = JSON.stringify(
				polygon.getPath().getArray()
			);
		});
		// add a listener for when the polygon is edited, and update the input field
		google.maps.event.addListener(polygon.getPath(), "set_at", function () {
			document.getElementById("polygon").value = JSON.stringify(
				polygon.getPath().getArray()
			);
			// calculate and display the area of the polygon
			var luas = google.maps.geometry.spherical.computeArea(polygon.getPath());
			document.getElementById("luas_kira").value = (luas / 10000).toFixed(2);
		});
		google.maps.event.addListener(polygon.getPath(), "insert_at", function () {
			document.getElementById("polygon").value = JSON.stringify(
				polygon.getPath().getArray()
			);
			// calculate and display the area of the polygon
			var luas = google.maps.geometry.spherical.computeArea(polygon.getPath());
			document.getElementById("luas_kira").value = (luas / 10000).toFixed(2);
		});

		var infowindow = new google.maps.InfoWindow({
			content: "Hello World!",
		});
	};

	// read the contents of the uploaded KML file
	reader.readAsText(kmlFile);
}
