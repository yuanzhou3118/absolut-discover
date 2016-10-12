<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index')->name('home');

//后台登陆
//登陆页面 #admin-login
Route::get('login', 'Admin\AdminController@login')->name('admin.login');
//提交登陆接口
Route::post('login', 'Admin\AdminController@doLogin')->name('admin.login.do');
//退出后台登陆 #admin-logout
Route::get('logout', 'Admin\AdminController@doLogout')->name('admin.logout');

//活动首页
Route::get('index', 'UserController@index')->name('user.home');
//二维码首页
Route::get('qrcode', 'UserController@qrCode')->name('user.qr.code');
//提交用户信息接口
Route::post('user-info', 'UserController@userInfo')->name('user.info');
//提交用户主题接口
Route::post('user-subject', 'UserController@userSubject')->name('user.subject');
//提交用户类型接口
Route::post('user-style', 'UserController@userStyle')->name('user.style');
//获取验证码接口
Route::post('captcha', 'UserController@mobile')->name('user.mobile');
//提交用户获取coupon券接口
Route::post('coupon', 'UserController@userCoupon')->name('user.coupon');

#houseparty
Route::get('house-party-index', 'Houseparty\UserController@index')->name('house.party.user.home');//首页
Route::get('house-party-user-info', 'Houseparty\UserController@userInfo')->name('house.party.user.info');
Route::get('house-party-theme', 'Houseparty\UserController@theme')->name('house.party.theme');
Route::post('house-party-captcha', 'Houseparty\UserController@mobile')->name('house.party.user.mobile');//获取验证码接口
Route::post('house-party-send-user', 'Houseparty\UserController@sendUserDataToAcxiom')->name('house.party.user.to.axiom');//提交用户获取coupon券接口;

Route::group(['middleware' => 'backend.auth'], function () {
    //后台主页
    Route::get('ad', 'Admin\AdminController@index')->name('backend.index');

    //导入coupon
    Route::post('import-coupon', 'Admin\AdminController@importCoupon')->name('import.coupon');
    //导出coupon
    Route::get('export-coupon', 'Admin\AdminController@exportCoupon')->name('export.coupon');
    //导出用户领券数据
    Route::get('export-user-coupon', 'Admin\AdminController@exportUserMsgCoupon')->name('export.user.coupon');
    //导出用户类型数据
    Route::get('export-user-style', 'Admin\AdminController@exportUserStyle')->name('export.user.style');
    //导出用户主题数据
    Route::get('export-user-subject', 'Admin\AdminController@exportUserSubject')->name('export.user.subject');

    //帮助中心 #ac
    //数据重置 #db-migrate-reset
    Route::get('acdmr', 'Admin\HelpCenterController@migrateReset')->name('db.migrate.reset');
    //清空缓存 #cache-clear
    Route::get('accc', 'Admin\HelpCenterController@clearCache')->name('cache.clear');
    //数据迁移 #db-migrate
    Route::get('acdm', 'Admin\HelpCenterController@migrate')->name('db.migrate');
    //初始化数据 #db-seed
    Route::get('acds', 'Admin\HelpCenterController@seed')->name('db.seed');
    //系统设置页面 #admin-setting
    Route::get('acas', 'Admin\HelpCenterController@appSetting')->name('admin.setting');
    //执行优化操作 #admin-optimize
    Route::get('acao', 'Admin\HelpCenterController@optimize')->name('admin.optimize');
    //查看系统log
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('sys.log');
});


