
// mapMarker class: Represents a marker with a title description
class mapMarker {
  constructor(marker_id, city_id, title, latitude, longitude) {
    this.marker_id = marker_id;
    this.city_id  = city_id;
    this.title = title;
    this.latitude = latitude;
    this.longitude = longitude;
  }
}


class mapCity {
  constructor(city_id, name, latitude, longitude) {
    this.city_id = city_id;
    this.name = name;
    this.latitude = latitude;
    this.longitude = longitude;
  }
}




// mapUI Class: Everything related to the UI for map
class mapUI {
  static jumpToCity(name) {
    const cities = [
      {
        city_id: 'city02A',
        name: 'Pecs',
        country: 'Hungary',
        latitude: '46.074287',
        longitude: '18.219796'
      },
      {
        city_id: 'city12A',
        name: 'Budapest',
        country: 'Hungary',
        latitude: '47.499227735163',
        longitude: '19.049263000488278'
      },
      {
        city_id: 'city10F',
        name: 'Chicago',
        country: 'USA',
        latitude: '41.873466',
        longitude: '-87.62800'
      }
    ];
    const matches = cities.filter(city => city.name === name);
    if (matches === undefined || matches.length == 0) {
      alert('No city found..');
    } else {
      // Display text for "City name"
      document.querySelector('#coord-present-city').textContent = `${matches[0].name}, ${matches[0].country}`;
      // Remove old map and create new map
      document.querySelector('#show_map').remove();
      const div = document.createElement('div');
      div.id = "show_map";
      document.querySelector('#show_col').appendChild(div);
      let mymap = setup('show_map', [parseFloat(matches[0].latitude), parseFloat(matches[0].longitude)], 12);
      let city_id = matches[0].city_id;
      return [mymap, city_id];
    }
  }
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
    const stored_mapmarkers = Store.getMarkers();
    const filtered_mapmarkers = stored_mapmarkers.filter((m) => m.city_id === filter_id);
    filtered_mapmarkers.forEach((m) => {
      const {marker_id, title, latitude, longitude} = m;
      const leaflet_marker = L.marker([latitude, longitude], {icon: redIcon}).addTo(mymap);
      const leaflet_id = leaflet_marker._leaflet_id;
      let popup_html = `
        <div class="marker-edit">
          <p>${title}</p>
          <button id="${marker_id}" onclick="mapUI.displayDetails('${marker_id}','${name}')" class="btn btn-success btn-sm">Details</button>
        </div>
      `;
      leaflet_marker.bindPopup(popup_html);
    });
  }
  static displayDetails(marker_id, name) {
    document.querySelector('#show_col').className = "col-lg-6";
    document.querySelector('#data_col').className = "col-lg-6";
    refreshMap(name);
    document.querySelector('#side_list > ul').classList.add('gone');
    document.querySelector('#back-button').classList.remove('gone');
    const DAT_marker = Store.getMarkers().filter((m) => m.marker_id == marker_id)[0];
    const {title, latitude, longitude} = DAT_marker;
    const specificDiv = document.createElement('div');
    specificDiv.className = "specific";
    specificDiv.innerHTML = `
      <h5>${title}</h5>
      <p>The latitude is ${latitude.slice(0,9)}, and longitude is ${longitude.slice(0,9)}</p>
    `;
    if (document.querySelector('.specific') === null) {
      document.querySelector('#side_list').appendChild(specificDiv);
    } else if (document.querySelector('.specific > h5').textContent != title) {
      document.querySelector('.specific').remove();
      document.querySelector('#side_list').appendChild(specificDiv);
    }
  } 

}
class Store {
  static getMarkers() {
    let mapmarkers;
    if(localStorage.getItem('mapmarkers') === null) {
      mapmarkers = [];
    } else {
      mapmarkers = JSON.parse(localStorage.getItem('mapmarkers'));
    }
    return mapmarkers;
  }
}