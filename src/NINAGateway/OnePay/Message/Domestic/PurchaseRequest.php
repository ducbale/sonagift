<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\NINAGateway\OnePay\Message\Domestic;
use NINA\NINAGateway\OnePay\Message\AbstractPurchaseRequest;

class PurchaseRequest extends AbstractPurchaseRequest
{
    protected $testEndpoint = 'https://mtf.onepay.vn/onecomm-pay/vpc.op';

    protected $productionEndpoint = 'https://onepay.vn/onecomm-pay/vpc.op';
}
