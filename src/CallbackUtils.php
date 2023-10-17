<?php

namespace Dxstudio\CwtSDK;

class CallbackUtils
{

    private $secret;

    private $type;

    private $orderId;

    private $localOrderId;

    private $params;

    function __construct( string $secret, array $params ){

        $this->secret = $secret;
        $this->type = $params['type'];
        $this->orderId = $params['serial'];
        $this->localOrderId = $params['localOrderId'];
        $this->params = $params;

    }

    /**
     * 验证签名
     * @param array $params
     * @param string $secret
     * @return bool
     */
    public function verifySign(): bool
    {
        $sign = $this->params['sign'];
        $params = $this->params;
        unset($params['sign']);
        $verify = SignUtils::getSign( $params, $this->secret );
        if( $sign == $verify ) return true;
        return false;
    }

    /**
     * 获取回调类型
     * @return int
     */
    public function getType() :int
    {
        return $this->type;
    }

    /**
     * 获取平台订单号
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }


    /**
     * 获取本地订单号
     * @return string
     */
    public function getLocalOrderId(): string
    {
        return $this->localOrderId;
    }


    /**
     * 获取响应参数
     * 当状态为
     * 1-确认回调，sonSerial，originalCash，cash
     * 2-子订单完成回调，eedConfirm, sonSerial, originalCash, cash, totalOriginalCash，totalCash
     * 4-订单扣减回调（发生在订单完成后），subCash，sonSerial，originalCash，cash
     * 5-订单撤回回调（发生在订单完成后）,sonSerial，originalCash，cash
     * 6-订单取消回调  totalOriginalCash，totalCash
     * 7-订单全部完成回调 totalOriginalCash，totalCash
     * @return array
     */
    public function getParams(): array
    {

        $params = $this->params;
        unset($params['type']);
        unset($params['serial']);
        unset($params['sign']);
        unset($params['localOrderId']);
        return $params;

    }

    /**
     * 响应成功
     * @return void
     */
    public function responseSuccess(){

        exit('success');

    }

    /**
     * 响应失败消息
     * @param string $msg
     * @return void
     */
    public function responseFail( string $msg ){

        exit($msg);

    }

}