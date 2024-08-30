function fetchCurrentLocation(e, key) {
    e.preventDefault(); // Prevent default form submission
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Alert the fetched coordinates (you can remove this if not needed)
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

        }, function() {
            alert('Unable to retrieve your location.');
        });
    } else {
        alert('Geolocation is not supported by this browser.');
    }
}