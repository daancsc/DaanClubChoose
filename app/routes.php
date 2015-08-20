<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/','IndexController@index');

Route::post('/login','StuAccountController@login');
Route::group(array('before' => 'stu_login'), function()
{
    Route::get('/logout','StuAccountController@logout');
    Route::get('/student','RouteController@chooselist');
    Route::post('/student','WriteController@choosewrite');
    Route::get('/chosenchange','ChangeController@chosenchange');
    Route::post('/resultwrite','WriteController@write');
    Route::get('/noresultchange','ChangeController@noresultchange');
});



Route::get('/admin','IndexController@admin');

Route::post('/admin','AccountController@login');
Route::group(array('before' => 'auth'), function()
{
    Route::get('/admin.logout','AccountController@logout');
    Route::get('/admin.setting','SettingController@settingview');
    Route::post('/admin.setting','SettingController@settingwrite');
    Route::get('/admin.club','ClubController@clubview');
    Route::post('/admin.club','ClubController@clubwrite');
    Route::get('/admin.club.del.{id}','ClubController@clubdel');
    Route::get('/admin.club.sort.{uid}.{did}','ClubController@clubsort');
    Route::get('/admin.student','StudentController@studentview');
    Route::post('/admin.student','StudentController@studentwrite');
    Route::get('/admin.student.del.{id}','StudentController@studentdel');
    Route::get('/admin.student.modify.{id}','StudentController@studentmodify');
    Route::post('/admin.student.modify.{id}','StudentController@studentmodifywrite');
    Route::get('/admin.forced.{id}.{clubid?}','StudentController@studentforced');
    Route::get('/admin.status','StatusController@statusview');
    Route::get('/admin.status.{id}','StatusController@statusfind');
    Route::get('/admin.result','ResultController@resultview');
    Route::get('/admin.result.{sort}.{id}','ResultController@resultfind');
    Route::get('/admin.noresult','ResultController@noresultview');
    Route::get('/admin.reset','ResetController@reset');
    Route::post('/admin.reset','ResetController@resetwrite');
    Route::get('/admin.deal','DealController@dealview');
    Route::post('/admin.deal','DealController@dealwrite');
    Route::get('/admin.doc','WordController@doc');
    Route::post('/admin.doc','WordController@docmake');
});

Route::get('/error',function(){
    return View::make('error');
});

/*
Route::post('/login','StudentController@login');

Route::group(array('before' => 'stu_login'), function()
{
    Route::get('/logout','StudentController@logout');
    Route::get('/student','StudentController@chooselist');
    Route::post('/student','StudentController@choosewrite');
    Route::get('/chosenchange',function (){
        return Redirect::to('./student')->with('change','1');
    });
    Route::post('/resultwrite','StudentController@write');
    Route::get('/noresultchange',function (){
        return Redirect::to('./student')->with('change','2');
    });
});





Route::post('/admin','AdminController@login');

Route::group(array('before' => 'auth'), function()
{
    Route::get('/admin.logout','AdminController@logout');
    Route::get('/admin.setting','AdminController@settingview');
    Route::post('/admin.setting','AdminController@settingwrite');
    Route::get('/admin.club','AdminController@clubview');
    Route::post('/admin.club','AdminController@clubwrite');
    Route::get('/admin.club.del.{id}','AdminController@clubdel');
    Route::get('/admin.club.sort.{uid}.{did}','AdminController@clubsort');
    Route::get('/admin.student','AdminController@studentview');
    Route::post('/admin.student','AdminController@studentwrite');
    Route::get('/admin.student.del.{id}','AdminController@studentdel');
    Route::get('/admin.student.modify.{id}','AdminController@studentmodify');
    Route::post('/admin.student.modify.{id}','AdminController@studentmodifywrite');
    Route::get('/admin.forced.{id}.{clubid?}','AdminController@studentforced');
    Route::get('/admin.status','AdminController@statusview');
    Route::get('/admin.status.{id}','AdminController@statusfind');
    Route::get('/admin.result','AdminController@resultview');
    Route::get('/admin.result.{sort}.{id}','AdminController@resultfind');
    Route::get('/admin.noresult','AdminController@noresultview');
    Route::get('/admin.reset','AdminController@reset');
    Route::post('/admin.reset','AdminController@resetwrite');
    Route::get('/admin.deal','DealController@dealview');
    Route::post('/admin.deal','DealController@dealwrite');
    Route::get('/admin.doc','AdminController@doc');
    Route::post('/admin.doc','AdminController@docmake');
});
*/


Route::when('admin*','https');
Route::when('*', 'csrf', array('post'));










/*
Route::get('/admin/hash/{pwd}',function ($pwd){
    return Hash::make($pwd);
});
*/

