<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

use NINA\Core\Routing\NINARouter;
NINARouter::group(['namespace' => 'Web','prefix' => config('app.web_prefix'),'middleware' => [\NINA\Middlewares\LangRequest::class,\NINA\Middlewares\CheckRedirect::class]], function ($language='vi') {
    NINARouter::get('/change-lang/{lang}', function ($lang) {
        if(\Illuminate\Support\Arr::has(config('app.langs'),$lang)){
            session()->set('locale',$lang);
            app()->make('config')->set('app.seo_default',$lang);
            response()->redirect(linkReferer());
        }
    });

    $typeNewsConfig = config('type.news'); 
    $typeProductConfig = config('type.product');
    $typeStaticConfig = config('type.static');
    $typePhotoConfig = config('type.photo');
   


    NINARouter::get('/', 'HomeController@index')->name('home');
    NINARouter::get('/index', 'HomeController@index')->name('index');
    NINARouter::get('/load-product', 'HomeController@ajaxProduct')->name('load-product');
    NINARouter::get('/load-quickview', 'ApiController@Quickview')->name('load-quickview');
    NINARouter::get('/video-home', 'HomeController@videoHome')->name('video-home');
    NINARouter::get('/load-token', 'ApiController@token')->name('token');
    NINARouter::get('/tags-san-pham', 'TagsController@index')->name('tags');

    //Tạo route cho product
    foreach ($typeProductConfig as $key => $config) {
        if (isset($config['routes']) && $config['routes'] === true) {
            NINARouter::get('/' . $key, 'ProductController@index')->name($key);
        }
    }

    // Tạo route cho news
    foreach ($typeNewsConfig as $key => $config) {
        if (isset($config['routes']) && $config['routes'] === true) {
            NINARouter::get('/' . $key, 'NewsController@index')->name($key);
        }
    }

    // NINARouter::group(['type' => 'tin-tuc'], function () {
    //     NINARouter::get('/news', 'NewsController@index')->name('about.en');
    //     NINARouter::get('/tin-tuc', 'NewsController@index')->name('about.vi');
    //     NINARouter::get('/丁图克', 'NewsController@index')->name('about.cn');
    // });

    // Tạo route cho static
    foreach ($typeStaticConfig as $key => $config) {
        if (isset($config['routes']) && $config['routes'] === true) {
            NINARouter::get('/' . $key, 'StaticController@index')->name($key);
        }
    }
// Tạo route cho photo
    foreach ($typePhotoConfig as $key => $config) {
        if (isset($config['routes']) && $config['routes'] === true) {
            NINARouter::get('/' . $key, 'PhotoController@index')->name($key);
        }
    }


    NINARouter::post('/lien-he-post', 'ContactController@submit')->name('lien-he-post');
    NINARouter::get('/lien-he', 'ContactController@index')->name('lien-he');
    NINARouter::post('/dang-ky-nhan-tin', 'HomeController@letter')->name('letter');
    NINARouter::get('/flash-sale', 'ProductController@fsale')->name('flash-sale');
    NINARouter::get('/tim-kiem', 'ProductController@searchProduct')->name('tim-kiem');
    NINARouter::get('/tim-kiem-goi-y', 'ProductController@suggestProduct')->name('tim-kiem-goi-y');
    NINARouter::post('/cart/{action}', 'CartController@handle')->name('cart');
    NINARouter::get('/gio-hang', 'CartController@showcart')->name('giohang');
    NINARouter::get('/{slug}', 'SlugController@handle')->where([ 'slug' => '[\w\-\.]+' ])->name('slugweb');
});