// clickMap.js
// Get the map object from the parent window
var map = window.parent.map;

// Get the markers and polygons arrays from the parent window
var markers = window.parent.markers;
var polygons = window.parent.polygons;

// Add a click event listener to each marker
markers.forEach(function (marker) {
	marker.addListener("click", function () {
		map.setZoom(15);
		map.panTo(marker.getPosition());
	});
});

// Add a click event listener to each polygon
polygons.forEach(function (polygon) {
	polygon.addListener("click", function () {
		var bounds = new google.maps.LatLngBounds();
		polygon.getPath().forEach(function (latLng) {
			bounds.extend(latLng);
		});
		map.fitBounds(bounds);
	});
});
