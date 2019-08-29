## Safimoney PHP SDK

### Overview
The Safimoney PHP library provides access to the Safimoney API from applications written in the PHP language.

### Requirements -
PHP 5.4.0 and later.

### Composer
You can install the bindings via Composer. Run the following command:
```
composer require readybytes/safimoney-sdk-php
```

### Getting Started

#### Create Order
To make the payment via Safimoney, you need to first create a transaction in safimoney for your order.
So you just need to create order and leave all the complexities of payment process to us.
```
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