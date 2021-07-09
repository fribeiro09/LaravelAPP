<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('auth')
        ->group(function() {

    /**
     * Routes WorkLogs
     */
    Route::any('worklogs/search', 'WorkLogController@search')->name('worklogs.search');
    Route::resource('worklogs', 'WorkLogController');

    /**
     * Routes Employees
     */
    Route::any('employees/search', 'EmployeeController@search')->name('employees.search');
    Route::resource('employees', 'EmployeeController');

    /**
     * Routes Users
     */
    Route::any('users/{id}/profile', 'UserController@profile')->name('users.profile');
    Route::any('users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController');

    /**
     * Routes Reports
     */
    Route::any('reports/search', 'ReportController@search')->name('reports.search');
    Route::resource('reports', 'ReportController');

    Route::get('/', function () { return view('index'); })->name('admin.index');
});

Route::get('/', function () {
    if (Auth::guest()) {
        return view('auth.login');
    } else {
        return view('index');
    }
});

Auth::routes();

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/phpinfo', function () {
    phpinfo();
});

Route::get('/cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";
});
