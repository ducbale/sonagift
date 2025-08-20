<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\NINAGateway\Momo\Message;
use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;

abstract class AbstractResponse extends BaseAbstractResponse
{
    use Concerns\ResponseProperties;
    public function isSuccessful(): bool
    {
        return '0' === $this->getCode();
    }
    public function isCancelled(): bool
    {
        return '49' === $this->getCode();
    }
    public function getMessage(): ?string
    {
        return $this->data['message'] ?? null;
    }
}