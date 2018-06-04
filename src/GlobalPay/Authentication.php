<?php
namespace GlobalPay;

class GlobalPay_Authentication {

    public $isLive;
    public function __construct($isLive = false) {
        $this->isLive = $isLive;
    }

    public function Client($clientId,$clientSecret){
        $fields = array('client_id'=>$clientId,
            'grant_type'=>"client_credentials",
            'client_secret'=>$clientSecret);
        $callClient = new Curl_helper();
        return json_decode($callClient->postForm($fields,$this->isLive),true);
    }

}





