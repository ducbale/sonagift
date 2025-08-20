<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\NINAGateway\Providers;

use NINA\Core\ServiceProvider;
use NINA\NINAGateway\GatewayManager;
use NINA\NINAGateway\Omnipay\GatewayFactory;

class GatewayServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('gateway', function ($app) {
            $defaults = $app['config']->get('gateways.defaults', array());
            return new GatewayManager($app, new GatewayFactory, $defaults);
        });
    }
}