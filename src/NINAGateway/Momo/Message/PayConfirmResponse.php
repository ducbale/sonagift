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

class PayConfirmResponse extends AbstractSignatureResponse
{
    protected function getSignatureParameters(): array
    {
        return [
            'amount' => 'data.amount',
            'momoTransId' => 'data.momoTransId',
            'partnerCode' => 'data.partnerCode',
            'partnerRefId' => 'data.partnerRefId',
        ];
    }
    public function getCode(): ?string
    {
        return $this->data['status'] ?? null;
    }
    public function getTransactionReference(): ?string
    {
        return $this->data['data']['momoTransId'] ?? null;
    }
    public function getTransactionId(): ?string
    {
        return $this->data['data']['partnerRefId'] ?? null;
    }
}