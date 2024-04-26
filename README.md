function attachInputListeners(pickupInput, dropInput) {
            pickupInput.addEventListener('change input keyup', calculatePrice);
            dropInput.addEventListener('change input keyup', calculatePrice);
        }
