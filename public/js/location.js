var map;
var position = {lat: lat, lng: lng}
window.addEventListener('load',function() {
    map = new google.maps.Map(document.getElementById('location-map'), {
        center: position,
        zoom: 14
    });
    
    var marker = new google.maps.Marker({
        position: position,
        map: map
    });
});