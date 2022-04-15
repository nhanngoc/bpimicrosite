<?php

use App\Http\Controllers\DepartmentController;
use App\Models\Department;

Route::group(['namespace' => 'Auth'], function () {

    Route::get('login', 'LoginController@showLoginForm')->name('access.login');
    Route::post('login', 'LoginController@login')->name('access.login');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('access.password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('access.password.email');

    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('access.password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('access.password.reset.post');
});

Route::group(['middleware' => 'admin'], function () {

    Route::get('sys/migrate', 'SysController@sysMigrate');

    Route::get('logout', [
        'as'         => 'access.logout',
        'uses'       => 'Auth\LoginController@logout',
        'permission' => false,
    ]);

    Route::get('/dashboard', [
        'as'         => 'dashboard.index',
        'uses'       => 'DashboardController@index',
        'permission' => false,
    ]);

    

   

   
    // Company routes
    Route::group(['prefix' => 'company-code', 'as' => 'company-code.'], function () {
        Route::resource('', 'CompanyCodeController')->parameters(['' => 'company-code']);
        Route::get('departments/{company_id}', 'CompanyCodeController@getDepartmentByCompanyId')->name('getDepartmentByCompanyId');
    });

    // Department routes
    Route::group(['prefix' => 'department', 'as' => 'department.'], function () {
        Route::resource('', 'DepartmentController')->parameters(['' => 'department']);
    });

    

    // User groups routes
    Route::group(['prefix' => 'user-group', 'as' => 'user-group.'], function () {
        Route::resource('', 'UserGroupController')->parameters(['' => 'user-group']);
    });

   


    Route::resource('roles', 'RoleController');

    Route::resource('users', 'UserController');

    Route::resource('customer', 'CustomerController');


    Route::group(['prefix' => 'settings'], function () {
        Route::get('general/', [
            'as'         => 'settings.options',
            'uses'       => 'SettingController@getOptions',
            'permission' => false,
        ]);

    });

    Route::resource('audit-logs', 'AuditHistoryController', ['names' => 'audit-log'])->only(['index', 'destroy']);
});
