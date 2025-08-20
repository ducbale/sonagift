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

use Omnipay\Common\GatewayInterface;

class Helper extends \Omnipay\Common\Helper
{
    public static function getGatewayClassName($shortName)
    {
        if (0 === strpos($shortName, '\\') || 0 === strpos($shortName, 'Omnipay\\')) {
            return $shortName;
        }
        if (is_subclass_of($shortName, GatewayInterface::class, true)) {
            return $shortName;
        }
        $shortName = str_replace('_', '\\', $shortName);
        if (false === strpos($shortName, '\\')) {
            $shortName .= '\\';
        }
        return '\\NINA\NINAGateway\\'.$shortName.'Gateway';
    }
}