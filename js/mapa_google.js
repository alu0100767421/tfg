var map;
var markers = [];
var Latitud=document.getElementById('Latitud').value;
var Longitud= document.getElementById('Longitud').value;
//console.log(Number(Latitud));
//console.log(Number(Longitud));
function initMap() {
  var marcador_inical = {lat: Number(Latitud), lng: Number(Longitud)};
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 28.072487, lng: -16.143498},
    zoom: 7,
    mapTypeId: 'hybrid'
  });
  addMarker(marcador_inical);

  // This event listener will call addMarker() when the map is clicked.
  map.addListener('click', function(event) {
    deleteMarkers();
    addMarker(event.latLng);
    var latitud=event.latLng.lat();
    var longitud= event.latLng.lng();
    document.getElementById('Latitud').value=latitud;
    document.getElementById('Longitud').value=longitud;
  });
}

function addMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markers.push(marker);
}

function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

function clearMarkers() {
  setMapOnAll(null);
}

function showMarkers() {
  setMapOnAll(map);
}

function deleteMarkers() {
  clearMarkers();
  markers = [];
}
