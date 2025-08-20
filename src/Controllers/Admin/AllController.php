<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Controllers\Admin;

use NINA\Models\SettingModel;
use NINA\Models\OrdersModel;
use NINA\Models\PhotoModel;
use NINA\Models\UserModel;
use NINA\Core\Support\Facades\Auth;
use Illuminate\Support\Str;
class AllController
{
    function composer($view)
    {
        
        $configMan = '';
        $upload = json_decode(json_encode(config('upload')));
        $configType = json_decode(json_encode(config('type')));
        $path_admin_array = explode('/',Str::after(config('app.admin_prefix'),'/'));
        $admin_path = end($path_admin_array);
        
        $urlSegments = explode('/', preg_replace('/^' . preg_quote($admin_path, '/') . '\//', '', request()->path()));
        $com = $urlSegments[0] ?? '';
        $act = $urlSegments[1] ?? '';
        $type = $urlSegments[2] ?? '';
        $comList = $com ? explode('-', $com) : [];
        $tb = $comList[0] ?? '';
        $kind = $comList[1] ?? '';
        $page = request()->query('page')??1;


        if (!empty($tb) && !empty($type)) {
            $configMan = $configType->{$tb}->{$type} ?? [];
        }
        $photos = PhotoModel::select('photo', 'namevi', 'link', 'type')
            ->whereIn('type', ['logo', 'mangxahoi'])
            ->whereRaw("FIND_IN_SET(?, status)", ['hienthi'])
            ->get();
        $logoPhoto = $photos->where('type', 'logo')->first();
        $social = $photos->where('type', 'mangxahoi');
        if (!empty(config('type.users.permission')) && !empty(Auth::guard('admin')->check())) {
            $permissions = Auth::guard('admin')->user()->roles()->first()?->permissions()->pluck('name')->toArray();
        }
        $view->share(['admin_path'=> $admin_path,'upload' => $upload, 'configType' => $configType, 'page' => $page, 'com' => $com, 'act' => $act, 'type' => $type, 'kind' => $kind, 'tb' => $tb, 'configMan' => $configMan, 'logo' => $logoPhoto, 'social' => $social, 'permissions' => $permissions ?? []]);
    }
}
