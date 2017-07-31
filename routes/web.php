<?php

Route::prefix(config('larablog.routes.frontend'))->middleware('web')->namespace('\Naoray\Larablog\Http\Controllers')->group(function () {
    Route::get('/', 'BlogController@index')->name('larablog.posts');
    Route::get('/{slug}', 'BlogController@show')->name('larablog.post.show');
});

Route::prefix(config('larablog.routes.backend'))->middleware(['web', 'auth'])->namespace('\Naoray\Larablog\Http\Controllers')->group(function () {
    Route::name('larablog.backend')->resource('posts', 'PostsController');
});
