function calculatePrice() {
    const tab = this.closest('.tab-pane');
    const pickupInput = tab.querySelector('.pickupLocation');
    const dropInput = tab.querySelector('.dropLocation');
    const fareView = tab.querySelector('.fare');

    const pickup = pickupInput.value;
    const drop = dropInput.value;

    // Call a function to calculate distance between pickup and drop locations
    const distance = calculateDistance(pickup, drop);

    // Calculate fare based on distance
    const fare = calculateFare(distance);

    // Update the fare view with the calculated fare
    fareView.innerText = fare.toFixed(2); // Display fare with two decimal places
}

// Attach event listeners to pickup and drop location input fields
document.querySelectorAll('.pickupLocation, .dropLocation').forEach(input => {
    input.addEventListener('input', calculatePrice);
});

function calculateDistance(pickup, drop) {
    // Implement distance calculation logic here
    // This function should return the distance between pickup and drop locations
    // For demonstration, let's assume a fixed distance value
    return 10; // Example distance in kilometers
}

function calculateFare(distance) {
    // Implement fare calculation logic here
    // This function should return the fare based on the distance
    // For demonstration, let's assume a fixed fare rate per kilometer
    const ratePerKm = 5; // Example rate per kilometer in currency
    return distance * ratePerKm;
}