<?php
/**
 * 查询订单的示例
 */

require __DIR__.'/../vendor/autoload.php';
$config = include __DIR__.'/config.php';

try {

    $sdk = new Dxstudio\CwtSDK\MerchantSDK( $config['gateway'], $config['key'], $config['secret'] );
    $queryParam = \Dxstudio\CwtSDK\RequestQueryOrderOneParamBuilder::getNew()
        ->setOrderId( 'G18B3ECF8BA20027A9IRY' );


    //此处 $r 为查询到的订单，可以使用各种get方法获取订单信息，如果未查询到订单，会抛出异常
    $r = $sdk->queryOrder($queryParam);

}catch ( Exception $e ){
    var_dump($e->getMessage());
}