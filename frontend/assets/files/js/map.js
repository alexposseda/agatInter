var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 50.4501, lng: 30.5234},
        zoom: 5
    });
}
$(document).ready(function () {
    initMap();
});