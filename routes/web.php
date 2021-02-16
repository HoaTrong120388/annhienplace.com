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

use Illuminate\Support\Facades\Artisan;

Route::get('viewer.html', 'Frontend\HomeController@viewer')->name('frontend.viewer');

//Clear config cache:
Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return 'Config cache cleared';
});

Route::any('/check-ip', function(Request $request) {
    return $request->ip();
});

Route::group(['middleware' => ['locale']], function () {
    Route::group(['namespace' => 'Frontend'], function() {
        Route::get('/', 'HomeController@home')->name('frontend.home');
        Route::get('/khuyen-mai', 'LandingpageController@comingsoon')->name('frontend.landingpage.comingsoon');
    
        Route::get('/change-language', 'CommonController@setLocale')->name('frontend.change.language');
        Route::get('/send-mail', 'TestController@sendmail')->name('tool.sendmail');
        
    
        /********* Contact *************/
        Route::get('/lien-he.html', 'CommonController@contact')->name('frontend.contact');
        Route::post('/contactsubmit', 'CommonController@contactsubmit')->name('frontend.contact.submit');
        /********* Contact *************/

        /********* Comment *************/
        Route::post('/add-comment', 'CommonController@addcomment')->name('frontend.comment.add');
        /********* Comment *************/
    
        /*** Url Search ***/
        Route::get('/search', 'ContentController@search')->name('frontend.search');
        /*** Url Search ***/
    
        // Route::get('/dich-vu', 'ContentController@service')->name('frontend.service.detail');
        // Route::get('/tin-tuc', 'ContentController@news')->name('frontend.blog.catalog');
        // Route::get('/danh-muc-san-pham', 'ContentController@product')->name('frontend.product.catalog');

        Route::get('/dich-vu', 'ContentController@serviceall')->name('frontend.service.all');
        Route::get('/san-pham', 'ContentController@productall')->name('frontend.product.all');
        Route::get('/tin-tuc', 'ContentController@newsall')->name('frontend.blog.catalog');
        Route::get('/catalog', 'ContentController@folderall')->name('frontend.folder.catalog');
        Route::get('/book.html', 'ContentController@bookdetail')->name('frontend.folder.detail');
    
        Route::get('page/{slug}.html', 'ContentController@Pagedetail')->name('frontend.page.detail');
        Route::get('/{slug}.html', 'ContentController@Postdetail')->name('frontend.post.detail');
        Route::get('/{slug}', 'ContentController@Catalogdetail')->name('frontend.catalog.detail');
    });
});

Route::get('storage/{name}', function ($name) {
    $path = storage_path($name);
    $mime = \File::mimeType($path);
    header('Content-type: ' . $mime);
    return readfile($path);
})->where('name', '(.*)');