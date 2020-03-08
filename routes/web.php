<?php
Auth::routes();
// Auth::routes(['verify' => true]);

Route::get('admin-login', 'Admin\LoginController@index')->name('admin.login');
Route::post('admin-handle-login', 'Admin\LoginController@handleLogin')->name('admin.handle.login');


Route::group(['namespace' =>'User'],function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/contact','HomeController@contact')->name('contact');
    Route::get('/about','HomeController@about')->name('about');
    Route::get('/partner','HomeController@partner')->name('partner');
    Route::get('/activate','HomeController@activate')->name('activate');
    Route::get('/event/{slug}','HomeController@eventDetail')->name('detail-event');
    Route::get('/event','HomeController@listEvent')->name('list-event');
});

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



    //Partner
    Route::get('partner', 'PartnerController@index')->name('system_admin.partner.index');
    Route::get('create/partner', 'PartnerController@create')->name('system_admin.partner.create');
    Route::post('create/partner', 'PartnerController@store')->name('system_admin.partner.store');
    Route::get('edit/partner/{id}', 'PartnerController@edit')->name('system_admin.partner.edit');
    Route::put('edit/partner/{id}', 'PartnerController@update')->name('system_admin.partner.update');
    Route::delete('partner/destroy', 'PartnerController@destroy')->name('system_admin.partner.destroy');
    Route::delete('partner/destroyAll', 'PartnerController@destroyAll')->name('system_admin.partner.destroyAll');
    Route::post('partner/restory', 'PartnerController@restore')->name('system_admin.partner.restore');

});