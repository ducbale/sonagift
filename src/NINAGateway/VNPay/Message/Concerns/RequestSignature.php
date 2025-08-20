<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\NINAGateway\VNPay\Message\Concerns;

use NINA\NINAGateway\VNPay\Support\Signature;

trait RequestSignature
{
    protected function generateSignature(string $hashType = 'sha512'): string
    {
        $data = [];
        $signature = new Signature(
            $this->getVnpHashSecret(),
            $hashType
        );
        foreach ($this->getSignatureParameters() as $parameter) {
            $data[$parameter] = $this->getParameter($parameter);
        }

        return $signature->generate($data);
    }
    protected function generateSignatureQueryTransaction(string $hashType = 'sha512'): string
    {
        $data = [];
        $signature = new Signature(
            $this->getVnpHashSecret(),
            $hashType
        );
        foreach ($this->getSignatureParameters() as $parameter) {
            $data[$parameter] = $this->getParameter($parameter);
        }
        return $signature->generateQueryTransaction($data);
    }
    abstract protected function getSignatureParameters(): array;
}