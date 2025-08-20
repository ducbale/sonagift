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
use Omnipay\Common\Message\RedirectResponseInterface;
class PurchaseResponse extends AbstractSignatureResponse implements RedirectResponseInterface
{
    public function isSuccessful(): bool
    {
        return false;
    }
    public function isRedirect(): bool
    {
        return isset($this->data['payUrl']);
    }
    public function getRedirectUrl(): string
    {
        return $this->data['payUrl'];
    }
    protected function getSignatureParameters(): array
    {
        return [
            'requestId', 'orderId', 'message', 'localMessage', 'payUrl', 'errorCode', 'requestType',
        ];
    }
}