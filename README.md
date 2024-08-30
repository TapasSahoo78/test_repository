function fetchCurrentLocation(e, key) {
    e.preventDefault(); // Prevent default form submission
    if (navigator.geolocation) {
        const options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        };
        
        const success = function(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            alert(latitude + '||||' + longitude);

            // Update the specific stop
            document.getElementById('latitude-' + key).value = latitude;
            document.getElementById('longitude-' + key).value = longitude;

            // Update all stops with the same latitude and longitude
            const latitudeFields = document.querySelectorAll('.latitude');
            const longitudeFields = document.querySelectorAll('.longitude');

            latitudeFields.forEach(function(latField) {
                latField.value = latitude;
            });

            longitudeFields.forEach(function(lonField) {
                lonField.value = longitude;
            });
        };

        const error = function() {
            alert('Unable to retrieve your location.');
        };

        navigator.geolocation.watchPosition(success, error, options);

    } else {
        alert('Geolocation is not supported by this browser.');
    }
}