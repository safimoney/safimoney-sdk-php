<?php

namespace Safimoney;

use Safimoney\ApiOperations\Error;
use Safimoney\ApiOperations\Request;

class Redirect
{
    public $key = null;
    public $secret = null;

    function __construct($key, $secret)
    {
        $this->key= $key;
        $this->secret = $secret;
        return $this;
    }

    function createOrder(Array $params)
    {
        $request = new Request();
        $arraykeys = array('order_id', 'amount', 'amount_currency','success_url','error_url','cancel_url');
        $result = $request->validateParams($params, $arraykeys);

        if($result === true){
            $namespace = 'PaymentGateway.Redirect';
            $action  = 'createOrder';
            return $request->makeApiCall($params, $namespace, $action, array('key'=>$this->key, 'secret'=>$this->secret));
        }else{
            return (new Error())->createErrorResponse($result);
        }
    }

    function getOrderDetail(Array $params)
    {
        $request = new Request();
        $arraykeys = array('order_id');
        $result = $request->validateParams($params, $arraykeys);

        if($result === true){
            $namespace = 'PaymentGateway.Redirect';
            $action  = 'getOrder';
            return $request->makeApiCall($params, $namespace, $action, array('key'=>$this->key, 'secret'=>$this->secret));
        }else{
            return (new Error())->createErrorResponse($result);
        }
    }
}