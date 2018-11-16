<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Users')->group(function () {

    Route::get('adminarchives', 'AdminController@archives');
    Route::get('staffarchives', 'StaffController@archives');
    Route::get('doctorarchives', 'DoctorController@archives');
    Route::get('nursearchives', 'NurseController@archives');
    Route::get('recipientarchives', 'RecipientController@archives');
    Route::get('donorarchives', 'DonorController@archives');
    Route::get('candidatearchives', 'CandidateController@archives');

    Route::get('doctorrestore/{id}', 'DoctorController@restore');
    Route::get('nurserestore/{id}', 'NurseController@restore');

    Route::get('donorrestore/{id}', 'DonorController@restore');
    Route::get('recipientrestore/{id}', 'RecipientController@restore');
    Route::get('candidaterestore/{id}', 'CandidateController@restore');
    Route::get('doctorforcedelete/{id}', 'DoctorController@forcedelete');
    Route::get('nurseforcedelete/{id}', 'NurseController@forcedelete');
    Route::get('adminforcedelete/{id}', 'AdminController@forcedelete');


    Route::apiResources([
        'admin' => 'AdminController',
        'staff' => 'StaffController',
        'doctor' => 'DoctorController',
        'nurse' => 'NurseController',
        'recipient' => 'RecipientController',
        'donor' => 'DonorController',
        'candidate' => 'CandidateController',
    ]);
});


Route::namespace('Files')->group(function () {
    Route::get('questionarchives', 'QuestionController@archives');
    Route::get('testarchives', 'TestController@archives');
    Route::get('conditionarchives', 'ConditionController@archives');

    Route::get('questionrestore/{id}', 'QuestionController@restore');
    Route::get('testrestore/{id}', 'TestController@restore');
    Route::get('conditionrestore/{id}', 'ConditionController@restore');

    Route::get('notavailable', 'MilkController@not_available');
    Route::get('pending', 'MilkController@pending');

    Route::get('milk2', 'MilkController@milk2');
    Route::post('givemilk/{id}', 'MilkController@givemilk');

    Route::get('newmilk', 'MilkController@newmilk');
    Route::get('milkdonor', 'MilkController@donors');
    Route::put('adddonormilk/{id}', 'MilkController@adddonor');
    Route::post('addcontainermilk', 'MilkController@addcontainer');
    Route::get('change/{id}', 'ContainerController@change');

    Route::apiResources([
        'condition' => 'ConditionController',
        'test' => 'TestController',
        'question' => 'QuestionController',
        'milk' => 'MilkController',
        'container' => 'ContainerController',
    ]);
});


Route::apiResources([
    'screening' => 'ScreeningController',
    'requesting' => 'RequestingController',
]);



Route::get('test2', 'Files\TestController@test2');
Route::get('test3', 'Files\TestController@test3');


Route::get('sapprovedlist', 'ScreeningController@approvedlist');
Route::get('sdisapprovedlist', 'ScreeningController@disapprovedlist');

Route::get('rapprovedlist', 'RequestingController@approvedlist');
Route::get('rdisapprovedlist', 'RequestingController@disapprovedlist');

Route::put('schedule/{id}', 'ScreeningController@schedule');
Route::get('schedulelist', 'ScreeningController@schedulelist');

Route::get('displaydonation', 'ReportsController@displaydonation');
Route::get('displaymilkrequest', 'ReportsController@displaymilkrequest');

Route::put('profile/{id}', 'Users\ProfileController@update');
Route::put('profile2/{id}', 'Users\ProfileController@update2');

Route::post('medtest', 'ScreeningController@medtest2');


