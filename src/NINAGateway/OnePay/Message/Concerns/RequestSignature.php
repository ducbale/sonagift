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

use NINA\NINAGateway\OnePay\Support\Signature;

trait RequestSignature
{
    protected function generateSignature(): string
    {
        $data = [];
        $signature = new Signature(
            $this->getVpcHashKey()
        );

        foreach ($this->getSignatureParameters() as $parameter) {
            $data[$parameter] = $this->getParameter($parameter);
        }

        return $signature->generate($data);
    }
    abstract protected function getSignatureParameters(): array;
}
