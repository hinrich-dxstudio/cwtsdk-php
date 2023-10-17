<?php

namespace Dxstudio\CwtSDK;

use Exception;

class MerchantSDK
{

    private $gateway;

    private $key;

    private $secret;

    private $version = 'v1';

    /**
     * @param string $gateway 网关地址
     * @param string $key API KEY，从团队端API管理获取
     * @param string $secret API SECRET， 从团队端API管理获取
     */
    function __construct( string $gateway, string $key, string $secret ){

        if( substr($gateway, -1) !== '/' ) $gateway = $gateway.'/';

        $this->gateway = $gateway;
        $this->key = $key;
        $this->secret = $secret;

    }


    /**
     * 创建订单
     * @throws Exception
     */
    public function createOrder(RequestCreateOrderParamBuilder $paramBuilder ): ResponseCreateOrder
    {

        $path = $this->getFullPath('collect/create');
        $params = $this->appendKeyAndSign( $paramBuilder->getParams() );
        $result = $this->postJSON( $path , json_encode($params) );
        $r = $this->throwResultException( $result, $path );
        return new ResponseCreateOrder( $r );

    }


    /**
     * 确认收款
     * @param \RequestConfirmParamBuilder $paramBuilder
     * @return ResponseConfirm
     * @throws Exception
     */
    public function confirm( \RequestConfirmParamBuilder $paramBuilder): ResponseConfirm
    {

        $path = $this->getFullPath('collect/confirm');
        $params = $this->appendKeyAndSign( $paramBuilder->getParams() );
        $result = $this->postJSON( $path , json_encode($params) );
        $r = $this->throwResultException( $result, $path );
        return new ResponseConfirm( $r );

    }

    /**
     * 取消订单，注意，此方法只会尝试拦截，如已有子订单在付款中，取消并不会实际生效(请以收到的回调为准)
     * @param RequestCancelOrderParamBuilder $paramBuilder
     * @return ResponseCancelOrder
     * @throws Exception
     */
    public function cancelOrder( RequestCancelOrderParamBuilder $paramBuilder): ResponseCancelOrder
    {

        $path = $this->getFullPath('collect/cancel');
        $params = $this->appendKeyAndSign( $paramBuilder->getParams() );
        $result = $this->postJSON( $path , json_encode($params) );
        $r = $this->throwResultException( $result, $path );
        return new ResponseCancelOrder( $r );

    }


    /**
     * 根据订单号查询订单
     * @param RequestQueryOrderOneParamBuilder $paramBuilder
     * @return ResponseQueryOrder
     * @throws Exception
     */
    public function queryOrder( RequestQueryOrderOneParamBuilder $paramBuilder)
    {

        $path = $this->getFullPath('collect/query');
        $params = $this->appendKeyAndSign( $paramBuilder->getParams() );
        $result = $this->postJSON( $path , json_encode($params) );
        $r = $this->throwResultException( $result, $path );

        return new ResponseQueryOrder( $r->records[0] );

    }


    public function getResponseCallbackUtils()
    {

        $postStr = file_get_contents('php://input');
        if(empty($postStr)) return null;
        $params = json_decode($postStr,true);
        if( empty($params) ) return null;

        return new CallbackUtils( $this->secret, $params );

    }


    /**
     * @throws Exception
     */
    private function throwResultException(array $result, string $path){

        if( $result[0] != 200 ){
            throw new Exception( 'url 请求错误: '+$path.'  '.$result[1] );
        }
        if( empty($result[1]) ){
            throw new Exception( '无任何响应');
        }
        $r = json_decode($result[1]);
        if( !$r->success ){
            throw new Exception( $r->message , $r->code);
        }

        return $r->result;

    }

    private function appendKeyAndSign( array $params ) : array{
        $params['key'] = $this->key;
        $sign = SignUtils::getSign($params,$this->secret);
        $params['sign'] = $sign;
        return $params;
    }

    private function getFullPath( string $method ) : string{

        return $this->gateway.$this->version.'/'. $method;

    }


    private function postJSON( $url, $jsonStr ): array
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8'
            )
        );
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return array($httpCode, $response);

    }


}