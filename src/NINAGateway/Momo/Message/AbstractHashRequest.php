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

abstract class AbstractHashRequest extends AbstractRequest
{
    use Concerns\RequestHash;
    use Concerns\RequestEndpoint;
    public function getData(): array
    {
        $parameters = $this->getParameters();
        call_user_func_array([$this, 'validate'], $this->getHashParameters());
        $parameters['hash'] = $this->generateHash();
        unset($parameters['testMode'], $parameters['publicKey'], $parameters['secretKey']);
        return $parameters;
    }
}