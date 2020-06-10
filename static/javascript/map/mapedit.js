

const OriginalCursor = document.getElementById("show_map").style.cursor;
let isPlacing = false;
let code = 1;

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
      let mymap = setup('show_map', [parseFloat(matches[0].latitude), parseFloat(matches[0].longitude)], 14);

      //Remove old list and create new list
      document.querySelector('#points_table > tbody').remove();
      const tbody = document.createElement('tbody');
      document.querySelector('#points_table').appendChild(tbody);

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
  static startPlacing(e) {
    if (e.originalEvent.key == 'w') {
      isPlacing = true;
      document.getElementById("show_map").style.cursor = "crosshair";
    }
  }
  static placeMarkers(e) {
    if(!isPlacing) {
      return;
    }
    const latitude = e.latlng.lat;
    const longitude = e.latlng.lng;
    const leaflet_marker = L.marker([latitude, longitude]).addTo(mymap);
    const leaflet_code = leaflet_marker._leaflet_id;
    const popup_html = `
      <div class="marker-edit">
        <p>Marker new-${code}</p>
        <input id="title-new-${code}" type="text" class="form-control" placeholder="Location title">
        <button onclick="mapUI.deleteMarker('${leaflet_code}', 'new-${code}')" class="btn btn-danger">Delete</button>
        <button onclick="mapUI.addMarker('${latitude}', '${longitude}', '${leaflet_code}', 'new-${code}','${city_id}')" class="btn btn-success">Add</button>
      </div>
    `;
    leaflet_marker.bindPopup(popup_html);
    code++;
  }
  static addMarker(latitude, longitude, leaflet_code, marker_id, city_id) {
    const title = document.querySelector(`#title-${marker_id}`).value;
    const mapmarker = new mapMarker(marker_id, city_id, title, latitude, longitude);
    if (document.querySelectorAll(`#tr-${marker_id}`).length === 0) {
      mapUI.addMarkerToList(mapmarker, leaflet_code, marker_id);
      Store.addMarker(mapmarker);
    } else {
      mapUI.updatePlaced(mapmarker, marker_id);
    }
    mymap.closePopup();
  }
  static endPlacing(e) {
    if (e.originalEvent.key == 'd') {
      isPlacing = false;
      document.getElementById("show_map").style.cursor = OriginalCursor;
    }
  }
  static updatePlaced(mapmarker, marker_id) {
    let td_title = document.querySelector(`#tr-${marker_id} > .td-title`);
    td_title.textContent = mapmarker.title;
    Store.updateMarker(mapmarker.title, marker_id);
  }
  static displayMarkers(mymap, filter_id) {
    const stored_mapmarkers = Store.getMarkers();
    const filtered_mapmarkers = stored_mapmarkers.filter((m) => m.city_id === filter_id);
    filtered_mapmarkers.forEach((m) => {
      const {marker_id, title, latitude, longitude} = m;
      const leaflet_marker = L.marker([latitude, longitude], {icon: redIcon}).addTo(mymap);
      const leaflet_code = leaflet_marker._leaflet_id;
      const mapmarker = new mapMarker(marker_id, city_id, title, latitude, longitude);
      mapUI.addMarkerToList(mapmarker, leaflet_code, marker_id);
      let popup_html = `
        <div class="marker-edit">
          <p>${title}</p>
          <input id="title-${marker_id}" type="text" class="form-control" placeholder="Location title">
          <button onclick="mapUI.deleteMarker('${leaflet_code}', '${marker_id}')" class="btn btn-danger">Delete</button>
          <button onclick="mapUI.addMarker('${latitude}', '${longitude}', '${leaflet_code}', '${marker_id}')" class="btn btn-info">Update</button>
        </div>
      `;
      leaflet_marker.bindPopup(popup_html);
    });
  } 
  static addMarkerToList(mapmarker, leaf_code, marker_id) {
    const tbody = document.querySelector('#points_table > tbody');
    const row = document.createElement('tr');
    row.id = `tr-${marker_id}`;

    row.innerHTML = `
      <td>${marker_id}</td>
      <td class="td-title">${mapmarker.title}</td>
      <td>${mapmarker.latitude.toString().slice(0,9)}</td>
      <td>${mapmarker.longitude.toString().slice(0,9)}</td>
      <td><a href="#" onclick="mapUI.deleteMarker('${leaf_code}', '${marker_id}')" class="btn btn-danger btn-sm">Delete</a></td>
    `;
    tbody.appendChild(row);
  }
  static deleteMarker(leaflet_code, marker_id) {
    let row = document.getElementById(`tr-${marker_id}`);
    if (document.querySelectorAll(`#tr-${marker_id}`).length !== 0) {
      row.remove();
    }
    mymap.removeLayer(mymap._layers[leaflet_code]);
    Store.removeMarker(marker_id);
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
  static addMarker(marker) {
    const mapmarkers = Store.getMarkers();
    mapmarkers.push(marker);
    localStorage.setItem('mapmarkers', JSON.stringify(mapmarkers));
  }
  static updateMarker(title, marker_id) {
    const mapmarkers = Store.getMarkers();
    const filtered = mapmarkers.filter((m) => m.marker_id === marker_id);
    filtered[0].title = title;
    localStorage.setItem('mapmarkers', JSON.stringify(mapmarkers));
  }
  static removeMarker(marker_id) {
    const mapmarkers = Store.getMarkers();
    mapmarkers.forEach((mapmarker, index) => {
      if (mapmarker.marker_id === marker_id) {
        mapmarkers.splice(index, 1);
      }
    }); 
    localStorage.setItem('mapmarkers', JSON.stringify(mapmarkers));
  }
}