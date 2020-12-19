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

Route::get('viewer.html', 'Frontend\ContentController@viewer')->name('frontend.viewer');


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
    Route::get('/', 'Frontend\HomeController@home')->name('frontend.home');
    Route::get('/khuyen-mai', 'Frontend\LandingpageController@comingsoon')->name('frontend.landingpage.comingsoon');

    Route::get('/change-language', 'Frontend\CommonController@setLocale')->name('frontend.change.language');
    Route::get('/send-mail', 'TestController@sendmail')->name('tool.sendmail');


    /********* Contact *************/
    Route::get('/lien-he', 'Frontend\CommonController@contact')->name('frontend.vi.contact');
    Route::get('/contact', 'Frontend\CommonController@contact')->name('frontend.en.contact');
    Route::post('/contactsubmit', 'Frontend\CommonController@contactsubmit')->name('frontend.contact.submit');
    Route::post('/registersubmit', 'Frontend\CommonController@registersubmit')->name('frontend.register.submit');
    Route::post('/landingpageregistersubmit', 'Frontend\CommonController@landingpageregistersubmit')->name('frontend.landingpgae.register.submit');
    /********* Contact *************/

    /********* About Us *************/
    // Route::get('/tri-seo/vai-tro-cat-day-seo-trong-dieu-tri-seo-ro-hieu-qua.html', 'Frontend\ContentController@detailLanding')->name('frontend.landing.post');
    /********* About Us *************/

    /*** Url Search ***/
    Route::get('/search', 'Frontend\ContentController@search')->name('frontend.search');
    /*** Url Search ***/

    Route::get('/page/{slugDetail}.html', 'Frontend\ContentController@detailPage')->name('frontend.page.detail');
    Route::get('/{slugCatalog}/{slugDetail}.html', 'Frontend\ContentController@detailLanding')->name('frontend.post.detailfull');

    Route::get('/{slug}.html', 'Frontend\ContentController@detailPost')->name('frontend.post.detail');
    Route::get('/{slug}', 'Frontend\ContentController@detailCatalog')->name('frontend.catalog.detail');
});

Route::get('storage/{name}', function ($name) {
    $path = storage_path($name);
    $mime = \File::mimeType($path);
    header('Content-type: ' . $mime);
    return readfile($path);
})->where('name', '(.*)');