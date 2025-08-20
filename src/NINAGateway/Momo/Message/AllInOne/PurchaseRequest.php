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
class PurchaseRequest extends AbstractSignatureRequest
{
    protected $responseClass = PurchaseResponse::class;
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        $this->setOrderInfo($this->getParameter('orderInfo') ?? '');
        $this->setExtraData($this->getParameter('extraData') ?? '');
        $this->setParameter('requestType', 'captureMoMoWallet');
        return $this;
    }
    public function getExtraData(): ?string
    {
        return $this->getParameter('extraData');
    }
    public function setExtraData(?string $data)
    {
        return $this->setParameter('extraData', $data);
    }
    public function getOrderInfo(): ?string
    {
        return $this->getParameter('orderInfo');
    }
    public function setOrderInfo(?string $info)
    {
        return $this->setParameter('orderInfo', $info);
    }
    protected function getSignatureParameters(): array
    {
        return [
            'partnerCode', 'accessKey', 'requestId', 'amount', 'orderId', 'orderInfo', 'returnUrl', 'notifyUrl',
            'extraData',
        ];
    }
}