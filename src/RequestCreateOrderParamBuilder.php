<?php

namespace Dxstudio\CwtSDK;

use Exception;

class RequestCreateOrderParamBuilder extends ParamBuilder
{

    //参数
    protected $params = [
        'localOrderId' => '',
        'type' => 1,
        'cash' => 0,
        'minRemain' => 0,
        'maxOrderNum' => 1,
        'waitTime' => 15 * 60,
        'notifyUrl' => '',
        'needConfirm' => 0,
        'allCall' => 0,
        'timeoutProcess' => 0,
        'payments' => []
    ];

    /**
     * @return RequestCreateOrderParamBuilder
     */
    static public function builder(): RequestCreateOrderParamBuilder{

        return new RequestCreateOrderParamBuilder();

    }

    /**
     * 设置本地订单号，本地订单号指 商户系统的订单号（必须唯一）
     * @param string $orderId
     * @return RequestCreateOrderParamBuilder
     */
    public function setLocalOrderId( string $orderId ): RequestCreateOrderParamBuilder{
        $this->params['localOrderId'] = $orderId;
        return $this;
    }


    /**
     * 设置金额
     * @param float $cash
     * @return RequestCreateOrderParamBuilder
     */
    public function setAmount( float $amount ): RequestCreateOrderParamBuilder{
        $this->params['cash'] = $amount;
        return $this;
    }

    /**
     * 设置回调地址，注意回调地址对应的IP 需要找运营加入白名单
     * @param string $url
     * @return RequestCreateOrderParamBuilder
     * @throws Exception
     */
    public function setNotifyUrl( string $url ): RequestCreateOrderParamBuilder{
        if( filter_var($url, FILTER_VALIDATE_URL) === false ) throw new Exception('回调地址格式错误');
        $this->params['notifyUrl'] = $url;
        return $this;
    }


    /**
     * 设置最大等待时间
     * @param int $seconds
     * @return RequestCreateOrderParamBuilder
     */
    public function setWaitTime( int $seconds ): RequestCreateOrderParamBuilder{
        $this->params['waitTime'] = $seconds;
        return $this;
    }


    /**
     * 是否自动确认收款，为true时，您不需要再调用确认接口，为false时，您需要在收到回调后再调用确认接口。
     * @param bool $isAutoConfirm
     * @return $this
     */
    public function setAutoConfirm( bool $isAutoConfirm ): RequestCreateOrderParamBuilder{

        $this->params['needConfirm'] = $isAutoConfirm?0:1;
        return $this;
    }


    /**
     * 是否需要完整回调
     * 如果为true，您将接收到提款过程的所有回调
     * 如果为false，您就仅接收简单的完成、取消回调
     * @param bool $isAllCallback
     * @return $this
     */
    public function setIsAllCallback( bool $isAllCallback ): RequestCreateOrderParamBuilder
    {
        $this->params['allCall'] = $isAllCallback?1:0;
        return $this;
    }


    /**
     * 设置超时处理方式
     * 0-超时无匹配时，自动取消
     * 1-超时无匹配时，运营介入，保证订单100%完成
     * @param int $method
     * @return $this
     */
    public function setTimeoutProcess( int $method ) : RequestCreateOrderParamBuilder
    {
        $this->params['timeoutProcess'] = $method;
        return $this;
    }


    /**
     * 设置收款银行卡
     * @param string $accountName
     * @param string $cardNumber
     * @param string $bankCode
     * @return RequestCreateOrderParamBuilder
     * @throws Exception
     */
    public function setBankInfo( string $accountName, string $cardNumber, string $bankCode ): RequestCreateOrderParamBuilder{

        $bank = [
            'type' => 0,
            'accountName' => $accountName,
            'bankerCode' => $bankCode,
            'account' => $cardNumber
        ];
        $this->params['payments'][0] = $bank;
        return $this;
    }

}