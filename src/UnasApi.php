<?php

namespace vadgab\Yii2UnasApi;


use vadgab\Yii2UnasApi\UnasOrders\UnasOrdersSchema;



class UnasApi
{
    public $apikey;
    public $Token;
    const URL_MAIN = "https://api.unas.eu/shop/";
    const LOGIN_PREFIX = "login";
    const GET_ORDER_PREFIX = "getOrder";
    const SET_ORDER_PREFIX = "setOrder";


    public function __construct($apikey)
    {
         $this->apikey = $apikey;
    }


    public function call($request,$prefix, $token = ""){

        $curl = curl_init();

        if($token){
            $headers=array();
            $headers[]="Authorization: Bearer ".$token;
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_HEADER, false);
        }else{
            curl_setopt($curl, CURLOPT_HEADER, false);
        }
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, self::URL_MAIN.$prefix);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$request);
        try{
            $response = curl_exec($curl);
            $resultXML = simplexml_load_string($response,'SimpleXMLElement', LIBXML_NOCDATA);
            return $resultXML;

        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }

    public function login(){

        ///////////////////////////////////////////////////////////////////
        /// login Authentikation return token and "Permission"
        $request='<?xml version="1.0" encoding="UTF-8" ?>
                    <Params>
                        <ApiKey>'.$this->apikey.'</ApiKey>
                    </Params>';
        $result = $this->call($request,self::LOGIN_PREFIX);
        return $result;

    }

    public function getOrders($schema){

        $login = self::login();
        $token_ = $login->Token;
        $result = $this->call($schema,self::GET_ORDER_PREFIX,$login->Token);
        return $result;

    }

    public function setOrders($schema){

        $login = self::login();
        $token_ = $login->Token;
        $result = $this->call($schema,self::SET_ORDER_PREFIX,$login->Token);
        return $result;

    }








}
?>