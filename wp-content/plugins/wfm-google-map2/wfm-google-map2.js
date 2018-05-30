function initMap() {
    var uluru = {lat: +wfmObj.cords1, lng: +wfmObj.cords2};
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: +wfmObj.zoom,
        center: uluru
    });
    /*var marker = new google.maps.Marker({
        position: uluru,
        map: map
    });*/
}
