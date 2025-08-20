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

use NINA\Controllers\Controller;
use NINA\Core\Support\Facades\Seo;
use NINA\Core\Support\Facades\View;
use Illuminate\Http\Request;
use NINA\Models\NewsCatModel;
use NINA\Models\NewsItemModel;
use NINA\Models\NewsListModel;
use NINA\Models\NewsModel;
use NINA\Core\Support\Facades\BreadCrumbs;
use NINA\Models\NewsSubModel;

class NewsController extends Controller
{

    private array $template;

    private function initTemplate(?string $type = null)
    {
        $this->template['folder'] = isset($this->configTypeArr['news'][$type ?? $this->type]['template']) ? $this->configTypeArr['news'][$type ?? $this->type]['template'] : 'news';
        $this->template['list'] = isset($this->configTypeArr['news'][$type ?? $this->type]['template-list']) ? $this->configTypeArr['news'][$type ?? $this->type]['template-list'] : 'news';
    }

    public function index()
    {
        $lang = $this->lang;  

        $news = NewsModel::select('id', 'name'.$lang, 'desc'.$lang, $this->sluglang.' as slug', 'photo','type')
            ->where('type', $this->type)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->datePublish()
            ->orderBy('numb', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);
        $titleMain =  $this->infoSeo('news', $this->type, 'title');
        $titleMain = __('web.' . $titleMain);
        BreadCrumbs::setBreadcrumb(type: $this->type, title: $titleMain);
        $this->seoPage($titleMain, $this->infoSeo('news', $this->type, 'type', 'index'));

        // Template
        $this->initTemplate();

        return View::share(['com' => $this->type])->view(implode('.', $this->template), compact('news', 'titleMain'));
    }

    public function list($slug)
    {
        $lang = $this->lang;  

        $itemList = NewsListModel::select('id', 'name'.$lang, 'desc'.$lang, $this->sluglang.' as slug', 'photo', 'type')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();
        if ($this->infoSeo('news', $itemList->type, 'type', 'index')) BreadCrumbs::set(url('slugweb', ['slug' => $itemList->type]), __('web.'.$this->infoSeo('news', $itemList->type, 'title')));
        $this->type =  $itemList->type;
        $titleMain = $itemList['name'.$this->lang];
        BreadCrumbs::setBreadcrumb(list: $itemList);
        $news = $itemList->getItems(['id', 'name'.$lang, 'desc'.$lang, $this->sluglang.' as slug', 'photo', 'type'])->paginate(10);
        $seoPage = $itemList->getSeo('news-list', 'save')->first();
        $seoPage['type'] = $this->infoSeo('news', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'news', 'seo');

        $this->initTemplate($itemList['type']);

        return View::share('com', $itemList->type)->view(implode('.', $this->template), compact('news', 'titleMain'));
    }

    public function cat($slug)
    {
        $lang = $this->lang;  
        $itemCat = NewsCatModel::select('id', 'name'.$lang, 'desc'.$lang, $this->sluglang.' as slug', 'photo', 'id_list', 'type')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();
        $this->type =  $itemCat->type;
        $titleMain = $itemCat['name'.$this->lang];
        $itemList = $itemCat->getCategoryList;
        if ($this->infoSeo('news', $itemCat->type, 'type', 'index')) BreadCrumbs::set(url('slugweb', ['slug' => $itemCat->type]), __('web.'.$this->infoSeo('news', $itemCat->type, 'title')));
        BreadCrumbs::setBreadcrumb(list: $itemList, cat: $itemCat);
        $news = $itemCat->getItems(['id', 'name'.$lang, 'desc'.$lang, $this->sluglang.' as slug', 'photo', 'type'])->paginate(10);

        $seoPage = $itemList->getSeo('news-cat', 'save')->first();
        $seoPage['type'] = $this->infoSeo('news', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'news', 'seo');

        $this->initTemplate($itemCat['type']);

        return View::share('com', $itemCat->type)->view(implode('.', $this->template), compact('news', 'titleMain'));

        
    }

