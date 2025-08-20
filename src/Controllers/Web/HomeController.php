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

use Carbon\Carbon;
use Illuminate\Http\Request;
use NINA\Controllers\Controller;
use NINA\Models\PhotoModel;
use NINA\Models\NewsModel;
use NINA\Models\ProductModel;
use NINA\Models\ProductListModel;
use NINA\Models\SettingModel;
use NINA\Models\StaticModel;
use NINA\Models\ProductCatModel;
use NINA\Models\TagsModel;
use NINA\Core\Support\Facades\View;
use NINA\Core\Support\Facades\Func;
use NINA\Core\Support\Facades\Email;
use NINA\Models\NewslettersModel;


class HomeController extends Controller
{
    public function index(Request $request)
    {

        $lang = $this->lang;

        $slider = PhotoModel::select('name'.$lang, 'photo', 'link','type')
            ->where('type', 'slide')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $slider_m = PhotoModel::select('name'.$lang, 'photo', 'link','type')
            ->where('type', 'slide-m')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $productNB = ProductModel::select('name'.$lang, 'photo', 'desc'.$lang, $this->sluglang.' as slug', 'regular_price', 'sale_price', 'discount', 'id','type','status')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['noibat1'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();


        $listProductNB = ProductListModel::select('name'.$lang, 'photo', 'id', $this->sluglang.' as slug','type')
            ->with(['getItemsNB'=>function ($query) {
                $query->select('name'.$this->lang, 'photo',$this->sluglang.' as slug','desc'.$this->lang,'id','id_list')
                    ->where('type','san-pham')
                    ->orderBy('numb', 'desc')
                    ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
                    ->whereRaw("FIND_IN_SET(?,status)", ['noibat']);
            }])
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['noibat'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $newsHome = NewsModel::select('name'.$lang, 'photo', 'desc'.$lang, $this->sluglang.' as slug','date_created','id','type','created_at')
            ->where('type', 'bai-viet')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['noibat'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $newsHome1 = NewsModel::select('name'.$lang, 'photo', 'desc'.$lang, $this->sluglang.' as slug','date_created','id','type','created_at')
            ->where('type', 'bai-viet-1')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['noibat'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $listProductNB1 = ProductListModel::select('name'.$lang,'desc'.$lang, 'photo','icon','id', $this->sluglang.' as slug','type')
            ->withcount(['getItemsNB'=>function ($query) {
                $query->whereRaw("FIND_IN_SET(?,status)", ['hienthi']);
            }])
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['noibat1'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();


        $quangcao = PhotoModel::select('name'.$lang, 'photo','desc'.$lang, 'link','id','type')
            ->where('type', 'quang-cao')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->get();

        $feedback = NewsModel::select('name'.$lang, 'photo', 'desc'.$lang,'office'.$lang,'id','type','created_at')
            ->where('type', 'feedback')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $proFlashsale = ProductModel::select('name'.$lang, 'photo','photo2', 'desc'.$lang, $this->sluglang.' as slug', 'regular_price', 'sale_price', 'discount', 'id','type','status')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['fsale'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        /* SEO */
        $titleMain = SettingModel::pluck('namevi')->first();
        $this->seoPage($titleMain);
        return View::share('com', 'trang-chu')->view('home.index', compact('slider_m','proFlashsale','newsHome1','feedback','quangcao','listProductNB1','slider', 'productNB', 'listProductNB','newsHome'));
    }
    public function letter(Request $request) {

        $responseCaptcha = $_POST['recaptcha_response_newsletter'];
        $resultCaptcha = Func::checkRecaptcha($responseCaptcha);
        $scoreCaptcha = (!empty($resultCaptcha['score'])) ? $resultCaptcha['score'] : 0;
        $actionCaptcha = (!empty($resultCaptcha['action'])) ? $resultCaptcha['action'] : '';
        $testCaptcha = (!empty($resultCaptcha['test'])) ? $resultCaptcha['test'] : false;
        if (($scoreCaptcha >= 0.5 && $actionCaptcha == 'Newsletter') || $testCaptcha == true) {
            $data['fullname'] = $request->input('fullname')??'';
            $data['phone'] = $request->input('phone')??''; 
            $data['email'] = $request->input('email')??''; 
            $data['address'] = $request->input('address')??''; 
            $data['content'] = $request->input('content')??''; 
            $data['date_created'] = Carbon::now()->timestamp;
            $data['confirm_status'] = 1;
            $data['type'] = 'dang-ky-nhan-tin';
            $data['subject'] = "Đăng ký nhận tin";
            if(NewslettersModel::create($data)){
                transfer(__('web.dangkynhantinthanhcong'),1,PeceeRequest()->getHeader('http_referer'));
            }else{
                transfer(__('web.dangkynhantinthatbai'),0,PeceeRequest()->getHeader('http_referer'));
            }
        } else {
            return transfer(__('web.dangkynhantinthatbai'),0,PeceeRequest()->getHeader('http_referer'));
        }
    }
    // public function ajaxProduct(Request $request)
    // {
    //     $id = $request->get('id') ?? 0;
    //     $type = $request->get('type') ?? 0;

    //     $query = ProductModel::select('name'.$lang, 'photo', 'desc'.$lang. 'as desc', $this->sluglang.' as slug', 'regular_price', 'sale_price', 'discount', 'id')
    //         ->where('type', 'san-pham')
    //         ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
    //         ->whereRaw("FIND_IN_SET(?,status)", ['noibat']);

    //     if (!empty($type) && $type == 'cat') {
    //         $query->where('id_cat', $id);
    //         $productAjax = $query->orderBy('id', 'desc')->get();
    //     }

    //     if (!empty($type) && $type == 'goi-y-hom-nay') {
    //         $rows = TagsModel::select('name'.$lang, 'desc'.$lang. 'as desc', 'type', 'id')
    //             ->where('id', $id)
    //             ->first();
    //         $productAjax = $rows->products()->get();
    //     }

    //     return view('ajax.homeProduct', ['productAjax' => $productAjax]);
    // }
    public function videoHome(Request $request)
    {   
        $lang = $this->lang;
        $id = $request->get('id') ?? 0;
        $video = PhotoModel::select('id', 'name'.$lang, 'photo', 'link', 'link_video') 
            ->where('type', 'video')
            ->where('com', 'photo-album')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi']); 
        if (!empty($id))  {
            $video->where('id', $id); 
        }
        $video  = $video->get();
         //dd($video);
        return view('ajax.video', ['video' => $video]);
    }
    public function ajaxProduct(Request $request)
    {

        $lang = $this->lang;

        $id_cat = $request->get('id_cat') ?? 0;
        $id_list = $request->get('id_list') ?? 0;
        $type = $request->get('type') ?? 0;
        $status = $request->get('status') ?? 0;
        $other = $request->get('other') ?? 1;
        $template = $request->get('template') ?? '';
        $slug = $request->get('slug') ?? '';
        $paginate = $request->get('paginate') ?? 8;
        $page = $request->get('page') ?? 1; // Nhận trang hiện tại từ request
        $view = 'ajax.'.'homeProduct'.$template;
        
        $query = ProductModel::select('name'.$lang, 'photo','photo2', 'desc'.$lang, $this->sluglang.' as slug', 'regular_price', 'sale_price', 'discount', 'id','type','status')
            ->where('type', 'san-pham')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", [$status])
            ->when($id_list,function($query,$id_list){
                $query->where('id_list',$id_list);
            })
            ->when($id_cat,function($query,$id_cat){
                $query->where('id_cat',$id_cat);
            })
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc');

            if (!empty($template)) {
                $productAjax = $query->get();
                $data = ['productAjax' => $productAjax,'id'=>$id_list];
            }else{
                if($other == 1){
                    $productAjax = $query->paginate($paginate);
                    $data = ['productAjax' => $productAjax,'other'=>$other];
                }elseif($other == 2){
                    $productAjax = $query->limit($paginate)->get();
                    $data = ['productAjax' => $productAjax,'other'=>$other,'slug'=>$slug];
                }elseif($other == 3){
                    $productAjax = $query->paginate($paginate, ['*'], 'page', $page); // Sử dụng phân trang với page
                    $currentPage = $productAjax->currentPage();
                    $lastPage = $productAjax->lastPage();
                    $data = [
                        'productAjax' => $productAjax,
                        'other' => $other,
                        'currentPage' => $currentPage,
                        'lastPage' => $lastPage,
                    ];
                }else{
                    $productAjax = $query->paginate($paginate);
                    $data = ['productAjax' => $productAjax,'other'=>$other];
                }
            }

        return view($view, $data);

    }
    public function ajaxNews(Request $request)
    {

        $lang = $this->lang;

        $id_cat = $request->get('id_cat') ?? 0;
        $id_list = $request->get('id_list') ?? 0;
        $type = $request->get('type') ?? 0;
        $paginate = $request->get('paginate') ?? 8;
        $view = 'ajax.'.'homeNews';
        
        $query = NewsModel::select('name'.$lang, 'photo', 'desc'.$lang, $this->sluglang.' as slug', 'id','type')
            ->where('type', $type)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['noibat'])
            ->when($id_list,function($query,$id_list){
                $query->where('id_list',$id_list);
            })
            ->when($id_cat,function($query,$id_cat){
                $query->where('id_cat',$id_cat);
            })
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc');

            if (!empty($template)) {
                $NewsAjax = $query->get();
                $data = ['NewsAjax' => $NewsAjax,'id'=>$id_list];
            }else{
                $NewsAjax = $query->paginate($paginate);
                $data = ['NewsAjax' => $NewsAjax];
            }

        return view($view, $data);

    }
}
