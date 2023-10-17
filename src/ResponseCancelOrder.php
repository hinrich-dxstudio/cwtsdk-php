<?php

namespace Dxstudio\CwtSDK;

class ResponseCancelOrder
{

    private $cancelStatus;

    function __construct( $response ){

        $this->cancelStatus = $response->cancelResult;

    }


    /**
     * 获取取消状态
     * 0 - 取消成功
     * 1 - 取消失败
     * 或抛出异常
     * @return int
     */
    public function getCancelStatus() : int{

        return $this->cancelStatus;

    }

}