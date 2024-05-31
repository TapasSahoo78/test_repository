Understood. For a one-to-one message exchange where users can send a message to an admin and the admin can reply back to the user, you need to implement a bidirectional messaging system. Below are the steps to achieve this using Firestore, Laravel, and jQuery:

### Firestore Schema
Set up a single collection to store all messages exchanged between users and admins.

```plaintext
messages (collection)
  - messageId (document)
    - senderId (userId or 'admin')
    - receiverId (userId or 'admin')
    - message
    - timestamp
```

### Laravel Routes
Define routes to handle sending and receiving messages in your `web.php` file.

```php
// web.php

use App\Http\Controllers\MessageController;

Route::post('/send-message', [MessageController::class, 'sendMessage']);
Route::get('/get-messages/{userId}', [MessageController::class, 'getMessages']);
```

### Laravel Controller
Create a controller method to handle sending and receiving messages between users and admins.

```php
// MessageController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class MessageController extends Controller
{
    protected $database;

    public function __construct()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(env('FIREBASE_CREDENTIALS_FILE'));

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        $this->database = $firebase->getFirestore();
    }

    public function sendMessage(Request $request)
    {
        $messagesRef = $this->database->collection('messages');

        $messagesRef->add([
            'senderId' => $request->senderId,
            'receiverId' => $request->receiverId,
            'message' => $request->message,
            'timestamp' => time(),
            'read' => false, // Mark message as unread initially
        ]);

        return response()->json(['success' => true]);
    }

    public function getMessages(Request $request)
    {
        $messagesRef = $this->database->collection('messages')
            ->where('senderId', '=', $request->userId)
            ->orWhere('receiverId', '=', $request->userId)
            ->orderBy('timestamp', 'desc')
            ->limit(10)
            ->documents();

        $messages = [];

        foreach ($messagesRef as $message) {
            $messages[] = $message->data();
        }

        return response()->json($messages);
    }
}
```

### jQuery
Write jQuery code to handle sending and receiving messages between users and admins.

```javascript
// Send message
$('#send-message-form').submit(function(e) {
    e.preventDefault();
    
    const senderId = $('#sender-id').val();
    const receiverId = $('#receiver-id').val();
    const message = $('#message').val();

    $.ajax({
        type: 'POST',
        url: '/send-message',
        data: {
            senderId: senderId,
            receiverId: receiverId,
            message: message
        },
        success: function(response) {
            console.log('Message sent successfully');
            $('#message').val(''); // Clear the message input field
        },
        error: function(error) {
            console.error('Error sending message:', error);
        }
    });
});

// Fetch messages
function fetchMessages(userId) {
    $.ajax({
        type: 'GET',
        url: '/get-messages/' + userId,
        success: function(response) {
            response.forEach(message => {
                $('#messages-container').append(`<p>${message.senderId}: ${message.message}</p>`);
            });
        },
        error: function(error) {
            console.error('Error fetching messages:', error);
        }
    });
}

// Usage
fetchMessages(userId); // Fetch messages for the current user
```

### HTML
Create an HTML form to send messages and a container to display messages.

```html
<!-- index.html -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Chat</h1>
    
    <div id="messages-container"></div>
    
    <form id="send-message-form">
        <input type="hidden" id="sender-id" value="user_id">
        <input type="hidden" id="receiver-id" value="admin_id">
        <input type="text" id="message" placeholder="Your message">
        <button type="submit">Send</button>
    </form>

    <script src="app.js"></script>
</body>
</html>
```

Replace `"user_id"` and `"admin_id"` with the actual IDs of the user and admin.

With this setup, users can send messages to admins, and admins can reply back to users. The messages are stored in Firestore and retrieved using AJAX requests. Adjust the code according to your specific requirements and application architecture.




















Route::controller(WalletController::class)->group(function () {
        Route::group(['prefix' => 'wallet', 'as' => 'wallet.'], function () {
            Route::post('/recharge', 'rechargeWallet')->name('recharge');
            Route::post('/verify', 'paymentVerify')->name('verify');
            Route::get('/history', 'walletLedger')->name('history');
            Route::post('/refund', 'initiateRefund')->name('refund');
        });
    });






