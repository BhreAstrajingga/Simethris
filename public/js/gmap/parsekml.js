function initMap() {
	var legend = document.getElementById("legend");

	var iconBase = "https://maps.google.com/mapfiles/kml/shapes/";
	var icons = {
		parking: {
			name: "Available",
			icon: iconBase + "parking_lot_maps.png",
		},
		library: {
			name: "Under Construction",
			icon: iconBase + "library_maps.png",
		},
		info: {
			name: "Coming Soon",
			icon: iconBase + "info-i_maps.png",
		},
	};

	var mapOptions = {
		streetViewControl: false,
		mapTypeControl: false,
		clickableIcons: false,
		fullscreenControl: false,
	};

	var silverStyle = [
		{
			elementType: "geometry",
			stylers: [{ color: "#f5f5f5" }],
		},
		{
			elementType: "labels.icon",
			stylers: [{ visibility: "off" }],
		},
		{
			elementType: "labels.text.fill",
			stylers: [{ color: "#616161" }],
		},
		{
			elementType: "labels.text.stroke",
			stylers: [{ color: "#f5f5f5" }],
		},
		{
			featureType: "administrative.land_parcel",
			elementType: "labels.text.fill",
			stylers: [{ color: "#bdbdbd" }],
		},
		{
			featureType: "poi",
			elementType: "geometry",
			stylers: [{ color: "#eeeeee" }],
		},
		{
			featureType: "poi",
			elementType: "labels.text.fill",
			stylers: [{ color: "#757575" }],
		},
		{
			featureType: "poi.park",
			elementType: "geometry",
			stylers: [{ color: "#e5e5e5" }],
		},
		{
			featureType: "poi.park",
			elementType: "labels.text.fill",
			stylers: [{ color: "#9e9e9e" }],
		},
		{
			featureType: "road",
			elementType: "geometry",
			stylers: [{ color: "#ffffff" }],
		},
		{
			featureType: "road.arterial",
			elementType: "labels.text.fill",
			stylers: [{ color: "#757575" }],
		},
		{
			featureType: "road.highway",
			elementType: "geometry",
			stylers: [{ color: "#A3A3A3" }],
		},
		{
			featureType: "road.highway",
			elementType: "labels.text.fill",
			stylers: [{ color: "#616161" }],
		},
		{
			featureType: "road.local",
			elementType: "labels.text.fill",
			stylers: [{ color: "#9e9e9e" }],
		},
		{
			featureType: "transit.line",
			elementType: "geometry",
			stylers: [{ color: "#e5e5e5" }],
		},
		{
			featureType: "transit.station",
			elementType: "geometry",
			stylers: [{ color: "#eeeeee" }],
		},
		{
			featureType: "water",
			elementType: "geometry",
			stylers: [{ color: "#c9c9c9" }],
		},
		{
			featureType: "water",
			elementType: "labels.text.fill",
			stylers: [{ color: "#9e9e9e" }],
		},
	];

	var map = new google.maps.Map(document.getElementById("myMap"), mapOptions);
	var york = new google.maps.KmlLayer({
		url:
			"http://www.google.com/maps/d/u/0/kml?forcekml=1&mid=1B8sLS4ifo6Sp9s79AI39qUKFYWg&time=" +
			new Date().getTime(),
		map: map,
	});

	map.setOptions({ styles: silverStyle });

	var legend = document.getElementById("legend");
	for (var key in icons) {
		var type = icons[key];
		var name = type.name;
		var icon = type.icon;
		var color = type.color;
	}

	map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legend);
}

initMap();
