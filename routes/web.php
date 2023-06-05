<?php

use Illuminate\Support\Facades\Route;
 /*Import controller file */
use App\Http\Controllers\userController;
use App\Http\Controllers\designController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\mainWindowController;
use App\Http\Controllers\pdrController;
use App\Http\Controllers\joborderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('login.index');
    return view('login.index');
});


Route::get('/register', [registerController::class, 'index'])->name('register.index');
Route::post('/register', [registerController::class, 'store']);
Route::get('/register.signUpPageClient', [registerController::class, 'signUpPageClient'])->name('register.signUpPageClient');
Route::post('/register.signUpPageClient', [registerController::class, 'storeClient']);
Route::get('logout', [loginController::class, 'logout'])->name('logout');



Route::get('/login', [loginController::class, 'index'])->middleware('guest');
Route::post('/login', [loginController::class, 'authenticate']);
Route::get('prod.mainWindow',[loginController::class, 'mainWindowProd'])->name('prod.mainWindow')->middleware('auth');
Route::get('sales.mainWindow',[loginController::class, 'mainWindowSales'])->name('sales.mainWindow')->middleware('auth');
Route::get('store.mainWindow',[loginController::class, 'mainWindowStore'])->name('store.mainWindow')->middleware('auth');
Route::get('qc.mainWindow',[loginController::class, 'mainWindowQC'])->name('qc.mainWindow')->middleware('auth');
Route::get('client.mainWindow',[loginController::class, 'mainWindowClient'])->name('client.mainWindow')->middleware('auth');


Route::get('/mainWindow', [mainWindowController::class, 'index'])->middleware('auth');


Route::resource('design', designController::class);

Route::resource('order', orderController::class);



Route::controller(designController::class)->group(function(){

    //sales 
    Route::get('sales.designDetailsPage/{design}', 'showForSalesP')->name('design.showForSalesP');
    Route::get('sales.designsListPage','getSalesDesignsListPage')->name('sales.designsListPage');

    //production
    // Route::get('prod.uploadDesignPage','uploadDesign')->name('design.uploadDesign');
    Route::get('prod.designsListPage','getProdDesignsListPage')->name('prod.designsListPage');
    Route::put('prod.designDetailsPage/{design}','updateDesignInfo')->name('design.updateDesignInfo');
    Route::get('prod.designDetailsPage/{design}', 'showForProdP')->name('design.showForProdP');

    Route::get('prod.RFQListPage','getProdRFQListPage')->name('prod.RFQListPage');
    Route::get('prod.RFQDetailsPage/{design}', 'getProdRFQDetailsPage')->name('design.getProdRFQDetailsPage');
    Route::put('prod.RFQDetailsPage/{design}','updateQuotationStatus')->name('design.updateQuotationStatus');


    //store
    Route::get('store.designDetailsPage/{design}', 'showForStoreP')->name('design.showForStoreP'); //details
    Route::get('store.designsListPage','getStoreDesignsListPage')->name('store.designsListPage'); //list
    Route::put('store.designDetailsPage/{design}','updateGoodsStock')->name('design.updateGoodsStock'); //update details

    //quality control
    Route::get('qc.designDetailsPage/{design}', 'showForQCP')->name('design.showForQCP');
    Route::get('qc.designsListPage','getQCDesignsListPage')->name('qc.designsListPage');

    //client -> approve design
    Route::get('client.myDesignDetailsPage/{design}','showForClient')->name('design.showForClient'); //details
    Route::get('client.myDesignsListPage','getClientDesignsListPage')->name('client.myDesignsListPage'); //list
    Route::put('client.myDesignDetailsPage/{design}','updateMyDesignInfo')->name('design.updateMyDesignInfo'); //confirm design
    Route::get('client.makeOrderPage/{design}', 'getMakeOrderPage')->name('client.makeOrderPage'); //

    
    Route::get('client.RFQFormPage','getRFQFormPage')->name('design.getRFQFormPage');
    Route::post('client.RFQFormPage', 'submitRFQ')->name('design.submitRFQ'); //submit rfq

    

});


