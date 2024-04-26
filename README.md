If the events are not working for mouse click to select an address from the autocomplete dropdown, you may need to handle the autocomplete component's event separately. 

Google Places Autocomplete provides its own event called `place_changed`, which fires when a place is selected from the autocomplete dropdown. You can listen for this event on the autocomplete instance associated with the input field.

Here's how you can modify the code to handle the `place_changed` event for both pickup and drop input fields:

```javascript
function attachInputListeners(pickupInput, dropInput) {
    // Pickup input events
    pickupInput.addEventListener('change', calculatePrice);
    pickupInput.addEventListener('input', calculatePrice);
    pickupInput.addEventListener('keyup', calculatePrice);
    pickupInput.addEventListener('mouseup', calculatePrice);
    pickupInput.addEventListener('focus', calculatePrice);
    pickupInput.addEventListener('blur', calculatePrice);

    // Drop input events
    dropInput.addEventListener('change', calculatePrice);
    dropInput.addEventListener('input', calculatePrice);
    dropInput.addEventListener('keyup', calculatePrice);
    dropInput.addEventListener('mouseup', calculatePrice);
    dropInput.addEventListener('focus', calculatePrice);
    dropInput.addEventListener('blur', calculatePrice);

    // Listen for place_changed event on pickup input autocomplete
    const pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput);
    pickupAutocomplete.addListener('place_changed', () => {
        calculatePrice();
    });

    // Listen for place_changed event on drop input autocomplete
    const dropAutocomplete = new google.maps.places.Autocomplete(dropInput);
    dropAutocomplete.addListener('place_changed', () => {
        calculatePrice();
    });

    // Trigger events initially
    triggerEvents(pickupInput);
    triggerEvents(dropInput);
}
```

In this code:
- We remove the `mousedown` event listener, as it may not be necessary.
- We add event listeners for `focus` and `blur` events to handle when the input field gains or loses focus.
- We add separate event listeners for the `place_changed` event on the autocomplete instances associated with the pickup and drop input fields. This ensures that the `calculatePrice` function is called when a place is selected from the autocomplete dropdown.
- Finally, we trigger the events initially to ensure that the `calculatePrice` function is invoked when the page loads.

With these modifications, the fare calculation should update correctly when a location is selected using the mouse from the autocomplete dropdown.