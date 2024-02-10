<script>
        const toggleInputCheckbox = document.getElementById('payment_mode');
        const hiddenFields = document.querySelectorAll('.hiddenField');

        toggleInputCheckbox.addEventListener('change', function() {
            hiddenFields.forEach(field => {
                if (this.value == 'cash') {
                    field.style.display = 'none'; // Show the field
                } else {
                    field.style.display = 'block'; // Hide the field
                }
            });
        });

        document.getElementById('myForm').addEventListener('submit', function() {
            console.log(toggleInputCheckbox);
            if (toggleInputCheckbox.value != 'online') {
                hiddenFields.forEach(field => {
                    const input = field.querySelector('input');
                    input.disabled = true; // Disable the input field
                });
            }
        });
    </script>
