<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'wlm-admin'], function () {
    Route::get('/', function(){return redirect()->route("admin.login");});
    Route::get('/login', 'Backend\HomeController@login')->name('admin.login');
    Route::post('/login', 'Backend\HomeController@loginsubmit')->name('admin.loginsubmit');

    Route::get('/logout', 'Backend\HomeController@logout')->name('admin.logout');
    Route::get('/reset-password', 'Backend\HomeController@resetpass')->name('admin.resetpassword');
    Route::any('/lock-screen', 'Backend\HomeController@lockscreen')->name('admin.lockscreen');

    Route::post('/update-status', 'Backend\HomeController@updatestatus')->name('admin.updatestatus');
    Route::post('/update-order', 'Backend\HomeController@updateorder')->name('admin.updateorder');
    Route::post('/update-data', 'Backend\HomeController@updatedata')->name('admin.updatedata');

    Route::group(['middleware' => ['login']], function () {
        Route::group(['middleware' => ['permissions']], function () {
            Route::group(['namespace' => 'Backend'], function() {

                Route::group(['prefix' => 'user'], function () {
    
                    Route::get('/info', 'UserController@info')->name('admin.user.info');
                    Route::post('/info', 'UserController@infosubmit')->name('admin.user.info');
    
                    Route::get('/', 'UserController@index')->name('admin.user.list');
                    Route::get('/add', 'UserController@add')->name('admin.user.add');
                    Route::get('/edit/{id}', 'UserController@edit')->where('id', '[\d]+')->name('admin.user.edit');
                    Route::post('/add', 'UserController@addsubmit')->name('admin.user.add');
    
                    Route::post('/update-fullname', 'UserController@updatefullname')->name('admin.user.updatefullname');
                    Route::post('/update-permission', 'UserController@updatepermission')->name('admin.user.updatepermission');
                    Route::post('/update-password', 'UserController@updatepassword')->name('admin.user.updatepassword');
    
                    Route::get('/delete/{id}', 'UserController@delete')->name('admin.user.delete');
                    Route::get('/reset-password', 'UserController@delete')->name('admin.user.resetpassword');
    
                });
    
                Route::group(['prefix' => 'group'], function () {
                    Route::get('/', 'UserController@group')->name('admin.group.index');
                    Route::post('/', 'UserController@groupSubmit')->name('admin.group.index');
                    Route::get('/add', 'UserController@groupadd')->name('admin.group.add');
                    Route::post('/add', 'UserController@groupaddsubmit')->name('admin.group.add');
    
                    Route::get('/permissions/{id}', 'UserController@groupPermissions')->name('admin.group.permissions');
                    Route::post('/permissions/{id}', 'UserController@groupPermissionsSubmit')->name('admin.group.permissions');
                });
    
                Route::group(['prefix' => 'permissions' ], function () {
                    Route::get('/', 'UserController@permissions')->name('admin.permissions.index');
                    Route::post('/', 'UserController@permissionssubmit')->name('admin.permissions.index');
    
                    Route::get('/delete/{id}', 'UserController@permissionsDelete')->name('admin.permissions.delete');
                });
    
                Route::group(['prefix' => 'setting'], function () {
                    Route::get('/', 'SettingController@index')->name('admin.setting.index');
                    Route::post('/', 'SettingController@settingsubmit')->name('admin.setting.index');
    
                    Route::get('/config', 'SettingController@config')->name('admin.setting.config');
                    Route::post('/config', 'SettingController@configSubmit')->name('admin.setting.config');
    
                    Route::get('/seo', 'SettingController@seo')->name('admin.setting.seo');
                    Route::post('/seo', 'SettingController@seoSubmit')->name('admin.setting.seo');
    
    
                    Route::get('/language', 'SettingController@language')->name('admin.setting.language');
                    Route::post('/language', 'SettingController@languageSubmit')->name('admin.setting.language');
                });
    
                Route::group(['prefix' => 'catalog'], function () {
                    Route::get('/', 'CatalogController@index')->name('admin.catalog.index');
                    Route::get('/todo', 'CatalogController@todo')->name('admin.catalog.todo');
                    Route::post('/todo', 'CatalogController@todosubmit')->name('admin.catalog.todo');
                    Route::get('/delete', 'CatalogController@delete')->name('admin.catalog.delete');
                });
                Route::group(['prefix' => 'post'], function () {
                    Route::get('/', 'PostController@index')->name('admin.post.index');
                    Route::get('/todo', 'PostController@todo')->name('admin.post.todo');
                    Route::post('/todo', 'PostController@todosubmit')->name('admin.post.todo');
                    Route::get('/delete', 'PostController@delete')->name('admin.post.delete');
                });
    
                Route::group(['prefix' => 'catalognews'], function () {
                    Route::get('/', 'CatalogNewsController@index')->name('admin.catalognews.index');
                    Route::get('/todo', 'CatalogNewsController@todo')->name('admin.catalognews.todo');
                    Route::post('/todo', 'CatalogNewsController@todosubmit')->name('admin.catalognews.todo');
                    Route::get('/delete', 'CatalogNewsController@delete')->name('admin.catalognews.delete');
                });
                Route::group(['prefix' => 'news'], function () {
                    Route::get('/', 'NewsController@index')->name('admin.news.index');
                    Route::get('/todo', 'NewsController@todo')->name('admin.news.todo');
                    Route::post('/todo', 'NewsController@todosubmit')->name('admin.news.todo');
                    Route::get('/delete', 'NewsController@delete')->name('admin.news.delete');
                });
                Route::group(['prefix' => 'catalogservice'], function () {
                    Route::get('/', 'CatalogServiceController@index')->name('admin.catalogservice.index');
                    Route::get('/todo', 'CatalogServiceController@todo')->name('admin.catalogservice.todo');
                    Route::post('/todo', 'CatalogServiceController@todosubmit')->name('admin.catalogservice.todo');
                    Route::get('/delete', 'CatalogServiceController@delete')->name('admin.catalogservice.delete');
                });
                Route::group(['prefix' => 'service'], function () {
                    Route::get('/', 'ServiceController@index')->name('admin.service.index');
                    Route::get('/todo', 'ServiceController@todo')->name('admin.service.todo');
                    Route::post('/todo', 'ServiceController@todosubmit')->name('admin.service.todo');
                    Route::get('/delete', 'ServiceController@delete')->name('admin.service.delete');
                });
                Route::group(['prefix' => 'catalogfolder'], function () {
                    Route::get('/', 'CatalogFolderController@index')->name('admin.catalogfolder.index');
                    Route::get('/todo', 'CatalogFolderController@todo')->name('admin.catalogfolder.todo');
                    Route::post('/todo', 'CatalogFolderController@todosubmit')->name('admin.catalogfolder.todo');
                    Route::get('/delete', 'CatalogFolderController@delete')->name('admin.catalogfolder.delete');
                });
                Route::group(['prefix' => 'folder'], function () {
                    Route::get('/', 'FolderController@index')->name('admin.folder.index');
                    Route::get('/todo', 'FolderController@todo')->name('admin.folder.todo');
                    Route::post('/todo', 'FolderController@todosubmit')->name('admin.folder.todo');
                    Route::get('/delete', 'FolderController@delete')->name('admin.folder.delete');
                });
                Route::group(['prefix' => 'page'], function () {
                    Route::get('/', 'PageController@index')->name('admin.page.index');
                    Route::get('/todo', 'PageController@todo')->name('admin.page.todo');
                    Route::post('/todo', 'PageController@todosubmit')->name('admin.page.todo');
                    Route::get('/delete', 'PageController@delete')->name('admin.page.delete');
                });
                Route::group(['prefix' => 'media'], function () {
                    Route::get('/', 'MediaController@index')->name('admin.media.index');
                    Route::get('/todo', 'MediaController@todo')->name('admin.media.todo');
                    Route::post('/todo', 'MediaController@todosubmit')->name('admin.media.todo');
                    Route::get('/delete', 'MediaController@delete')->name('admin.media.delete');
                });
    
                Route::group(['prefix' => 'contact'], function () {
                    Route::get('/', 'ContactController@index')->name('admin.contact.index');
                    Route::get('/delete', 'ContactController@delete')->name('admin.contact.delete');
                });
                Route::group(['prefix' => 'comment'], function () {
                    Route::get('/', 'CommentController@index')->name('admin.comment.index');
                    Route::get('/todo', 'CommentController@todo')->name('admin.comment.todo');
                    Route::post('/todo', 'CommentController@todosubmit')->name('admin.comment.todo');
                    Route::get('/delete', 'CommentController@delete')->name('admin.comment.delete');
                });
            });
        });
        Route::get('/dashboard', 'Backend\HomeController@dashboard')->name('admin.dashboard');

    });
});
