// // Floating action button
// var fab = L.easyButton({
// 	states: [
// 		{
// 			stateName: "add-location",
// 			icon: "fa-map-marker",
// 			title: "Add Location",
// 			onClick: function (btn, map) {
// 				map.on("click", function (e) {
// 					marker.setLatLng(e.latlng);
// 					map.off("click");
// 					document.getElementById("latitude").value = e.latlng.lat.toFixed(6);
// 					document.getElementById("longitude").value = e.latlng.lng.toFixed(6);
// 					updateMarkerPosition();
// 				});
// 			},
// 		},
// 	],
// });

// fab.addTo(map);

//button go to current record location
var mapContainer = document.getElementById("map");
var buttonGroup = L.DomUtil.create("div", "btn-group");
buttonGroup.setAttribute("role", "group");
buttonGroup.setAttribute("aria-label", "Basic example");
mapContainer.appendChild(buttonGroup);

var goToButton = L.DomUtil.create("button", "btn btn-sm floating-button");
goToButton.setAttribute("title", "Go to current recorded marker");
goToButton.innerHTML = '<i class="fal fa-map-pin"></i>';
buttonGroup.appendChild(goToButton);

var removeButton = L.DomUtil.create("button", "btn btn-sm floating-button");
removeButton.setAttribute("title", "Remove current marker");
removeButton.innerHTML = '<i class="fal fa-map-marker-times"></i>';
buttonGroup.appendChild(removeButton);

goToButton.addEventListener("click", function (e) {
	e.preventDefault();
	var latitude = document.getElementById("latitude").value;
	var longitude = document.getElementById("longitude").value;
	if (latitude && longitude) {
		map.setView([latitude, longitude], 13);
	}
});

removeButton.addEventListener("click", function (e) {
	e.preventDefault();
	if (currentMarker) {
		map.removeLayer(currentMarker);
		currentMarker = null;
	}
});
