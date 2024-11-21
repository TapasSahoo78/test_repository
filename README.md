<script>
    function initDoubleMap() {
        @foreach ($startLocations as $key => $booking)
            (function() {
                // Block scope to avoid overwriting variables
                var startLatitude = {{ $booking['pickup_latitude'] }};
                var startLongitude = {{ $booking['pickup_longitude'] }};
                var endLatitude = {{ $booking['drop_latitude'] }};
                var endLongitude = {{ $booking['drop_longitude'] }};
                var driverId = {{ $booking['driver_id'] }};

                // Log data for debugging
                console.log(`Driver ${driverId}:`, startLatitude, startLongitude, endLatitude, endLongitude);

                var mapDiv = document.getElementById('map-' + driverId);
                if (!mapDiv) {
                    console.log(`Map div not found for driver: ${driverId}`);
                    return; // Skip this iteration if the map div is not found
                }

                // Initialize the map
                var map = new google.maps.Map(mapDiv, {
                    zoom: 10,
                    center: {
                        lat: startLatitude,
                        lng: startLongitude
                    }
                });

                // Create DirectionsRenderer and attach to map
                var directionsRenderer = new google.maps.DirectionsRenderer();
                directionsRenderer.setMap(map);

                // Request directions for the route
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
                        console.error(`Directions request failed for driver ${driverId}: ${status}`);
                    }
                });
            })(); // Immediately invoke the function to create a unique scope for each iteration
        @endforeach
    }

    // Initialize the maps when the window loads
    window.onload = initDoubleMap;
</script>