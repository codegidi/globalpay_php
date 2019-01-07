<?php
namespace GlobalPay;

class Curl_helper {

    private $BASE_URL_STAGING = "https://gpaygatewayapi.azurewebsites.net/api/v3/Payment";
    private $AUTH_URL_STAGING = "https://gpayauthorisation.azurewebsites.net/connect/token";
    private $BASE_URL_LIVE = "https://api.globalpay.com.ng/api/v3/Payment";
    private $AUTH_URL_LIVE = "https://auth.globalpay.com.ng/connect/token";
	

    public function post($endPoint,$body,$accessKey,$isLive){
        $ch = curl_init();
        $baseURL = $this->BASE_URL_STAGING;
        if($isLive){
            $baseURL = $this->BASE_URL_LIVE;
        }
        $payload = json_encode($body);
        curl_setopt($ch,CURLOPT_URL,$baseURL . $endPoint);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$payload);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json',
            "Authorization: Bearer {$accessKey}",));
        curl_setopt($ch,CURLOPT_TIMEOUT, 20);

        $response = curl_exec($ch);
        $err = curl_error($ch);

        curl_close ($ch);

        if ($err) {
            return array('error'=> "cURL Error #:" . $err);
        } else {
            return $response;
        }
    }

    public function postForm($body,$isLive){
        $ch = curl_init();

        $baseURL = $this->AUTH_URL_STAGING;
        if($isLive){
            $baseURL = $this-> AUTH_URL_LIVE;
        }

        $postvars = '';
        foreach($body as $key=>$value) {
            $postvars .= $key . "=" . $value . "&";
        }

        curl_setopt($ch,CURLOPT_URL,$baseURL);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt($ch,CURLOPT_TIMEOUT, 20);

        $response = curl_exec($ch);
        $err = curl_error($ch);

        curl_close ($ch);

        if ($err) {
            return array('error'=> "cURL Error #:" . $err);
        } else {
            return $response;
        }

    }
}