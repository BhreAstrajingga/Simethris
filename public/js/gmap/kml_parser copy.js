var geocoder = null;
var geoXml = null;
var geoXmlDoc = null;
var map = null;
var myLatLng = null;
var myGeoXml3Zoom = true;
var marker = [];
var polyline;

function kml_parser() {
	geocoder = new google.maps.Geocoder();
	infowindow = new google.maps.InfoWindow({
		size: new google.maps.Size(150, 50),
	});
	var total_file = document.getElementById("kml_file").files.length;
	var filekml = "";
	for (var i = 0; i < total_file; i++) {
		filekml += URL.createObjectURL(event.target.files[i]);
	}

	var myOptions = {
		zoom: 10,
		mapTypeControl: true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
		},
		navigationControl: true,
		mapTypeId: google.maps.MapTypeId.SATELLITE,
	};
	map = new google.maps.Map(document.getElementById("myMap"), myOptions);
	infowindow = new google.maps.InfoWindow({});
	geoXml = new geoXML3.parser({
		map: map,
		infoWindow: infowindow,
		singleInfoWindow: true,
		zoom: myGeoXml3Zoom,
		markerOptions: { optimized: false },
		createMarker: createMarker,
		polygonOptions: { optimized: false },
		createPolygon: createPolygon,
	});
	geoXml.parse(filekml);
}

var kmlColor = function (kmlIn, colorMode) {
	var kmlColor = {};
	kmlIn = kmlIn || "ffffffff"; // white (KML 2.2 default)

	var aa = kmlIn.substr(0, 2);
	var bb = kmlIn.substr(2, 2);
	var gg = kmlIn.substr(4, 2);
	var rr = kmlIn.substr(6, 2);

	kmlColor.opacity = parseInt(aa, 16) / 256;
	kmlColor.color =
		colorMode === "random" ? randomColor(rr, gg, bb) : "#" + rr + gg + bb;
	return kmlColor;
};
var createMarker = function (placemark, doc) {
	var markerOptions = geoXML3.combineOptions(geoXml.options.markerOptions, {
		myMap: geoXml.options.map,
		position: new google.maps.LatLng(
			placemark.Point.coordinates[0].lat,
			placemark.Point.coordinates[0].lng
		),
		title: placemark.name,
		zIndex: Math.round(placemark.Point.coordinates[0].lat * -100000) << 5,
		icon: placemark.style.icon,
		shadow: placemark.style.shadow,
	});

	// Create the marker on the map
	var marker = new google.maps.Marker(markerOptions);
	if (!!doc) {
		doc.markers.push(marker);
	}

	// Set up and create the infowindow if it is not suppressed
	if (!geoXml.options.suppressInfoWindows) {
		var infoWindowOptions = geoXML3.combineOptions(
			geoXml.options.infoWindowOptions,
			{
				content:
					'<div class="geoxml3_infowindow"><h3>' +
					placemark.name +
					"</h3><div>" +
					placemark.description +
					"</div></div>",
				pixelOffset: new google.maps.Size(0, 2),
			}
		);
		if (geoXml.options.infoWindow) {
			marker.infoWindow = geoXml.options.infoWindow;
		} else {
			marker.infoWindow = new google.maps.InfoWindow(infoWindowOptions);
		}
		marker.infoWindowOptions = infoWindowOptions;

		// Infowindow-opening event handler
		google.maps.event.addListener(marker, "click", function () {
			var mLat = placemark.Point.coordinates[0].lat;
			var mLng = placemark.Point.coordinates[0].lng;
			document.getElementById("latitude").value = mLat;
			document.getElementById("longitude").value = mLng;
			this.infoWindow.close();
			marker.infoWindow.setOptions(this.infoWindowOptions);
			this.infoWindow.open(this.map, this);
		});
	}
	placemark.marker = marker;
	return marker;
};

var createPolygon = function (placemark, doc) {
	var bounds = new google.maps.LatLngBounds();
	var pathsLength = 0;
	var paths = [];
	for (
		var polygonPart = 0;
		polygonPart < placemark.Polygon.length;
		polygonPart++
	) {
		for (
			var j = 0;
			j < placemark.Polygon[polygonPart].outerBoundaryIs.length;
			j++
		) {
			var coords =
				placemark.Polygon[polygonPart].outerBoundaryIs[j].coordinates;
			var path = [];
			for (var i = 0; i < coords.length; i++) {
				var pt = new google.maps.LatLng(coords[i].lat, coords[i].lng);
				path.push(pt);
				bounds.extend(pt);
			}
			paths.push(path);
			pathsLength += path.length;
		}
		for (
			var j = 0;
			j < placemark.Polygon[polygonPart].innerBoundaryIs.length;
			j++
		) {
			var coords =
				placemark.Polygon[polygonPart].innerBoundaryIs[j].coordinates;
			var path = [];
			for (var i = 0; i < coords.length; i++) {
				var pt = new google.maps.LatLng(coords[i].lat, coords[i].lng);
				path.push(pt);
				bounds.extend(pt);
			}
			paths.push(path);
			pathsLength += path.length;
		}
	}

	// Load basic polygon properties
	var kmlStrokeColor = kmlColor(
		placemark.style.color,
		placemark.style.colorMode
	);
	var kmlFillColor = kmlColor(
		placemark.style.fillcolor,
		placemark.style.colorMode
	);
	if (!placemark.style.fill) kmlFillColor.opacity = 0.0;
	var strokeWeight = placemark.style.width;
	if (!placemark.style.outline) {
		strokeWeight = 0;
		kmlStrokeColor.opacity = 0.0;
	}
	var polyOptions = geoXML3.combineOptions(geoXml.options.polyOptions, {
		myMap: geoXml.options.map,
		paths: paths,
		title: placemark.name,
		strokeColor: kmlStrokeColor.color,
		strokeWeight: strokeWeight,
		strokeOpacity: kmlStrokeColor.opacity,
		fillColor: kmlFillColor.color,
		fillOpacity: kmlFillColor.opacity,
	});
	var MyPolygon = new google.maps.Polygon(polyOptions);
	MyPolygon.bounds = bounds;
	if (!geoXml.options.suppressInfoWindows) {
		var infoWindowOptions = geoXML3.combineOptions(
			geoXml.options.infoWindowOptions,
			{
				content:
					'<div class="geoxml3_infowindow"><h3>' +
					placemark.name +
					"</h3><div>" +
					placemark.description +
					"</div></div>",
				pixelOffset: new google.maps.Size(0, 2),
			}
		);
		if (geoXml.options.infoWindow) {
			MyPolygon.infoWindow = geoXml.options.infoWindowOptions;
		} else {
			MyPolygon.infoWindow = new google.maps.InfoWindow(infoWindowOptions);
		}
		MyPolygon.infoWindowOptions = infoWindowOptions;
		// Infowindow-opening event handler
		google.maps.event.addListener(MyPolygon, "click", function (event) {
			const polygon = this;
			const path = polygon.getPath();
			var encodeString = google.maps.geometry.encoding.encodePath(path);
			document.getElementById("realisasi_polygon").value = encodeString;
		});
	}
	placemark.polygon = MyPolygon;
	return MyPolygon;
};
