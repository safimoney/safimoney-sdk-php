## Safimoney PHP SDK

### Overview
The Safimoney PHP library provides access to the Safimoney API from applications written in the PHP language.

### Requirements -
PHP 5.4.0 and later.

### Composer
You can install the bindings via Composer. Run the following command:
```
composer require safimoney/safimoney-php-sdk
```

### Getting Started

> **Payment Gateway (Only For Business Wallets)**

#### Create Order

To make the payment via Safimoney, you need to first create a transaction in safimoney for your order.
So you just need to create order and leave all the complexities of payment process to us.

```json
$object = new \Safimoney\Redirect(YOUR_SAFIMONEY_KEY, YOUR_SAFIMONEY_SECRET);

//required parameters
$payload = [
     'order_id'        => 222, // Your order Id
     'amount'          => 50, // Amount to your order
     'amount_currency' => EUR, // Currency of amount
     'notify_url'      => http://your.notify.url, // Webhook url of your site
     'success_url'     => http://your.success.url, // url to which safimoney redirects your customer after successful payment
     'error_url'       => http://your.error.url, // url to which safimoney redirects your customer on getting any error in payment
     'cancel_url'      => http://your.cancel.url, // url to which safimoney redirects your customer if customer cancels the payment
];
$result = $object->createOrder($payload);

//if all data is proper then you will get a url where you need to redirect your customer
$redirectUrl = $result->redirect_url;
```

#### Get Order Detail
For getting details about any of your order processed by safimoney, you can use it.
```
$object = new \Safimoney\Redirect(YOUR_SAFIMONEY_KEY, YOUR_SAFIMONEY_SECRET);

//required parameters
$payload = [
     'order_id'        => 222, // Your order Id
];
$order = $object->getOrderDetail($payload);
```

For more detail, you can refer this [document](https://gitlab.com/readybytes/safimoney-payment-gateway/blob/master/documentation.md).



> **Cash In Cash Out (Only for Partner Wallets)**

**Cash In**

To deposit a wallet Via Cash In API you need to make request with your API Credentials to SafiMoney.

```json
$object = new \Safimoney\CashInCashOut(YOUR_SAFIMONEY_KEY, YOUR_SAFIMONEY_SECRET);

//required parameters
$payload = [
     'debit_wallet_id'        => '100000000000', // Your wallet Id,
     'debit_currency' 	=> 'EUR',// Your wallet currency,
     'amount'          => 50, // Amount to your order
     'credit_wallet_id' => '10123334445', // Wallet Id from which you will take cash
     'credit_currency'      => 'EUR', // Wallet Currency from which you will take cash
];
$result = $object->cashIn($payload);

//if all data is proper then you will get the transaction in response
$transaction = $result->transaction;
```

**Cash Out**

To make cash out request you need to follow the below steps :

1. **Search Transaction**

   When customer will provide transaction ID, to get the full detail you can search the transaction from given ID. 

   ```json
   $object = new \Safimoney\CashInCashOut(YOUR_SAFIMONEY_KEY, YOUR_SAFIMONEY_SECRET);
   
   //required parameters
   $payload = [
        'id'      => '100000000022', // Transaction ID of cash out Request,
   ];
   $result = $object->search($payload);
   
   //if all data is proper then you will get the transaction in response
   $transaction = $result->transaction;
   ```

   

2. **Submit ID Proof**

   Before approving Cash out request, you need to submit the ID Proof which will be attached to the given Transaction ID.

   ```json
   $object = new \Safimoney\CashInCashOut(YOUR_SAFIMONEY_KEY, YOUR_SAFIMONEY_SECRET);
   
   //required parameters
   $payload = [
       'id'      	=> '100000000022', // Transaction ID of cash out Request,
       'name' 	=> 'Name of the ID PROOF',// Name of your Id Proof ex. Passport, ID Proof
       'number' 	=> '12334',// Number of ID Proof
       'expiry_date' => '2022-04-18',// Expiry Date of ID Proof, format should yy-mm-dd
       'type' => '10'// Type of ID Proof e.g for Personal ID Proof set 10 for Business type set 20
   ];
   $result = $object->saveIdProof($payload);
   
   //if all data is proper then you will get the transaction in response
   $transaction = $result->transaction;
   ```

   

   

3. **Approve Transaction**

   Before approving Cash out request, you need to submit the ID Proof which will be attached to the given Transaction ID.

   ```json
   $object = new \Safimoney\CashInCashOut(YOUR_SAFIMONEY_KEY, YOUR_SAFIMONEY_SECRET);
   
   //required parameters
   $payload = [
       'id'      	=> '100000000022', // Transaction ID of cash out Request,
       'pin_number' 	=> 'Name of the ID PROOF',// Withdraw code which will be shared by customer
   ];
   $result = $object->cashOut($payload);
   
   //if all data is proper then you will get the transaction in response
   $transaction = $result->transaction;
   ```

   



