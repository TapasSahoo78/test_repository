function calculatePrice() {
    const tab = this.closest('.tab-pane');
    const pickupInput = tab.querySelector('.pickupLocation_loc');
    const dropInput = tab.querySelector('.dropLocation_loc');
    console.log('Drop Input:', dropInput); // Debug statement to check dropInput
    console.log('Drop Value:', dropInput.value); // Debug statement to check dropInput value

    // Rest of the code...
}