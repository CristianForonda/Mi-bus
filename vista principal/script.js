function iniciarMap(){
    var coord = {lat:11.2347776 ,lng: -74.1896829};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 10,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });
}