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

use NINA\Core\Support\Facades\View;
use Illuminate\Http\Request;
use NINA\Controllers\Controller;
use NINA\Core\Support\Facades\Seo;
use NINA\Models\TagsModel;
use NINA\Models\ProductModel;
use NINA\Models\ProductTagsModel;
use NINA\Core\Support\Facades\BreadCrumbs;

use Func;

class TagsController extends Controller
{

    public function detail($slug)
    {
        $lang = $this -> lang;

        $rowTags = TagsModel::select('name'.$lang, 'desc'.$lang, 'type', 'id')
            ->where('slug'. $lang, $slug)
            ->first();

        $this->type =  $rowTags->type;
        $titleMain = $rowTags['name' . $this->lang];

        BreadCrumbs::setBreadcrumb(list: $rowTags);

        $seoPage = $rowTags->getSeo('tags', 'save')->first();
        $seoPage['type'] = $this->infoSeo('tags', $this->type, 'type', 'index');
        Seo::setSeoData($seoPage, 'tags', 'seo');

        if ($rowTags['type'] == 'san-pham') {
            $product = $rowTags->products()->paginate(12);
            return view('product.product', compact('product', 'titleMain'));
        } else {
            $news = $rowTags->news()->paginate(12);
            return view('news.news', compact('news', 'titleMain'));
        }
    }
}
