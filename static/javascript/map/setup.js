function setup(mapid,mapcoords,mapzoom) {
  var mymap = L.map(mapid).setView(mapcoords, mapzoom);
  L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiamFnZ2VyMjg1IiwiYSI6ImNrZDc1Zzg2ajF5dmMydW50dms1Nzh4eXUifQ.GHuD7IxoAs1O0HxZ11OAVA', {
    maxZoom: 19,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
  }).addTo(mymap);
  return mymap;
}

