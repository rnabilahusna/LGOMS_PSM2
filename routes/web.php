<?php

use Illuminate\Support\Facades\Route;
 /*Import controller file */
use App\Http\Controllers\userController;
use App\Http\Controllers\appointmentController;
use App\Http\Controllers\designController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\mainWindowController;

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
    return view('welcome');
});

Route::controller(userController::class)->group(function(){

    Route::get('loginPage','index')->name('loginPage');

    Route::get('registration','signUpPageStaff')->name('registration');

    // Route::get('signUpPageStaff','signUpPageStaff')->name('signUpPageStaff');

    Route::get('logout','logout')->name('logout');

    Route::post('validate_registration', 'validate_registration')->name('user.validate_registration');

    Route::post('validate_login', 'validate_login')->name('user.validate_login');

    Route::get('dashboard', 'dashboard')->name('dashboard');

});

Route::get('/register', [registerController::class, 'index'])->name('register.index');
Route::post('/register', [registerController::class, 'store']);

Route::get('/login', [loginController::class, 'index'])->middleware('guest');
Route::post('/login', [loginController::class, 'authenticate']);


Route::get('/mainWindow', [mainWindowController::class, 'index'])->middleware('auth');

Route::resource('appointment', appointmentController::class);

Route::resource('design', designController::class);

Route::resource('order', orderController::class);






Route::controller(appointmentController::class)->group(function(){

    //client
    Route::get('client.appointmentForm','requestAppointment')->name('appointment.requestAppointment');
    Route::get('client.myDesignsListPage','getMyDesignsListPage')->name('client.getMyDesignsListPage');

    //production
    Route::get('prod.appointmentsListPage','getProdAppointmentsListPage')->name('prod.appointmentsListPage');
    Route::put('prod.appointmentDetailsPage/{appointment}','updateAppointmentInfo')->name('appointment.updateAppointmentInfo');
    Route::get('prod.appointmentDetailsPage/{appointment}', 'showForProdP')->name('appointment.showForProdP');

    
});


Route::controller(designController::class)->group(function(){

    //sales 
    Route::get('sales.designDetailsPage/{design}', 'showForSalesP')->name('design.showForSalesP');
    Route::get('sales.designsListPage','getSalesDesignsListPage')->name('sales.designsListPage');

    //production
    Route::get('prod.uploadDesignPage','uploadDesign')->name('design.uploadDesign');
    Route::get('prod.designsListPage','getProdDesignsListPage')->name('prod.designsListPage');
    Route::put('prod.designDetailsPage/{design}','updateDesignInfo')->name('design.updateDesignInfo');
    Route::get('prod.designDetailsPage/{design}', 'showForProdP')->name('design.showForProdP');

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
});


Route::controller(orderController::class)->group(function(){

    //sales 
    Route::get('sales.orderDetailsPage/{order}', 'showForSalesP')->name('order.showForSalesP'); //details
    Route::get('sales.ordersListPage','getSalesOrdersListPage')->name('sales.ordersListPage'); //list
    Route::put('sales.orderDetailsPage/{order}','updateOrderStatusInfo')->name('order.updateOrderStatusInfo'); //update

    //production
    Route::get('prod.ordersListPage','getProdOrdersListPage')->name('prod.ordersListPage');
    Route::get('prod.orderDetailsPage/{order}', 'showForProdP')->name('order.showForProdP');

    //store
    Route::get('store.orderDetailsPage/{order}', 'showForStoreP')->name('order.showForStoreP');
    Route::get('store.ordersListPage','getStoreOrdersListPage')->name('store.ordersListPage');

    //quality control
    Route::get('qc.orderDetailsPage/{order}', 'showForQCP')->name('order.showForQCP');
    Route::get('qc.ordersListPage','getQCOrdersListPage')->name('qc.ordersListPage');

    //client
    Route::get('client.myOrderDetailsPage/{order}', 'showForClient')->name('order.showForClient');
    Route::get('client.myOrdersListPage','getClientOrdersListPage')->name('client.myOrdersListPage');
    Route::put('client.orderDetailsPage/{order}','updatePaymentInfo')->name('order.updatePaymentInfo');
    
});


