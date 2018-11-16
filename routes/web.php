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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Users')->group(function () {

    Route::get('/dashboard', 'HomeController@admin')->middleware(['admin','verified']);
    Route::get('/staffhome', 'HomeController@staff')->middleware(['staff','verified']);
    Route::get('/donorhome', 'HomeController@donor')->middleware(['donor','verified']);
    Route::get('/candidatehome', 'HomeController@candidate')->middleware(['candidate','verified']);
    Route::get('/recipienthome', 'HomeController@recipient')->middleware(['recipient','verified']);

    //want to add
    Route::get('/doctorhome', 'HomeController@doctor')->middleware(['doctor','verified']);
    Route::get('/nursehome', 'HomeController@nurse')->middleware(['nurse','verified']);
    Route::get('/midwifehome', 'HomeController@midwife')->middleware(['midwife','verified']);


    
    Route::get('/clienthome', 'HomeController@client')->middleware(['client','verified']);
    Route::get('/donate', 'PageController@donate')->middleware(['client', 'verified']);
    Route::get('/request', 'PageController@request')->middleware(['client', 'verified']);



    Route::get('profile1', 'PageController@profile1');

    Route::get('profile2', 'PageController@profile2');

    //transaction pages
    Route::get('/screenings', 'PageController@screenings')->middleware(['verified']);
    Route::get('/requestings', 'PageController@requestings')->middleware(['verified']);

    //user maintenance
    Route::get('/adminadmins', 'PageController@adminadmins')->middleware(['verified']);
    Route::get('/candidates', 'PageController@candidates')->middleware(['verified']);
    Route::get('/clients', 'PageController@clients')->middleware(['verified']);
    Route::get('/doctors', 'PageController@doctors')->middleware(['verified']);
    Route::get('/donors', 'PageController@donors')->middleware(['verified']);
    Route::get('/nurses', 'PageController@nurses')->middleware(['verified']);
    Route::get('/recipients', 'PageController@recipients')->middleware(['verified']);
    Route::get('/staff', 'PageController@staff')->middleware(['verified']);    

    //file maintenance

    Route::get('/questions', 'PageController@questions')->middleware(['verified']);
    Route::get('/conditions', 'PageController@conditions')->middleware(['verified']);
    Route::get('/tests', 'PageController@tests')->middleware(['verified']);
    Route::get('/milks', 'PageController@milks')->middleware(['verified']);

});

Route::get('profile', 'Users\ProfileController@profile');
Route::put('profile/{id}', 'Users\ProfileController@update');


Route::post('senddonate', 'ScreeningController@store');
Route::post('senddonate2', 'ScreeningController@store2');

Route::post('sendrequest', 'RequestingController@store');
Route::post('sendrequest2', 'RequestingController@store2');

Route::get('approvedscreening/{id}', 'ScreeningController@approved');
Route::get('disapprovedscreening/{id}', 'ScreeningController@disapproved');

Route::get('requestreports', 'Users\PageController@requestreports');

Route::get('donationreports', 'Users\PageController@donationreports');

Route::get('medtest/{id}', 'ScreeningController@medtestshow');

Route::post('/postmedtest', 'ScreeningController@medtest');
Route::post('/postmedtest2', 'ScreeningController@medtest2');

Route::get('excelmilkrequest', 'ReportsController@excelmilkrequest');

// Route::get('requestpdf', 'ReportsController@requestpdf');

// Route::get('donationpdf', 'ReportsController@donationpdf');

Route::post('postrequestpdf', 'ReportsController@postrequestpdf');
Route::post('postdonationpdf', 'ReportsController@postdonationpdf');

Route::get('approvedrequesting/{id}', 'RequestingController@approved');
Route::get('disapprovedrequesting/{id}', 'RequestingController@disapproved');

Route::get('selectedquestion', 'Files\QuestionController@selectedquestion');

Route::get('countwrongquestion', 'ScreeningController@countwrongquestion');
Route::get('countwrongmedtest', 'ScreeningController@countwrongmedtest');

Route::get('check_approved_request', 'RequestingController@check_approved');

Route::get('check_approved_for_medical_test', 'ScreeningController@check_approved_for_medical_test');
Route::get('check_approved_to_donate', 'ScreeningController@check_approved_to_donate');

Route::get('checkscreeningmedtest', 'ScreeningController@checkmedtest');
Route::get('loadschedule', 'ScreeningController@loadschedule');

Route::get('notclaimedmilk', 'Users\PageController@notclaimedmilk');
Route::get('expiredmilk', 'Users\PageController@expiredmilk');
Route::get('donatedmilk', 'Users\PageController@donatedmilk');

Route::get('claimed', 'ReportsController@claimed');
Route::get('donated', 'ReportsController@donated');
Route::get('expired', 'ReportsController@expired');