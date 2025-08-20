<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

$app = new \NINA\Core\Container(realpath(__DIR__ . '/../'));
$app->singleton(\NINA\Core\App::class, function ($app) {
    return new \NINA\Core\App($app);
});
return $app;