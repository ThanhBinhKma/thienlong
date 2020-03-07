<?php
Auth::routes();
// Auth::routes(['verify' => true]);

Route::get('admin-login', 'Admin\LoginController@index')->name('admin.login');
Route::post('admin-handle-login', 'Admin\LoginController@handleLogin')->name('admin.handle.login');
Route::post('images-delete', 'User\HomeController@deleteImage')->name('images-delete');
Route::post('images-save', 'User\HomeController@saveImage')->name('images-save');

Route::get('/', 'User\HomeController@index')->name('home');

Route::group(['prefix' => 'system-admin', 'namespace' => 'Admin', 'middleware' => 'adminLogin'], function () {
    Route::get('/', 'DashboardController@index')->name('system_admin.dashboard');
    // Member

    Route::get('member', 'MemberController@index')->name('system_admin.member.index');
    Route::get('create/member', 'MemberController@create')->name('system_admin.member.create');
    Route::post('create/member', 'MemberController@store')->name('system_admin.member.store');
    Route::get('edit/member/{id}', 'MemberController@edit')->name('system_admin.member.edit');
    Route::put('edit/member/{id}', 'MemberController@update')->name('system_admin.member.update');
    Route::delete('member/destroy', 'MemberController@destroy')->name('system_admin.member.destroy');
    Route::delete('member/destroyAll', 'MemberController@destroyAll')->name('system_admin.member.destroyAll');
    Route::post('member/restory', 'MemberController@restore')->name('system_admin.member.restore');

    //Event
    Route::get('event', 'EventController@index')->name('system_admin.event.index');
    Route::get('create/event', 'EventController@create')->name('system_admin.event.create');
    Route::post('create/event', 'EventController@store')->name('system_admin.event.store');
    Route::get('edit/event/{id}', 'EventController@edit')->name('system_admin.event.edit');
    Route::put('edit/event/{id}', 'EventController@update')->name('system_admin.event.update');
    Route::delete('event/destroy', 'EventController@destroy')->name('system_admin.event.destroy');
    Route::delete('event/destroyAll', 'EventController@destroyAll')->name('system_admin.event.destroyAll');
    Route::post('event/restory', 'EventController@restore')->name('system_admin.event.restore');

    //Media
    Route::get('media', 'MediaController@index')->name('system_admin.media.index');
    Route::get('create/media', 'MediaController@create')->name('system_admin.media.create');
    Route::post('create/media', 'MediaController@store')->name('system_admin.media.store');
    Route::get('edit/media/{id}', 'MediaController@edit')->name('system_admin.media.edit');
    Route::put('edit/media/{id}', 'MediaController@update')->name('system_admin.media.update');
    Route::delete('media/destroy', 'MediaController@destroy')->name('system_admin.media.destroy');
    Route::delete('media/destroyAll', 'MediaController@destroyAll')->name('system_admin.media.destroyAll');
    Route::post('media/restory', 'MediaController@restore')->name('system_admin.media.restore');


    Route::post('upload-image', 'ImageController@fileStore')->name('system_admin.fileStore');
    Route::post('delete-image', 'ImageController@fileDestroy')->name('system_admin.fileDestroy');
    //Submedia
    Route::get('sub-media', 'SubMediaController@index')->name('system_admin.submedia.index');
    Route::get('create/sub-media', 'SubMediaController@create')->name('system_admin.submedia.create');
    Route::post('create/sub-media', 'SubMediaController@store')->name('system_admin.submedia.store');
    Route::get('edit/sub-media/{id}', 'SubMediaController@edit')->name('system_admin.submedia.edit');
    Route::put('edit/sub-media/{id}', 'SubMediaController@update')->name('system_admin.submedia.update');
    Route::delete('sub-media/destroy', 'SubMediaController@destroy')->name('system_admin.submedia.destroy');
    Route::delete('sub-media/destroyAll', 'SubMediaController@destroyAll')->name('system_admin.submedia.destroyAll');
    Route::post('sub-media/restory', 'SubMediaController@restore')->name('system_admin.submedia.restore');

    //Produce
    Route::get('produce', 'ProduceController@index')->name('system_admin.produce.index');
    Route::get('create/produce', 'ProduceController@create')->name('system_admin.produce.create');
    Route::post('create/produce', 'ProduceController@store')->name('system_admin.produce.store');
    Route::get('edit/produce/{id}', 'ProduceController@edit')->name('system_admin.produce.edit');
    Route::put('edit/produce/{id}', 'ProduceController@update')->name('system_admin.produce.update');
    Route::delete('produce/destroy', 'ProduceController@destroy')->name('system_admin.produce.destroy');
    Route::delete('produce/destroyAll', 'ProduceController@destroyAll')->name('system_admin.produce.destroyAll');
    Route::post('produce/restory', 'ProduceController@restore')->name('system_admin.produce.restore');

});