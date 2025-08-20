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
use NINA\Models\PhotoModel;
use NINA\Models\SettingModel;
use NINA\Models\NewsModel;
use NINA\Models\StaticModel;
use NINA\Models\ExtensionsModel;
use NINA\Models\ProductListModel;
use NINA\Models\ProductModel;
use NINA\Core\Container;

class ApiController
{
    public function token(Request $request){
        $token = csrf_token();
        echo $token;
    }
    public function Quickview(Request $request)
    {   
        $id = $request->get('id') ?? 0;
        $rowDetail = ProductModel::select('*')            
        ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])->where("id",$id)->first(); 
        $rowDetailPhoto = $rowDetail->getPhotos('product')->where('type', $rowDetail->type)->get();     
        return view('ajax.quickview', ['rowDetail' => $rowDetail,'rowDetailPhoto'=>$rowDetailPhoto]);
    }
}
