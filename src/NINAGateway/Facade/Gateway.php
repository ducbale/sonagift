<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\NINAGateway\Facade;

use NINA\Core\Support\Facades\Facade;
use Omnipay\Common\CreditCard;

/**
 * @method static gateway(Gateway $class)
 */
class Gateway extends Facade
{
    public static function creditCard($parameters = null): CreditCard {
        return new CreditCard($parameters);
    }
    protected static function getFacadeAccessor(): string {
        return 'gateway';
    }
}