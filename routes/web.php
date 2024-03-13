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

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
Route::get('/password', function () {

    $original='ayaz3258';
    // // Encrypted
    $password = Hash::make($original);

    // $decrypted_string = Crypt::decrypt('$2y$10$BC1O2pa.EEmqargQ5QO1Z.R0Q.xSxuPH4BrfrggcbZl.C7dMPcvN6');
    $value = Crypt::decrypt($password);
    // echo $password;
    return $value;
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('/random', function () {
    // return view('welcome');
    $i="usama sadsa sdda";
    echo $i."<br>";
    echo Str::slug($i);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/homeav', 'HomeController@verificationav')->name('homeav');
Route::get('/banker', 'BankersController@index')->name('banker');
// Route::get('/Dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/Dashboard', 'HomeController@index')->name('dashboard');
Route::get('/Muccaduum', 'DashboardController@muccaduum');
Route::get('/Clearing', 'DashboardController@clearing');
Route::get('/bir', 'DashboardController@bir');
Route::get('/ie', 'DashboardController@ie');
Route::get('/mvr', 'DashboardController@mvr');
Route::get('/lcr', 'DashboardController@lcr');
Route::get('/mcr', 'DashboardController@mcr');
Route::get('/legal-service', 'DashboardController@legal_service');

Route::get('/supervision', 'DashboardController@supervision');
Route::get('/supervisionCreate', 'SupervisionController@index');
Route::get('/getTerminalsForSupervision', 'SupervisionController@getTerminalsForSupervision');
Route::get('/getWarehousesForSupervision', 'SupervisionController@getWarehousesForSupervision');
Route::get('/getGodownsForSupervision', 'SupervisionController@getGodownsForSupervision');
Route::get('/getWarehouseAddressForFrom/{id}', 'SupervisionController@getWarehouseAddressForFrom');
Route::get('/getGodownData/{id}', 'SupervisionController@getGodownData');
Route::post('/addWarehouse', 'SupervisionController@addWarehouse');
Route::post('/addGodown', 'SupervisionController@addGodown');

Route::get('/getPackagesForSupervision', 'SupervisionController@getPackagesForSupervision');

Route::get('/getAgentsForSupervision', 'SupervisionController@getAgentsForSupervision');

Route::get('/getConsigmentsForSupervision', 'SupervisionController@getConsigmentsForSupervision');

Route::get('/getTransportersForSupervision', 'SupervisionController@getTransportersForSupervision');

Route::post('/addAgent', 'SupervisionController@addAgent');
Route::post('/addTransporter', 'SupervisionController@addTransporter');
Route::get('/getSupervisionJob/{id}', 'SupervisionController@getSupervisionJob');
Route::get('/getLetterData/{id}', 'SupervisionController@getLetterData');

Route::get('/printSupervisionLogReport/{id}', 'SupervisionController@printLogReport');
Route::get('/printSupervisionLetter/{id}', 'SupervisionController@printLetter');

Route::put('/updateSupervision/{id}', 'SupervisionController@updateSupervision');
Route::post('/printSupBill', 'SupervisionController@printBill');


Route::get('/inspection', 'DashboardController@inspection');
Route::get('/verification', 'DashboardController@verification');
Route::get('/prism', 'DashboardController@prism');
Route::get('/inspectionByParam', 'DashboardController@inspectionByParam');
Route::get('/getLivestockMis', 'InspectionsController@getLivestockMis');
Route::get('/getBankRepresentatives/{id}', 'InspectionsController@getBankRepresentatives');
Route::get('/getBankRepresentativesDetails', 'InspectionsController@getBankRepresentativesDetails');
Route::get('/mis', 'InspectionsController@getMIS');

Route::get('/inspectionCreate', 'DashboardController@inspectionCreate');
Route::post('/printInsBill', 'InspectionsController@printBill');
Route::put('/saveInsReport/{id}', 'InspectionsController@saveInsReport');
Route::put('/saveDetailsofanimals/{id}', 'InspectionsController@saveDetailsofanimals');
Route::put('/saveDetailsofRemarks/{id}', 'InspectionsController@saveDetailsofRemarks');
Route::post('/addDetailsofanimalsRow/{id}', 'InspectionsController@addDetailsofanimalsRow');
Route::post('/addDetailsofanimalsRemark/{id}', 'InspectionsController@addDetailsofanimalsRemark');
Route::get('/getDetailsofanimals/{id}', 'InspectionsController@getDetailsofanimals');
Route::get('/getRemarksDetails/{id}', 'InspectionsController@getRemarksDetails');
Route::get('/getLiveStockDetails/{id}', 'InspectionsController@getLiveStockDetails');
Route::post('/deleteInspectionDetailsItem/{id}', 'InspectionsController@deleteInspectionDetailsItem');
Route::post('/deleteInspectionDetailsRemarks/{id}', 'InspectionsController@deleteInspectionDetailsRemarks');
Route::get('/printInsReport/{id}', 'InspectionsController@printReport');
Route::get('/getInspectionJob/{id}', 'InspectionsController@getInspectionJob');
Route::get('/getCustomerAddress/{id}', 'InspectionsController@getCustomerAddress');
Route::put('/updateInspection/{id}', 'InspectionsController@updateInspection');
Route::put('/updateOrder/{id}', 'InspectionsController@updateOrder');
Route::get('/getLivestockImages/{id}', 'InspectionsController@getLivestockImages');
Route::post('/deleteLivestockImage/{id}', 'InspectionsController@deleteLivestockImage');
Route::put('/cancelInspection/{id}', 'InspectionsController@cancelInspection');
Route::put('/holdInspection/{id}', 'InspectionsController@holdInspection');

Route::put('/cancelSupervision/{id}', 'SupervisionController@cancelSupervision');
Route::put('/holdSupervision/{id}', 'SupervisionController@holdSupervision');


Route::get('/verificationCreate', 'VerificationsController@verificationCreate');
Route::get('/verificationPending', 'VerificationsController@verificationPending');
Route::get('/getVerificationJob/{id}', 'VerificationsController@getVerificationJob');
Route::get('/getVerificationDetails/{id}', 'VerificationsController@getVerificationDetails');
Route::put('/updateVerification/{id}', 'VerificationsController@updateVerification');
Route::put('/cancelVerification/{id}', 'VerificationsController@cancelVerification');
Route::put('/holdVerification/{id}', 'VerificationsController@holdVerification');
Route::post('/printVerBill', 'VerificationsController@printBill');
Route::post('/addVerificationJobsBulk', 'VerificationsController@uploadJobsinbulk');
// Route::get('/verifications', 'VerificationsController@verifications');
Route::get('/getExcel', 'VerificationsController@uploadExcel');
Route::get('/verification-perfoma', 'VerificationsController@perfoma');
Route::get('/getQCOfficers', 'VerificationsController@getQCOfficers');
Route::get('/getSurveyors', 'VerificationsController@getSurveyors');
Route::get('/getSurveyImages/{id}', 'VerificationsController@getSurveyImages');
Route::get('/getSurveysForERP/{id}', 'VerificationsController@getSurveys');
Route::get('/getSurveysData/{id}', 'VerificationsController@getSurveysData');
Route::get('/getDocumentsList', 'VerificationsController@getDocumentsList');
Route::post('/addSurvey', 'VerificationsController@addSurvey');
Route::put('/updateSurvey', 'VerificationsController@updateSurvey');
Route::put('/cancelSurvey', 'VerificationsController@cancelSurvey');
Route::put('/completeSurvey', 'VerificationsController@completeSurvey');
Route::put('/clearSurvey', 'VerificationsController@clearSurvey');
Route::get('/getsurveyreport/{id}', 'VerificationsController@surveyReport');
Route::get('/finalverificationreport/{id}', 'VerificationsController@finalReport');
Route::get('/getBankersData', 'VerificationsController@getBankersData');
Route::get('/verification-invoices', 'VerificationsController@verificationInvoices');
Route::get('/getAtten/{id}', 'VerificationsController@getAtten');
Route::get('/getVerificationChargesTotal', 'VerificationsController@getVerificationChargesTotal');
Route::get('/checkSurveys', 'VerificationsController@checkSurveys');
Route::post('/getInvoices', 'VerificationsController@getInvoices');
Route::post('/uploadSurveyimages', 'VerificationsController@uploadSurveyimages');
Route::post('/deleteSurveyImage/{id}', 'VerificationsController@deleteSurveyImage');
Route::put('/rotateImage', 'VerificationsController@rotateImage');
Route::put('/orderImage', 'VerificationsController@orderImage');
Route::post('/getBillsOfInvoice', 'VerificationsController@getBillsOfInvoice');
Route::post('/updateType/{id}', 'VerificationsController@updateType');
Route::post('/updateVerificationServiceCharges/{id}', 'VerificationsController@updateVerificationServiceCharges');
Route::post('/updateAttention/{id}', 'VerificationsController@updateAttention');


Route::get('/valuation', 'DashboardController@valuation');
Route::get('/Bir', 'DashboardController@bir');
Route::get('/Ibr', 'DashboardController@ibr');
Route::get('/Debt', 'DebsController@index');

Route::get('/ibrCreate', 'DashboardController@ibrCreate');
Route::get('/debtCreate', 'DashboardController@debtCreate');
Route::get('/getIbrData', 'IbrController@getIbrData');
Route::get('/getValuationData', 'ValuationController@getValuationData');
Route::get('/getDebtData', 'DebsController@getDebtData');
Route::get('/Ie', 'DashboardController@ie');
Route::get('/Lcr', 'DashboardController@lcr');
Route::get('/Mcr', 'DashboardController@mcr');
Route::get('/Mvr', 'DashboardController@mvr');

Route::get('/getCompany', 'IbrController@getCompany');
Route::get('/getRegion', 'IbrController@getRegions');
Route::get('/getUserRoles', 'UsersController@getUserRoles');
Route::get('/getBanks', 'IbrController@getBanks');
Route::get('/getCustomers', 'IbrController@getCustomers');
Route::get('/getCountries', 'IbrController@getCountry');
Route::get('/getIbrCompany', 'IbrController@getIbrCompany');
Route::get('/getReportType', 'IbrController@getReportType');
Route::get('/getDeliveryType', 'IbrController@getDeliveryType');
Route::get('/getRates/{id}', 'IbrController@getRates');
Route::get('/getCompanyByCountry/{id}', 'IbrController@getCompanyByCountry');
Route::get('/getCompanyByCountryForEdit/{id}/{jobid}', 'IbrController@getCompanyByCountryForEdit');
Route::get('/getCompanyById/{id}', 'IbrController@getCompanyById');
Route::get('/getVendors', 'IbrController@getVendors');
Route::get('/getSalesRegion', 'IbrController@getSalesRegion');
Route::get('/getSalesTaxByRegion/{id}', 'IbrController@getSalesTaxByRegion');
Route::get('/getIslamicBanks', 'IbrController@getIslamicBanks');
Route::get('/getBranches/{id}', 'IbrController@getBranches');
Route::get('/getBranchById/{id}', 'IbrController@getBranchById');
Route::get('/getCustomerById/{id}', 'IbrController@getCustomerById');
Route::get('/getVendorById/{id}', 'IbrController@getVendorById');
Route::post('/addBranch', 'IbrController@addBranch');
Route::post('/addBank', 'IbrController@addBank');
Route::post('/addCompany', 'IbrController@addCompany');
Route::get('/getCities', 'IbrController@getCities');
Route::post('/addCustomer', 'IbrController@addCustomer');
Route::post('/postJob', 'IbrController@addJob');
Route::post('/addDebtCollectionJob', 'DebsController@addJob');
Route::get('/getVendor/{id}', 'IbrController@getVendorAddress');
Route::get('/getJob/{id}', 'IbrController@getJobByCountry');


Route::post('/duplicateJob/{id}', 'PrismController@duplicateJob');



Route::get('/edit/{id}', 'HomeController@editJob');
Route::get('/editDebt/{id}', 'DebsController@editJob');
Route::get('/getIbrJob/{id}', 'IbrController@getIbrJob');
Route::get('/getDebtJob/{id}', 'DebsController@getDebtJob');
Route::get('/users', 'UsersController@index');
Route::get('/usersCreate', 'UsersController@create');
Route::get('/logs', 'LogsController@index');
Route::put('/updateIbr/{id}', 'IbrController@updateIbr');
Route::put('/updateDebt/{id}', 'DebsController@updateDebt');
Route::put('/cancelIbr/{id}', 'IbrController@cancelIbr');
Route::post('/printReport', 'IbrController@print');
Route::post('/uplaodAgreement', 'DebsController@uplaodAgreement');
Route::post('/ibrPDF', 'IbrController@printPDF');
Route::post('/updateBill/{id}', 'BillsController@updateBill');
Route::post('/updateBillPrism/{id}', 'BillsController@updateBillPrism');
Route::get('/pdf', function () {
    return view('Inspection/Reports/firstpage');
});
Route::get('/printInvoice/{slashData}', 'VerificationsController@printInvoice')->where('slashData', '.*');
Route::get('/getInvoiceDetails/{slashData}', 'VerificationsController@getInvoiceDetails')->where('slashData', '.*');
// Route::get('/getInvoiceDetails', 'VerificationsController@getInvoiceDetails');



Route::get('/getFilesView', 'FilesController@index');
Route::get('/getFiles', 'FilesController@getFiles');

Route::post('/printBill', 'IbrController@printBill');
Route::post('/addComment', 'IbrController@storeProgress');
Route::post('/addUser', 'UsersController@addUser');
Route::get('/ibrProgress', 'IbrController@progress');
Route::get('/billing', 'DashboardController@receipts');
Route::post('/getBills', 'BillsController@getBills');
Route::post('/getBillsPrism', 'BillsController@getBillsPrism');
// Route::post('/getBillsByInvoice', 'BillsController@getBillsByInvoice');
Route::post('/getBillsForEdit', 'BillsController@getBillsForEdit');
Route::post('/getBillsForEditPrism', 'BillsController@getBillsForEditPrism');
Route::get('/geStats', 'StatsController@getStats');
Route::get('/getInstruments', 'BillsController@getInstruments');
Route::get('/getAccounts', 'BillsController@getAccounts');
Route::get('/getReceipts', 'BillsController@getReceipts');
Route::get('/getReceiptsById/{id}', 'BillsController@getReceiptsById');
Route::get('/posts', 'BillsController@posts');
Route::get('/allReceipts', 'BillsController@allReceipts');
Route::get('/bills', 'BillsController@getBillView');
Route::get('/getAllBills', 'BillsController@getAllBills');
Route::post('/updateStatsLog', 'BillsController@updatelog');
Route::get('/getTotalofBill', 'BillsController@getTotalofBill');
Route::get('/allReceiptsForUnPosted', 'BillsController@allReceiptsForUnPosted');
// Route::get('/allReceipts', 'BillsController@getReceiptsAll');
Route::get('/getReceiptById/{id}', 'BillsController@getReceiptById');
Route::post('/getBillsExcel', 'BillsController@getBillsExcel')->name('downloadexcel');
Route::post('/generateReceipt', 'BillsController@makeReceipt');
Route::post('/ApproveReceipt', 'BillsController@ApproveReceipt');
Route::post('/rejectBill', 'BillsController@rejectBill');
Route::post('/approveBill', 'BillsController@approveBill');


Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});


Route::get('/getIbrBill/{id}', 'BillsController@getIbrBill')->where('id', '(.*)');
Route::get('/editBills/{id}', 'BillsController@editBills');
Route::get('/jobView/{id}', 'BillsController@viewJob')->where('id', '(.*)');

Route::get('/valuationCreate', 'ValuationController@index');
Route::get('/valuationEdit', 'ValuationController@edit');
Route::get('/getValuationJob/{id}', 'ValuationController@getValuationJob');
Route::get('/getFiles/{id}', 'ValuationController@getFiles');
Route::get('/getDebtFiles/{id}', 'DebsController@getDebtFiles');
Route::get('/getFinalReport/{id}', 'ValuationController@getFinalReport');
Route::get('/valuationReportASKBL/{id}', 'ValuationController@printReportASKBL');
Route::get('/valuationReportBAH/{id}', 'ValuationController@printReportBAH');
Route::get('/getTypes', 'ValuationController@getTypes');
Route::get('/getImages/{id}', 'ValuationController@getImages');
Route::put('/updateValuation/{id}', 'ValuationController@updateValuation');
Route::put('/updateBrightStatus/{id}', 'ValuationController@updateBrightStatus');
Route::put('/updateHalfStatus/{id}', 'ValuationController@updateHalfStatus');
Route::post('/uploadDocuments', 'ValuationController@uploadDocuments');
Route::post('/uploadLivestockimages', 'InspectionsController@uploadLivestockimages');
Route::post('/uploadDebtDocuments', 'DebsController@uploadDocuments');
Route::post('/uploadFinal', 'ValuationController@uploadFinal');
Route::post('/uploadValuationImages', 'ValuationController@uploadValuationImages');
Route::post('/deleteVehicleImage/{id}', 'ValuationController@deleteVehicleImage');
Route::post('/printValBill', 'ValuationController@printBill');

Route::get('/MuccaduumCreate', 'MuccaduumController@create');

Route::get('/ClearingCreate', 'ClearingController@create');
Route::get('/birCreate', 'BIRController@create');
Route::get('/ieCreate', 'IEController@create');
Route::get('/lcrCreate', 'LCRController@create');
Route::get('/mvrCreate', 'MVRController@create');
Route::get('/statistics', 'StatsController@index');
Route::get('/getstats', 'StatsController@getstats');
Route::get('/getsites', 'StatsController@getsitesstats');
Route::get('/getaging', 'StatsController@getaging');
Route::get('/getOpening', 'StatsController@getOpening');
Route::get('/getBalance', 'StatsController@getBalance');
Route::get('/getOutstanding', 'StatsController@getOutstanding');
Route::get('/getBilling', 'StatsController@getBilling');


Route::put('/cancelVerificationprism/{id}', 'PrismController@cancelVerification');
Route::put('/updateReplcaed/{id}', 'PrismController@updateReplcaed');
Route::put('/updateReplacedControl', 'PrismController@updateReplacedControl');
Route::put('/updateDismantle/{id}', 'PrismController@updateDismantle');
Route::post('/addToBeRepaired', 'PrismController@addToBeRepaired');
Route::put('/holdVerificationprism/{id}', 'PrismController@holdVerification');
Route::get('/getHoldVerificationprism/{id}', 'PrismController@getholdVerification');
Route::get('/getCancelVerificationprism/{id}', 'PrismController@getCancelVerificationprism');
Route::get('downloadAssets/{id}', 'PrismController@downloadZip');
Route::get('downloadDocuments/{id}', 'PrismController@downloadDocuments');
Route::get('printPrismBill/{id}', 'PrismController@printInvoice');
Route::post('/getPrismInvoices', 'PrismController@getInvoices');
Route::get('/prism-invoices', 'PrismController@prismInvoices');
Route::post('/getBillsOfInvoicePrism', 'PrismController@getBillsOfInvoicePrism');
Route::post('/updatePrismBillForInvoice/{id}', 'PrismController@updateBill');
Route::get('/prism-surveys', 'PrismController@getPrismStats');
Route::get('/prismSurveysBySurveyors', 'PrismController@prismSurveysBySurveyors');
Route::get('/getsurveyorsregions', 'PrismController@getsurveyorsregions');


Route::get('/legalCreate', 'LegalServiceController@index');
Route::get('/getTask', 'LegalServiceController@GetTask');
Route::get('/getManager', 'LegalServiceController@GetLineManager');
Route::get('/getLegalServiceJob/{id}', 'LegalServiceController@getLegalServiceJob');
Route::put('/updateLegalService/{id}', 'LegalServiceController@updateLegalService');
Route::put('/holdLegalService/{id}', 'LegalServiceController@holdLegalService');
Route::put('/cancelLegalService/{id}', 'LegalServiceController@cancelLegalService');
Route::post('/uploadLegalServiceDocuments', 'LegalServiceController@uploadDocuments');
Route::get('/getLegalServiceFiles/{id}', 'LegalServiceController@getLegalServiceFiles');
Route::post('/printLegalBill', 'LegalServiceController@printBill');


Route::post('/signin', 'FlutAppController@login');
Route::post('/signinprism', 'PrismAppController@login');
Route::get('/getSurveys/{id}', 'FlutAppController@surveys');
Route::post('/addimageone/{id}', 'FlutAppController@addImageone');
Route::post('/addimagetwo/{id}', 'FlutAppController@addImagetwo');
Route::post('/addimagethree/{id}', 'FlutAppController@addImagethree');
Route::post('/addimagefour/{id}', 'FlutAppController@addImagefour');
Route::post('/addimagefive/{id}', 'FlutAppController@addImagefive');
Route::post('/addimagesix/{id}', 'FlutAppController@addImagesix');
Route::post('/addimageseven/{id}', 'FlutAppController@addImageseven');
Route::post('/addimageeight/{id}', 'FlutAppController@addImageeight');
Route::post('/addimagenine/{id}', 'FlutAppController@addImagenine');
Route::post('/submitSurvey/{id}', 'FlutAppController@submitSurvey');
Route::post('/updateapplicantdetails/{id}', 'FlutAppController@submitApplicantDetails');
Route::post('/updateCordinates/{id}', 'FlutAppController@updateCordinates');
Route::get('/getapplicantdetails/{id}', 'FlutAppController@getApplicantDetails');

Route::post('/postNeighboorone/{id}', 'FlutAppController@postNeighboorOne');
Route::get('/getNeighboorone/{id}', 'FlutAppController@getNeighboorOne');

Route::post('/postNeighboortwo/{id}', 'FlutAppController@postNeighboorTwo');
Route::get('/getNeighboortwo/{id}', 'FlutAppController@getNeighboorTwo');

Route::post('/postOutcome/{id}', 'FlutAppController@postVerificationOutcome');
Route::get('/getOutcome/{id}', 'FlutAppController@getVerificationOutcome');

Route::get('/getList', 'FlutAppController@getList');
Route::get('/getVerificationImages/{id}', 'FlutAppController@getImages');

// Residence Survey

Route::get('/getResidenceProfile/{id}', 'FlutAppController@getResidenceProfile');
Route::post('/updateResidenceProfile/{id}', 'FlutAppController@updateResidenceProfile');


// Workplace Survey

Route::get('/getWorkplaceProfile/{id}', 'FlutAppController@getBusinessProfile');
Route::post('/updateWorkplaceProfile/{id}', 'FlutAppController@updateWorkplaceProfile');

Route::get('/getHRDetails/{id}', 'FlutAppController@getHRDetails');
Route::post('/updateHRDetails/{id}', 'FlutAppController@updateHRDetails');

Route::get('/getSalaryDetails/{id}', 'FlutAppController@getSalaryDetails');
Route::post('/updateSalaryDetails/{id}', 'FlutAppController@updateSalaryDetails');

Route::post('/addsalaryimageone/{id}', 'FlutAppController@addsalaryimageone');
Route::post('/addsalaryimagetwo/{id}', 'FlutAppController@addsalaryimagetwo');
Route::post('/addsalaryimagethree/{id}', 'FlutAppController@addsalaryimagethree');


Route::post('/updateBankStatement/{id}', 'FlutAppController@updateBankStatement');
Route::get('/getBankStatement/{id}', 'FlutAppController@getBankStatement');



Route::post('/postMarketcheckone/{id}', 'FlutAppController@postMarketcheckone');
Route::get('/getMarketcheckone/{id}', 'FlutAppController@getMarketcheckone');
Route::post('/postMarketchecktwo/{id}', 'FlutAppController@postMarketchecktwo');
Route::get('/getMarketchecktwo/{id}', 'FlutAppController@getMarketchecktwo');
Route::get('/getSalaryDetails/{id}', 'FlutAppController@getSalaryDetails');


Route::get('/prismCreate', 'PrismController@index');
Route::get('/prismCreateIntimatingPerson', 'PrismController@intimating');
Route::get('/getInsurers', 'PrismController@getInsurers');
Route::get('/gePrismTypes', 'PrismController@gePrismTypes');
Route::get('/getInsurerBranch/{id}', 'PrismController@getInsurerBranch');
Route::get('/getModes/{id}', 'PrismController@getModes');
Route::get('/getItems/{id}', 'PrismController@getItems');
Route::get('/getInsurerBranchById/{id}', 'PrismController@getInsurerBranchById');
Route::post('/addInsurerBranch', 'PrismController@addBranch');
Route::get('/getVehicles', 'PrismController@getVehicles');
Route::post('/uploadFinalPrism', 'PrismController@uploadFinal');
Route::get('/getIntimatingPerson', 'PrismController@getIntimatingPerson');
Route::get('/getFinalReportPrism/{id}', 'PrismController@getFinalReport');
Route::post('/uploadDocumentsPrism', 'PrismController@uploadDocuments');
Route::post('/updateStaxInvoice', 'PrismController@updateStaxInvoice');
Route::post('/updateInvoiceBranch', 'PrismController@updateInvoiceBranch');

// Route::get('/shiftBills', 'PrismController@shiftBills');
Route::get('/testquery', 'StatsController@testQuery');



Route::get('/getFilesPrism/{id}', 'PrismController@getFilesPrism');
// Route::get('/printPrismReport/{id}', 'PrismController@printPrismReport');
Route::post('/printPrismInvoice/{slashData}', 'PrismController@printPrismInvoice')->where('slashData', '.*');
Route::post('/printPrismBillsByInvoice/{slashData}', 'PrismController@printPrismBillsByInvoice')->where('slashData', '.*');
Route::post('/printPrismReportsByInvoice/{slashData}', 'PrismController@printPrismReportsByInvoice')->where('slashData', '.*');
Route::get('/printPrismReport/{id}', 'PrismController@printPrismReport');
Route::get('salesTaxInvoice/{id}', 'PrismController@SalesTaxInvoice');
Route::get('/getAccessories', 'PrismController@getAccessories');
Route::get('/getAccessoriesRecs/{id}', 'PrismController@getAccessoriesRecs');
Route::get('/getAccessoriesToBeRepaired/{id}', 'PrismController@getAccessoriesToBeRepaired');
Route::get('/getAccessoriesToBeReplaced/{id}', 'PrismController@getAccessoriesToBeReplaced');
Route::get('/getAccessoriesToBeDismantle/{id}', 'PrismController@getAccessoriesToBeDismantle');
Route::put('/changeName', 'PrismController@changeName');
Route::put('/changeValuesBeReplaced', 'PrismController@changeValuesBeReplaced');
Route::put('/changeValuesBeDismantle', 'PrismController@changeValuesBeDismantle');
Route::put('/changeAccessoriesToBeRepaired', 'PrismController@changeAccessoriesToBeRepaired');
Route::put('/changeAccessoriesToBeReplaced', 'PrismController@changeAccessoriesToBeReplaced');
Route::put('/changeAccessoriesToBeDismantle', 'PrismController@changeAccessoriesToBeDismantle');
Route::put('/changeAssetTitle/{id}', 'PrismController@changeAssetTitle');
Route::put('/changeType', 'PrismController@changeType');
Route::post('/deleteAccessory/{id}', 'PrismController@deleteAccessory');
Route::post('/deleteAccessoryToBeRepaired/{id}', 'PrismController@deleteAccessoryToBeRepaired');
Route::post('/deleteAccessoryToBeReplaced/{id}', 'PrismController@deleteAccessoryToBeReplaced');
Route::post('/deleteAccessoryToBeDismantle/{id}', 'PrismController@deleteAccessoryToBeDismantle');
Route::post('/addAccessory', 'PrismController@addAccessory');
Route::post('/addToBeReplaced/{id}', 'PrismController@addToBeReplaced');
Route::post('/addToBeDismantle/{id}', 'PrismController@addToBeDismantle');
Route::put('/updateToBeRepaired', 'PrismController@updateToBeRepaired');
Route::put('/updateToBeDismantle', 'PrismController@updateToBeDismantle');
Route::post('/uploadAssets', 'PrismController@uploadAssets');
Route::get('/getAssets/{id}', 'PrismController@getAssets');
Route::get('/getToBeRepairedDetails/{id}', 'PrismController@getToBeRepairedDetails');
Route::post('/deleteAsset/{id}', 'PrismController@deleteAsset');


Route::get('/reduceSize', 'ChangesController@reduceSize');
Route::get('/updateBills', 'ChangesController@updateBills');
Route::get('/compressFiles', 'ChangesController@compressFiles');
Route::post('/compress/{id}', 'ChangesController@compress');
Route::get('/getStats', 'ChangesController@getStats');


Route::get('/getMucJob/{id}', 'MuccaduumController@getMucJob');

Route::put('/updateIEJob/{id}', 'IEController@updateIEJob');

Route::get('/getIeJob/{id}', 'IEController@getIeJob');

Route::post('/printIEBill', 'IEController@printIEBill');


Route::put('/updateMuccaddum/{id}','MuccaduumController@updateMuccaddumJob');
Route::post('/printMucBill', 'MuccaduumController@printBill');
Route::get('/NoLossReport/{id}', 'PrismController@NoLossReport');

Route::get('/getPartialData/{id}', 'PrismController@getPartialData');