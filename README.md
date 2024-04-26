<form action="{!! route('user.pay-payment') !!}" method="POST">
                            @csrf
                            <input type="text" class="float-number form-control" id="razorpayAmount" name="recharge_amount">
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_l5IvNZuMCyyln6"
                                data-buttontext="Add Money" data-name="Driver4Wheels" data-description="Payment" data-prefill.name="name"
                                data-prefill.email="email" data-prefill.contact="9898989898" data-theme.color="#fff"></script>
                        </form>

document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('razorpayAmount');
            const razorpayScript = document.querySelector('script[data-key="rzp_test_l5IvNZuMCyyln6"]');

            amountInput.addEventListener('change', function() {
                const amountValue = parseFloat(amountInput.value.trim());

                // Check if the amount is a valid positive number
                if (!isNaN(amountValue) && amountValue >= 1) {
                    // Convert to integer paise
                    const amountInPaisa = Math.round(amountValue * 100);

                    // Check if the amount meets the minimum value requirement
                    if (amountInPaisa >= 100) {
                        console.log(amountInPaisa);
                        razorpayScript.setAttribute('data-amount', amountInPaisa);
                    } else {
                        alert('Amount must be at least 1 INR (100 paise).');
                    }
                } else {
                    alert('Invalid amount entered.');
                }
            

always only 1 value show razorpay
