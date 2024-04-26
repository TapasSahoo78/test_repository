<div class="col-lg-6 col-12 mb-3">
                                                    <div class="form-group green">
                                                        <input type="text"
                                                            class="form-control pickupLocation-{{ $value->id }} pickupLocation_loc"
                                                            id="pickupLocation-{{ $value->id }}"
                                                            placeholder="Type Your Pickup Location" name="pickup_location">
                                                        <label for=""><img src="assets/images/location.svg"
                                                                class="img-fluid" alt=""></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12 mb-3">
                                                    <div class="form-group red">
                                                        <input type="text"
                                                            class="form-control dropLocation-{{ $value->id }} dropLocation_loc"
                                                            id="dropLocation-{{ $value->id }}"
                                                            placeholder="Type Your Destination Location"
                                                            name="drop_location">
                                                    </div>
                                                </div>

// Attach event listeners to pickup and drop location input fields
                pickupInput.addEventListener('input', calculatePrice);
                dropInput.addEventListener('input', calculatePrice);

function calculatePrice() {
            const tab = this.closest('.tab-pane');
            const pickupInput = tab.querySelector('.pickupLocation_loc');
            const dropInput = tab.querySelector('.dropLocation_loc');
            const fareView = tab.querySelector('.fare');

            const pickup = pickupInput.value;
            const drop = dropInput.value;

            if (pickup && drop) {
                // Make API request to Google Maps Distance Matrix API
                const service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix({
                    origins: [pickup],
                    destinations: [drop],
                    travelMode: 'DRIVING',
                    unitSystem: google.maps.UnitSystem.METRIC,
                    avoidHighways: false,
                    avoidTolls: false,
                }, (response, status) => {
                    if (status === 'OK') {
                        console.log(response.rows[0]);
                        return;
                        const distance = response.rows[0].elements[0].distance.value; // Distance in meters
                        const distanceInKm = distance / 1000; // Convert meters to kilometers
                        const fare = distanceInKm * 5; // Fare calculation: 5 currency units per kilometer
                        fareView.innerText = fare.toFixed(2); // Update the fare view with the calculated fare
                    } else {
                        console.error('Error:', status);
                        fareView.innerText = ''; // Clear fare view if there's an error
                    }
                });
            } else {
                fareView.innerText = '';
            }
        }
