$(function () {

    var myCenter = new google.maps.LatLng(23.7457308, 90.3929755);
    function initMap() {
        var mapProp = {
            center:{lat: 23.7457308, lng: 90.3929755},
            scrollwheel: false,
            zoom:17,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        var map=new google.maps.Map(document.getElementById("map"),mapProp);
        var marker=new google.maps.Marker({
            position:myCenter,
            map:map,
            animation:google.maps.Animation.BOUNCE
        });
        marker.setMap(map);
        var infowindow = new google.maps.InfoWindow({
            content:"Athena"
        });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
    }
    if(document.getElementById("map")) {
        google.maps.event.addDomListener(window, 'load', initMap);
    }

});

