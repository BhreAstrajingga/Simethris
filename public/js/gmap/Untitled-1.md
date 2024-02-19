/\*\*

- 1.  create a new map 'myMap' with initial
- - center: { lat: -2.5489, lng: 118.0149 },
- - zoom: 5,
- 2.  array to store the marker and polygon
- 3.  location search feature. use input text in blade form input with Enter Key and button
- 4.  Get kml layer from input text and extract the data.
- i found this on codepen, maybe we can use to get the kml value
- var pick_a_name = new google.maps.KmlLayer({
  url:
  "http://www.google.com/maps/d/u/0/kml?forcekml=1&mid=replace_with_value_from_user_input_kmlinput&time=" +
  new Date().getTime(),
  map: map,
  });
- - user just input the replace_with_value_from_user_input_kmlinput then javascript do the rest
- - display the marker and polygon from kml to the map
- - the click and edit event will use event listener in another part of this script
- 5.  create a drawing manager with a marker and polygon mode and add it to the map
- 6.  add a listener for when a marker is completed
- - add the marker to the array of markers and make it draggable
- - add a listener for when the marker is clicked, center the map on the marker, and update the input fields
- - add a listener for when the marker is dragged, update the input fields latitude and longitude
- 7.  check if the latitude and longitude inputs have values, and if so, create a marker at that position
- - add the marker to the array of markers,
- - center the map on the marker,
- - and add listeners for click and drag events
- 8.  check if the polygon inputs have values, and if so, create a polygon using the recorded value in polygon input fields
- - add a listener for when the polygon is clicked, and update the input field
- - add a listener for when the polygon is edited, and update the input field
- 9.  add a listener for when a polygon is completed
- - add the polygon to the map
- - add a listener for when the polygon is clicked, and update the input field
- - calculate and display the area of the polygon
- initMap
- 11. All library needed to achieve these requirements
      \*/
