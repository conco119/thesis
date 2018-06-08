var map = undefined;
var marker = null;
var geocoder;
var infowindow = null;
var addressReturn;
var latlngReturn;

//Khởi tạo
//21.03051273991227,105.7872292696228
function initialize(lat, lng) {
    try {
        if (lat != "0" && lng != "0") {
            infowindow = new google.maps.InfoWindow();

            var myOptions = {
                zoom: 14,
                center: new google.maps.LatLng(lat, lng),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
            if (lat == "" || lng == "" || lat == null || lng == null) {
                lat = 21.0295818;
                lng = 105.8504133;
            }
            var myLatlng = new google.maps.LatLng(lat, lng);
            marker = new google.maps.Marker({
                map: map,
                position: myLatlng,
                draggable: true
            });
            map.setCenter(myLatlng);
            google.maps.event.addListener(map, 'click', function (event) {
                placeMarker(event.latLng);
            });
            google.maps.event.addListener(marker, 'dragstart', function () { infowindow.close(); });
            //google.maps.event.addListener(marker, 'dragend', getAddress);
            geocoder = new google.maps.Geocoder();
            //getAddress();
        } else {
            $("#map_canvas").css('display', 'none');
        }
    } catch (ex) {
        console.log(ex);
    }
}
//Add maker
function placeMarker(location) {

    try {

        marker.setMap(null);
        marker = new google.maps.Marker({
            position: location,
            map: map,
            draggable: true
        });
        google.maps.event.addListener(marker, 'dragstart', function () { infowindow.close(); });
        google.maps.event.addListener(marker, 'dragend', getAddress);
        map.setCenter(location);
        getAddress();
    } catch (ex) {
        console.log(ex);
    }
}
function getAddress() {

    try {

        var point = marker.getPosition();
        //alert(point);
        var lat = point.lat();
        var lng = point.lng();
        document.getElementById('txtPositionX').value = lat;
        document.getElementById('txtPositionY').value = lng;
        var latlng = new google.maps.LatLng(lat, lng);
        //alert(latlng);
        geocoder.geocode({ 'latLng': latlng }, function (results2, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results2[0]) {
                    infowindow.setContent("<span id='address'><b>Địa chỉ : </b>" + results2[0].formatted_address + "</span>");
                    addressReturn = results2[0].formatted_address;
                    infowindow.open(map, marker);
                    document.getElementById('address').value = results2[0].formatted_address;
                }
            } else {
                alert("Geocoder failed due to: " + status);
            }
        });
        map.setCenter(point);
    } catch (ex) {
        console.log(ex);
    }
}
