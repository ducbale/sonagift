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

class PayQueryStatusResponse extends AbstractResponse
{
    public function getCode(): ?string
    {
        return $this->data['status'] ?? null;
    }
    public function getTransactionId(): ?string
    {
        return $this->data['data']['billId'] ?? null;
    }
    public function getTransactionReference(): ?string
    {
        return $this->data['data']['transid'] ?? null;
    }
}