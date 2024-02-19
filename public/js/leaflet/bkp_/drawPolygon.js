// Tambahkan kontrol untuk membuat dan mengubah polygon
var polygonControl = L.Control.extend({
	options: {
		position: "topright",
	},

	onAdd: function (map) {
		var container = L.DomUtil.create(
			"div",
			"leaflet-bar leaflet-control leaflet-control-custom"
		);
		container.innerHTML =
			'<button class="btn btn-primary" id="polygon-btn">Buat Polygon</button>';

		L.DomEvent.disableClickPropagation(container);
		L.DomEvent.on(container, "click", function () {
			if (!drawingPolygon) {
				startPolygon();
			} else {
				stopPolygon();
			}
		});

		return container;
	},
});

// Tambahkan kontrol untuk menghapus marker/polygon
var deleteControl = L.Control.extend({
	options: {
		position: "topright",
	},

	onAdd: function (map) {
		var container = L.DomUtil.create(
			"div",
			"leaflet-bar leaflet-control leaflet-control-custom"
		);
		container.innerHTML =
			'<button class="btn btn-danger" id="delete-btn">Hapus Marker/Polygon</button>';

		L.DomEvent.disableClickPropagation(container);
		L.DomEvent.on(container, "click", function () {
			if (activeMarker) {
				deleteMarker(activeMarker);
			} else if (drawingPolygon) {
				stopPolygon();
			} else if (activePolygon) {
				deletePolygon(activePolygon);
			}
		});

		return container;
	},
});

// Tambahkan kontrol untuk mengubah marker/polygon
var editControl = L.Control.extend({
	options: {
		position: "topright",
	},

	onAdd: function (map) {
		var container = L.DomUtil.create(
			"div",
			"leaflet-bar leaflet-control leaflet-control-custom"
		);
		container.innerHTML =
			'<button class="btn btn-success" id="edit-btn">Ubah Marker/Polygon</button>';

		L.DomEvent.disableClickPropagation(container);
		L.DomEvent.on(container, "click", function () {
			if (activeMarker) {
				editMarker(activeMarker);
			} else if (activePolygon) {
				editPolygon(activePolygon);
			}
		});

		return container;
	},
});
