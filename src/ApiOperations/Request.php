<?php namespace Safimoney\ApiOperations;

class Request
{
    public $serverUrl = 'https://api.safimoney.com/api/v2';

    function validateParams(Array $params,Array $arrayKeys)
    {
        foreach($arrayKeys as $key){
            if(!array_key_exists($key, $params)){
                $errorMessage = $key.' is required';
                return $errorMessage;
            }
        }
        return true;
    }

    public function makeApiCall(Array $params, $namespace, $action, $credentials, $needFullResponse = false)
    {
        /**
         * check if credentials are empty
         */
        if(empty($credentials['key']) || empty($credentials['secret'])){
            return (new Error())->createErrorResponse('Either your Safimoney key or secret is not set');
        }

        $payload = json_encode($params);
        $auth = $this->_getAuthHash($namespace, $action, $credentials);

        // Prepare new cURL resource
        $ch = curl_init($this->serverUrl);
        // Set HTTP Header for POST request
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $auth)
        );
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        // Submit the POST request
        $result = curl_exec($ch);

        // Close cURL session handle
        curl_close($ch);

        /**
         * parse response
         */
        $response = json_decode($result);

        if(!empty($response->error)){
            return (new Error())->createErrorResponse($response->error->message);
        }

        return $needFullResponse ? $response : $response->data;
    }

    private function _getAuthHash($namespace, $action, $credentials)
    {
        $key = $credentials['key'];
        $secret = $credentials['secret'];
        $timestamp = time();
        $signature = $namespace . $action . $key . $timestamp . $secret;
        $hash = hash('sha256', $signature);
        $data = new \stdClass();
        $data->namespace = $namespace;
        $data->action = $action;
        $data->key = $key;
        $data->secret = $secret;
        $data->timestamp = $timestamp;
        $data->hash = $hash;
        return json_encode($data);
    }
}
