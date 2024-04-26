<button data-bs-toggle="modal" data-bs-target="#addMoneyModal">Add Money</button>

    <!--Wallet Recharge Modal -->
    <div class="modal fade popup" id="addMoneyModal" tabindex="-1" aria-labelledby="addMoneyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body popup">

                    <a href="javascript:void(0)">
                        <form action="{!! route('user.pay-payment') !!}" method="POST">
                            @csrf
                            <input type="text" class="float-number form-control" id="razorpay">
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_l5IvNZuMCyyln6"
                                data-amount="{{ 500 * 100 }}" data-buttontext="Add Money" data-name="Driver4Wheels" data-description="Payment"
                                data-prefill.name="name" data-prefill.email="email" data-prefill.contact="9898989898" data-theme.color="#fff">
                            </script>
                        </form>
                    </a>

                </div>

            </div>
        </div>
    </div>
