function fetchCurrentLocation(e, key) {
            e.preventDefault(); // Prevent default form submission
            if (navigator.geolocation) {
                const options = {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                };
                const error = function() {
                    alert('Unable to retrieve your location.');
                };

                navigator.geolocation.watchPosition(function(position), error, options {
                    // alert(position.coords.latitude + '||||' + position.coords.longitude);
                    document.getElementById('latitude-' + key).value = position.coords.latitude;
                    document.getElementById('longitude-' + key).value = position.coords.longitude;
                }, function() {
                    alert('Unable to retrieve your location.');
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }
