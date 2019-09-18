### Cash In Cash Out (Only for Partner Wallets)

> **Cash In**

To deposit a wallet Via Cash In API you need to make request with your API Credentials to SafiMoney.

```php
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



> **Cash Out**

To make cash out request you need to follow the below steps :

1. **Search Transaction**

   When customer will provide transaction ID, to get the full detail you can search the transaction from given ID. 

   ```php
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

   ```
   $object = new \Safimoney\CashInCashOut(YOUR_SAFIMONEY_KEY, YOUR_SAFIMONEY_SECRET);
   
   //required parameters
   $payload = [
       'id'      	=> '100000000022', // Transaction ID of cash out Request,
       'name' 	=> 'Name of the ID PROOF',// Name of your Id Proof ex. Passport, ID Proof
       'number' 	=> '12334',// Number of ID Proof
       'expiry_date' => '2022-04-18',// Expiry Date of ID Proof, format should yyyy-mm-dd
       'type' => '10'// Type of ID Proof e.g for Personal ID Proof set 10 for Business type set 20
   ];
   $result = $object->saveIdProof($payload);
   
   //if all data is proper then you will get the transaction in response
   $transaction = $result->transaction;
   ```

   

   

3. **Approve Transaction**

   Before approving Cash out request, you need to submit the ID Proof which will be attached to the given Transaction ID.

   ```php
   $object = new \Safimoney\CashInCashOut(YOUR_SAFIMONEY_KEY, YOUR_SAFIMONEY_SECRET);
   
   //required parameters
   $payload = [
      //1. Transaction ID of cash out Request,
       'id'      	=> '1000000000123456', // 16 digit numeric only, 
       //2.  Withdraw code, shared by customer
       'pin_number' 	=> '123456',// Six digits
   ];
   $result = $object->cashOut($payload);
   
   //if all data is proper then you will get the transaction in response
   $transaction = $result->transaction;
   ```

   



