<?php

namespace Dxstudio\CwtSDK;

class RequestQueryOrderOneParamBuilder extends ParamBuilder
{

    protected $params = [
        'serial' => ''
    ];

    static public function builder(): RequestQueryOrderOneParamBuilder
    {
        // TODO: Implement builder() method.
        return new RequestQueryOrderOneParamBuilder();
    }

    public function setOrderId( string $orderId ): RequestQueryOrderOneParamBuilder
    {

        $this->params['serial'] = $orderId;
        return $this;

    }

}