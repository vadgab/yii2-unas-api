<?php

namespace vadgab\Yii2UnasApi\UnasOrders;

use vadgab\Yii2UnasApi\UnasApi;



    class UnasOrdersSchema extends UnasApi{

        private $schema = "";
        /*
            Unas api login
        */
        public $Token;
        public $apikey;
        /*
            Unas api variables getOrder
        */
        public $Status = "";
        public $StatusName = "";
        public $StatusID = "";
        public $Email = "";
        public $InvoiceStatus = "";
        public $InvoiceAutoSet = "";
        public $TimeStart = "";
        public $TimeEnd = "";
        public $DateStart = "";
        public $DateEnd = "";
        public $TimeModStart = "";
        public $TimeModEnd = "";
        public $LimitNum = "";
        public $LimitStart = "";
        public $Key = "";
        public $Lang = "";
        /*
            Unas api variables setOrder
        */
        public $setOrderParams = array();


        public function __construct($apikey)
        {
             $this->apikey = $apikey->apikey;
        }

        public function multiDimensionArrayNotNullValue($multiDimesionArrayValue)
        {
            $defaultValue = false;
            if(!empty($multiDimesionArrayValue))foreach($multiDimesionArrayValue as  $key => $item){
                if(is_array($item)){
                    if(!$defaultValue)$defaultValue = self::multiDimensionArrayNotNullValue($item);
                }else{
                    if($item!='')$defaultValue = true;
                }
            }
            return $defaultValue;
        }

        public function multiDimensionArrayXmlSchema($multiDimesionArray)
        {
            $out = "";
             if(!empty($multiDimesionArray))foreach($multiDimesionArray as $key => $item){
                 if(is_array($item)){
                    /*
                        Check is a item not null value
                    */
                    $multiNotNullValue = false;
                    if(!empty($item))foreach($item as $checkItem){
                        if(is_array($checkItem)){
                            if(!$multiNotNullValue)$multiNotNullValue = self::multiDimensionArrayNotNullValue($checkItem);
                        }else{
                            if($checkItem!='')$multiNotNullValue = true;
                        }

                    }
                    if($multiNotNullValue!==false){
                        $out .= "<".$key.">";
                        $out .= self::multiDimensionArrayXmlSchema($item);
                        $out .= "</".$key.">";
                    }
                 }else{
                    if($item!='')$out .= "<".$key.">".$item."</".$key.">";
                 }
             }
             return $out;
        }


        function createGetOrdersSchema(){

                                        $this->schema = '<?xml version="1.0" encoding="UTF-8" ?>';
                                        $this->schema .='     <Params>';
            if($this->Status)           $this->schema .='        <Status>'.$this->Status.'</Status>';
            if($this->StatusName)       $this->schema .='        <StatusName>'.$this->StatusName.'</StatusName>';
            if($this->StatusID)         $this->schema .='        <StatusID>'.$this->StatusID.'</StatusID>';
            if($this->Email)            $this->schema .='        <Email>'.$this->Email.'</Email>';
            if($this->InvoiceStatus)    $this->schema .='        <InvoiceStatus>'.$this->InvoiceStatus.'</InvoiceStatus>';
            if($this->InvoiceAutoSet)   $this->schema .='        <InvoiceAutoSet>'.$this->InvoiceAutoSet.'</InvoiceAutoSet>';
            if($this->TimeStart)        $this->schema .='        <TimeStart>'.$this->TimeStart.'</TimeStart>';
            if($this->TimeEnd)          $this->schema .='        <TimeEnd>'.$this->TimeEnd.'</TimeEnd>';
            if($this->DateStart)        $this->schema .='        <DateStart>'.$this->DateStart.'</DateStart>';
            if($this->DateEnd)          $this->schema .='        <DateEnd>'.$this->DateEnd.'</DateEnd>';
            if($this->TimeModStart)     $this->schema .='        <TimeModStart>'.$this->TimeModStart.'</TimeModStart>';
            if($this->TimeModEnd)       $this->schema .='        <TimeModEnd>'.$this->TimeModEnd.'</TimeModEnd>';
            if($this->LimitNum)         $this->schema .='        <LimitNum>'.$this->LimitNum.'</LimitNum>';
            if($this->LimitStart)       $this->schema .='        <LimitStart>'.$this->LimitStart.'</LimitStart>';
            if($this->Key)              $this->schema .='        <Key>'.$this->Key.'</Key>';
            if($this->Lang)             $this->schema .='        <Lang>'.$this->Lang.'</Lang>';
                                        $this->schema .='    </Params>';

            return $this->schema;

        }



        function createSetOrdersSchema(){


            $this->schema = '<?xml version="1.0" encoding="UTF-8" ?>';
            $this->schema .='     <Orders>';
            $this->schema .='     <Order>';
            if(!empty($this->setOrderParams))foreach($this->setOrderParams as $key => $item){
                if(is_array($item)){
                /*
                    Check is a item not null value
                */
                $multiNotNullValue = false;

                if(!empty($item))foreach($item as $checkItem){
                    if(is_array($checkItem)){
                        if(!$multiNotNullValue)$multiNotNullValue = self::multiDimensionArrayNotNullValue($checkItem);
                    }else{
                        if($checkItem!='')$multiNotNullValue = true;
                    }

                }
                if(!$checkItem)$multiNotNullValue = true;

                if($multiNotNullValue){
                    $this->schema  .= "<".$key.">";
                    $this->schema  .= self::multiDimensionArrayXmlSchema($item);
                    $this->schema  .= "</".$key.">";
                }
                }else{
                if($item!='')$this->schema  .= "<".$key.">".$item."</".$key.">";
                }

            }
            $this->schema .='    </Order>';
            $this->schema .='    </Orders>';

            return $this->schema;

        }







}



