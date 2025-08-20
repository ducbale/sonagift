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
use NINA\Core\View\BladeOne;
use NINA\Core\View\View;

class ViewServiceProvider extends ServiceProvider
{
    protected $defer = true;
    public function boot(): void {
        $blade = $this->app->make('view');
        $blade->addAssetDict('assets/js/alpinejs.min.js','//unpkg.com/alpinejs');
        $errorCallback = function($key = null){
            $errorArray = session()->getError();
            if (array_key_exists($key, $errorArray)) {
                session()->unset('flashError.'.$key);
                return implode('<br>', $errorArray[$key]);
            }
            return false;
        };
        $blade->setErrorFunction($errorCallback);

    }
    public function register(): void {
        $this->app->singleton('view', function () {
            return new View();
        });
    }
    public function provides(){
        return ['view'];
    }
}