<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\NINAGateway\OnePay\Message;

use Omnipay\Common\Message\AbstractResponse;
class Response extends AbstractResponse
{
    use Concerns\ResponseProperties;

    public function isSuccessful(): bool
    {
        return '0' === $this->getCode();
    }

    public function isCancelled(): bool
    {
        return '99' === $this->getCode();
    }

    public function getMessage(): ?string
    {
        return $this->data['vpc_Message'] ?? null;
    }

    public function getCode(): ?string
    {
        return $this->data['vpc_TxnResponseCode'] ?? null;
    }

    public function getTransactionId(): ?string
    {
        return $this->data['vpc_MerchTxnRef'] ?? null;
    }

    public function getTransactionReference(): ?string
    {
        return $this->data['vpc_TransactionNo'] ?? null;
    }
}
