It seems like the value is not being updated properly before submitting the form. Let's modify the script to ensure that the updated amount is correctly passed to the Razorpay checkout. Here's the revised code:

```html
<form id="razorpayForm" action="{!! route('user.pay-payment') !!}" method="POST">
    @csrf
    <input type="hidden" id="razorpayAmount" name="recharge_amount" value="500">
    <button type="button" class="btn btn-primary" id="submitBtn">Add Money</button>
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('razorpayForm');
        const amountInput = document.getElementById('razorpayAmount');
        const submitBtn = document.getElementById('submitBtn');

        submitBtn.addEventListener('click', function() {
            const amountValue = parseFloat(amountInput.value.trim());

            // Check if the amount is a valid positive number
            if (!isNaN(amountValue) && amountValue >= 1) {
                // Convert to integer paise
                const amountInPaisa = Math.round(amountValue * 100);

                // Check if the amount meets the minimum value requirement
                if (amountInPaisa >= 100) {
                    // Update the value of the hidden input field
                    amountInput.value = amountValue;

                    // Trigger Razorpay checkout
                    const options = {
                        key: 'rzp_test_l5IvNZuMCyyln6',
                        amount: amountInPaisa,
                        currency: 'INR',
                        name: 'Driver4Wheels',
                        description: 'Payment',
                        prefill: {
                            name: 'name',
                            email: 'email',
                            contact: '9898989898'
                        },
                        theme: {
                            color: '#fff'
                        },
                        handler: function(response) {
                            // Handle the response from Razorpay
                            console.log(response);
                        }
                    };
                    const rzp = new Razorpay(options);
                    rzp.open();
                } else {
                    alert('Amount must be at least 1 INR (100 paise).');
                }
            } else {
                alert('Invalid amount entered.');
            }
        });
    });
</script>
```

In this version:

- The submit button triggers the payment process directly when clicked.
- The Razorpay options are defined within the click event listener, allowing us to dynamically set the amount based on the input value.