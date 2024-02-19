// Modul 3 - Add Marker and Polygon to Map

let marker;
let polygon;

// Fungsi untuk menambahkan marker ke peta
function addMarker(lat, lng) {
	// Hapus marker sebelumnya jika ada
	if (marker) {
		mymap.removeLayer(marker);
	}

	// Tambahkan marker baru ke peta dengan tampilan menggunakan font awesome
	marker = L.marker([lat, lng], {
		icon: L.divIcon({
			className: "fas fa-map-marker-alt fa-2x text-danger",
			iconSize: [26, 36],
		}),
		draggable: true,
	}).addTo(mymap);

	// Perbarui posisi marker dan nilai input latitude dan longitude saat marker dipindahkan
	marker.on("dragend", function () {
		updateMarkerPosition(marker);
	});

	updateMarkerPosition(marker);
}

// Fungsi untuk menambahkan polygon ke peta
function addPolygon(coords) {
	// Hapus polygon sebelumnya jika ada
	if (polygon) {
		mymap.removeLayer(polygon);
	}

	// Tambahkan polygon baru ke peta
	polygon = L.polygon(coords, { color: "red" }).addTo(mymap);

	// Perbarui nilai input polygon dan hitung luas kira saat polygon berubah
	polygon.on("edit", function () {
		updatePolygonValue(polygon);
		calculateArea(polygon);
	});

	updatePolygonValue(polygon);
	calculateArea(polygon);
}

// Fungsi untuk menambahkan marker dan polygon ke peta berdasarkan nilai input latitude, longitude, dan polygon
function addMarkerAndPolygon() {
	const lat = parseFloat(latInput.value);
	const lng = parseFloat(longInput.value);
	const polygonCoords = JSON.parse(polygonInput.value);

	if (!isNaN(lat) && !isNaN(lng) && polygonCoords.length > 0) {
		addMarker(lat, lng);
		addPolygon(polygonCoords);
	}
}

// Tambahkan event listener untuk menambahkan marker dan polygon saat tombol "Tambahkan" di klik
const addButton = document.getElementById("add-button");
addButton.addEventListener("click", addMarkerAndPolygon);
