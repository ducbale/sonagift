<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Controllers\Web;
use NINA\Core\Support\Facades\View;
use Illuminate\Http\Request;
use NINA\Controllers\Controller;
use NINA\Core\Support\Facades\Seo;
use NINA\Models\PhotoModel;
use NINA\Core\Support\Facades\BreadCrumbs;

class PhotoController extends Controller
{

    private array $template;

    private function initTemplate(?string $type = null)
    {
        $this->template['folder'] = isset($this->configTypeArr['photo'][$type ?? $this->type]['template']) ? $this->configTypeArr['photo'][$type ?? $this->type]['template'] : 'video';
        $this->template['list'] = isset($this->configTypeArr['photo'][$type ?? $this->type]['template-list']) ? $this->configTypeArr['photo'][$type ?? $this->type]['template-list'] : 'video';
    }

    public function index()
    {
        $lang = $this -> lang;
        $photo = PhotoModel::select('photo', 'name'.$lang,'type','link_video','id')
        ->where('type', $this->type)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi']) 
            ->orderBy('numb', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);  
            $titleMain = __('web.' . config('type.photo.'.$this->type.'.website.title'));
        BreadCrumbs::setBreadcrumb(type: $this->type, title: $titleMain);
        $this->seoPage($titleMain,$this->infoSeo('photo', $this->type, 'type','index'));

        $this->initTemplate();

        return View::share(['com' => $this->type])->view(implode('.', $this->template), compact('photo', 'titleMain'));
    }

    public function videoSelect(Request $request)
    { 
        $lang = $this -> lang;
        $id = $request->id??0; 
        $video = PhotoModel::select('id', 'name'.$lang, 'photo', 'link', 'link_video')
            ->where('id', $id) 
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi']) 
            ->first();
        return view('ajax.homeVideo', ['video' => $video]);
    }
}