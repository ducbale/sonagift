<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\NINAGateway\OnePay\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use NINA\NINAGateway\OnePay\Concerns\Parameters;
use NINA\NINAGateway\OnePay\Concerns\ParametersNormalization;

abstract class AbstractRequest extends BaseAbstractRequest
{
    use Parameters;
    use ParametersNormalization;

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        return parent::initialize(
            $this->normalizeParameters($parameters)
        );
    }
}
