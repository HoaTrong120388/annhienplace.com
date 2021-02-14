<?php

use Illuminate\Http\Request;

Route::post('nap-the','NapTheController@send')->name("api.napthe.send");

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});