    public function item($slug)
    {
        $lang = $this->lang;  
        $itemItem = NewsItemModel::select('id', 'name'.$lang, 'desc'.$lang, $this->sluglang.' as slug', 'photo', 'id_list', 'id_cat', 'type')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();
        $this->type =  $itemItem->type;
        $titleMain = $itemItem['name'.$this->lang];
        $itemList = $itemItem->getCategoryList;
        $itemCat = $itemItem->getCategoryCat;
        if ($this->infoSeo('news', $itemItem->type, 'type', 'index')) BreadCrumbs::set(url('slugweb', ['slug' => $itemItem->type]), __('web'.$this->infoSeo('news', $itemItem->type, 'title')));
        BreadCrumbs::setBreadcrumb(list: $itemList, cat: $itemCat, item: $itemItem);
        $news = $itemItem->getItems(['id', 'name'.$lang, 'desc'.$lang, $this->sluglang.' as slug', 'photo', 'type'])->paginate(10);

        $seoPage = $itemList->getSeo('news-item', 'save')->first();
        $seoPage['type'] = $this->infoSeo('news', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'news', 'seo');

        $this->initTemplate($itemItem['type']);

        return View::share('com', $itemItem->type)->view(implode('.', $this->template), compact('news', 'titleMain'));
    }

    public function sub($slug)
    {
        $lang = $this->lang;  
        $itemSub = NewsSubModel::select('id', 'name'.$lang, 'desc'.$lang, $this->sluglang.' as slug', 'photo', 'id_list', 'id_cat', 'id_item', 'type')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();
        $this->type =  $itemSub->type;
        $titleMain = $itemSub['name'.$this->lang];
        $itemList = $itemSub->getCategoryList;
        $itemCat = $itemSub->getCategoryCat;
        $itemItem = $itemSub->getCategoryItem;
        if ($this->infoSeo('news', $itemSub->type, 'type', 'index')) BreadCrumbs::set(url('slugweb', ['slug' => $itemSub->type]), __('web.'.$this->infoSeo('news', $itemSub->type, 'title')));
        BreadCrumbs::setBreadcrumb(list: $itemList, cat: $itemCat, item: $itemItem, sub: $itemSub);
        $news = $itemSub->getItems(['id', 'name'.$lang, 'desc'.$lang, $this->sluglang.' as slug', 'photo', 'type'])->paginate(10);

        $seoPage = $itemList->getSeo('news-sub', 'save')->first();
        $seoPage['type'] = $this->infoSeo('news', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'news', 'seo');

        $this->initTemplate($itemSub['type']);

        return View::share('com', $itemSub->type)->view(implode('.', $this->template), compact('news', 'titleMain'));
    }

    public function detail($slug)
    {
        $lang = $this->lang;  
        $rowDetail = NewsModel::select('type', 'id', 'name'.$lang, 'desc'.$lang, $this->sluglang.' as slug', 'content'.$lang, 'view', 'id_list', 'id_cat', 'id_item', 'id_sub', 'photo', 'options','file')
            ->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            })
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();
        $seoPage = $rowDetail->getSeo('news', 'save')->first();
        Seo::setSeoData($seoPage, 'news', 'seo');
        $rowDetailPhoto = $rowDetail->getPhotos('news')->get();
        $tags = $rowDetail->tags ?? [];
        $itemList = $rowDetail->getCategoryList;
        $itemCat = $rowDetail->getCategoryCat;
        $itemItem = $rowDetail->getCategoryItem;
        $itemSub = $rowDetail->getCategorySub;
        if ($this->infoSeo('news', $rowDetail->type, 'type', 'index')) BreadCrumbs::set(url('slugweb', ['slug' => $rowDetail->type]), __('web.'.$this->infoSeo('news', $rowDetail->type, 'title')));
        BreadCrumbs::setBreadcrumb(detail: $rowDetail, list: $itemList, cat: $itemCat, item: $itemItem, sub: $itemSub);
        $news = NewsModel::select('id', 'name'.$lang, 'desc'.$lang, $this->sluglang.' as slug','photo','type')
            ->where(['type' => $rowDetail['type'], 'id_list' => $rowDetail->id_list])
            ->where("id", "!=", $rowDetail['id'])
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->get();

        $this->initTemplate($rowDetail['type']);

        return View::share('com', $rowDetail->type)->view($this->template['folder'] . '.detail', compact('rowDetail', 'rowDetailPhoto', 'news', 'tags'));
    }

    public function searchNews(Request $request)
    {
        $lang = $this -> lang;
        $keyword = $request->query('keyword');
        $news = NewsModel::select('id', 'name'.$lang, 'desc'.$lang, $this->sluglang.' as slug', 'photo','type')
            // ->search($keyword)
            ->where('namevi', 'like','%'.$keyword.'%')
            ->where('type', 'dich-vu')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);
        $titleMain = 'Tìm kiếm dịch vụ';
        return View::share(['com' => $this->type])->view('news.news', compact('news', 'titleMain'));
    }
}