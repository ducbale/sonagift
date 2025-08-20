<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\NINAGateway\VTCPay\Message;
class NotificationRequest extends AbstractIncomingRequest
{
    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('data');

        return parent::getData();
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data): IncomingResponse
    {
        $signature = $data['signature'];
        $dataNormalized = explode('|', $data['data']);
        [$amount, $message, $payment_type, $reference_number, $status, $trans_ref_no, $website_id] = $dataNormalized;
        $data = compact(
            'amount', 'message', 'payment_type', 'reference_number', 'status', 'trans_ref_no', 'website_id'
        );
        $data['signature'] = $signature;

        return parent::sendData($data);
    }

    /**
     * {@inheritdoc}
     */
    protected function getIncomingParameters(): array
    {
        return $this->httpRequest->request->all();
    }
}
