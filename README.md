Here’s a complete guide on setting up a Laravel project to transfer funds from your Razorpay merchant account to a bank account. I’ll take you through each step with all necessary code.

Step 1: Set Up Your Laravel Project

1. Create a New Laravel Project (if you don’t already have one):

composer create-project laravel/laravel razorpay-fund-transfer
cd razorpay-fund-transfer


2. Install Razorpay PHP SDK:

composer require razorpay/razorpay



Step 2: Configure Razorpay API Credentials

1. Add your Razorpay API Key and Secret to your .env file:

RAZORPAY_KEY=your_razorpay_key
RAZORPAY_SECRET=your_razorpay_secret


2. Update config/services.php to load these credentials:

'razorpay' => [
    'key' => env('RAZORPAY_KEY'),
    'secret' => env('RAZORPAY_SECRET'),
],



Step 3: Create a Razorpay Service

Run this command to create a RazorpayService class that will handle API interactions:

php artisan make:service RazorpayService

If make:service is not available, you can manually create the service file by running:

mkdir -p app/Services
touch app/Services/RazorpayService.php

Then, add the following code in app/Services/RazorpayService.php:

<?php

namespace App\Services;

use Razorpay\Api\Api;

class RazorpayService
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
    }

    /**
     * Create a contact for the transfer.
     */
    public function createContact($name, $email, $contact, $type = 'employee')
    {
        return $this->api->contact->create([
            'name' => $name,
            'email' => $email,
            'contact' => $contact,
            'type' => $type
        ]);
    }

    /**
     * Create a fund account for the contact.
     */
    public function createFundAccount($contactId, $bankAccount)
    {
        return $this->api->fund_account->create([
            'contact_id' => $contactId,
            'account_type' => 'bank_account',
            'bank_account' => $bankAccount
        ]);
    }

    /**
     * Transfer funds to a bank account.
     */
    public function transferToBank($amount, $accountId, $notes = [])
    {
        return $this->api->transfer->create([
            'amount' => $amount, // Amount in paise (100 paise = 1 INR)
            'currency' => 'INR',
            'account' => $accountId,
            'notes' => $notes,
        ]);
    }
}

Step 4: Create a Controller for Handling Transfers

Generate a controller to handle the API requests:

php artisan make:controller RazorpayController

In app/Http/Controllers/RazorpayController.php, add the following code:

<?php

namespace App\Http\Controllers;

use App\Services\RazorpayService;
use Illuminate\Http\Request;

class RazorpayController extends Controller
{
    protected $razorpayService;

    public function __construct(RazorpayService $razorpayService)
    {
        $this->razorpayService = $razorpayService;
    }

    /**
     * Create a new contact.
     */
    public function createContact(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $contact = $request->input('contact');

        $contact = $this->razorpayService->createContact($name, $email, $contact);
        return response()->json($contact);
    }

    /**
     * Create a fund account.
     */
    public function createFundAccount(Request $request)
    {
        $contactId = $request->input('contact_id');
        $bankAccount = [
            'name' => $request->input('account_name'),
            'ifsc' => $request->input('ifsc'),
            'account_number' => $request->input('account_number'),
        ];

        $fundAccount = $this->razorpayService->createFundAccount($contactId, $bankAccount);
        return response()->json($fundAccount);
    }

    /**
     * Transfer funds.
     */
    public function transferToBank(Request $request)
    {
        $amount = $request->input('amount');
        $accountId = $request->input('account_id');
        $notes = $request->input('notes', []);

        $transfer = $this->razorpayService->transferToBank($amount, $accountId, $notes);
        return response()->json($transfer);
    }
}

Step 5: Set Up Routes

In routes/web.php, add routes to handle the transfer process:

use App\Http\Controllers\RazorpayController;

Route::post('/razorpay/contact', [RazorpayController::class, 'createContact']);
Route::post('/razorpay/fund-account', [RazorpayController::class, 'createFundAccount']);
Route::post('/razorpay/transfer', [RazorpayController::class, 'transferToBank']);

Step 6: Test the Functionality

You can now test the following endpoints using Postman or any other API testing tool:

1. Create Contact:

URL: POST /razorpay/contact

Body:

{
    "name": "John Doe",
    "email": "johndoe@example.com",
    "contact": "9876543210"
}



2. Create Fund Account:

URL: POST /razorpay/fund-account

Body:

{
    "contact_id": "contact_id_from_previous_step",
    "account_name": "John Doe",
    "ifsc": "IFSC_CODE",
    "account_number": "1234567890"
}



3. Transfer to Bank:

URL: POST /razorpay/transfer

Body:

{
    "amount": 10000, // Amount in paise (10000 paise = 100 INR)
    "account_id": "fund_account_id_from_previous_step",
    "notes": {
        "purpose": "payout"
    }
}




Step 7: Handling Webhooks (Optional)

For tracking the status of transfers, Razorpay provides webhooks. Configure your webhook endpoint in Razorpay's dashboard and create a route and method to handle these events.

In routes/web.php, add:

Route::post('/razorpay/webhook', [RazorpayController::class, 'handleWebhook']);

In RazorpayController.php, add:

public function handleWebhook(Request $request)
{
    // Process webhook data and handle specific events
    $payload = $request->all();
    // Example: Log the webhook payload
    \Log::info('Razorpay Webhook:', $payload);

    return response()->json(['status' => 'success']);
}

Summary

With this setup, you now have a Laravel project configured to:

1. Create a contact for the payout.


2. Create a fund account for the contact.


3. Transfer funds to the bank account.


4. (Optional) Handle webhooks for tracking transfer statuses.



This implementation will enable you to initiate and manage bank transfers using Razorpay’s API through a clean and modular Laravel service.

