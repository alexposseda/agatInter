var marker;
function createMarker(coordinates){
    var center = map.center;
    if(coordinates !== undefined){
        center = coordinates;
        map.setCenter(coordinates);
    }
    marker = new google.maps.Marker({
        position: center,
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP
    });

    google.maps.event.addListener(marker, 'dragend', function(){
        var coord = {lat: marker.getPosition().lat(), lng: marker.getPosition().lng()}
        $('#coordinates').val(JSON.stringify(coord));
    });
}

function showMarkersOnMap(){
    console.log(otherMarkers);
    for(var i = 0; i < otherMarkers.length; i++){
        var m = new google.maps.Marker({
            position: JSON.parse(otherMarkers[i].coordinates),
            draggable:false,
            title: otherMarkers[i].title,
            icon: otherMarkers[i].icon
        });
        m.setMap(map);
    }
}
$(document).ready(function(){
    if($('#coordinates').length > 0) {
        if ($('#coordinates').val() != '') {
            var c = JSON.parse($('#coordinates').val());
            createMarker(c);
        } else {
            createMarker();
            $('#coordinates').val(JSON.stringify({lat: marker.getPosition().lat(), lng: marker.getPosition().lng()}));
        }
    }

    if(otherMarkers !== undefined){
        showMarkersOnMap();
    }
});

