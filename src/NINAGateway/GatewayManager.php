<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\NINAGateway;
use NINA\NINAGateway\Omnipay\GatewayFactory;
class GatewayManager
{
    protected $app;
    protected $gateways;
    protected $defaults;
    protected $factory;

    public function __construct($app, GatewayFactory $factory, $defaults = array())
    {
        $this->app = $app;
        $this->factory = $factory;
        $this->defaults = $defaults;
    }
    public function gateway($class = null)
    {
        $class = $class ?: $this->getDefaultGateway();
        if (!isset($this->gateways[$class])) {
            $gateway = $this->factory->create($class, null, $this->app['request']);
            $gateway->initialize($this->getConfig($class));
            $this->gateways[$class] = $gateway;
        }
        return $this->gateways[$class];
    }
    protected function getConfig($name)
    {
        return array_merge(
            $this->defaults,
            $this->app['config']->get('gateways.gateways.'.$name.'.options', [])
        );
    }
    public function getDefaultGateway()
    {
        return $this->app['config']['gateways.gateway'];
    }
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->gateway(), $method], $parameters);
    }
}