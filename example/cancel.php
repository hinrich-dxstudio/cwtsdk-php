<?php
/**
 * 取消提款订单的示例
 */

require __DIR__.'/../vendor/autoload.php';
$config = include __DIR__.'/config.php';


try {

    $sdk = new Dxstudio\CwtSDK\MerchantSDK( $config['gateway'], $config['key'], $config['secret'] );
    $cancelParam = \Dxstudio\CwtSDK\RequestCancelOrderParamBuilder::builder()
        ->setOrderId( 'G18B3ECF8BA20027A9IRY' );

    $r = $sdk->cancelOrder( $cancelParam );

    if( $r->getCancelStatus() == 0){
        echo '取消成功';
    }

}catch ( Exception $e ){
    var_dump( $e->getMessage() );
}

