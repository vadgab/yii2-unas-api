<?php

namespace vadgab\Yii2UnasApi;

use vadgab\Yii2UnasApi\UnasOrders;



class UnasApi
{
    private $apikey;
    const URL_MAIN = "https://api.unas.eu/shop/";
    const LOGIN_PREFIX = "login";


    public function __construct($apikey)
    {
         $this->apikey = $apikey;
    }


    public function call($request){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, self::URL_MAIN.self::LOGIN_PREFIX);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$request);
        try{
            $response = curl_exec($curl);
            $resultXML = simplexml_load_string($response);
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
        $result = $this->call($request);
        return $result;

    }

    public function getOrders($schema){

        $result = $this->call($schema);
        return $result;

    }







}
?>