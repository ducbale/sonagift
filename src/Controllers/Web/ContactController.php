<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Controllers\Web;

use NINA\Controllers\Controller;
use Illuminate\Http\Request;
use NINA\Core\Support\Facades\BreadCrumbs;
use NINA\Core\Support\Facades\View;
use NINA\Core\Support\Facades\Func;
use NINA\Core\Support\Facades\Email;
use NINA\Models\NewslettersModel;
use NINA\Models\StaticModel;
use NINA\Traits\TraitSave;
use NINA\Core\Support\Facades\Seo;
use Validator;

class ContactController extends  Controller
{
    use TraitSave;
    public function index(Request $request)
    {
        $contact = StaticModel::where('type', 'lienhe') ->first();
        $seoPage = $contact->getSeo('static', 'save')->first();
        $seoPage['type'] = 'article';
        $titleMain = __('web.lienhe');
        BreadCrumbs::setBreadcrumb(type: $this->type, title:$titleMain);
        Seo::setSeoData($seoPage, 'news');
        return View::share(['com' => $this->type])->view('contact.contact', ['contact' => $contact,'titleMain'=>$titleMain]);
    }
    public function submit(Request $request)
    {
        $responseCaptcha = $_POST['recaptcha_response_contact'];
        $resultCaptcha = Func::checkRecaptcha($responseCaptcha);
        $scoreCaptcha = (!empty($resultCaptcha['score'])) ? $resultCaptcha['score'] : 0;
        $actionCaptcha = (!empty($resultCaptcha['action'])) ? $resultCaptcha['action'] : '';
        $testCaptcha = (!empty($resultCaptcha['test'])) ? $resultCaptcha['test'] : false;

        $validator = Validator::makeValidate($request, [
            'email' => 'required|email',
        ], [
            'email.required' => __('web.emailkhongduocdetrong'),
            'email.email' => __('web.emailkhongdungdinhdang'),
        ]);

        $dataContact = (!empty($request->dataContact)) ? $request->dataContact : null;

        if (($scoreCaptcha >= 0.5 && $actionCaptcha == 'contact') || $testCaptcha == true) {
            foreach ($dataContact as $column => $value) {
                $data[$column] = htmlspecialchars(Func::sanitize($value));
            }

            $data['confirm_status'] = 1;
            $data['type'] = 'lien-he';
            $data['status'] = '1';
            $data['date_created'] = time();
            $itemSave = NewslettersModel::create($data);
            if (!empty($itemSave)) {
                $id_insert = $itemSave->id;
                $file = $request->file('file');
                $this->insertImge(NewslettersModel::class, $request, $file, $id_insert, 'file', 'file_attach');

                $arrayEmail = null;
                $subject = (!empty($dataContact['subject'])) ? $dataContact['subject'] : __('web.thulienhekhachhang');
                $message = Email::markdown('contact.send', $dataContact);
                $optCompany = json_decode(Func::setting('options'), true);
                $company = Func::setting();
                $file = 'file';

                if (Email::send("admin", $arrayEmail, $subject, $message, $file, $optCompany, $company)) {
                    $arrayEmail = array(
                        "dataEmail" => array(
                            "name" => $dataContact['fullname'],
                            "email" => $dataContact['email']
                        )
                    );

                    Email::send("customer", $arrayEmail, $subject, $message, $file, $optCompany, $company);
                    return transfer(__('web.thongtinlienhethanhcong'), true, linkReferer());
                } else {
                    return transfer(__('web.thongtinlienhethatbai'), false, linkReferer());
                }
            } else {
                return transfer(__('web.thongtinlienhethatbai'), false, linkReferer());
            }
        } else {
            return transfer(__('web.thongtinlienhethatbai'), false, linkReferer());
        }
    }
}
