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
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;
class PurchaseResponse extends Response implements RedirectResponseInterface
{
    private $redirectUrl;
    public function __construct(RequestInterface $request, array $data, string $redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
        parent::__construct($request, $data);
    }
    public function isSuccessful(): bool{
        return false;
    }
    public function isRedirect(): bool{
        return true;
    }
    public function getRedirectUrl(): string{
        return $this->redirectUrl;
    }
}