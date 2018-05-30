function initMap() {
  console.log(wfmObj);
  var center = {lat: parseInt(wfmObj.coords1), lng: parseInt(wfmObj.coords2)};
  
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: parseInt(wfmObj.zoom),
    center: center
  });

}