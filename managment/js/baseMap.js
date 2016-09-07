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

    if(otherMarkers !== undefined){
        showMarkersOnMap();
    }
});
