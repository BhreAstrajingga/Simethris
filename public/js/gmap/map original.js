// map.js
let myMap;

function initMap() {
	//init the map viewport
	myMap = new google.maps.Map(document.getElementById("myMap"), {
		center: { lat: -2.5489, lng: 118.0149 },
		zoom: 5,
		mapTypeId: google.maps.MapTypeId.SATELLITE,
	});

	// 2. array to store the marker and polygon
	const markers = [];
	const polygons = [];

	// var infowindow = new google.maps.InfoWindow({
	// 	content: "Hello World!",
	// });

	// 3. setup drawing manager
	var drawingManager = new google.maps.drawing.DrawingManager({
		drawingMode: google.maps.drawing.OverlayType.DEFAULT,
		drawingControl: true,
		drawingControlOptions: {
			position: google.maps.ControlPosition.TOP_CENTER,
			drawingModes: ["marker", "polygon"],
		},
		polygonOptions: {
			fillColor: "#fd3995",
			strokeColor: "#fd3995",
			strokeWeight: 2,
			fillOpacity: 0.5,
			editable: true,
			draggable: true,
		},
	});
	drawingManager.setMap(myMap); //attach draw manager to map

	/** 3. event listener for when a marker is completed
	 *
	 * add the marker to the array of markers and make it draggable
	 * add a listener for when the marker is clicked, center the map on the marker, and update the input fields
	 * add a listener for when the marker is dragged, update the input fields
	 */

	google.maps.event.addListener(
		drawingManager,
		"markercomplete",
		function (marker) {
			// add the marker to the array of markers and make it draggable
			markers.push(marker);
			marker.setDraggable(true);
			//  add a listener for when the marker is clicked, center the map on the marker, and update the input fields
			google.maps.event.addListener(marker, "click", function () {
				myMap.setCenter(marker.getPosition());
				document.getElementById("latitude").value = marker
					.getPosition()
					.lat();
				document.getElementById("longitude").value = marker
					.getPosition()
					.lng();
			});
			//  add a listener for when the marker is dragged, update the input fields
			google.maps.event.addListener(marker, "drag", function () {
				document.getElementById("latitude").value = marker
					.getPosition()
					.lat();
				document.getElementById("longitude").value = marker
					.getPosition()
					.lng();
			});
		}
	);

	/** 4. check if the latitude and longitude inputs have values
	 *
	 * and if true, create a marker at that position
	 * add marker
	 */
	// check if the latitude and longitude inputs have values, and if so, create a marker at that position
	var latitude = document.getElementById("latitude").value;
	var longitude = document.getElementById("longitude").value;
	if (latitude != "" && longitude != "") {
		var position = new google.maps.LatLng(latitude, longitude);
		var marker = new google.maps.Marker({
			position: position,
			map: myMap,
			draggable: true,
		});
		// add the marker to the array of markers, center the map on the marker, and add listeners for click and drag events
		markers.push(marker);
		myMap.setCenter(position);
		myMap.setZoom(18);
		google.maps.event.addListener(marker, "click", function () {
			myMap.setCenter(marker.getPosition());
		});
		google.maps.event.addListener(marker, "drag", function () {
			document.getElementById("latitude").value = marker
				.getPosition()
				.lat();
			document.getElementById("longitude").value = marker
				.getPosition()
				.lng();
		});
	}

	// 5. check if polygon has input value
	var polygonCoords = document.getElementById("polygon").value;
	if (polygonCoords != "") {
		polygonCoords = JSON.parse(polygonCoords);
		var polygon = new google.maps.Polygon({
			paths: polygonCoords,
			strokeColor: "#FF0000",
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: "#FF0000",
			fillOpacity: 0.35,
			editable: true,
			map: myMap,
		});
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
			var luas = google.maps.geometry.spherical.computeArea(
				polygon.getPath()
			);
			document.getElementById("luas_kira").value = (luas / 10000).toFixed(
				2
			);
		});
		google.maps.event.addListener(
			polygon.getPath(),
			"insert_at",
			function () {
				document.getElementById("polygon").value = JSON.stringify(
					polygon.getPath().getArray()
				);
				// calculate and display the area of the polygon
				var luas = google.maps.geometry.spherical.computeArea(
					polygon.getPath()
				);
				document.getElementById("luas_kira").value = (
					luas / 10000
				).toFixed(2);
			}
		);
	}

	// Part 9 add a listener for when a polygon is completed
	google.maps.event.addListener(
		drawingManager,
		"polygoncomplete",
		function (polygon) {
			// add the polygon to the map
			polygon.setMap(myMap);

			// add a listener for when the polygon is clicked, and update the input field
			google.maps.event.addListener(polygon, "click", function () {
				document.getElementById("polygon").value = JSON.stringify(
					polygon.getPath().getArray()
				);

				// calculate and display the area of the polygon
				var luas = google.maps.geometry.spherical.computeArea(
					polygon.getPath()
				);
				document.getElementById("luas_kira").value = (
					luas / 10000
				).toFixed(2);
			});

			// add a listener for when the polygon is edited, and update the input field
			google.maps.event.addListener(
				polygon.getPath(),
				"set_at",
				function () {
					document.getElementById("polygon").value = JSON.stringify(
						polygon.getPath().getArray()
					);

					// calculate and display the area of the polygon
					var luas = google.maps.geometry.spherical.computeArea(
						polygon.getPath()
					);
					document.getElementById("luas_kira").value = (
						luas / 10000
					).toFixed(2);
				}
			);

			google.maps.event.addListener(
				polygon.getPath(),
				"insert_at",
				function () {
					document.getElementById("polygon").value = JSON.stringify(
						polygon.getPath().getArray()
					);

					// calculate and display the area of the polygon
					var luas = google.maps.geometry.spherical.computeArea(
						polygon.getPath()
					);
					document.getElementById("luas_kira").value = (
						luas / 10000
					).toFixed(2);
				}
			);
		}
	);
}
