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

class RefundRequest extends AbstractSignatureRequest
{
    protected $responseClass = RefundResponse::class;
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        $this->setParameter('requestType', 'refundMoMoWallet');

        return $this;
    }
    public function getTransactionId(): ?string
    {
        return $this->getTransId();
    }
    public function setTransactionId($value)
    {
        return $this->setTransId($value);
    }
    public function getTransId(): ?string
    {
        return $this->getParameter('transId');
    }
    public function setTransId(?string $id)
    {
        return $this->setParameter('transId', $id);
    }
    protected function getSignatureParameters(): array
    {
        return [
            'partnerCode', 'accessKey', 'requestId', 'amount', 'orderId', 'transId', 'requestType',
        ];
    }
}