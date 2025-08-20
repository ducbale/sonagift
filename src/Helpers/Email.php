<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Helpers;
use Illuminate\Http\Request;
use NINA\Core\Singleton;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email
{
    use Singleton;
    private $d;
    private $data = array();
    private $company = array();
    private $optcompany = '';

    function __construct()
    {
    }

    public function set($key, $value)
    {
        if (!empty($key) && !empty($value)) {
            $this->data[$key] = $value;
        }
    }

    public function get($key)
    {
        return (!empty($this->data[$key])) ? $this->data[$key] : '';
    }


    public function addAttrs($array1 = array(), $array2 = array())
    {
        if (!empty($array1) && !empty($array2)) {
            foreach ($array2 as $k2 => $v2) {
                array_push($array1, $v2);
            }
        }

        return $array1;
    }

    public function markdown($path = '', $params = array())
    {
        $content = '';

        if (!empty($path)) {
            ob_start();
            view($path, ['params' => $params]);
            $content = ob_get_contents();
            ob_clean();
        }
        return $content;
    }

    public function send($owner = '', $arrayEmail = array(), $subject = "", $message = "", $file = '', $optCompany = array(), $company = array())
    {
        $mail = new PHPMailer(true);

        $config_host = '';
        $config_port = 0;
        $config_secure = '';
        $config_email = '';
        $config_password = '';

        if ($optCompany['mailertype'] == 1) {
            $config_host = $optCompany['ip_host'];
            $config_port = $optCompany['port_host'];
            $config_secure = $optCompany['secure_host'];
            $config_email = $optCompany['email_host'];
            $config_password = $optCompany['password_host'];

            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPDebug = false;
            $mail->SMTPSecure = $config_secure;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
        } else if ($optCompany['mailertype'] == 2) {
            $config_host = $optCompany['host_gmail'];
            $config_port = $optCompany['port_gmail'];
            $config_secure = $optCompany['secure_gmail'];
            $config_email = $optCompany['email_gmail'];
            $config_password = $optCompany['password_gmail'];
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPDebug = false;
            $mail->SMTPSecure = $config_secure;
        }

        $mail->Host = $config_host;
        if ($config_port) {
            $mail->Port = $config_port;
        }
        $mail->Username = $config_email;
        $mail->Password = $config_password;
        $mail->SetFrom($config_email, $company['namevi']);


        if ($owner == 'admin') {
            $mail->AddAddress($optCompany['email'], $company['namevi']);
        } else if ($owner == 'customer') {
            if ($arrayEmail && count($arrayEmail) > 0) {
                foreach ($arrayEmail as $vEmail) {
                    $mail->AddAddress($vEmail['email'], $vEmail['name']);
                }
            }
        }
        $mail->AddReplyTo($optCompany['email'], $company['namevi']);
        $mail->CharSet = "utf-8";
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
        $mail->Subject = $subject;

        $mail->MsgHTML($message);

        if ($file != '' && isset($_FILES[$file]) && !$_FILES[$file]['error']) {
            $mail->AddAttachment($_FILES[$file]["tmp_name"], $_FILES[$file]["name"]);
        }

        if ($mail->Send()) return true;
        else return false;
    }
}
