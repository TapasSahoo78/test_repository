<?php
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';



| Domain: tikandtake.com
| cPanel IP: https://13.200.168.123:2083
| UserName: tikandtake
| PassWord: cUd9udEf=o(&










<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class WithdrawController extends Controller
{
    public function withdraw(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $driverId = $request->user()->id; // Assuming you have a driver authenticated
        $amount = $request->input('amount');
        $withdrawalMethod = $request->input('withdrawal_method'); // Assuming you collect withdrawal method (e.g., "bank_account" or "upi_id")

        try {
            // Create a withdrawal
            $withdrawalData = [
                'fund_account_id' => $driverId,
                'amount' => $amount * 100, // Amount in paise
                'currency' => 'INR',
            ];

            if ($withdrawalMethod === 'bank_account') {
                $bankAccount = $request->input('bank_account');
                $withdrawalData['account_number'] = $bankAccount['account_number'];
                // Add other bank account details as needed
            } elseif ($withdrawalMethod === 'upi_id') {
                $upiId = $request->input('upi_id');
                $withdrawalData['contact'] = $upiId;
                // Add other UPI details as needed
            } else {
                throw new \Exception('Invalid withdrawal method');
            }

            $withdrawal = $api->withdrawals->create($withdrawalData);

            // Handle success
            // Update driver's earnings status, etc.
            return response()->json(['message' => 'Withdrawal successful'], 200);
        } catch (\Exception $e) {
            // Handle error
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}