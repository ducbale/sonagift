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
    'bai-viet' => [
        'title_main' => "Bài viết",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'baiviet'
        ],
        'routes' => true,
        'dropdown' => false,
        'tags' => false,
        'view' => true,
        'copy' => false,
        'slug' => true,
        'status' => ["noibat" => "Nổi bật","hienthi" => "Hiển thị"],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '585',
                'height' => '500',
                'thumb' => '585x500x1',
                'thumb1' => '300x250x1'

            ]
        ],
        'categories' => [
            'list' => [
                'title_main_categories' => "Danh mục cấp 1",
                'copy_categories' => false,
                'images' => [
                    'photo' => [
                        'title' => 'Ảnh đại diện',
                        'width' => '500',
                        'height' => '500',
                        'thumb' => '500x500x1'
                    ]
                ],
                'slug_categories' => true,
                'status_categories' => ["hienthi" => "Hiển thị"],
                'gallery_categories' => [],
                'name_categories' => true,
                'desc_categories' => false,
                'desc_categories_cke' => false,
                'content_categories' => false,
                'content_categories_cke' => false,
                'seo_categories' => true,
            ],
            'cat' => [
                'title_main_categories' => "Danh mục cấp 2",
                'copy_categories' => false,
                'images' => [
                    'photo' => [
                        'title' => 'Ảnh đại diện',
                        'width' => '500',
                        'height' => '500',
                        'thumb' => '500x500x1'
                    ]
                ],
                'slug_categories' => true,
                'status_categories' => ["hienthi" => "Hiển thị"],
                'gallery_categories' => [],
                'name_categories' => true,
                'desc_categories' => false,
                'desc_categories_cke' => false,
                'content_categories' => false,
                'content_categories_cke' => false,
                'seo_categories' => true,
            ],
        ],
        'show_images' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'schema' => true,
    ],
    'bai-viet-1' => [
        'title_main' => "Bài viết 1",
        'website' => [
            'type' => [
                'index' => 'object',
                // 'detail' => 'article'
            ],
            'title' => 'baiviet1'
        ],
        'routes' => true,
        'dropdown' => false,
        'tags' => false,
        'view' => true,
        'copy' => false,
        'slug' => true,
        'status' => ["noibat" => "Nổi bật","hienthi" => "Hiển thị"],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '404',
                'height' => '440',
                'thumb' => '404x440x1'
            ]
        ],
        'show_images' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => true,
        'desc_cke' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'schema' => true,
    ],
    'catalogue' => [
        'title_main' => "Catalogue",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'catalogue'
        ],
        'routes' => true,
        'dropdown' => false,
        'template-list' => 'catalogue',
        'template' => 'catalogue',
        'file' => true,
        'tags' => false,
        'view' => true,
        'copy' => false,
        'slug' => true,
        'status' => ["hienthi" => "Hiển thị"],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '404',
                'height' => '440',
                'thumb' => '404x440x1',
                'thumb1' => '404x440x1'
            ]
        ],
        'categories' => [
            'list' => [
                'title_main_categories' => "Danh mục cấp 1",
                'copy_categories' => false,
                // 'images' => [
                //     'photo' => [
                //         'title' => 'Ảnh đại diện',
                //         'width' => '500',
                //         'height' => '500',
                //         'thumb' => '500x500x1'
                //     ]
                // ],
                'slug_categories' => true,
                'status_categories' => ["hienthi" => "Hiển thị"],
                'gallery_categories' => [],
                'name_categories' => true,
                'desc_categories' => false,
                'desc_categories_cke' => false,
                'content_categories' => false,
                'content_categories_cke' => false,
                'seo_categories' => true,
            ],
        ],
        'show_images' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => false,
        'content' => true,
        'content_cke' => true,
        'seo' => false,
        'schema' => false,
    ],
    'chinh-sach' => [
        'title_main' => "Điều khoản dịch vụ",
        'website' => [
            'type' => [
                'index' => 'object',
                // 'detail' => 'article'
            ],
            'title' => 'chinhsach'
        ],
        'routes' => true,
        'dropdown' => false,
        'tags' => false,
        'view' => true,
        'copy' => false,
        'slug' => true,
        'status' => ["hienthi" => "Hiển thị"],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '150',
                'height' => '150',
                'thumb' => '150x150x1'
            ]
        ],
        'show_images' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'schema' => true,
    ],
    'dich-vu' => [
        'title_main' => "Dịch vụ",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'dichvu'
        ],
        'routes' => true,
        'dropdown' => false,
        'tags' => false,
        'view' => true,
        'copy' => false,
        'slug' => true,
        'template-list' => 'service',
        'status' => ["hienthi" => "Hiển thị"],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '380',
                'height' => '280',
                'thumb' => '380x280x1',
                'thumb1' => '300x250x1'
            ]
        ],
        'show_images' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => true,
        'content' => true,
        'content_cke' => true,
        'seo' => true,
        'schema' => true,
    ],
    'feedback' => [
        'title_main' => "Feedback",
        'status' => ["hienthi" => "Hiển thị"],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '420',
                'height' => '420',
                'thumb' => '420x420x1'
            ]
        ],
        'show_images' => true,
        'name' => true,
        'desc' => true,
        'office' => true,
    ],
    'hinh-thuc-thanh-toan' => [
        'title_main' => "Hình thức thanh toán",
        'dropdown' => false,
        'list' => false,
        'tags' => false,
        'view' => false,
        'copy' => false,
        'datePublish' => false,
        'copy_image' => false,
        'comment' => false,
        'slug' => false,
        'status' => ["hienthi" => "Hiển thị"],
        'images' => false,
        'icon' => false,
        'show_images' => false,
        'name' => true,
        'desc' => true,
        'desc_cke' => true,
        'content' => false,
        'content_cke' => false,
        'seo' => false,
        'schema' => false,
        'width' => 420,
        'height' => 288,
        'thumb' => '100x100x1',
        'width_icon' => 30,
        'height_icon' => 30,
        'thumb_icon' => '100x100x1',
    ]
];
