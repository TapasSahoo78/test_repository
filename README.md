function fetchCurrentLocation(e, key) {
    e.preventDefault(); // Prevent default form submission
    if (navigator.geolocation) {
        const options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        };

        const success = function(position) {
            document.getElementById('latitude-' + key).value = position.coords.latitude;
            document.getElementById('longitude-' + key).value = position.coords.longitude;
        };

        const error = function() {
            alert('Unable to retrieve your location.');
        };

        navigator.geolocation.watchPosition(success, error, options);
    } else {
        alert('Geolocation is not supported by this browser.');
    }
}