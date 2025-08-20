<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\NINAGateway\OnePay\Message\Concerns;
use Omnipay\Common\Exception\InvalidResponseException;
use NINA\NINAGateway\OnePay\Support\Signature;

trait ResponseSignatureValidation
{
    protected function validateSignature(): void
    {
        $data = $this->getData();

        if (! isset($data['vpc_SecureHash'])) {
            throw new InvalidResponseException('Response from OnePay is invalid!');
        }
        $dataSignature = array_filter($data, function ($parameter) {
            return 0 === strpos($parameter, 'vpc_') && 'vpc_SecureHash' !== $parameter;
        }, ARRAY_FILTER_USE_KEY);
        $signature = new Signature(
            $this->getRequest()->getVpcHashKey()
        );

        if (! $signature->validate($dataSignature, $data['vpc_SecureHash'])) {
            throw new InvalidResponseException(sprintf('Data signature response from OnePay is invalid!'));
        }
    }
}
