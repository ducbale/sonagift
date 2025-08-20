<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\NINAGateway\VTCPay;

use Omnipay\Common\AbstractGateway;
use NINA\NINAGateway\VTCPay\Message\PurchaseRequest;
use NINA\NINAGateway\VTCPay\Message\NotificationRequest;
use NINA\NINAGateway\VTCPay\Message\CompletePurchaseRequest;

class Gateway extends AbstractGateway
{
    use Concerns\Parameters;
    use Concerns\ParametersNormalize;

    public function getName(): string
    {
        return 'VTCPay';
    }
    public function initialize(array $parameters = []): Gateway
    {
        return parent::initialize(
            $this->normalizeParameters($parameters)
        );
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\AbstractRequest|PurchaseRequest
     */
    public function purchase(array $options = []): PurchaseRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\AbstractRequest|CompletePurchaseRequest
     */
    public function completePurchase(array $options = []): CompletePurchaseRequest
    {
        return $this->createRequest(CompletePurchaseRequest::class, $options);
    }

    /**
     * Khởi tạo IPN request tiếp nhận từ VTCPay gửi sang.
     *
     * @return \Omnipay\Common\Message\AbstractRequest|NotificationRequest
     */
    public function notification(array $options = []): NotificationRequest
    {
        return $this->createRequest(NotificationRequest::class, $options);
    }
}
