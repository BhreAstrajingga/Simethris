// usermap.js
// let userMap;

function inituserMap() {
	//init the map viewport
	userMap = new google.maps.Map(document.getElementById("userMap"), {
		center: { lat: -2.5489, lng: 118.0149 },
		zoom: 5,
		mapTypeId: google.maps.MapTypeId.SATELLITE,
	});

	// 2. array to store the marker and polygon
	const usermarkers = [];
	// check if the latitude and longitude inputs have values, and if so, create a marker at that position
	var userlat = document.getElementById("userlat").value;
	var userlng = document.getElementById("userlng").value;
	if (userlat != "" && userlng != "") {
		var position = new google.maps.LatLng(userlat, userlng);
		var marker = new google.maps.Marker({
			position: position,
			map: userMap,
			draggable: false,
		});
		// add the marker to the array of markers, center the map on the marker, and add listeners for click events
		usermarkers.push(marker);
		userMap.setCenter(position);
		userMap.setZoom(18);
		google.maps.event.addListener(marker, "click", function () {
			userMap.setCenter(marker.getPosition());
			document.getElementById("latitude").value = marker.getPosition().lat();
			document.getElementById("longitude").value = marker.getPosition().lng();
		});
	}

	// 5. check if polygon has input value
	var userpolys = document.getElementById("userpoly").value;
	if (userpolys != "") {
		userpolys = JSON.parse(userpolys);
		var userpoly = new google.maps.Polygon({
			paths: userpolys,
			strokeColor: "#ffd900",
			strokeOpacity: 1,
			strokeWeight: 2,
			fillColor: "#ffd900",
			fillOpacity: 0.35,
			editable: false,
			map: userMap,
		});
		// add listener for polygon click event
		google.maps.event.addListener(userpoly, "click", function () {
			// change the value of polygon input field
			document.getElementById("polygon").value = JSON.stringify(
				userpoly.getPaths().getArray()
			);
			// calculate and display the area of the polygon
			var luas = google.maps.geometry.spherical.computeArea(userpoly.getPath());
			document.getElementById("luas_kira").value = (luas / 10000).toFixed(2);
		});
	}
}
