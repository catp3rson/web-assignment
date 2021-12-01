<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3rMarZKfKHtdqrkVk6XV3zBMgNyHfnAg&callback=initMap&libraries=&v=weekly" async></script>
<script>
function initMap() {
    var markers = new Array();
    var mapOptions = {
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(10.760126435947619, 106.66319203208252)
    };
    <?php
        $sql = "SELECT * FROM locations";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo 'var locations = [';
            $style = "'font-size: 15px; font-weight: 5px;'";
            while($row = $result->fetch_assoc()) {
                echo '[new google.maps.LatLng('. $row['latitude']. ','. $row['longtitude']. '), "'.$row['location_name'].'",'.'"<h1 style='.$style.'>'.$row['location_name'].'</h1><hr>'. '<p>Address: '.$row['location_description'].'</p>"'. '],';
                
            }
            echo '];';
        }
    ?>
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);
    var infowindow = new google.maps.InfoWindow();
    for (var i = 0; i < locations.length; i++) {
        $('#markers').append('<a class="marker-link" data-markerid="' + i + '" href="#maps">' + locations[i][1] + '</a> ');
        var marker = new google.maps.Marker({
            position: locations[i][0],
            map: map,
            title: locations[i][1],
        });
        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(locations[i][2]);
                infowindow.open(map, marker);
            }
        })(marker, i));
        markers.push(marker);
    }
    $('.marker-link').on('click', function () {
        google.maps.event.trigger(markers[$(this).data('markerid')], 'click');
    });
}
</script>