To initiate a third-party withdrawal from Razorpay to a bank account, you can use RazorpayX’s Payout API. This allows you to transfer funds from your RazorpayX account to an external bank account.

Here’s how you can set up a withdrawal using cURL.

Step 1: Set Up RazorpayX Account and Fund it

1. Make sure you have a RazorpayX account and sufficient balance in it.


2. Generate your API Key and Secret from Razorpay’s dashboard to authenticate requests.



Step 2: Create a Contact

Before initiating a payout, you need to create a Contact in Razorpay for the third-party account holder if you haven’t done so already.

cURL Request to Create a Contact:

curl -u YOUR_KEY_ID:YOUR_KEY_SECRET \
     -X POST "https://api.razorpay.com/v1/contacts" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "John Doe",
           "email": "johndoe@example.com",
           "contact": "9876543210",
           "type": "vendor",
           "reference_id": "contact_12345",
           "notes": {
             "note_key": "note_value"
           }
         }'

This will create a contact in Razorpay, and the response will contain a unique contact_id for the third party.

Step 3: Create a Fund Account

Next, create a Fund Account linked to the contact with their bank account details. This is the bank account where funds will be transferred.

cURL Request to Create a Fund Account:

curl -u YOUR_KEY_ID:YOUR_KEY_SECRET \
     -X POST "https://api.razorpay.com/v1/fund_accounts" \
     -H "Content-Type: application/json" \
     -d '{
           "contact_id": "cont_ABCDEF12345",       // Replace with the contact_id from Step 2
           "account_type": "bank_account",
           "bank_account": {
             "name": "John Doe",
             "ifsc": "HDFC0001234",                // Replace with the correct IFSC code
             "account_number": "1234567890"        // Replace with the correct account number
           }
         }'

The response will contain a fund_account_id, which is needed for the payout.

Step 4: Create a Payout

Once you have the fund_account_id, you can initiate the payout.

cURL Request to Create a Payout:

curl -u YOUR_KEY_ID:YOUR_KEY_SECRET \
     -X POST "https://api.razorpay.com/v1/payouts" \
     -H "Content-Type: application/json" \
     -d '{
           "account_number": "Your_RazorpayX_Virtual_Account_Number",  // RazorpayX account number
           "fund_account_id": "fa_ABCDEF12345",                        // Replace with the fund_account_id from Step 3
           "amount": 10000,                                            // Amount in paise (e.g., 10000 for Rs 100)
           "currency": "INR",
           "mode": "IMPS",                                             // Options: IMPS, NEFT, RTGS, UPI
           "purpose": "payout",
           "queue_if_low_balance": true,
           "reference_id": "txn_12345",
           "narration": "Payout for services",
           "notes": {
             "note_key": "note_value"
           }
         }'

Step 5: Handle the Response

If successful, Razorpay will return a payout_id along with the payout details:

{
  "id": "pout_ABCDEF12345",
  "status": "processed",
  "fund_account_id": "fa_ABCDEF12345",
  "amount": 10000,
  "currency": "INR",
  "mode": "IMPS",
  "purpose": "payout",
  "reference_id": "txn_12345",
  "narration": "Payout for services",
  "notes": {
    "note_key": "note_value"
  },
  ...
}

If there’s an error, you might see something like:

{
  "error": {
    "code": "BAD_REQUEST_ERROR",
    "description": "Insufficient balance"
  }
}

Step 6: Common Issues

1. Insufficient Balance: Make sure your RazorpayX account has enough funds for the payout.


2. Incorrect Account Details: Double-check the IFSC code and account number.


3. Unauthorized Access: Ensure your API keys are correct and have necessary permissions.



Notes

Payout Modes: RazorpayX supports IMPS, NEFT, RTGS, and UPI.

Amount Format: The amount is specified in paise (100 paise = 1 INR).

RazorpayX Account Number: This is the virtual account number assigned by RazorpayX, which should be used for payouts.


This setup should help you transfer funds from your RazorpayX account to any third-party bank account.

