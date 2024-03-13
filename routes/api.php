<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


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



Route::group(['middleware' => 'auth:api'], function () {


    //Valuation Module
    Route::get('/getCategory', 'ValuationController@getCategory');
    Route::get('/getConsultants', 'ValuationController@getConsultants');
    Route::get('/getDistricts', 'ValuationController@getDistricts');
    Route::get('/getSubcategory/{id}', 'ValuationController@getSubcategory');
    Route::post('/addValuationJob', 'ValuationController@addJob');
    Route::post('/addInspectionJob', 'InspectionsController@addJob');
    Route::get('/getMuccadums', 'InspectionsController@getMuccadums');
    Route::get('/getFacilities', 'InspectionsController@getFacilities');


    // Verification Module
    Route::post('/addVerificationJob', 'VerificationsController@addJob');

    Route::get('/getEmployees', 'ValuationController@getEmployees');
    Route::get('/getClasses', 'ValuationController@getClasses');
    Route::get('/getEmployeesById/{id}', 'ValuationController@getEmployeesById');
    Route::get('/getBodyTypes', 'ValuationController@getBodyTypes');
    Route::get('/getRimTypes', 'ValuationController@getRimTypes');
    Route::put('/storeReportData/{id}', 'ValuationController@storeReportData');
    Route::get('/getReportDetails/{id}', 'ValuationController@getReportDetails');

    //Supervision Module
    Route::post('/addSupervisionjob', 'SupervisionController@create');
    Route::put('/updateSupervisionLetterData/{id}', 'SupervisionController@updateSupervisionLetterData');


    //Legal Service

    Route::post('/addLegalServiceJob', 'LegalServiceController@addJob');
    Route::post('/addLineManager', 'LegalServiceController@addManager');

    //Prism 

    Route::post('/addPrismJob', 'PrismController@addPrismJob');
    Route::post('/addJobByPerson', 'PrismController@addJobByPerson');


    Route::get('/getsurveystats', 'PrismController@getSurveyStats');
    Route::get('/getsurveystatsbyregion/{id}', 'PrismController@getSurveyStatsbyRegion');
    Route::get('/getPrismSurveyors', 'PrismController@getPrismSurveyors');
    Route::post('/updatePrismJob/{id}', 'PrismController@updatePrismJob');
    Route::get('/getPrismSurveys/{id}', 'PrismAppController@getPrismSurveys');
    Route::get('/gePrismJobData/{id}', 'PrismController@gePrismJobData');
    Route::put('/updatePrismJob/{id}', 'PrismController@updatePrismJob');
    Route::get('/gePrismSurveyDetails/{id}', 'PrismAppController@getSurveyDetails');
    Route::post('/updateSurveyDetails/{id}', 'PrismAppController@updateSurveyDetails');
    Route::get('/getVehicleDetails/{id}', 'PrismAppController@getVehicleDetails');
    Route::post('/updateVehicleDetails/{id}', 'PrismAppController@updateVehicleDetails');
    Route::post('/updatePrismBill/{id}', 'PrismController@printBill');
    Route::get('/getMake/{id}', 'PrismController@getMake');
    Route::get('/getsurveysBySurveyor/{id}', 'PrismController@getsurveysBySurveyor');
    Route::post('/updateRemarks/{id}', 'PrismAppController@updateRemarks');
    Route::get('/getSurveyRemarks/{id}', 'PrismAppController@getSurveyRemarks');

    Route::get('/getBodyObservation/{id}', 'PrismAppController@getBodyObservation');
    Route::post('/updateBodyObservation/{id}', 'PrismAppController@updateBodyObservation');
    Route::post('/updateCordinates/{id}', 'PrismAppController@updateCordinates');

    Route::get('/getInsuredEstimateValues/{id}', 'PrismAppController@getInsuredEstimateValues');
    Route::post('/updateInsuredEstimateValues/{id}', 'PrismAppController@updateInsuredEstimateValues');

    Route::get('/getReceivingImpDoc/{id}', 'PrismAppController@getReceivingImpDoc');
    Route::post('/updateReceivingImpDoc/{id}', 'PrismAppController@updateReceivingImpDoc');
    Route::post('/process/{id}', 'PrismAppController@process');
    Route::post('/addPrismImage/{id}', 'PrismAppController@addImage');
    Route::get('/getPrismImages/{id}', 'PrismAppController@getImages');
    Route::post('/updateLetterHead/{id}', 'PrismController@updateLetterHead');
    Route::post('/updateStamp/{id}', 'PrismController@updateStamp');
    Route::post('/updateIsImages/{id}', 'PrismController@updateIsImages');
    Route::post('/updatePartRates/{id}', 'PrismController@updatePartRates');
    Route::post('/updateReportType/{id}', 'PrismController@updateReportType');
    Route::post('/submitPrismSurvey/{id}', 'PrismAppController@submitSurvey');
    Route::post('/addPrismModalAccessories/{id}', 'PrismAppController@addPrismModalAccessories');
    Route::get('/getPrismModalAccessories/{id}', 'PrismAppController@getPrismModalAccessories');
    Route::put('/updatePrismLetterData/{id}', 'PrismController@updatePrismLetterData');


    Route::post('/updateTravellingExpense/{id}', 'PrismAppController@updateTravellingExpense');
    Route::get('/getTravellingExpense/{id}', 'PrismAppController@getTravellingExpense');


    //Muccadum 
    
    Route::post('/addMucJob', 'MuccaduumController@addJob');
    


    //IE 

    Route::post('/addIeJob', 'IEController@addJob');
    




});
