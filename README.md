<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Routes</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <style>
        .map {
            width: 100%;
            height: 400px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    @foreach ($startLocations as $booking)
        <div id="map-{{ $booking['driver_id'] }}" class="map"></div>
    @endforeach

    <script>
        function initDoubleMap() {
            @foreach ($startLocations as $key => $booking)
                // Define start and end coordinates
                var startLatitude = {{ $booking['pickup_latitude'] }};
                var startLongitude = {{ $booking['pickup_longitude'] }};
                var endLatitude = {{ $booking['drop_latitude'] }};
                var endLongitude = {{ $booking['drop_longitude'] }};

                var mapDiv = document.getElementById('map-{{ $booking['driver_id'] }}');
                if (!mapDiv) {
                    console.log('Map div not found for driver: {{ $booking['driver_id'] }}');
                    continue; // Skip iteration if map div is not found
                }

                // Initialize Google Map for the specific driver
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

                // Request directions for the specific route
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
                        console.error('Directions request failed for driver {{ $booking['driver_id'] }}: ' + status);
                    }
                });
            @endforeach
        }

        // Initialize the maps once the page loads
        window.onload = initDoubleMap;
    </script>
</body>
</html>