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
use NINA\Controllers\Controller;
use NINA\Models\PhotoModel;
use NINA\Models\SettingModel;
use NINA\Models\NewsModel;
use NINA\Models\StaticModel;
use NINA\Models\ExtensionsModel;
use NINA\Models\ProductListModel;
use NINA\Models\NewsListModel;
use NINA\Models\ProductCatModel;
use NINA\Core\Container;

class AllController extends Controller
{

    function composer($view): void
    {
        
        $lang = $this->lang;

        $extHotline = '';
        $photos = PhotoModel::select('photo', 'name'.$lang, 'link', 'type')
            ->whereIn('type', ['logo', 'logoft', 'favicon', 'social', 'mangxahoi1','lien-ket','banner-qc','doitac','video-home'])
            ->whereRaw("FIND_IN_SET(?, status)", ['hienthi'])
            ->get();

        $logoPhoto = $photos->where('type', 'logo')->first();
        $logoPhotoFooter = $photos->where('type', 'logoft')->first();
        $favicon = $photos->where('type', 'favicon')->first();
        $banner_qc = $photos->where('type', 'banner-qc')->first();
        $video_home = $photos->where('type', 'video-home')->first();

        $social = $photos->where('type', 'social');
        $doitac = $photos->where('type', 'doitac');
        $lienket = $photos->where('type', 'lien-ket');
        $social1 = $photos->where('type', 'mangxahoi1');

        $listProductMenu = ProductListModel::select('name'.$lang, 'photo', $this->sluglang.' as slug', 'id')
            ->where('type', 'san-pham',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->get();

        $listProductDm = ProductListModel::select('name'.$lang, 'photo', $this->sluglang.' as slug', 'id')
            ->withcount(['getItemsNB'=>function ($query) {
                $query->whereRaw("FIND_IN_SET(?,status)", ['hienthi']);
            }])
            ->where('type', 'san-pham',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['danhmuc'])
            ->orderBy('numb', 'asc')
            ->get();
         $Contentprd = NewsModel::select('contentvi', 'numb','name'.$lang)
            ->where('type', 'Content')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereIn('numb', [3, 4])
            ->orderBy('id', 'desc')
            ->get();
        $listcatologue = NewsListModel::select('name'.$lang, 'photo', $this->sluglang.' as slug', 'id')
            ->where('type', 'catologue',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->get();

        $listBvMenu = NewsListModel::select('name'.$lang, 'photo', $this->sluglang.' as slug', 'id')
            ->where('type', 'bai-viet',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->get();

        $catProductMenu = ProductCatModel::select('name'.$lang, 'photo', $this->sluglang.' as slug', 'id')
            ->where('type', 'san-pham',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['menu'])
            ->orderBy('numb', 'asc')
            ->get();

        $footer = StaticModel::select('name'.$lang, 'content'.$lang,'photo', 'desc'.$lang, $this->sluglang.' as slug' ,'type')
            ->where('type', 'footer')
            ->first();

        $extHotline = ExtensionsModel::select('*')
            ->where('type', 'hotline')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();

        $extSocial = ExtensionsModel::select('*')
            ->where('type', 'social')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();

        $extPopup = ExtensionsModel::select('*')
            ->where('type', 'popup')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();

        $policy = NewsModel::select('name'.$lang, 'photo', $this->sluglang.' as slug', 'id')
            ->where('type', 'chinh-sach',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();


        $slogan = StaticModel::select('name'.$lang, 'photo', 'desc'.$lang,'type')
            ->where('type', 'slogan')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();

        $copyright = StaticModel::select('name'.$lang, 'photo', 'desc'.$lang,'type')
            ->where('type', 'copyright')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();

        $setting = SettingModel::first();
        $optSetting = json_decode($setting['options'], true);
        $configType = json_decode(json_encode(config('type')));
        $lang = session()->get('locale');
        $view->share(compact(
            'listcatologue',
            'listProductDm',
            'Contentprd',
            'listBvMenu',
            'copyright',
            'video_home',
            'doitac',
            'banner_qc',
            'slogan',
            'lienket',
            'configType',
            'logoPhoto',
            'logoPhotoFooter',
            'social1',
            'favicon',
            'setting',
            'optSetting',
            'listProductMenu',
            'catProductMenu',
            'social',
            'footer',
            'extHotline',
            'extSocial',
            'extPopup',
            'lang',
            'policy',
        ));
    }
}
