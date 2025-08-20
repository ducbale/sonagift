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
use NINA\Database\Capsule\Manager as Capsule;
class DatabaseServiceProvider extends ServiceProvider
{
    protected $defer = true;
    public function register(): void
    {
        $this->app->singleton('db', function () {
            $defaultConnet = config('database.default');
            $capsule = new Capsule;
            $capsule->addConnection(config('database.connections.'.$defaultConnet));
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            return \NINA\Database\Capsule\Manager::connection();
        });
    }
    public function boot(): void
    {
        $setting = $this->app->make('db')->table('setting')->first();
        $optionSetting = json_decode($setting->options,true);
        $AdminUrl = $optionSetting['admin_url']??'admin';
        $site_path = $this->app->make('config')->get('app.site_path');
        $this->app->make('config')->set('app.admin_prefix',$site_path.$AdminUrl);
        
    }
    public function provides()
    {
        return ['db'];
    }
}