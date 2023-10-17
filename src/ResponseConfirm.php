<?php

namespace Dxstudio\CwtSDK;

class ResponseConfirm
{

    private $subOrderId;

    private $amount;

    function __construct( $response ){

        $this->subOrderId = $response->sonSerial;
        $this->amount = $response->cash;

    }

    public function getSubOrderId(){
        return $this->subOrderId;
    }

    public function getAmount(){
        return $this->amount;
    }

}