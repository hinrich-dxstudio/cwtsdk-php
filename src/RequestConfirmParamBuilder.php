<?php

class RequestConfirmParamBuilder extends \Dxstudio\CwtSDK\ParamBuilder
{

    protected $params = [
        'serial' => '',
        'sonSerial' => '',
    ];

    static public function getNew():RequestConfirmParamBuilder
    {
        // TODO: Implement builder() method.
        return new RequestConfirmParamBuilder();
    }

    public function setOrderId( string $orderId ) : RequestConfirmParamBuilder{
        $this->params['serial'] = $orderId;
        return $this;
    }

    public function setSubOrderId( string $subOrderId ) : RequestConfirmParamBuilder{
        $this->params['sonSerial'] = $subOrderId;
        return $this;
    }


}