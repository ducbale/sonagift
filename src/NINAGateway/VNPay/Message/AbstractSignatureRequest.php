<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\NINAGateway\VNPay\Message;
use Omnipay\Common\Message\AbstractRequest;
use NINA\NINAGateway\VNPay\Concerns\Parameters;
use NINA\NINAGateway\VNPay\Concerns\ParametersNormalization;
abstract class AbstractSignatureRequest extends AbstractRequest
{
    use Parameters;
    use ParametersNormalization;
    use Concerns\RequestEndpoint;
    use Concerns\RequestSignature;

    public function initialize(array $parameters = [])
    {

        parent::initialize(
            $this->normalizeParameters($parameters)
        );
        $this->setVnpIpAddr(
            $this->getVnpIpAddr() ?? $this->httpRequest->getClientIp()
        );
        $this->setVnpCreateDate(
            $this->getVnpCreateDate() ?? date('Ymdhis')
        );

        return $this;
    }

    public function getData(): array
    {
        call_user_func_array(
            [$this, 'validate'],
            $this->getSignatureParameters()
        );
        $parameters = $this->getParameters();
        $parameters['vnp_SecureHash'] = $this->generateSignature(
            $parameters['vnp_SecureHashType'] = $this->getSecureHashType() ?? 'sha512'
        );

        unset($parameters['vnp_HashSecret'], $parameters['testMode'],$parameters['vnp_SecureHashType']);
        return $parameters;
    }
    public function getDataQueryTransaction(): array
    {
        $parameters = $this->getParameters();
        $parameters['vnp_SecureHash'] = $this->generateSignatureQueryTransaction(
            $parameters['vnp_SecureHashType'] = $this->getSecureHashType() ?? 'sha512'
        );
        unset($parameters['vnp_HashSecret'], $parameters['testMode'],$parameters['vnp_SecureHashType']);
        return $parameters;
    }
    public function getVnpTxnRef(): ?string
    {
        return $this->getTransactionId();
    }
    public function setVnpTxnRef(?string $ref)
    {
        return $this->setTransactionId($ref);
    }
    public function getTransactionId(): ?string
    {
        return $this->getParameter('vnp_TxnRef');
    }
    public function setTransactionId($value)
    {
        return $this->setParameter('vnp_TxnRef', $value);
    }
    public function getVnpOrderInfo(): ?string
    {
        return $this->getParameter('vnp_OrderInfo');
    }
    public function setVnpOrderInfo(?string $info)
    {
        return $this->setParameter('vnp_OrderInfo', $info);
    }
    public function getVnpCreateDate(): ?string
    {
        return $this->getParameter('vnp_CreateDate');
    }
    public function setVnpCreateDate(?string $date)
    {
        return $this->setParameter('vnp_CreateDate', $date);
    }
    public function getVnpIpAddr(): ?string
    {
        return $this->getClientIp();
    }
    public function setVnpIpAddr(?string $ip)
    {
        return $this->setClientIp($ip);
    }
    public function getClientIp(): ?string
    {
        return $this->getParameter('vnp_IpAddr');
    }
    public function setClientIp($value)
    {
        return $this->setParameter('vnp_IpAddr', $value);
    }
    public function getSecureHashType(): ?string
    {
        return $this->getParameter('vnp_SecureHashType');
    }
    public function setSecureHashType(?string $secureHashType)
    {
        return $this->setParameter('vnp_SecureHashType', $secureHashType);
    }
}