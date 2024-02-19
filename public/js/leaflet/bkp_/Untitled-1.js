// Inisialisasi peta dengan setView default Indonesia dan zoom level 5
var defaultview = [-0.7893, 113.9213];
var defaultzoom = 5;
var myMap = L.map("myMap").setView(defaultview, defaultzoom);

// Tambahkan layer peta dari OpenStreetMap
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
	attribution:
		'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
}).addTo(myMap);

// Tambahkan fitur DrawControl untuk polygon
var drawnItems = new L.FeatureGroup();
myMap.addLayer(drawnItems);

var drawControl = new L.Control.Draw({
	edit: {
		featureGroup: drawnItems,
		remove: true,
	},
	draw: {
		polygon: {
			allowIntersection: false,
			showArea: true,
		},
		circle: false,
		circlemarker: false,
		marker: false,
		polyline: false,
		rectangle: false,
	},
});
myMap.addControl(drawControl);

// Tambahkan marker dan polygon dari input field jika tidak null
var lat = parseFloat(document.getElementById("latitude").value);
var lng = parseFloat(document.getElementById("longitude").value);
var polygon = document.getElementById("polygon").value;

var marker = L.marker([lat, lng], {
	draggable: true,
	icon: L.divIcon({
		className: "fas fa-map-marker-alt fa-2x text-danger",
	}),
}).addTo(myMap);

// Atur setView ke lokasi marker atau polygon dengan zoom level maksimum jika nilai latitude, longitude atau polygon tidak null
if (lat && lng) {
	myMap.setView([lat, lng], 18);
} else if (polygonLayer) {
	myMap.fitBounds(polygonLayer.getBounds(), { maxZoom: 18 });
}

marker.on("dragend", function (e) {
	document.getElementById("latitude").value = e.target.getLatLng().lat;
	document.getElementById("longitude").value = e.target.getLatLng().lng;
});

var polygonLayer;
var luas_kira;

if (polygon) {
	var polygonCoords = JSON.parse(polygon);
	polygonLayer = L.polygon(polygonCoords).addTo(drawnItems);
	myMap.fitBounds(polygonLayer.getBounds());

	// Hitung luas polygon dalam satuan hektar
	var area = L.GeometryUtil.geodesicArea(polygonLayer.getLatLngs()[0]) / 10000;
	luas_kira = area.toFixed(2);
	document.getElementById("luas_kira").innerHTML = luas_kira;
}
console.log("luas_kira");
myMap.on(L.Draw.Event.CREATED, function (event) {
	drawnItems.addLayer(event.layer);

	if (event.layerType === "polygon") {
		polygonLayer = event.layer;

		// Hitung luas polygon dalam satuan hektar
		var area =
			L.GeometryUtil.geodesicArea(polygonLayer.getLatLngs()[0]) / 10000;
		luas_kira = area.toFixed(2);
		document.getElementById("luas_kira").innerHTML = luas_kira;
		document.getElementById("polygon").value = JSON.stringify(
			polygonLayer.getLatLngs()
		);
	}
});

myMap.on(L.Draw.Event.EDITED, function (event) {
	var layers = event.layer;

	layers.eachLayer(function (layer) {
		if (layer instanceof L.Polygon) {
			polygonLayer = layer;

			// Hitung luas polygon dalam satuan hektar
			var area = L.GeometryUtil.geodesicArea(polygonLayer.getLatLngs()[0]);
			luas_kira = (area / 10000).toFixed(2);
			document.getElementById("luas_kira").innerHTML = luas_kira;
			document.getElementById("polygon").value = JSON.stringify(
				polygonLayer.getLatLngs()
			);
		}
	});

	var lat = parseFloat(document.getElementById("latitude").value);
	var lng = parseFloat(document.getElementById("longitude").value);
	var polygon = document.getElementById("polygon").value;

	if (lat && lng) {
		myMap.setView([lat, lng], myMap.getMaxZoom());
	} else if (polygon) {
		var polygonCoords = JSON.parse(polygon);
		polygonLayer = L.polygon(polygonCoords).addTo(drawnItems);
		myMap.fitBounds(polygonLayer.getBounds());
		myMap.setMaxZoom(myMap.getZoom());
	}
});
