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

class IncomingRequest extends AbstractRequest
{
    use Parameters;
    use ParametersNormalization;
    public function getData(): array
    {
        call_user_func_array(
            [$this, 'validate'],
            array_keys($parameters = $this->getIncomingParameters())
        );

        return $parameters;
    }
    public function sendData($data): SignatureResponse
    {
        return $this->response = new SignatureResponse($this, $data);
    }
    public function initialize(array $parameters = [])
    {
        parent::initialize(
            $this->normalizeParameters($parameters)
        );

        foreach ($this->getIncomingParameters() as $parameter => $value) {
            $this->setParameter($parameter, $value);
        }

        return $this;
    }
    protected function getIncomingParameters(): array
    {
        return $this->httpRequest->query->all();
    }
}