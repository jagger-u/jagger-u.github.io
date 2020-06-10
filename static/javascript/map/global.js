var redIcon = L.icon({
  iconUrl: './static/images/marker-red.png',
  shadowUrl: './static/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});

function refreshMap(name) {
  result = mapUI.jumpToCity(name);
  mymap = result[0];
  city_id = result[1];
  mapUI.displayMarkers(mymap, city_id, name);
  mapUI.initializeMap(mymap.getCenter().lat, mymap.getCenter().lng);
  mymap.on('mousemove', mapUI.showCoords);
}