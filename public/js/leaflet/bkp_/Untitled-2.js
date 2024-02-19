// set default map view
const indonesia = [-2.548926, 118.014863];
const defaultZoom = 5;
const myMap = L.map('myMap').setView(indonesia, defaultZoom);

// add tile layer
const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
const tileLayer = L.tileLayer(tileUrl, {
  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
  maxZoom: 18,
}).addTo(myMap);

// create draw control
const drawOptions = {
  edit: {
    featureGroup: drawnItems,
    remove: true,
  },
  draw: {
    marker: false,
    circle: false,
    circlemarker: false,
    polyline: false,
    polygon: {
      shapeOptions: {
        color: '#3388ff',
        fillOpacity: 0.3,
      },
      allowIntersection: false,
      drawError: {
        color: '#3388ff',
        message: '<strong>Error:</strong> shape edges cannot cross!',
      },
    },
  },
};

const drawControl = new L.Control.Draw(drawOptions);
myMap.addControl(drawControl);

// add marker and polygon
let marker = null;
let polygon = null;
let luas_kira = null;

function updateMarker(latlng) {
  if (!marker) {
    marker = L.marker(latlng, {
      draggable: true,
      icon: L.divIcon({
        className: 'fas fa-map-marker-alt fa-2x text-danger',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
      }),
    }).addTo(myMap);
    marker.on('drag', () => {
      const latlng = marker.getLatLng();
      latInput.value = latlng.lat.toFixed(6);
      lngInput.value = latlng.lng.toFixed(6);
    });
  } else {
    marker.setLatLng(latlng);
  }
  myMap.setView(latlng, defaultZoom);
}

function updatePolygon(newPolygon) {
  if (polygon) {
    drawnItems.removeLayer(polygon);
  }
  polygon = newPolygon.addTo(drawnItems);
  polygon.on('edit', updateLuas);
  polygon.on('delete', updateLuas);
  updateLuas();
  myMap.fitBounds(polygon.getBounds());
}

function updateLuas() {
  const area = L.GeometryUtil.geodesicArea(polygon.getLatLngs()[0]);
  luas_kira = (area / 10000).toFixed(2);
  luasInput.value = luas_kira;
}

const latInput = document.getElementById('latitude');
const lngInput = document.getElementById('longitude');
const polyInput = document.getElementById('polygon');
const luasInput = document.getElementById('luas_kira');

if (latInput.value && lngInput.value) {
  const latlng = L.latLng(parseFloat(latInput.value), parseFloat(lngInput.value));
  updateMarker(latlng);
} else if (polyInput.value) {
  const latlngs = JSON.parse(polyInput.value);
  const newPolygon = L.polygon(latlngs);
  updatePolygon(newPolygon);
} else {
  myMap.setView(indonesia, defaultZoom);
}

myMap.on(L.Draw.Event.CREATED, (e) => {
  if (e.layerType === 'marker') {
    const latlng = e.layer.getLatLng();
    latInput.value = latlng.lat.toFixed(6);
    lngInput.value = latlng.lng.toFixed(6);
    updateMarker(latlng);
  } else if (e.layerType === 'polygon') {

const newPolygon = e.layer;
updatePolygon(newPolygon);
});

// disable Leaflet's default behavior of creating a popup on marker click
myMap.on('click', (e) => {
L.DomEvent.stopPropagation(e);
});

// add event listener for input fields
latInput.addEventListener('input', () => {
const lat = parseFloat(latInput.value);
const lng = parseFloat(lngInput.value);
const latlng = L.latLng(lat, lng);
if (!isNaN(lat) && !isNaN(lng)) {
updateMarker(latlng);
}
});

lngInput.addEventListener('input', () => {
const lat = parseFloat(latInput.value);
const lng = parseFloat(lngInput.value);
const latlng = L.latLng(lat, lng);
if (!isNaN(lat) && !isNaN(lng)) {
updateMarker(latlng);
}
});

polyInput.addEventListener('input', () => {
const polygonValue = polyInput.value;
if (polygonValue) {
const latlngs = JSON.parse(polygonValue);
const newPolygon = L.polygon(latlngs);
updatePolygon(newPolygon);
}
});

// function to convert polygon coordinates to JSON string
function polygonToJSONString(polygon) {
const latlngs = polygon.getLatLngs()[0];
const latlngsJSON = latlngs.map(latlng => [latlng.lat, latlng.lng]);
return JSON.stringify(latlngsJSON);
}