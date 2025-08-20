<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Providers;
use NINA\Core\ServiceProvider;
use NINA\Helpers\BreadCrumbs;
class BreadCrumbsServiceProvider extends ServiceProvider
{
    protected $defer = true;
    public function register(): void
    {
        $this->app->singleton('breadcrumbs', function () {
            return new BreadCrumbs();
        });
    }
    public function provides(){
        return ['breadcrumbs'];
    }
}