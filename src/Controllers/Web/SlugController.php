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
use Illuminate\Http\Request;
use NINA\Controllers\Controller;
use NINA\Models\SlugModel;
use NINA\Core\Routing\NINARouter;
class SlugController extends Controller{
    public function handle($slug, Request $request)
    {
        
        if (!empty($slug)) {
            $query = SlugModel::select('*')->where(function ($query) use ($slug) {
                $query->where("slugvi", $slug)->orwhere("slugen", $slug);
            });
            $check = $query->first();
          
            if (!empty($check) && !empty($check->getStatus($check['model'])->first()->id)) {
                $method = !empty(explode('-', $check['com'])[1])? explode('-', $check['com'])[1]:'detail';
                
                $controller = new ($check['controller']);
                return $controller->$method($slug, $request);
            } else {
                NINARouter::response()->httpCode(404);
                view('error.notfound',[]);
            }
        }
    }
}
