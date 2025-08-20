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
    'loginpage' => 'basic', //cover or basic
    'defaults' => [
        'guard' => 'admin'
    ],
    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ]
    ],
    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model' => \NINA\Models\UserModel::class,
            'table' => 'user'
        ]
    ]
];