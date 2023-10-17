<?php

namespace Dxstudio\CwtSDK;

class ResponseCreateOrder
{

    private $orderId;

    private $orderAt;

    function __construct( $response ){

        $this->orderId = $response->serial;
        $this->orderAt = $response->timeCreate;

    }

    /**
     * 获取创建的订单号
     * @return mixed
     */
    public function getOrderId():string{
        return $this->orderId;
    }

    /**
     * 获取订单的创建时间戳
     * @return int
     */
    public function getOrderAt():int{
        return $this->orderAt;
    }

}