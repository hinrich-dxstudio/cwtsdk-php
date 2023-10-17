<?php

namespace Dxstudio\CwtSDK;

class ResponseQueryOrder
{

    private $orderId;

    private $localOrderId;

    private $orderAt;

    private $status;

    private $amount;

    private $amountReceived;

    function __construct( $response ){

        $this->orderId = $response->serial;
        $this->localOrderId = $response->localOrderId;
        $this->orderAt = $response->timeCreate;
        $this->status = $response->status;
        $this->amount = $response->originCash;
        $this->amountReceived = $response->cash;

    }

    public function getOrderId():string
    {
        return $this->orderId;
    }

    public function getLocalOrderId():string
    {
        return $this->localOrderId;
    }

    public function getOrderAt():int
    {
        return $this->orderAt;
    }

    public function getStatus():int
    {
        return $this->status;
    }

    public function getAmount():float
    {
        return $this->amount;
    }

    public function getAmountReceived():float
    {
        return $this->amountReceived;
    }

}