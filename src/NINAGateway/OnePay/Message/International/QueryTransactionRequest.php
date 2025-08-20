<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\NINAGateway\OnePay\Message\International;

use NINA\NINAGateway\OnePay\Message\AbstractQueryTransactionRequest;
class QueryTransactionRequest extends AbstractQueryTransactionRequest
{
    protected $testEndpoint = 'https://mtf.onepay.vn/vpcpay/Vpcdps.op';

    protected $productionEndpoint = 'https://onepay.vn/vpcpay/Vpcdps.op';
}
