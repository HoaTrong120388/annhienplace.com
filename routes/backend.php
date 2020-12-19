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

            Route::group(['prefix' => 'user'], function () {

                Route::get('/info', 'Backend\UserController@info')->name('admin.user.info');
                Route::post('/info', 'Backend\UserController@infosubmit')->name('admin.user.info');

                Route::get('/', 'Backend\UserController@index')->name('admin.user.list');
                Route::get('/add', 'Backend\UserController@add')->name('admin.user.add');
                Route::get('/edit/{id}', 'Backend\UserController@edit')->where('id', '[\d]+')->name('admin.user.edit');
                Route::post('/add', 'Backend\UserController@addsubmit')->name('admin.user.add');

                Route::post('/update-fullname', 'Backend\UserController@updatefullname')->name('admin.user.updatefullname');
                Route::post('/update-permission', 'Backend\UserController@updatepermission')->name('admin.user.updatepermission');
                Route::post('/update-password', 'Backend\UserController@updatepassword')->name('admin.user.updatepassword');

                Route::get('/delete/{id}', 'Backend\UserController@delete')->name('admin.user.delete');
                Route::get('/reset-password', 'Backend\UserController@delete')->name('admin.user.resetpassword');

            });

            Route::group(['prefix' => 'group'], function () {
                Route::get('/', 'Backend\UserController@group')->name('admin.group.index');
                Route::post('/', 'Backend\UserController@groupSubmit')->name('admin.group.index');
                Route::get('/add', 'Backend\UserController@groupadd')->name('admin.group.add');
                Route::post('/add', 'Backend\UserController@groupaddsubmit')->name('admin.group.add');

                Route::get('/permissions/{id}', 'Backend\UserController@groupPermissions')->name('admin.group.permissions');
                Route::post('/permissions/{id}', 'Backend\UserController@groupPermissionsSubmit')->name('admin.group.permissions');
            });

            Route::group(['prefix' => 'permissions' ], function () {
                Route::get('/', 'Backend\UserController@permissions')->name('admin.permissions.index');
                Route::post('/', 'Backend\UserController@permissionssubmit')->name('admin.permissions.index');

                Route::get('/delete/{id}', 'Backend\UserController@permissionsDelete')->name('admin.permissions.delete');
            });

            Route::group(['prefix' => 'setting'], function () {
                Route::get('/', 'Backend\SettingController@index')->name('admin.setting.index');
                Route::post('/', 'Backend\SettingController@settingsubmit')->name('admin.setting.index');

                Route::get('/config', 'Backend\SettingController@config')->name('admin.setting.config');
                Route::post('/config', 'Backend\SettingController@configSubmit')->name('admin.setting.config');

                Route::get('/seo', 'Backend\SettingController@seo')->name('admin.setting.seo');
                Route::post('/seo', 'Backend\SettingController@seoSubmit')->name('admin.setting.seo');


                Route::get('/language', 'Backend\SettingController@language')->name('admin.setting.language');
                Route::post('/language', 'Backend\SettingController@languageSubmit')->name('admin.setting.language');
            });

            Route::group(['prefix' => 'catalog'], function () {
                Route::get('/', 'Backend\CatalogController@index')->name('admin.catalog.index');
                Route::get('/todo', 'Backend\CatalogController@todo')->name('admin.catalog.todo');
                Route::post('/todo', 'Backend\CatalogController@todosubmit')->name('admin.catalog.todo');
                Route::get('/delete', 'Backend\CatalogController@delete')->name('admin.catalog.delete');
            });
            Route::group(['prefix' => 'post'], function () {
                Route::get('/', 'Backend\PostController@index')->name('admin.post.index');
                Route::get('/todo', 'Backend\PostController@todo')->name('admin.post.todo');
                Route::post('/todo', 'Backend\PostController@todosubmit')->name('admin.post.todo');
                Route::get('/delete', 'Backend\PostController@delete')->name('admin.post.delete');
            });

            Route::group(['prefix' => 'catalognews'], function () {
                Route::get('/', 'Backend\CatalogNewsController@index')->name('admin.catalognews.index');
                Route::get('/todo', 'Backend\CatalogNewsController@todo')->name('admin.catalognews.todo');
                Route::post('/todo', 'Backend\CatalogNewsController@todosubmit')->name('admin.catalognews.todo');
                Route::get('/delete', 'Backend\CatalogNewsController@delete')->name('admin.catalognews.delete');
            });
            Route::group(['prefix' => 'news'], function () {
                Route::get('/', 'Backend\NewsController@index')->name('admin.news.index');
                Route::get('/todo', 'Backend\NewsController@todo')->name('admin.news.todo');
                Route::post('/todo', 'Backend\NewsController@todosubmit')->name('admin.news.todo');
                Route::get('/delete', 'Backend\NewsController@delete')->name('admin.news.delete');
            });
            Route::group(['prefix' => 'page'], function () {
                Route::get('/', 'Backend\PageController@index')->name('admin.page.index');
                Route::get('/todo', 'Backend\PageController@todo')->name('admin.page.todo');
                Route::post('/todo', 'Backend\PageController@todosubmit')->name('admin.page.todo');
                Route::get('/delete', 'Backend\PageController@delete')->name('admin.page.delete');
            });
            Route::group(['prefix' => 'libary'], function () {
                Route::get('/', 'Backend\ImageController@index')->name('admin.image1.index');
                Route::get('/image', 'Backend\ImageController@index')->name('admin.image.index');
                Route::get('/image/todo', 'Backend\ImageController@todo')->name('admin.image.todo');
                Route::post('/image/todo', 'Backend\ImageController@todosubmit')->name('admin.image.todo');
                Route::get('/image/delete', 'Backend\ImageController@delete')->name('admin.image.delete');
                Route::get('/video', 'Backend\VideoController@index')->name('admin.video.index');
                Route::get('/video/todo', 'Backend\VideoController@todo')->name('admin.video.todo');
                Route::post('/video/todo', 'Backend\VideoController@todosubmit')->name('admin.video.todo');
                Route::get('/video/delete', 'Backend\VideoController@delete')->name('admin.video.delete');
            });
            Route::group(['prefix' => 'customer'], function () {
                Route::get('/', 'Backend\CustomerController@index')->name('admin.customer.index');
                Route::get('/todo', 'Backend\CustomerController@todo')->name('admin.customer.todo');
                Route::post('/todo', 'Backend\CustomerController@todosubmit')->name('admin.customer.todo');
                Route::get('/delete', 'Backend\CustomerController@delete')->name('admin.customer.delete');
            });
            Route::group(['prefix' => 'media'], function () {
                Route::get('/', 'Backend\MediaController@index')->name('admin.media.index');
                Route::get('/todo', 'Backend\MediaController@todo')->name('admin.media.todo');
                Route::post('/todo', 'Backend\MediaController@todosubmit')->name('admin.media.todo');
                Route::get('/delete', 'Backend\MediaController@delete')->name('admin.media.delete');
            });

            Route::group(['prefix' => 'contact'], function () {
                Route::get('/', 'Backend\ContactController@index')->name('admin.contact.index');
                Route::get('/delete', 'Backend\ContactController@delete')->name('admin.contact.delete');
            });
        });
        Route::get('/dashboard', 'Backend\HomeController@dashboard')->name('admin.dashboard');

        Route::group(['prefix' => 'nap-the'], function () {
            Route::get('/{page?}', 'Backend\NapTheController@index')->name('admin.napthe.index');
            Route::post('/send', 'Backend\NapTheController@send')->name('admin.napthe.send');
        });
        Route::group(['prefix' => 'tai-khoan'], function () {
            Route::get('lich-su/{page?}', 'Backend\TaiKhoanController@history')->name('admin.taikhoan.giaodich');
            // Route::post('/send', 'Backend\NapTheController@send')->name('admin.napthe.send');
        });

        Route::group(['prefix' => 'rut-tien'], function () {
            Route::get('/index', 'Backend\RutTienController@index')->name('admin.ruttien.index');
            Route::post('/send', 'Backend\RutTienController@send')->name('admin.ruttien.send');
        });


        Route::group(['prefix' => 'static', 'middleware' => ['permissionadmin'] ], function () {
            Route::any('/customer-profit', 'Backend\StaticController@customerprofit')->name('admin.static.profit');
            Route::any('/thu-chi', 'Backend\StaticController@index')->name('admin.static.inout');
        });
    });
});