Route::controller(orderController::class)->group(function(){

    //sales 
    Route::get('sales.orderDetailsPage/{order}', 'showForSalesP')->name('order.showForSalesP'); //details
    Route::get('sales.ordersListPage','getSalesOrdersListPage')->name('sales.ordersListPage'); //list
    Route::put('sales.orderDetailsPage/{order}','updateOrderStatusInfo')->name('order.updateOrderStatusInfo'); //update
    Route::get('sales.PDRFormPage/{order}', 'getPDRFormPageForSalesP')->name('pdr.getPDRFormPageForSalesP'); //details


    //production
    Route::get('prod.ordersListPage','getProdOrdersListPage')->name('prod.ordersListPage');
    Route::get('prod.orderDetailsPage/{order}', 'showForProdP')->name('order.showForProdP');


    //store
    Route::get('store.orderDetailsPage/{order}', 'showForStoreP')->name('order.showForStoreP');
    Route::get('store.ordersListPage','getStoreOrdersListPage')->name('store.ordersListPage');

    Route::get('store.jobOrderFormPage/{order}', 'getJobOrderFormPageForStoreP')->name('joborder.getJobOrderFormPageForStoreP'); //details
   

    //quality control
    Route::get('qc.orderDetailsPage/{order}', 'showForQCP')->name('order.showForQCP');
    Route::get('qc.ordersListPage','getQCOrdersListPage')->name('qc.ordersListPage');

    //client
    Route::get('client.myOrderDetailsPage/{order}', 'showForClient')->name('order.showForClient');
    Route::get('client.myOrdersListPage','getClientOrdersListPage')->name('client.myOrdersListPage');
    Route::get('client.orderHistoryPage','getClientOrdersHistoryListPage')->name('client.getClientOrdersHistoryListPage');
    Route::put('client.orderDetailsPage/{order}','updatePaymentInfo')->name('order.updatePaymentInfo');
    

    //CLIENT REORDER TRU ORDER HISTORY
    Route::get('client.reorderPage/{order}', 'getReorderPage')->name('client.reorderPage');

    //CLIENT SUBMIT ORDER TRU DESIGN
    Route::post('client.makeOrderPage','submitOrder')->name('order.submitOrder');

    
});


Route::controller(pdrController::class)->group(function(){

    //sales 
    Route::post('sales.PDRFormPage','createPDRFormPageForSalesP')->name('pdr.createPDRFormPageForSalesP'); //create
    Route::get('sales.updatePDRForm/{pdr}','getPDRFormPageForSalesP')->name('sales.getPDRFormPageForSalesP');
    Route::put('sales.updatePDRForm/{pdr}','updatePDRFormPageForSalesP')->name('sales.updatePDRFormPageForSalesP'); //update

    //prod
    Route::get('prod.PDRFormPage/{pdr}','getPDRFormPageForProdP')->name('pdr.getPDRFormPageForProdP');
    Route::put('prod.PDRFormPage/{pdr}','updatePDRFormPageForProdP')->name('prod.updatePDRFormPageForProdP'); //update

    //store
    Route::get('store.PDRFormPage/{pdr}','getPDRFormPageForStoreP')->name('pdr.getPDRFormPageForStoreP');
    Route::put('store.PDRFormPage/{pdr}','updatePDRFormPageForStoreP')->name('store.updatePDRFormPageForStoreP'); //update


});

Route::controller(joborderController::class)->group(function(){

    //store
    Route::post('store.jobOrderFormPage','createJobOrderFormPageForStoreP')->name('joborder.createJobOrderFormPageForStoreP'); //update
    Route::get('store.updateJobOrderFormPage/{joborder}','getJobOrderFormPageForStoreP')->name('store.getJobOrderFormPageForStoreP'); //update
    Route::put('store.updateJobOrderFormPage/{joborder}','updateJobOrderFormPageForStoreP')->name('store.updateJobOrderFormPageForStoreP'); //update
    
    
    //qc 
    Route::get('qc.jobOrderFormPage/{joborder}', 'getJobOrderFormPageForQCP')->name('joborder.getJobOrderFormPageForQCP'); //details
    Route::put('qc.jobOrderFormPage/{joborder}','updateJobOrderFormPageForQCP')->name('joborder.updateJobOrderFormPageForQCP'); //update


    //prod
    Route::get('prod.jobOrderFormPage/{joborder}', 'getJobOrderFormPageForProdP')->name('joborder.getJobOrderFormPageForProdP'); //details
    Route::put('prod.orderDetailsPage/{joborder}','updateJobOrderFormPageForProdP')->name('joborder.updateJobOrderFormPageForProdP'); //update

    
    
});



