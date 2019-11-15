<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('trangchu','PageController@trangchu')->name('trangchu');

#----------Auth---------------------

Route::get('','HomeController@index');
Route::get('login','AuthController@getLogin')->name('login');
Route::post('login','AuthController@postLogin');
Route::get('logout','AuthController@logout')->name('logout');
Route::get('register','AuthController@getRegister')->name('register');
Route::post('register','AuthController@postRegister');
Route::get('forgot','AuthController@getForgot')->name('forgot');

#--------------------------------------

#-------------CBQL---------------------

Route::get('cbql_duyetdk','CanboController@cbql_duyetdk')->name('cbql_duyetdk');
Route::get('get_cbql_duyetdk/{mssv}','LoadController@get_cbql_duyetdk')->name('get_cbql_duyetdk');
Route::get('get_cbql_huydk/{mssv}','LoadController@get_cbql_huydk')->name('get_cbql_huydk');
Route::get('get_cbql_ttsv/{mssv}','LoadController@get_cbql_ttsv')->name('get_cbql_ttsv');
#--------------------------------------

#----------Student---------------------

#----------Đăng_kí_phòng_ở--------
Route::get('student_dkphong','StudentController@student_dkphong')->name('student_dkphong');
Route::get('get_student_dkphong/{id}','LoadController@get_student_dkphong')->name('get_student_dkphong');
Route::get('student_chonphong/{id}','StudentController@student_chonphong')->name('student_chonphong');

#----------Xem đăng kí-----------
Route::get('student_xemdk','StudentController@student_xemdk')->name('student_xemdk');

#----------Thông_tin_cá_nhân-----------------
Route::get('student_ttcn','StudentController@student_ttcn')->name('student_ttcn');
Route::get('student_chinhsua','LoadController@getStudent_chinhsua')->name('student_chinhsua');
Route::post('student_chinhsua','LoadController@postStudent_chinhsua')->name('student_chinhsua');
Route::post('student_suatt','LoadController@student_suatt')->name('student_suatt');

#----------Thành_viên_cùng_phòng---
Route::get('student_bancp','StudentController@student_bancp')->name('student_bancp');

#---------Thông_tin_cán_bộ------------------
Route::get('student_cbql','StudentController@student_cbql')->name('student_cbql');
