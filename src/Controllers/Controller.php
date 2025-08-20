<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Controllers;
use NINA\Core\Routing\NINAController;
use NINA\Core\Support\Facades\Seo;
use NINA\Models\SeoPageModel;


class Controller extends NINAController
{
    protected string $lang;
    protected string $sluglang;
    protected string $seolang;
    protected ?string $type;
    protected array $configTypeArr;
    
    public function __construct(){
  
        $this->lang = session()->get('locale')??config('app.lang_default');
        $this->sluglang = (count(config('app.slugs') ) > 1) ? 'slug'.$this->lang : 'slug'.config('app.lang_default'); 
        $this->seolang = app()->getSeoLang();
        $this->type = (config('app.langconfig') === 'link') ? request()->segment(2) : (request()->segment(1)??'trang-chu');
        $this->configTypeArr = json_decode(json_encode(config('type')), true);
    }
    public function seoPage( $titleMain = '',$type=null): void {
        $seoPage = SeoPageModel::select('*')
            ->where('type', $this->type)
            ->first();
        $seoPage['title' . $this->lang] = $seoPage['title' . $this->lang]?? $titleMain;
        $seoPage['type'] = $type??'website';
        Seo::setSeoData($seoPage,'seopage', 'seopage');
    }
    public function infoSeo($com = '', $type = '', ...$field){
        return config('type.' . $com . '.' . $type . '.website.'.implode('.',$field))??[];
    }

}