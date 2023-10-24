<?php
/**
 * 创建提款订单的示例
 */
require __DIR__.'/../vendor/autoload.php';
$config = include __DIR__.'/config.php';


try {

    $sdk = new Dxstudio\CwtSDK\MerchantSDK( $config['gateway'], $config['key'], $config['secret'] );
    //构建订单参数
    $createOrderParam = \Dxstudio\CwtSDK\RequestCreateOrderParamBuilder::getNew()
        ->setLocalOrderId('1111122222444444')
        ->setAmount(11.11)
        ->setNotifyUrl('http://192.168.222.187/callback.php')
        ->setWaitTime(10000)
        ->setAutoConfirm(true)
        ->setTimeoutProcess(1)
        ->setBankInfo('hinrich','1111112222221','JJBANK');

    $r = $sdk->createOrder( $createOrderParam );

    //创建成功，则可获取创建的订单号，否则会抛出异常
    $orderId = $r->getOrderId();

}catch ( Exception $e ){

    //打印错误消息
    var_dump($e->getMessage());

}

