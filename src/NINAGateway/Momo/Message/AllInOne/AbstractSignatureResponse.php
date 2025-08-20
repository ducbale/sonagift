<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\NINAGateway\Momo\Message\AllInOne;
use NINA\NINAGateway\MoMo\Message\AbstractSignatureResponse as BaseAbstractSignatureResponse;
abstract class AbstractSignatureResponse extends BaseAbstractSignatureResponse
{
    public function getCode(): ?string
    {
        return $this->data['errorCode'] ?? null;
    }
    public function getTransactionId(): ?string
    {
        return $this->data['orderId'] ?? null;
    }
    public function getTransactionReference(): ?string
    {
        return $this->data['transId'] ?? null;
    }
}