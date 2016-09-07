var markers = [];
function showMarkersOnMap(){
    for(var i = 0; i < otherMarkers.length; i++){
        var m = new google.maps.Marker({
            position: JSON.parse(otherMarkers[i].coordinates),
            draggable:false,
            title: otherMarkers[i].title,
            icon: otherMarkers[i].icon,
            animation: google.maps.Animation.DROP
        });
        m.setMap(map);
        m.id = otherMarkers[i].id;
        markers.push(m);
    }
}

function addListeners(){
    for(var i = 0; i < markers.length; i++){
        markers[i].addListener('click', function(){
            $('#trafficItemLink-'+this.id).trigger('click');
        });
    }
}
$(document).ready(function(){
    if(otherMarkers !== undefined){
        showMarkersOnMap();
        addListeners();
    }
});
