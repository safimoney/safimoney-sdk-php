<?php

namespace Safimoney;

use Safimoney\ApiOperations\Error;
use Safimoney\ApiOperations\Request;

class CashInCashOut
{
    public $key = null;
    public $secret = null;

    function __construct($key, $secret)
    {
        $this->key= $key;
        $this->secret = $secret;
        return $this;
    }

    function cashIn(Array $params)
    {
        $request = new Request();
        $params['amount_type'] = 'debit_transfer_value';
        $params['type'] = 4;
        $arraykeys = array('debit_wallet_id', 'amount', 'amount_type','debit_currency','credit_currency',
        'credit_wallet_id', 'type');

        $result = $request->validateParams($params, $arraykeys);

        if($result === true){
            $namespace = 'transaction';
            $action  = 'cashDepositOffline';
            return $request->makeApiCall($params, $namespace, $action, array('key'=>$this->key, 'secret'=>$this->secret));
        }else{
            return (new Error())->createErrorResponse($result);
        }
    }

    function searchTransaction(Array $params)
    {
        $request = new Request();
        $arraykeys = array('id');
        $result = $request->validateParams($params, $arraykeys);

        if($result === true){
            $namespace = 'transaction';
            $action  = 'search';
            return $request->makeApiCall($params, $namespace, $action, array('key'=>$this->key, 'secret'=>$this->secret));
        }else{
            return (new Error())->createErrorResponse($result);
        }
    }

    function saveIdProof(Array $params){
        $request = new Request();
        $arraykeys = array('transaction_id', 'name', 'number', 'expiry_date', 'type');
        $result = $request->validateParams($params, $arraykeys);

        if($result === true){
            $namespace = 'IdentityProof';
            $action  = 'save';
            return $request->makeApiCall($params, $namespace, $action, array('key'=>$this->key, 'secret'=>$this->secret));
        }else{
            return (new Error())->createErrorResponse($result);
        }
    }

    function cashOut(Array $params){
        $request = new Request();
        $arraykeys = array('id', 'pin_number');
        $result = $request->validateParams($params, $arraykeys);

        if($result === true){
            $namespace = 'transaction';
            $action  = 'approveWithdrawByPartner';
            return $request->makeApiCall($params, $namespace, $action, array('key'=>$this->key, 'secret'=>$this->secret));
        }else{
            return (new Error())->createErrorResponse($result);
        }
    }
}
