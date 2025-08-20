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
    'gioi-thieu' => [
        'title_main' => "Giới thiệu",
        'routes' => true,
        'website' => [
            'type' => 'object',
            'title' => 'gioithieu'
        ],
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'images' => [
            'photo' => [
                'title' =>  'Hình ảnh',
                'width' => '300',
                'height' => '300',
                'thumb' => '300x300x1'
            ]
        ],
        // 'gallery' => [
        //     'gioi-thieu' => [
        //         "title_main_photo" => "Hình ảnh Giới thiệu",
        //         "status_photo" => ["hienthi" => "Hiển thị"],
        //         "number_photo" => 3,
        //         "images_photo" => true,
        //         "name_photo" => true,
        //         "width_photo" => 500,
        //         "height_photo" => 340,
        //         "thumb_photo" => '500x340x1'
        //     ],
        // ],
        'name' => true,
        // 'desc' => true,
        // 'desc_cke' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
    ],
    'lienhe' => [
        'title_main' => "Liên hệ",
        'website' => [
            'title' => 'lienhe'
        ],
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'images' => [
            // 'photo' => [
            //     'title' =>  'Hình ảnh',
            //     'width' => '300',
            //     'height' => '300',
            //     'thumb' => '300x300x1'
            // ]
        ],
        'name' => false,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
    ],
    'footer' => [
        'title_main' => "Footer",
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'images' => [
            'photo' => [
                'title' =>  'Hình ảnh',
                'width' => '238',
                'height' => '74',
                'thumb' => '238x74x1'
            ]
        ],
        'name' => true,
        // 'desc' => true,
        'content' => true,
        'content_cke' => true,
    ],
    'slogan' => [
        'title_main' => "Slogan",
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'name' => true,
    ],
    'copyright' => [
        'title_main' => "Copyright",
        'status' => [
            "hienthi" => 'Hiển thị'
        ],
        'name' => true,
    ]
];
