async function fetchCurrentLocation(e, key) {
    e.preventDefault(); // Prevent default form submission
    const button = e.target;

    // Disable the button and add a loader
    button.disabled = true;
    button.innerHTML = 'Loading...'; // Change button text to indicate loading

    try {
        // Wait for 5 seconds (5000 milliseconds) before fetching the location
        await new Promise(resolve => setTimeout(resolve, 5000));

        if (navigator.geolocation) {
            const options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };

            const position = await new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(resolve, reject, options);
            });

            // Update the latitude and longitude fields
            document.getElementById('latitude-' + key).value = position.coords.latitude;
            document.getElementById('longitude-' + key).value = position.coords.longitude;
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    } catch (error) {
        alert('Unable to retrieve your location.');
    } finally {
        // Re-enable the button and remove the loader
        button.disabled = false;
        button.innerHTML = 'Current Location'; // Reset button text
    }
}