public function walletLedger()
    {
        $wallet = (new WalletService)->getWalletHistory();
        if (isset($wallet) && !empty($wallet)) {
            return response()->json([
                'status'        =>  true,
                'response_code' =>  200,
                'message'       =>  config('message.MSG_RECORD_FETCHED_SUCCESS'),
                'wallet_total' => $wallet->amount ?? 0.00,
                'data' =>  $wallet->getWalletHistory()->latest()->paginate(10)
            ], 200);
        } else {
            return $this->apiResponseJson(true, 200, config('message.MSG_RECORD_FETCHED_FAILED'), []);
        }
    }
    public function rechargeWallet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "amount" => "required|numeric"
        ]);
        if ($validator->fails()) {
            return $this->apiResponseJson(false, 422, $validator->errors()->first(), (object) []);
        }
        $amount = $request->amount * 100;
        $receiptId = uniqid('recharge_');

        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $orderData = [
            'amount' => $amount,
            'currency' => 'INR',
            'receipt' => $receiptId,
            'payment_capture' => 1
            // 'description' => 'Wallet Recharge',
        ];

        try {
            $razorpayOrder = $api->order->create($orderData);
            Transaction::create([
                "user_id" => Auth::id(),
                "razorpayOrderId" => $razorpayOrder?->id,
                "paidAmount" => $razorpayOrder?->amount / 100,
                "remark" => "Wallet Recharge",
                // "paymentDate" => ,
                "paymentStatus" => "Pending",
            ]);
            // if ($transactionCreated) {
            //     $transactionLogCreated = [];
            // }
            return $this->apiResponseJson(true, 200, 'Intent created successfully in Razorpay Server', (object)[
                "amount" => $razorpayOrder?->amount,
                "orderId" => $razorpayOrder?->id
            ]);
        } catch (\Exception $e) {
            logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
            return $this->apiResponseJson(false, 500, (onProduction()) ?  config('message.MSG_ERROR_TRY_AGAIN') : $e->getMessage(), (object) []);
        }
    }

    public function paymentVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "razorpay_order_id" => "required",
            "razorpay_payment_id" => "required"
        ]);
        if ($validator->fails()) {
            return $this->apiResponseJson(false, 422, $validator->errors()->first(), (object) []);
        }

        try {
            $updateAmount = Transaction::where('razorpayOrderId', $request->razorpay_order_id)->latest()->first();
            if ($updateAmount) {
                Transaction::where('razorpayOrderId', $request->razorpay_order_id)->update([
                    "payment_id" => $request->razorpay_payment_id,
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
                return $this->apiResponseJson(true, 200, 'Payment Successful!', (object)[]);
            }
        } catch (\Exception $e) {
            logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
            return $this->apiResponseJson(false, 500, (onProduction()) ?  config('message.MSG_ERROR_TRY_AGAIN') : $e->getMessage(), (object) []);
        }
    }





RAZORPAY_KEY_ID=rzp_test_l5IvNZuMCyyln6
RAZORPAY_KEY_SECRET=JOGyC0ctO2xLWoMDFEyVeB6h







FIREBASE_API_KEY=AAAAuLwTeqs:APA91bGLxAWBtwlJKLJLnqqfcg1pHPvaLG-yVrpGPUeyl5IPRmy9iMOGwVyCvl2ElJrIkLmaEIpmhOA_XTBwORtOx34CY5BoVmuYqrf0CqRZHseSAgannjJF5rYX2HnQ5J__aoR-dwe2







Transaction ID: 275560372515 is insufficient for certification, as it's just MOTO transaction. Please arrange 3Ds successful and failed transactions using the cards mentioned in the integration kit.














if (json_decode($response)->Transaction->ResponseCode == 0) {
                $response['TransactionID'] = $request->TransactionID;
                // $isIncidentCreated = Incident::where('id', $orderId)->first();
                // if ($isIncidentCreated) {
                //     $parts = explode('_', $orderId);
                //     $authIdPart = $parts[0]; // Get the first part
                //     $isTransactionCreated = $isIncidentCreated->transaction()->create([
                //         // 'user_id' => $attributes['user_id'],
                //         'user_id' => $authIdPart,
                //         'amount' => json_decode($response)?->Transaction?->amount?->value ?? json_decode($response)?->Transaction?->amount,
                //         'currency' => getSiteSetting('currency_code') ?? 'AED',
                //         'json_response' => json_decode($response) ?? null,
                //     ]);
                // }
                return $this->responseJson(true, 200, 'Make Payment Successfully', json_decode($response))












// Turn on error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Decode JSON response
$responseData = json_decode($response);

if ($responseData === null) {
    return $this->responseJson(false, 400, 'Invalid JSON response');
}

// Check the response code
if ($responseData->Transaction->ResponseCode == 0) {
    // Ensure $request->TransactionID exists
    if (isset($request->TransactionID)) {
        $responseData->TransactionID = $request->TransactionID;
    } else {
        return $this->responseJson(false, 400, 'TransactionID not found in request');
    }

    // Uncomment and modify the following code as needed for your logic
    /*
    $isIncidentCreated = Incident::where('id', $orderId)->first();
    if ($isIncidentCreated) {
        $parts = explode('_', $orderId);
        $authIdPart = $parts[0]; // Get the first part

        // Create transaction
        $isTransactionCreated = $isIncidentCreated->transaction()->create([
            'user_id' => $authIdPart,
            'amount' => $responseData->Transaction->amount->value ?? $responseData->Transaction->amount,
            'currency' => getSiteSetting('currency_code') ?? 'AED',
            'json_response' => $responseData,
        ]);

        if (!$isTransactionCreated) {
            return $this->responseJson(false, 500, 'Failed to create transaction');
        }
    } else {
        return $this->responseJson(false, 404, 'Incident not found');
    }
    */

    // Return success response
    return $this->responseJson(true, 200, 'Make Payment Successfully', $responseData);
} else {
    // Handle non-successful response code
    return $this->responseJson(false, 400, 'Payment failed', $responseData);
}