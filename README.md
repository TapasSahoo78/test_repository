<form action="{!! route('user.pay-payment') !!}" method="POST">
                            @csrf
                            <input type="text" class="float-number form-control" id="razorpayAmount" name="amount">
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_l5IvNZuMCyyln6"
                                data-buttontext="Add Money" data-name="Driver4Wheels" data-description="Payment" data-prefill.name="name"
                                data-prefill.email="email" data-prefill.contact="9898989898" data-theme.color="#fff"></script>
                        </form>



 public function payment(Request $request)
    {
        $input = $request->all();

        $api = new Api("rzp_test_l5IvNZuMCyyln6", "JOGyC0ctO2xLWoMDFEyVeB6h");
        $orderData = [
            'receipt' => 'VS' . time(),
            'amount' => 500 * 100,
            'currency' => 'INR',
        ];
        $razorpayOrder = $api->order->create($orderData);
        // dd($order);
        Transaction::create([
            "user_id" => Auth::id(),
            "razorpayOrderId" => $razorpayOrder?->id,
            "paidAmount" => $razorpayOrder?->amount / 100,
            "remark" => "Wallet Recharge",
            // "paymentDate" => ,
            "paymentStatus" => "Pending",
        ]);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        try {
            $updateAmount = Transaction::where('razorpayOrderId', $razorpayOrder?->id)->latest()->first();
            if ($updateAmount) {
                Transaction::where('razorpayOrderId', $razorpayOrder?->id)->update([
                    "payment_id" => $payment?->id,
                    "paymentStatus" => "Paid"
                ]);

                $userWalletMoney = UserWallet::firstOrNew(['user_id' => Auth::id()]);
                $userWalletMoney->amount += $updateAmount->paidAmount;
                $userWalletMoney->save();

                WalletHasLedger::create([
                    'user_wallet_id' => $userWalletMoney->id,
                    'razor_payment_id' => $request->razorpay_payment_id,
                    'amount' => $updateAmount?->paidAmount,
                    'mode' => "Credited",
                    'currentBalance' => $userWalletMoney?->amount,
                    'remark' => 'Recharge of ' . ($updateAmount?->paidAmount) . ' is successful',
                ]);
                return redirect()->route('user.wallet');
                // return $this->responseJson(true, 200, 'Payment Successful!', route('user.wallet'));
            }
        } catch (\Exception $e) {
            logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
            return $this->apiResponseJson(false, 500, (onProduction()) ? config('message.MSG_ERROR_TRY_AGAIN') : $e->getMessage(), (object) []);
        }
    }
