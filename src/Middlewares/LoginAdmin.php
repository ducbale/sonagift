<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Middlewares;

use NINA\Core\Support\Facades\Auth;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;
use Illuminate\Support\Str;
class LoginAdmin implements IMiddleware
{
    public function handle(Request $request): void
    {
    	$path_admin_array = explode('/',Str::after(config('app.admin_prefix'),'/'));
        $path_admin = end($path_admin_array);
        if($request->getUrl()->getPath() != (config('app.admin_prefix').'/user/logout/') && Auth::guard('admin')->checkRemember()) return;
        if (!Auth::guard('admin')->check() && $request->getUrl()->getPath() != substr(config('app.site_path'), 0, -1).'/'.$path_admin.'/user/login/' && (Auth::guard('admin')->checkRemember() == false)) {
            response()->redirect(url('loginAdmin'));
        }
    }
}