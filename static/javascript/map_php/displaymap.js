





class mapMarker {
  constructor(marker_id, suspect_id, street, group, first, last, gender, latitude, longitude) {
    this.marker_id = marker_id;
    this.suspect_id = suspect_id;
    this.street  = street;
    this.group = group;
    this.first = first;
    this.last = last;
    this.gender = gender;
    this.latitude = latitude;
    this.longitude = longitude;
  }
}

const db_mapMarkers = [];
let markerInputSelect = document.querySelectorAll('.db_data_marker');
markerInputSelect.forEach((e) => {
  let suspect_id, suspect_lat, suspect_long, suspect_street, suspect_group;
  let suspect_first, suspect_last, suspect_gender;
  Array.from(e.children).forEach((elem) => {
    let textCont = elem.textContent;
    if (elem.className == 'db_data_marker_suspect_id') {
      suspect_id = textCont;
    } else if (elem.className == 'db_data_marker_lat') {
      suspect_lat = textCont;
    } else if (elem.className == 'db_data_marker_long') {
      suspect_long = textCont;
    } else if (elem.className == 'db_data_marker_group') {
      suspect_group = textCont;
    } else if (elem.className == 'db_data_marker_street') {
      suspect_street = textCont;
    } else if (elem.className == 'db_data_marker_first') {
      suspect_first = textCont;
    } else if (elem.className == 'db_data_marker_last') {
      suspect_last = textCont;
    } else if (elem.className == 'db_data_marker_gender') {
      suspect_gender = textCont;
    } 
    
    else {
      // no nothing for now...
    }
  });

  newMarker = new mapMarker(suspect_id, suspect_id, suspect_street, suspect_group, suspect_first, suspect_last, suspect_gender, parseFloat(suspect_lat), parseFloat(suspect_long));
  db_mapMarkers.push(newMarker);
});










class mapCity {
  constructor(city_id, name, latitude, longitude) {
    this.city_id = city_id;
    this.name = name;
    this.latitude = latitude;
    this.longitude = longitude;
  }
}
const cities = [];
let cityInputSelect = document.querySelectorAll('.db_city_row');
cityInputSelect.forEach((e) => {
  let city_id, city_name, city_lat, city_long;
  Array.from(e.children).forEach((elem) => {
    let textCont = elem.textContent;
    if (elem.className == 'db_city_id') {
      city_id = textCont;
    } else if (elem.className == 'db_city_name') {
      city_name = textCont;
    } else if (elem.className == 'db_city_lat') {
      city_lat = textCont;
    } else {
      city_long = textCont;
    }
  });

  newCity = new mapCity(city_id, city_name, parseFloat(city_lat), parseFloat(city_long));
  cities.push(newCity);
});


// mapUI Class: Everything related to the UI for map
class mapUI {
  static initializeMap(latitude, longitude) {
    const lat_span = document.getElementById("coord-present-lat");
    const long_span = document.getElementById("coord-present-long");
    lat_span.innerHTML =  latitude.toString().slice(0,9);
    long_span.innerHTML = longitude.toString().slice(0,9);
  }
  static showCoords(e) {
    const lat_span = document.getElementById("coord-present-lat");
    const long_span = document.getElementById("coord-present-long");
    lat_span.innerHTML =  e.latlng.lat.toString().slice(0,9);
    long_span.innerHTML =  e.latlng.lng.toString().slice(0,9);
  }
  static displayMarkers(mymap, filter_id, name) {
    const filtered_mapmarkers = db_mapMarkers;
    console.log(filtered_mapmarkers);
    filtered_mapmarkers.forEach((m) => {
      const {marker_id, suspect_id, street, group, first, last, gender, latitude, longitude} = m;
      const leaflet_marker = L.marker([latitude, longitude], {icon: redIcon}).addTo(mymap);
      let popup_html = `
        <div class="marker-edit">
          <h4>Street: ${street}</h4>
          <div class="marker-wrapper">
            <div class="itemleft">
              <div>Suspect ID: </div>
              <div>First name: </div>
              <div>Last name: </div>
              <div>Gender: </div>
              <div>Age:</div>
            </div>
            <div class="itemright">
              <div>${suspect_id}</div>
              <div>${first}</div>
              <div>${last}</div>
              <div>${gender}</div>
              <div>${group}</div>
            </div>
          </div>
        </div>
      `;
      leaflet_marker.bindPopup(popup_html);
    });
  }
}
