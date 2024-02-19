// Polygon.js

var Polygon = (function () {
	var polygon;
	var polygonLayer = new L.LayerGroup();
	var latitudeField = document.getElementById("latitude"); // replace with your HTML input element ID
	var longitudeField = document.getElementById("longitude"); // replace with your HTML input element ID
	var areaField = document.getElementById("area"); // replace with your HTML input element ID

	function addPolygon(latlngs) {
		// remove existing polygon layer before adding new polygon
		polygonLayer.clearLayers();

		// create new polygon and add to polygon layer
		polygon = L.polygon(latlngs).addTo(polygonLayer);

		// add polygon layer to map
		polygonLayer.addTo(MyMap.getMap());

		// update input field values
		var area = L.GeometryUtil.geodesicArea(polygon.getLatLngs()[0]) / 1000000; // convert to km²
		latitudeField.value = latlngs[0].lat.toFixed(6);
		longitudeField.value = latlngs[0].lng.toFixed(6);
		areaField.value = area.toFixed(2);
	}

	function getPolygon() {
		return polygon;
	}

	return {
		addPolygon: addPolygon,
		getPolygon: getPolygon,
	};
})();
