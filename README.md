function fetchCurrentLocation(e, key) {
    e.preventDefault(); // Prevent default form submission
    const button = e.target;
    
    // Disable the button and add a loader
    button.disabled = true;
    button.innerHTML = 'Loading...'; // Change button text to indicate loading

    if (navigator.geolocation) {
        const options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        };

        navigator.geolocation.getCurrentPosition(function(position) {
            // Update the latitude and longitude fields
            document.getElementById('latitude-' + key).value = position.coords.latitude;
            document.getElementById('longitude-' + key).value = position.coords.longitude;
            
            // Re-enable the button and remove the loader
            button.disabled = false;
            button.innerHTML = 'Current Location'; // Reset button text
        }, function() {
            alert('Unable to retrieve your location.');
            
            // Re-enable the button and remove the loader even on error
            button.disabled = false;
            button.innerHTML = 'Current Location';
        }, options);
    } else {
        alert('Geolocation is not supported by this browser.');
        
        // Re-enable the button and remove the loader if geolocation is not supported
        button.disabled = false;
        button.innerHTML = 'Current Location';
    }
}