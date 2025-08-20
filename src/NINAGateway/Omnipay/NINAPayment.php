<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\NINAGateway\Omnipay;
use NINA\NINAGateway\Omnipay\GatewayFactory;

class NINAPayment extends \Omnipay\Omnipay
{
    private static $factory;
    public static function getFactory()
    {
        if (is_null(self::$factory)) {
            self::$factory = new GatewayFactory;
        }
        return self::$factory;
    }
    public static function setFactory(GatewayFactory|\Omnipay\Common\GatewayFactory $factory = null)
    {
        self::$factory = $factory;
    }
    public static function __callStatic($method, $parameters)
    {
        $factory = self::getFactory();

        return call_user_func_array(array($factory, $method), $parameters);
    }
}