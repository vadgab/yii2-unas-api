<?php

namespace vadgab\Yii2UnasApi\UnasOrders;




    class UnasOrdersSchema extends UnasApi{

        private $schema = "";
        public $InvoiceStatus = "1";
        public $DateStart = "";
        public $DateEnd = "";


        function loadGetOrdersSchema(){

            $this->schema = '<?xml version="1.0" encoding="UTF-8" ?>';
            $this->schema .='     <Params>';
            $this->schema .='        <InvoiceStatus>'.$this->InvoiceStatus.'</InvoiceStatus>';
            $this->schema .='        <DateStart>'.$this->DateStart.'</DateStart>';
            $this->schema .='        <DateEnd>'.$this->DateEnd.'</DateEnd>';
            $this->schema .='    </Params>';

        }




}
