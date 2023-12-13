<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->namespace('Admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/','HomeController@index')->name('home');
    Route::get('/data','HomeController@data')->name('home.data');
    Route::get('/RowData','HomeController@RowData')->name('home.RowData');
    Route::get('/Attendance','HomeController@Attendance')->name('home.Attendance');
    Route::get('/TodaySalary','HomeController@TodaySalary')->name('home.TodaySalary');
    Route::resource('/rows','RowController')->except('show');
    Route::resource('/students','StudentController');
     	Route::get('/status','StudentController@status')->name('students.status');
    Route::get('/student/card/{id}','StudentController@card')->name('students.card');
    Route::post('/student/search','StudentController@search')->name('students.search');
    Route::resource('/salary','SalaryController');
    Route::get('/notpay','SalaryController@notIndex')->name('students.notpay');

    Route::post('/salary/search','SalaryController@search')->name('salary.search');
    Route::get('/salary/feature/all','SalaryController@feature')->name('salary.feature');
    Route::post('/salary/feature/post','SalaryController@featurePost')->name('salary.feature.post');
    Route::resource('/table','TableController');
    Route::post('/table/search','TableController@search')->name('table.search');
    Route::resource('/subject','SubjectController')->except('show');
    Route::resource('/teacher','TeacherController')->except('show');
    Route::resource('/teacher_attendance','TeacherAttendanceController');
    Route::post('/teacher_attendance/search','TeacherAttendanceController@search')->name('teacher_attendance.search');
    Route::get('/student_attendance','StudentAttendanceController@index')->name('student_attendance.index');
    Route::post('/student_attendance','StudentAttendanceController@attendance')->name('student_attendance.attendance');
    Route::delete('/student_attendance/delete/{id}','StudentAttendanceController@destroy')->name('student_attendance.destroy');
    Route::post('/student_attendance/search','StudentAttendanceController@search')->name('student_attendance.search');
    Route::get('/fatora','FatoraController@index')->name('fatora.index')->middleware('admin');
    Route::post('/fatora/search','FatoraController@search')->name('fatora.search')->middleware('admin');
    Route::post('/fatora/pay','FatoraController@pay')->name('fatora.pay');
    Route::resource('/user','UserController')->middleware('admin')->except('show');
    Route::get('edit/profile','HomeController@editProfile')->name('edit.profile');
    Route::post('edit/profile','HomeController@editProfilePost')->name('edit.profile.post');
    Route::get('edit/password','HomeController@editPassword')->name('edit.password');
    Route::post('edit/password','HomeController@editPasswordPost')->name('edit.password.post');
});

Auth::routes(['register' => false, 'reset' => false,'confirm'=>false]);

Route::get('/', 'HomeController@index')->name('home');

Route::fallback(function () {

    return view('404');

});
