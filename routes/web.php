<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ReceiveChallanController;
use App\Http\Controllers\DeliveryChallanController;
use App\Http\Controllers\MovingChallanController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PartyPurchaseController;
use App\Http\Controllers\PettyPurchaseController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PartySaleController;
use App\Http\Controllers\PartySaleCommissionController;
use App\Http\Controllers\PartySalePaymentController;
use App\Http\Controllers\CashSaleController;
use App\Http\Controllers\WastageSaleController;
use App\Http\Controllers\PartySaleReturnController;
use App\Http\Controllers\SaleReturnController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BulkSendController;
use App\Http\Controllers\KnittingController;
use App\Http\Controllers\CuttingController;
use App\Http\Controllers\ProductionSendController;
use App\Http\Controllers\ProductionReceiveController;
use App\Http\Controllers\TpProductionSendController;
use App\Http\Controllers\TpProductionReceiveController;
use Illuminate\Support\Facades\Route;

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
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:cache');
    Artisan::call('config:clear');
    Artisan::call('storage:link');
    echo '<script>alert("cache clear Success")</script>';
});

Route::get('/', function () {
    return view('login');
});

Auth::routes();
Route::get('/admin-logout',[LoginController::class,'user_logout'])->name('admin-logout');

Route::group(['middleware' => ['auth', 'is_department_selected']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    /**
     * *********************
     * Bank Account
     * *********************
     */
    Route::get('bank_account/history/{account}',[BankAccountController::class,'history'])->name('bank_account.history');
    Route::resource('bank_account',BankAccountController::class);

    /**
     * *********************
     * Item
     * *********************
     */
    Route::get('item-variations/{itemId}', [ItemsController::class, 'getVariations'])->name('get.variations');
    Route::get('item/stock',[ItemsController::class, 'stock'])->name('item.stock');
    Route::resource('item', ItemsController::class);
    Route::resource('brand', BrandController::class);
    Route::get('unit/{unit}/get_related',[UnitController::class, 'get_related'])->name('unit.get_related');
    Route::resource('unit', UnitController::class);

    /**
     * *********************
     * Department
     * *********************
    */
    Route::resource('department', DepartmentController::class);
    Route::get('change-active-shop',[DepartmentController::class,'change_active'])->name('department.change_active');

    /**
     * *********************
     * Production
     * *********************
    */ 
    Route::resource('bulk_send', BulkSendController::class);
    Route::resource('knitting', KnittingController::class);
    Route::resource('cutting', CuttingController::class);
    Route::resource('production_send', ProductionSendController::class);
    Route::resource('production_receive', ProductionReceiveController::class);
    // Third Party Production
    Route::resource('tp_production_send', TpProductionSendController::class); 
    Route::resource('tp_production_receive', TpProductionReceiveController::class); 
    Route::get('tp_production_receive-stock', [TpProductionReceiveController::class,'stock_report'])->name('tp_production_receive.stock');
    Route::get('getSendInfo', [TpProductionReceiveController::class,'getSendInfo']);

    Route::get('cutting/print/{id}', [CuttingController::class,'print'])->name('cutting.print');
    Route::get('production_send/print/{id}', [ProductionSendController::class,'print'])->name('production_send.print');
    Route::get('production_receive/print/{id}', [ProductionReceiveController::class,'print'])->name('production_receive.print');
    Route::get('cutting-report', [CuttingController::class,'report'])->name('cutting.report');
    Route::get('knitting-stock', [KnittingController::class,'stock_report'])->name('knitting.stock');


    /**
     * *********************
     * Purchase
     * *********************
    */

    Route::resource('party-purchase', PartyPurchaseController::class)->except(['show']);
    Route::get('party-purchase/payment/list/{party_purchase}',[PartyPurchaseController::class,'payment_list'])->name('party-purchase.payment_list');
    Route::post('party-purchase/payment/by_invoice',[PartyPurchaseController::class,'by_invoice'])->name('party-purchase.invoice_payment');
    Route::get('party-purchase/{id}',[PartyPurchaseController::class,'get_purchase']);
    Route::get('challan-receive/{purchase}',[PartyPurchaseController::class,'challan_receive'])->name('challan.receive');
    Route::get('party/purchase/report',[PartyPurchaseController::class,'report'])->name('party-purchase.report');
    Route::get('party/purchase/invoice/{purchase_id}',[PartyPurchaseController::class,'invoice'])->name('party-purchase.invoice');
    Route::get('party/purchase/create-return/{party_purchase}',[PartyPurchaseController::class,'return_purchase'])->name('party-purchase.return');

    Route::get('party/purchase/return/list',[PurchaseReturnController::class,'party_index'])->name('party-purchase-return.index');
    Route::get('petty/purchase/return/list',[PurchaseReturnController::class,'petty_index'])->name('petty-purchase-return.index');
    Route::post('purchase/return/store',[PurchaseReturnController::class,'store'])->name('purchase-return.store');
    Route::delete('purchase/return/delete/{purchase_return}',[PurchaseReturnController::class,'destroy'])->name('purchase-return.destroy');

    Route::resource('petty-purchase', PettyPurchaseController::class)->except(['show']);
    Route::get('petty-purchase/payment/list/{petty_purchase}',[PettyPurchaseController::class,'payment_list'])->name('petty-purchase.payment_list');
    Route::post('petty-purchase/payment/by_invoice',[PettyPurchaseController::class,'by_invoice'])->name('petty-purchase.invoice_payment');
    Route::get('petty/purchase/report',[PettyPurchaseController::class,'report'])->name('petty-purchase.report');
    Route::get('petty/purchase/invoice/{purchase_id}',[PettyPurchaseController::class,'invoice'])->name('petty-purchase.invoice');
    Route::get('petty/purchase/create-return/{petty_purchase}',[PettyPurchaseController::class,'return_purchase'])->name('petty-purchase.return');

    /**
     * *********************
     * Sale
     * *********************
    */

    Route::resource('party-sale', PartySaleController::class)->except(['show']);
    Route::get('party-sale/report',[PartySaleController::class,'report'])->name('party-sale.report');
    Route::get('party-sale/payment/list/{party_sale}',[PartySaleController::class,'payment_list'])->name('party-sale.payment_list');
    Route::post('party-sale/payment/by_invoice',[PartySaleController::class,'by_invoice'])->name('party-sale.invoice_payment');
    Route::get('party-sale/{id}',[PartySaleController::class,'get_sale']);
    Route::get('challan-delivery/{party_sale}',[PartySaleController::class,'challan_delivery'])->name('challan.delivery');
    Route::get('party-sale/invoice/{sale_id}',[PartySaleController::class,'invoice'])->name('party-sale.invoice');
    Route::get('party-sale/create-return/{party_sale}',[PartySaleController::class,'return_sale'])->name('party-sale.return');

    Route::get('party-sale/return/list',[PartySaleReturnController::class,'index'])->name('party-sale-return.index');
    Route::post('party-sale/return/store',[PartySaleReturnController::class,'store'])->name('party-sale-return.store');
    Route::delete('party-sale/return/delete/{sale_return}',[PartySaleReturnController::class,'destroy'])->name('party-sale-return.destroy');

    Route::resource('party-sale-commission', PartySaleCommissionController::class)->except(['show']);
    Route::get('party-sale/total-qty/{partyId}', [PartySaleCommissionController::class, 'get_total_qty']);

    Route::resource('party-sale-payment', PartySalePaymentController::class)->except(['show']);
    Route::get('party-sale/total-due-invoice/{partyId}', [PartySalePaymentController::class, 'get_total_due_invoice']);

    Route::resource('cash-sale', CashSaleController::class)->except(['show']);
    Route::get('cash-sale/report',[CashSaleController::class,'report'])->name('cash-sale.report');
    Route::get('cash-sale/payment/list/{cash_sale}',[CashSaleController::class,'payment_list'])->name('cash-sale.payment_list');
    Route::post('cash-sale/payment/by_invoice',[CashSaleController::class,'by_invoice'])->name('cash-sale.invoice_payment');
    Route::get('cash-sale/{id}',[CashSaleController::class,'get_sale']);
    Route::get('cash-sale/invoice/{sale_id}',[CashSaleController::class,'invoice'])->name('cash-sale.invoice');
    Route::get('cash-sale/create-return/{cash_sale}',[CashSaleController::class,'return_sale'])->name('cash-sale.return');

    Route::get('cash-sale/return/list',[SaleReturnController::class,'index'])->name('cash-sale-return.index');
    Route::post('cash-sale/return/store',[SaleReturnController::class,'store'])->name('cash-sale-return.store');
    Route::delete('cash-sale/return/delete/{sale_return}',[SaleReturnController::class,'destroy'])->name('cash-sale-return.destroy');

    Route::resource('wastage-sale', WastageSaleController::class)->except(['show']);
    Route::get('wastage-sale/report',[WastageSaleController::class,'report'])->name('wastage-sale.report');
    Route::get('wastage-sale/payment/list/{wastage_sale}',[WastageSaleController::class,'payment_list'])->name('wastage-sale.payment_list');
    Route::post('wastage-sale/payment/by_invoice',[WastageSaleController::class,'by_invoice'])->name('wastage-sale.invoice_payment');
    Route::get('wastage-sale/{id}',[WastageSaleController::class,'get_sale']);
    Route::get('wastage-sale/invoice/{sale_id}',[WastageSaleController::class,'invoice'])->name('wastage-sale.invoice');

    /**
     * *********************
     * Challan
     * *********************
    */
    Route::resource('receive-challan', ReceiveChallanController::class)->except(['show']);
    Route::get('receive-challan/report',[ReceiveChallanController::class, 'report'])->name('receive-challan.report');
    Route::get('receive-challan/invoice/{challan_id}',[ReceiveChallanController::class,'invoice'])->name('receive-challan.invoice');

    Route::resource('delivery-challan', DeliveryChallanController::class)->except(['show']);
    Route::get('delivery-challan/report',[DeliveryChallanController::class, 'report'])->name('delivery-challan.report');
    Route::get('delivery-challan/invoice/{challan_id}',[DeliveryChallanController::class,'invoice'])->name('delivery-challan.invoice');

    Route::resource('moving-challan', MovingChallanController::class)->except(['show']);
    Route::get('moving-challan/report',[MovingChallanController::class, 'report'])->name('moving-challan.report');
    
    /**
     * *********************
     * Payment
     * *********************
    */
    Route::resource('payment', PaymentController::class);
    /**
     * *********************
     * Reports
     * *********************
    */
    Route::get('top-sale/item/report',[ReportController::class, 'top_sale_item'])->name('top-sale-item.report');
    Route::get('top-purchase/item/report',[ReportController::class, 'top_purchase_item'])->name('top-purchase-item.report');
    Route::get('top-sale/party/report',[ReportController::class, 'top_sale_party'])->name('top-sale-party.report');
    Route::get('top-purchase/party/report',[ReportController::class, 'top_purchase_party'])->name('top-purchase-party.report');
    /**
     * *********************
     * People
     * *********************
    */
    Route::resource('party', PartyController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('permission', PermissionController::class);
    
    Route::get('setting',[SettingController::class, 'setting'])->name('setting');
    Route::post('setting/update',[SettingController::class, 'update_setting'])->name('update_setting');

    /**
     * *********
     * Profile
     * *********
    */
    Route::get('profile',[ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::get('change-password',[ProfileController::class, 'change_password'])->name('change.password');
    Route::post('update-password',[ProfileController::class, 'update_password'])->name('update.password');
});

Route::get('/update-all', function () {
$allData = App\Models\items::all();
    foreach ($allData as $data){
        $data->update_calculated_data();
        $data->update();
    }
});