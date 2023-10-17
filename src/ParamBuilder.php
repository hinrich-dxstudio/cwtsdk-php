<?php
namespace Dxstudio\CwtSDK;

abstract class ParamBuilder
{

    protected $params = [];

    abstract static public function builder();

    public function getParams(){

        return $this->params;

    }

}