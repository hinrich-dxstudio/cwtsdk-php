<?php
/**
 * 回调示例
 */

require __DIR__.'/../vendor/autoload.php';
$config = include __DIR__.'/config.php';


$sdk = new Dxstudio\CwtSDK\MerchantSDK( $config['gateway'], $config['key'], $config['secret'] );

//获取回调处理工具类
$responseUtils = $sdk->getResponseCallbackUtils( );

//验证签名
if( !$responseUtils->verifySign() ){
    exit('验证签名失败');
}



//获取订单号
$orderId = $responseUtils->getOrderId();
//获取您系统的订单号
$localOrderId = $responseUtils->getLocalOrderId();

//获取回调类型，根据不同回调类型处理业务，7为订单全部完成（即已全部收款）
if( $responseUtils->getType() == 7 ){

    //获取其他回调参数，此部分见文档
    $params = $responseUtils->getParams();

    /**
     * 处理你的业务
     * ....................
     * 把你的订单 localOrderId 改为完成，也可再校验一下金额
     */

    //响应成功
    $responseUtils->responseSuccess();

}

//处理取消回调
if( $responseUtils->getType() == 6 ){

    //获取取消相关的回调参数
    $params = $responseUtils->getParams();

    /**
     * 处理你的业务
     * ......
     */

    //响应成功
    $responseUtils->responseSuccess();

}

//因为我方系统在未收到您明确的 success 时，会不断尝试重试。
//这里为了不频繁收到其他状态的回调，对所有其他未知状态 输出 success
$responseUtils->responseSuccess();