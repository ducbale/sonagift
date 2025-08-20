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
    'san-pham' => [
        'title_main' => "Sản Phẩm",
        'website' => [
            'type' => [
                'index' => 'object',
                'detail' => 'article'
            ],
            'title' => 'sanpham'
        ],
        'routes' => true,
        'id_categories' => true,
        'copy' => true,
        'tags' => false,
        'suggest' => false,
        'slug' => true,
        'status' => ["fsale" => "Flash sale","sale" => "Sale", "hot" => "Hot","noibat1" => "Nổi bật1","noibat" => "Nổi bật","stock" => "Hết hàng","hienthi" => "Hiển thị"],
        'images' => [
            'photo' => [
                'title' => 'Ảnh đại diện',
                'width' => '370',
                'height' => '393',
                'thumb' => '370x393x1',
                'thumb_detail' => '600x600x2'
            ],
            'photo2' => [
                'title' => 'Ảnh đại diện',
                'width' => '370',
                'height' => '393',
                'thumb' => '370x393x1',
                'thumb_detail' => '450x650x1'
            ],
        ],
        'show_images' => true,
        'gallery' => [
            'san-pham' => [
                "title_main_photo" => "Hình ảnh sản phẩm",
                "title_sub_photo" => "Hình ảnh",
                "status_photo" => ["hienthi" => "Hiển thị"],
                "number_photo" => 3,
                "images_photo" => true,
                "avatar_photo" => true,
                "name_photo" => true,
                "photo_width" => 950,
                "photo_height" => 630,
                "photo_thumb" => '100x100x1'
            ],
            // 'hinh-anh' => [
            //     "title_main_photo" => "Hình ảnh khác",
            //     "title_sub_photo" => "Hình ảnh",
            //     "status_photo" => ["hienthi" => "Hiển thị"],
            //     "number_photo" => 3,
            //     "images_photo" => true,
            //     "avatar_photo" => true,
            //     "name_photo" => true,
            //     "photo_width" => 950,
            //     "photo_height" => 630,
            //     "photo_thumb" => '100x100x1'
            // ],
        ],
        // 'posts' => [
        //     'khuyen-mai-san-pham' => 'Khuyến mãi',
        //     'uu-dai-san-pham' => 'Ưu đãi',
        //     'ho-tro-san-pham' => 'Hỗ trợ',
        // ],
        // 'excel' => [
        //     'import' => [
        //         'title_main_excel' => "Import",
        //     ],
        //     'export' => [
        //         'title_main_excel' => "Export",
        //     ]
        // ],
        'view' => true,
        'comment' => true,
        'properties' => true,
        'code' => true,
        'regular_price' => true,
        'sale_price' => true,
        'discount' => true,
        'datePublish' => false,
        'name' => true,
        'desc' => true,
        'desc_cke' => true,
        'content' => true,
        'content_cke' => true,
        'content1' => true,
        'content1_cke' => true,
        'parameter' => false,
        'parameter_cke' => false,
        'promotion' => false,
        'promotion_cke' => false,
        'incentives' => false,
        'incentives_cke' => false,
        'schema' => true,
        'seo' => true,
        'group' => false,
        'categories' => [
            'list' => [
                'title_main_categories' => "Danh mục cấp 1",
                'images' => [
                    'photo' => [
                        'title' => 'Ảnh đại diện',
                        'width' => '500',
                        'height' => '500',
                        'thumb' => '500x500x1'
                    ],
                    'icon' => [
                        'title' => 'Icon',
                        'width' => '90',
                        'height' => '90',
                        'thumb' => '90x90x1'
                    ]
                ],
                'copy_categories' => false,
                'show_images_categories' => true,
                'slug_categories' => true,
                'status_categories' => ["danhmuc" => "Danh mục","noibat1" => "Nổi bật1","noibat" => "Nổi bật","hienthi" => "Hiển thị"],
                'gallery_categories' => [],
                'name_categories' => true,
                'desc_categories' => true,
                'desc_categories_cke' => false,
                'content_categories' => false,
                'content_categories_cke' => false,
                'seo_categories' => true,
            ],
            'cat' => [
                'title_main_categories' => "Danh mục cấp 2",
                'images' => [
                    'photo' => [
                        'title' => 'Ảnh đại diện',
                        'width' => '500',
                        'height' => '500',
                        'thumb' => '500x500x1'
                    ],
                    'icon' => [
                        'title' => 'Ảnh đại diện',
                        'width' => '25',
                        'height' => '25',
                        'thumb' => '25x25x1'
                    ]
                ],
                'copy_categories' => false,
                'show_images_categories' => true,
                'slug_categories' => true,
                'status_categories' => ["noibat" => "Nổi bật", "hienthi" => "Hiển thị"],
                'gallery_categories' => [],
                'name_categories' => true,
                'desc_categories' => true,
                'desc_categories_cke' => false,
                'content_categories' => false,
                'content_categories_cke' => false,
                'seo_categories' => true,
            ],
            'item' => [
                'title_main_categories' => "Danh mục cấp 3",
                'images' => [
                    'photo' => [
                        'title' => 'Ảnh đại diện',
                        'width' => '500',
                        'height' => '500',
                        'thumb' => '500x500x1'
                    ],
                    'icon' => [
                        'title' => 'Ảnh đại diện',
                        'width' => '25',
                        'height' => '25',
                        'thumb' => '25x25x1'
                    ]
                ],
                'copy_categories' => false,
                'show_images_categories' => true,
                'slug_categories' => true,
                'status_categories' => ["hienthi" => "Hiển thị"],
                'gallery_categories' => [],
                'name_categories' => true,
                'desc_categories' => true,
                'desc_categories_cke' => false,
                'content_categories' => false,
                'content_categories_cke' => false,
                'seo_categories' => true,
            ]
        ]
    ]
];
