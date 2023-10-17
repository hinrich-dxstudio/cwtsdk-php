<?php
/**
 * 回调示例
 */

require __DIR__.'/../vendor/autoload.php';
$config = include __DIR__.'/config.php';


$sdk = new Dxstudio\CwtSDK\MerchantSDK( $config['gateway'], $config['key'], $config['secret'] );

//获取回调处理工具类
$responseUtils = $sdk->getResponseCallbackUtils();

//验证签名
if( !$responseUtils->verifySign() ){
    exit('验证签名失败');
}


//获取回调类型，根据不同回调类型处理业务
if( $responseUtils->getType() == 7 ){

    //获取订单号
    $orderId = $responseUtils->getOrderId();
    //获取您系统的订单号
    $localOrderId = $responseUtils->getLocalOrderId();

    //获取其他回调参数，此部分见文档
    $params = $responseUtils->getParams();

    /**
     * 处理你的业务
     * ....................
     */

    //响应成功
    $responseUtils->responseSuccess();

}