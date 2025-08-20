<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

return [
    'compiled' => base_path('compiled'),

    'view_mobile' => base_path('src/Views/mobile'),

    'view_templates' => base_path('src/Views/templates'),

    'view_amp' => base_path('src/Views/amp'),

    'mode' => [
        'web' =>NINA\Core\View\BladeOne::MODE_AUTO,
        'admin' =>NINA\Core\View\BladeOne::MODE_AUTO
    ], //BladeOne::MODE_AUTO,BladeOne::MODE_DEBUG,BladeOne::MODE_FAST,BladeOne::MODE_SLOW

    'asset' => '/',

    'composer' => \NINA\Controllers\Web\AllController::class,

    'composer_admin' => \NINA\Controllers\Admin\AllController::class,

];