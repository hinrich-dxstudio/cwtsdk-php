<?php
namespace Dxstudio\CwtSDK;

abstract class ParamBuilder
{

    protected $params = [];

    abstract static public function getNew();

    public function getParams(){

        return $this->params;

    }

}