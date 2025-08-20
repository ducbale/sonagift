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

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SlugController
{
    public function handle($com, $act, $type, Request $request)
    {
        $path_admin_array = explode('/',Str::after(config('app.admin_prefix'),'/'));
        $admin_base = end($path_admin_array);
        if ($request->is($admin_base.'/*')) {
            $path = explode('/', $request->path());
            $controllerName = '\NINA\Controllers\Admin\\' . ucfirst(explode('-', $path[1])[0]) . 'Controller';
            $controller = new ($controllerName);
            if ($act == 'add') { $act = 'edit'; }
            $man = (!empty($path[1])) ? explode('-', $path[1]) : '';
            $method = $act . (!empty($man[1]) ? ucfirst($man[1]) : '');
            return $controller->$method($com, $act, $type, $request);
        }
    }
}
