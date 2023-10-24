<?php

namespace Dxstudio\CwtSDK;

class RequestCancelOrderParamBuilder extends ParamBuilder
{

    protected $params = [
      'serial' => ''
    ];

    static public function getNew():RequestCancelOrderParamBuilder
    {
        // TODO: Implement builder() method.
        return new RequestCancelOrderParamBuilder();
    }


    /**
     * 设置订单号
     * @param string $orderId
     * @return $this
     */
    public function setOrderId( string $orderId ) : RequestCancelOrderParamBuilder
    {
        $this->params['serial'] = $orderId;
        return $this;
    }

}