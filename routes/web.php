<?php
Auth::routes();
// Auth::routes(['verify' => true]);
 
Route::get('admin-login','Admin\LoginController@index')->name('admin.login');
Route::post('admin-handle-login','Admin\LoginController@handleLogin')->name('admin.handle.login');
Route::post('images-delete','User\HomeController@deleteImage')->name('images-delete');
Route::post('images-save','User\HomeController@saveImage')->name('images-save');
Route::get('lang/{lang}','LangController@lang')->name('lang');

Route::group(['prefix' => 'system-admin', 'namespace' => 'Admin' , 'middleware' => 'adminLogin' ], function () {
  Route::get('/', 'DashboardController@index')->name('system_admin.dashboard');
  Route::get('mails', 'MailController@index')->name('system_admin.email.index');


  /*
    Account
  */
  Route::get('account', 'AccountController@index')->name('system_admin.account.index');
  Route::get('create-account','AccountController@create')->name('system_admin.account.create');
  Route::post('store-account','AccountController@store')->name('system_admin.account.store');

  Route::get('edit-account-{id}','AccountController@edit')->name('system_admin.account.edit');

  Route::put('update-account-{id}','AccountController@update')->name('system_admin.account.update');

  Route::delete('account/destroy','AccountController@destroy')->name('system_admin.account.destroy');
  Route::delete('account/destroyAll','AccountController@destroyAll')->name('system_admin.account.destroyAll');
  Route::post('account/restory','AccountController@restore')->name('system_admin.account.restore');
  /*
  |------------- -------------------------------------------------------------
  | Category
  |--------------------------------------------------------------------------
  */

  Route::get('category','CategoryController@index')->name('system_admin.category.index');
  Route::get('category/create','CategoryController@create')->name('system_admin.category.create');
  Route::get('category/edit/{id}','CategoryController@edit')->name('system_admin.category.edit');
  Route::put('category/update/{id}','CategoryController@update')->name('system_admin.category.update');
  Route::post('category/store','CategoryController@store')->name('system_admin.category.store');
  Route::delete('category/destroy','CategoryController@destroy')->name('system_admin.category.destroy');
  Route::delete('category/destroyAll','CategoryController@destroyAll')->name('system_admin.category.destroyAll');
  Route::post('category/restory','CategoryController@restore')->name('system_admin.category.restory');


  /*
  |--------------------------------------------------------------------------
  | post
  |--------------------------------------------------------------------------
  */
  Route::get('post','PostController@index')->name('system_admin.post.index');
  Route::get('post-list-account','PostController@listAccount')->name('system_admin.post.list_account');
  Route::get('post-api','PostController@checkPost')->name('system_admin.post.up');

  /*
  |--------------------------------------------------------------------------
  | List Post
  |--------------------------------------------------------------------------
  */
  Route::get('list-post','ListPostController@index')->name('system_admin.list_post.index');
  Route::get('view-list-post-{id}','ListPostController@view')->name('system_admin.list_post.view');


  Route::get('view-list-kma','PostController@kma')->name('system_admin.kma.index');
  Route::post('dangki-kma','PostController@testKma')->name('system_admin.kma.testKma');


  // Member

  Route::get('member','MemberController@index')->name('system_admin.member.index');
  Route::get('create/member','MemberController@create')->name('system_admin.member.create');
  Route::post('create/member','MemberController@store')->name('system_admin.member.store');
  Route::get('edit/member/{id}','MemberController@edit')->name('system_admin.member.edit');
});