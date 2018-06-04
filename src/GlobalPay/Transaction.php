<?php

namespace GlobalPay;

class GlobalPay_Transaction {

    public $token;
    public $isLive;
    function __construct($access_token,$isLive = false) {
        $this->token = $access_token;
        $this->isLive = $isLive;
    }

    public function initiation($merchantid,$returnurl,$merchantreference,$description,$totalamount,$currencycode,$customerEmail,$customerNumber,$customerFirstName,$customerLastName){

        $customer = array('email'=> $customerEmail,
            'firstname'=> $customerFirstName,
            'lastname'=> $customerLastName,
            'mobile'=>$customerNumber);

        $product = array('name'=> $description,
            'unitprice'=> $totalamount,
            'quantity'=>"1");

        $fields = array( 'returnurl'=>$returnurl,
            'customerip'=>'127.0.0.1',
            'merchantid'=>$merchantid,
            'merchantreference'=>$merchantreference,
            'description'=>$description,
            'totalamount'=>$totalamount,
            'paymentmethod'=>'card',
            'transactionType'=>'Payment',
            'connectionmode'=>'redirect',
            'currencycode'=>$currencycode,
            'customer'=>$customer,
            'product'=>array($product));
        $callClient = new Curl_helper();

        return json_decode($callClient->post("/api/v3/Payment/SetRequest",$fields,$this->token,$this->isLive),true);
    }

    public function verification($merchantid,$merchantreference,$transactionreference){
        $fields = array('merchantid'=> $merchantid,
            'merchantreference'=> $merchantreference,
            'transactionreference'=> $transactionreference);

        $callClient = new Curl_helper();
        return $callClient->post("/api/v3/Payment/Retrieve",$fields,$this->token,$this->isLive);

    }
}

