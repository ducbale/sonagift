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

NINARouter::group(['namespace' => 'Admin', 'prefix' => config('app.admin_prefix'), 'middleware' => \NINA\Middlewares\LoginAdmin::class], function () {
    NINARouter::get('/delete-cache',function (){
        deleteOldThumbnails();

        transfer('Xóa cache thành công !',1,PeceeRequest()->getHeader('http_referer'));
    })->name('deleteCache');
    NINARouter::get('/delete-cache/{path}',function ($path){
        if(!in_array($path,['thumbs','watermarks'])){
            transfer('Không thể thao tác trên thư mục '.$path,0,PeceeRequest()->getHeader('http_referer'));exit;
        }
        deleteOldThumbnails($path);
        transfer('Xóa cache thành công !',1,PeceeRequest()->getHeader('http_referer'));
    });
    NINARouter::get('/ckfinder/','CKFController@show');
    NINARouter::get('/', 'HomeController@index')->name('index');
    
    NINARouter::match(['get', 'post'], '/user/login', 'UserController@login')->name('loginAdmin');
    NINARouter::get('/user/logout', 'UserController@logout')->name('logoutAdmin');
    NINARouter::group(['middleware' => \NINAPermission\Middlewares\PermissionAdmin::class], function () {
        NINARouter::get('/status', 'ApiController@status')->name('status');
        NINARouter::get('/slug', 'ApiController@slug')->name('slug');
        NINARouter::get('/numb', 'ApiController@numb')->name('numb');
        NINARouter::get('/copy', 'ApiController@copy')->name('copy');
        NINARouter::post('/category', 'ApiController@category')->name('category');
        NINARouter::post('/check-link', 'ApiController@checklink')->name('checklink');
        NINARouter::post('/category-group', 'ApiController@categoryGroup')->name('categoryGroup');
        NINARouter::post('/filer', 'ApiController@filer')->name('filer');
        NINARouter::post('/database', 'ApiController@database')->name('database');
        NINARouter::post('/place', 'ApiController@place')->name('place');
        NINARouter::post('/properties', 'ApiController@properties')->name('properties');
        NINARouter::post('/propertiesList', 'ApiController@propertiesList')->name('propertiesList');
        NINARouter::post('/readmail', 'ApiController@readmail')->name('readmail');
        NINARouter::post('/reset-link', 'ApiController@resetlink')->name('resetlink');
        
        NINARouter::get('/permission/man', 'PermissionController@index')->name('permission');
        NINARouter::get('/permission/add', 'PermissionController@add')->name('permission_add');
        NINARouter::post('/permission/save', 'PermissionController@save')->name('permission_save');
        NINARouter::get('/permission/edit/', 'PermissionController@edit',['as' => 'permission_edit']);
        NINARouter::get('/permission/delete', 'PermissionController@delete')->name('permission_delete');

        NINARouter::get('/users/man', 'UserController@index')->name('user');
        NINARouter::get('/users/add', 'UserController@add')->name('user.add');
        NINARouter::post('/users/save', 'UserController@save')->name('user.save');
        NINARouter::get('/users/edit/', 'UserController@edit',['as' => 'user.edit']);
        NINARouter::get('/users/delete', 'UserController@delete')->name('user.delete');


        NINARouter::match(['get', 'post'], '/{com}/{act}/{type}', 'SlugController@handle')->name('admin');
    });
});
