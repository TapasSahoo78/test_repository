<script>
    function initDoubleMap() {
        @foreach ($startLocations as $key => $booking)
            var startLatitude = {{ $booking['pickup_latitude'] }};
            var startLongitude = {{ $booking['pickup_longitude'] }};
            var endLatitude = {{ $booking['drop_latitude'] }};
            var endLongitude = {{ $booking['drop_longitude'] }};

            console.log(startLatitude);
            console.log(startLongitude);
            console.log(endLatitude);
            console.log(endLongitude);

            var mapDiv = document.getElementById('map-{{ $booking['driver_id'] }}');
            if (!mapDiv) {
                console.log('Map div not found for index: {{ $booking['driver_id'] }}');
                // continue; // Skip this iteration if the map div is not found
            }

            var map = new google.maps.Map(mapDiv, {
                zoom: 10,
                center: {
                    lat: startLatitude,
                    lng: startLongitude
                }
            });

            // Create a new DirectionsRenderer for each route
            var directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            // Request directions
            var directionsService = new google.maps.DirectionsService();
            directionsService.route({
                origin: {
                    lat: startLatitude,
                    lng: startLongitude
                },
                destination: {
                    lat: endLatitude,
                    lng: endLongitude
                },
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(response);
                } else {
                    console.error('Directions request failed due to ' + status);
                }
            });
        @endforeach
    }
    // Initialize the map when the window loads
    window.onload = initDoubleMap;
</script>
