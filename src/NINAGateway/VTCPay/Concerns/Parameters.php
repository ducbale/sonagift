<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\NINAGateway\VTCPay\Concerns;
trait Parameters
{
    /**
     * Trả về mã website.
     *
     * @return null|string
     */
    public function getWebsiteId(): ?string
    {
        return $this->getParameter('website_id');
    }

    /**
     * Thiết lập mã website.
     *
     * @param  null|string  $id
     *
     * @return $this
     */
    public function setWebsiteId(?string $id)
    {
        return $this->setParameter('website_id', $id);
    }

    /**
     * Trả về mã bảo mật.
     *
     * @return null|string
     */
    public function getSecurityCode(): ?string
    {
        return $this->getParameter('security_code');
    }

    /**
     * Thiết lập mã bảo mật dùng để tạo chữ ký dữ liệu.
     *
     * @param  string  $code
     *
     * @return $this
     */
    public function setSecurityCode(?string $code)
    {
        return $this->setParameter('security_code', $code);
    }
}
