To make the recharge amount dynamic in your modal, you can update the `data-amount` attribute of the Razorpay script tag dynamically based on the amount entered by the user in the input field. Here's how you can achieve this:

```html
<button data-bs-toggle="modal" data-bs-target="#addMoneyModal">Add Money</button>

<!-- Wallet Recharge Modal -->
<div class="modal fade popup" id="addMoneyModal" tabindex="-1" aria-labelledby="addMoneyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body popup">
                <form action="{!! route('user.pay-payment') !!}" method="POST">
                    @csrf
                    <input type="text" class="float-number form-control" id="razorpayAmount" name="amount">
                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_l5IvNZuMCyyln6"
                        data-amount="" data-buttontext="Add Money" data-name="Driver4Wheels" data-description="Payment"
                        data-prefill.name="name" data-prefill.email="email" data-prefill.contact="9898989898" data-theme.color="#fff">
                    </script>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const amountInput = document.getElementById('razorpayAmount');
        const razorpayScript = document.querySelector('script[data-key="rzp_test_l5IvNZuMCyyln6"]');

        amountInput.addEventListener('input', function () {
            const amount = parseFloat(amountInput.value || 0) * 100; // Convert to paisa
            razorpayScript.setAttribute('data-amount', amount);
        });
    });
</script>
```

In this code:
- An input field with the id `razorpayAmount` is added to the modal to allow the user to enter the recharge amount.
- The script tag for Razorpay is included with an empty `data-amount` attribute. This attribute will be dynamically updated.
- A JavaScript event listener is added to the `razorpayAmount` input field to listen for changes in the entered amount.
- When the amount is changed, the event listener calculates the amount in paisa (multiplied by 100) and updates the `data-amount` attribute of the Razorpay script tag accordingly. This ensures that the recharge amount dynamically reflects in the Razorpay payment form.