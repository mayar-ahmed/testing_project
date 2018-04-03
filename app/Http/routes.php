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
Route::group(['middleware'=>['web']],function()
{



});
//-----------------ADMIN ROUTES-----------------//
Route::auth();
Route::get('/admin/addcourse' ,'AdminController@addCoursePage');
Route::get('/admin/editcourse/{course}' ,'AdminController@editCoursePage');
Route::get('/admin/course_description/{courseID}',['as'=>'cd','uses'=>'AdminController@ACourseDescription']);
Route::get('/admin/courses/{category}','AdminController@ACoursesByCategory');
Route::get('/admin/registrant/{registrantID}', ['as'=>'reg','uses'=>'AdminController@singleRegistrant']);
Route::get('/admin/search/{category}/{name}','AdminController@searchCourse');
Route::get('/admin','AdminController@index');
Route::get('/admin/messages','AdminController@messages');
Route::get('/admin/downloadmaterial/{courseID}','CourseController@downloadAdmin');

Route::get('/admin/deletecourse/{course_id}', 'CourseController@deleteCourse');
Route::get('/admin/latestregistrations', 'AdminController@latestRegistrations');
Route::get('/admin/courseregistrations/{course}', 'CourseController@courseRegistrations');
Route::get('/admin/deleteregistration/{course}/{registrant_id}', 'CourseController@deleteRegistration');
Route::get('/admin/confirmregistration/{course}/{registrant_id}','RegistrantController@confirm');
Route::post('/admin/messages/{m}','MessageController@send');
Route::post('/admin/editcourse/{course}' ,'CourseController@editCourse');
Route::post('/addcourse' ,'CourseController@addCourse');
Route::post('/admin/searchreg', 'RegistrantController@Registrant_validation');
Route::post('/admin/searchcourse', 'CourseController@searchAdmin');
Route::post('/search', 'CourseController@searchPublic');
Route::get('/logout', 'AdminController@logout');
Route::get('/admin/deletemessage/{message_id}','MessageController@deleteMessage');


Route::get('/searchcourse/{courseName}', 'HomeController@search');
Route::get('/course_description/{courseID}','CourseController@CCourseDescription');
Route::get('/courses/{category}','CourseController@CCoursesByCategory');
Route::get('/', 'HomeController@index');
Route::get('/contactus', 'HomeController@contact');

Route::post('/registeration/{courseID}','RegistrantController@Registration');
Route::post('/feedback', 'MessageController@feedback');
Route::post('/course_description/{courseID}/download','CourseController@download');

Route::post('/course_description/{courseID}/addreview' ,'RegistrantController@addReview');
Route::post('/course_description/{courseID}/addrating' ,'RegistrantController@addRating');


