<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::auth();
    
    //form companies
    Route::any('/company','CompanyController@index');
    Route::any('/company/delete/{id}','CompanyController@destroy');
    Route::get('company/add', function () {
        return view('company.add');
    });
    Route::any('/company/store','CompanyController@store');
    Route::any('/company/edit/{id}','CompanyController@edit');
    Route::any('/company/update/{id}','CompanyController@update');

    //from workers
    Route::any('/worker','WorkerController@index');
    Route::any('/worker/delete/{id}','WorkerController@destroy');
    Route::get('worker/add', 'WorkerController@add');

    Route::any('/worker/store','WorkerController@store');
    Route::any('/worker/edit/{id}','WorkerController@edit');
    Route::any('/worker/update/{id}','WorkerController@update');
});
