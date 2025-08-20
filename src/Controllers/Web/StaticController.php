<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.0 
 * Date 14-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Controllers\Web;
use NINA\Core\Support\Facades\View;
use Illuminate\Http\Request;
use NINA\Controllers\Controller;
use NINA\Core\Support\Facades\Seo;
use NINA\Models\StaticModel;
use NINA\Core\Support\Facades\BreadCrumbs;

class StaticController extends Controller
{
    public function index(Request $request)
    {
        $lang = $this -> lang;
        $rowDetail = StaticModel::select('name'.$lang, 'photo', 'desc'.$lang,'content'.$lang, 'photo','type','id')
            ->where('type', $this->type)
            ->first();
        $seoPage = $rowDetail->getSeo('static','save')->first();
        $seoPage['type'] = 'article';
        BreadCrumbs::setBreadcrumb(type:$this->type,title: __('web.'.config('type.static.'.$rowDetail['type'].'.website.title')));
        Seo::setSeoData($seoPage,'news');
        return View::share('com', $this->type)->view('static.static', ['static' => $rowDetail]);
    }
}
