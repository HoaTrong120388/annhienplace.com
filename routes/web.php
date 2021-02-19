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
        
        Route::get('/ve-chung-toi.html', 'CommonController@aboutus')->name('frontend.aboutus');
    
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
    

        Route::get('/dich-vu', 'ContentController@serviceall')->name('frontend.service.all');
        Route::get('/tags-service/{keyword}', 'ContentController@servicetags')->name('frontend.service.tags');

        Route::get('/tin-tuc', 'ContentController@newsall')->name('frontend.news.all');
        Route::get('/tags-blog/{keyword}', 'ContentController@newstags')->name('frontend.news.tags');

        Route::get('/san-pham', 'ContentController@productall')->name('frontend.product.all');
        Route::get('/tim-kiem', 'ContentController@productsearch')->name('frontend.product.search');
        Route::get('/tags-product/{keyword}', 'ContentController@producttags')->name('frontend.product.tags');


        Route::get('/danh-muc-noi-bat', 'ContentController@catalogall')->name('frontend.catalog.all');
    
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