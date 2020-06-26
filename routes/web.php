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

// hanya untuk tamu yg belum auth #login baru
Route::get('/loginBaru', 'LoginBaruController@getLogin')->middleware('guest');
Route::post('/loginBaru', 'LoginBaruController@postLogin');
Route::get('/logoutBaru', 'LoginBaruController@logout');


Route::get('/admin', function() {
	return view('loginBaru.admin');
  })->middleware('auth:admin');

Route::get('/pengguna', function() {
return view('loginBaru.pengguna');
})->middleware('auth:pengguna');



Route::get('/enkripsi', 'CustomerController@enkripsi');

Route::get('/tagihan', 'CustomerController@tagihan');

Auth::routes();

Route::get('contact', 'ContactController@index')->name('contact.index');
Route::post('contact', 'ContactController@store')->name('contact.store');

Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/aboutus', 'HomeController@aboutus')->name('aboutus');
Route::get('/methods', 'HomeController@methods')->name('methods');
Route::get('/belajar', 'HomeController@belajar')->name('belajar');
Route::get('/partners', 'HomeController@partners')->name('partners');
Route::get('/store', 'HomeController@store')->name('store');
Route::get('/news', 'HomeController@news')->name('news');
Route::get('/signup', 'HomeController@signup')->name('signup');
Route::post('/signup', 'PenggunaController@store');

Route::group(['middleware' =>['auth']], function(){


Route::get('/metro', function () {
    return view('metro');
});

Route::get('/metro_so', function () {
    return view('metro_so');
});

Route::get('/metro_so_new', function () {
    return view('metro_so_new');
});


Route::get('/home', 'HomeController@getIndex')->name('dashboard');

Route::get('user/profile', 'UserController@viewProfile')->name('user.profile');


// Language Switcher
Route::get('locale/{locale}', 'SettingsController@switchLocale')->name('locale.set');

Route::get('daftarBank', 'SlipOrderController@getBank');
Route::post('editBiayaSewa', 'SlipOrderController@editBiayaSewa');
Route::get('setting_biaya_sewa', 'SlipOrderController@biayaSewa');


	/*========================================================
		Customer route
	=========================================================*/
	Route::model('customer', 'App\Customer');
	Route::get('customer', 'CustomerController@getIndex')->name('customer.index');
	Route::post('customer', 'CustomerController@postIndex');	

	

	Route::post('simpanTarikanBarang', 'CustomerController@simpanTarikanBarang');

	Route::get('formTarikanBarang', 'CustomerController@formTarikanBarang');


	Route::get('getTarikanBarang', 'CustomerController@getTarikanBarang');
	Route::post('getTarikanBarang', 'CustomerController@postIndexgetTarikanBarang');

	Route::get('customer/new', 'CustomerController@getNewCustomer')->name('customer.new');
	Route::post('customer/new', 'CustomerController@postCustomer')->name('customer.post');

	Route::get('customer/{customer}', 'CustomerController@getEditCustomer')->name('customer.edit');
	Route::post('customer/{customer}', 'CustomerController@postCustomer')->name('customer.post');
	Route::delete('customer/delete/{customer}', 'CustomerController@deleteCustomer')->name('customer.delete');

	Route::get('customer/{id}/details', 'CustomerController@getCustomerDetails')->name('customer.details');
	
	
	/*========================================================
		Lead route
	=========================================================*/
	Route::model('lead', 'App\Lead');
	Route::get('lead', 'LeadController@getIndex')->name('lead.index');
	Route::post('lead', 'LeadController@postIndex');

	Route::get('lead/new', 'LeadController@getNewLead')->name('lead.new');
	Route::post('lead/new', 'LeadController@postLead')->name('lead.post');

	
	Route::get('lead/{lead}', 'LeadController@getEditLead')->name('lead.edit');
	Route::post('lead/{lead}', 'LeadController@postLead')->name('lead.post');
	Route::delete('lead/delete/{lead}', 'LeadController@deleteLead')->name('lead.delete');

	Route::get('lead/{lead}/details', 'LeadController@getLeadDetails')->name('lead.details');

	Route::post('lead/convert', 'CustomerController@postIndex')->name('lead.convert');	
	
	
	/*========================================================
		Slip Order route
	=========================================================*/
	Route::get('slipOrder', 'SlipOrderController@getIndex')->name('slipOrder.index');

	Route::get('indexSlipOrderNew', 'SlipOrderController@indexSlipOrderNew')->name('indexSlipOrderNew');
	Route::get('orderSewaRecurring', 'SlipOrderController@getNewSlipOrderSewaRecurring')->name('orderSewaRecurring');
	Route::get('orderSewaPeriode', 'SlipOrderController@getNewSlipOrderSewaPeriode')->name('orderSewaPeriode');
	Route::get('orderJualPutus', 'SlipOrderController@getNewSlipOrderJualPutus')->name('orderJualPutus');
	Route::post('slipOrder/simpan', 'SlipOrderController@postSlipOrder');

	Route::get('slipOrderSewaPeriode', 'SlipOrderController@getIndexSewaPeriode')->name('slipOrder.indexSewaPeriode');
	Route::post('slipOrderSewaPeriode', 'SlipOrderController@postIndexSewaPeriode');

	Route::get('FaultDataRecurring', 'SlipOrderController@getIndexFaultDataRecurring')->name('slipOrder.indexSewaRecurring');
	Route::post('FaultDataRecurring', 'SlipOrderController@postIndexFaultDataRecurring');
	Route::post('simpanUbahStatusRecurring', 'SlipOrderController@simpanUbahStatusRecurring');
	Route::post('updateStatusFaultDataRecurring', 'SlipOrderController@updateStatusFaultDataRecurring');

	Route::get('slipOrderSewaRecurring', 'SlipOrderController@getIndexSewaRecurring')->name('slipOrder.indexSewaRecurring');
	Route::post('slipOrderSewaRecurring', 'SlipOrderController@postIndexSewaRecurring');

	Route::get('slipOrderSewaRecurring10', 'SlipOrderController@getIndexSewaRecurring10')->name('slipOrder.indexSewaRecurring10');
	Route::post('slipOrderSewaRecurring10', 'SlipOrderController@postIndexSewaRecurring10');

	Route::get('slipOrderSewaRecurring25', 'SlipOrderController@getIndexSewaRecurring25')->name('slipOrder.indexSewaRecurring25');
	Route::post('slipOrderSewaRecurring25', 'SlipOrderController@postIndexSewaRecurring25');
	
	Route::post('slipOrderSewaRecurringPerminggu', 'SlipOrderController@postIndexSewaRecurringPerminggu')->name('sewaRecurring.perminggu');

	Route::get('slipOrderSewa', 'SlipOrderController@getIndexSewa')->name('slipOrder.indexSewa');
	Route::post('slipOrderSewa', 'SlipOrderController@postIndexSewa');
	Route::post('slipOrderSewaPerminggu', 'SlipOrderController@postIndexSewaPerminggu')->name('sewa.perminggu');

	Route::get('slipOrderPutus', 'SlipOrderController@getIndexPutus')->name('slipOrder.indexPutus');
	Route::post('slipOrderPutus', 'SlipOrderController@postIndexPutus');
	Route::post('slipOrderPutusPerminggu', 'SlipOrderController@postIndexPutusPerminggu')->name('putus.perminggu');
	
	
	Route::get('SO/{id}/details', 'SlipOrderController@getInvoiceDetails')->name('SO.details');
	Route::get('SO/{id}/detailsPeriode', 'SlipOrderController@getInvoiceDetailsPeriode')->name('SO.detailsPeriode');
	Route::post('SO/detailsPutus', 'SlipOrderController@getInvoiceDetailsPutus');


	Route::get('printSOsewa/{id}', 'SlipOrderController@cetakSewa');
	Route::get('printSOperiode/{id}', 'SlipOrderController@cetakPeriode');
	Route::get('printSOputus/{id}', 'SlipOrderController@cetakPutus');
	// Route::get('cetak', 'SlipOrderController@cetak');

	Route::post('upgradeStatusSewa', 'SlipOrderController@upgradeStatusSewa');
	

	Route::post('bayarSewa', 'SlipOrderController@bayarSewa');
	Route::post('bayarPinalti', 'SlipOrderController@bayarPinalti');
	Route::post('bayarCicilan', 'SlipOrderController@bayarCicilan');
	Route::post('bayarCicilanPeriode', 'SlipOrderController@bayarCicilanPeriode');
	
	Route::get('konvert', 'SlipOrderController@getDownload');
	Route::post('bank_format/{tanggal}', 'SlipOrderController@bankFormatSewa');
	Route::get('daftarRecurringKosong', 'SlipOrderController@daftarRecurringKosong')->name('daftarRecurringKosong');
	Route::get('SO/{id}/updateRecurring', 'SlipOrderController@updateRecurring')->name('SO.updateRecurring');
	Route::post('bank_format_putus', 'SlipOrderController@bankFormatPutus');
	
	Route::model('slipOrder', 'App\Invoice');
	
	Route::get('slipOrder/new', 'InvoiceController@getNewInvoice')->name('slipOrder.new');

	Route::get('slipOrder/slipOrder/new/getlokasi/{id}', 'InvoiceController@getlokasi');
	Route::get('dropdownlist/getstates/{id}','DataController@getStates');

	Route::post('slipOrder/new', 'InvoiceController@postInvoice')->name('slipOrder.post');
	
	Route::post('isiDataRecurring', 'SlipOrderController@isiDataRecurring');

	Route::get('/cart','CartController@index')->name('cart.index');
	Route::post('/cart','CartController@add')->name('cart.add');
	Route::post('/cart/conditions','CartController@addCondition')->name('cart.addCondition');
	Route::delete('/cart/conditions','CartController@clearCartConditions')->name('cart.clearCartConditions');
	Route::get('/cart/details','CartController@details')->name('cart.details');
	Route::delete('/cart/{id}','CartController@delete')->name('cart.delete');

	Route::post('order/search','InvoiceController@search');
	Route::get('slipOrderPutus/{invoice}', 'InvoiceController@getEditSalesOrder')->name('slipOrderPutus.edit');
	Route::post('slipOrderPutusEdit', 'InvoiceController@postEditSalesOrder')->name('slipOrderPutus.post');
	

	Route::get('dataManager', 'SlipOrderController@dataManager')->name('dataManager');

	
	

	// Route::model('akunting', 'App\Invoice');
	
	Route::get('akunting', 'SlipOrderController@getAkunting')->name('akunting.index');
	Route::post('akunting', 'SlipOrderController@postAkunting');

	Route::get('akunting/{id}', 'SlipOrderController@akuntingBank');

	Route::get('exportExcelPerBank/{kodeBank}', 'SlipOrderController@exportExcelPerBank');

	
	
	
	/*========================================================
		Staf route
	=========================================================*/
	Route::model('staf', 'App\User');
	Route::get('user', 'UserController@getIndex')->name('user.index');
	Route::post('user', 'UserController@postIndex');

	Route::get('staf/new', 'UserController@getNewUser')->name('staf.new');
	Route::post('staf/new', 'UserController@postUser')->name('staf.post');

	Route::get('staf/{staf}', 'UserController@getEditUser')->name('staf.edit');
	Route::post('staf/{staf}', 'UserController@postUser')->name('staf.post');
	Route::delete('staf/delete/{staf}', 'UserController@deleteUser')->name('staf.delete');

	Route::get('staf/{staf}/details', 'UserController@getUserDetails')->name('staf.details');


	Route::post('postSalesManager', 'StafController@postSalesManager')->name('salesManager.store');
	Route::post('postSales', 'StafController@postSales')->name('sales.store');

	Route::get('getSales/{id}', 'StafController@getSalesPilihan');
	Route::get('slipOrder/jualPutus/getSales/{id}', 'StafController@getSalesPilihan');

	


	/*========================================================
		Staf marketing route
	=========================================================*/


	Route::get('penjualanVP', 'StafController@dataPenjualanVP')->name('dataPenjualanVP');
	Route::get('dataSales/{id}', 'StafController@dataSales')->name('dataSales');
	Route::get('salesReportExcel/{id}', 'StafController@salesReportExcel');
	Route::get('dataPenjualanSales/{id}', 'SlipOrderController@dataPenjualanSales')->name('dataPenjualanSales');



	/*========================================================
		Tiket route
	=========================================================*/
	Route::model('tiket', 'App\Tiket');
	Route::get('tiket', 'TiketController@getIndex')->name('tiket.index');
	Route::post('tiket', 'TiketController@postIndex');
	Route::post('tiketPerminggu', 'TiketController@postIndexTiketPerminggu')->name('tiket.perminggu');

	Route::get('tiket/new', 'TiketController@getNewTiket')->name('tiket.new');
	Route::post('tiket/new', 'TiketController@postTiket')->name('tiket.post');

	Route::post('updateTiket', 'TiketController@updateTiket')->name('updateTiket');

	Route::get('tiket/{tiket}', 'TiketController@getEditTiket')->name('tiket.edit');
	Route::post('tiket/{tiket}', 'TiketController@postTiket')->name('tiket.post');
	Route::delete('tiket/delete/{tiket}', 'TiketController@deleteTiket')->name('tiket.delete');

	Route::get('tiket/{tiket}/details', 'TiketController@getTiketDetails')->name('tiket.details');


	

/*========================================================
		Barang route
	=========================================================*/
	Route::model('barang', 'App\Barang');
	
	Route::get('barang', 'BarangController@getIndex')->name('barang.index');
	Route::post('barang', 'BarangController@postIndex');


	Route::get('barangTersedia', 'BarangController@getIndexTersedia')->name('barangTersedia.index');
	Route::post('barangTersedia', 'BarangController@postIndexTersedia');

	Route::get('barangTersewa', 'BarangController@getIndexTersewa')->name('barangTersewa.index');
	Route::post('barangTersewa', 'BarangController@postIndexTersewa');

	Route::get('barangTerbeli', 'BarangController@getIndexTerbeli')->name('barangTerbeli.index');
	Route::post('barangTerbeli', 'BarangController@postIndexTerbeli');

	Route::get('barang/new', 'BarangController@getNewBarang')->name('barang.new');
	Route::post('barang/new', 'BarangController@postBarang')->name('barang.post');

	Route::get('gudang/{id}', 'BarangController@getBarangGudang');

	Route::get('gudang', 'BarangController@getIndexGudang')->name('gudang.index');
	Route::post('gudang', 'BarangController@postIndexGudang');

	Route::get('tambahGudang', 'BarangController@getNewGudang')->name('tambahGudang');
	Route::post('newGudang/simpan', 'BarangController@postGudang')->name('gudang.post');

	Route::get('barang/{barang}/editData', 'BarangController@getEditDataBarang')->name('barang.editData');
	Route::post('barang/{barang}/editData', 'BarangController@editDataSimpan')->name('barang.editDataSimpan');

	Route::get('barang/{barang}/updateStok', 'BarangController@getUpdateStok')->name('barang.updateStok');
	Route::post('stokBarang/{barang}', 'BarangController@postStok')->name('barang.stok');

	Route::post('barang/{barang}', 'BarangController@postBarang')->name('barang.post');
	Route::delete('barang/delete/{barang}', 'BarangController@deleteBarang')->name('barang.delete');

	Route::get('barang/{barang}/details', 'BarangController@getBarangDetails')->name('barang.details');
	
	Route::get('barang_sparepart/add/{barang}', 'BarangController@getBarangSparepart')->name('barang.sparepart');
	Route::post('barang_sparepart', 'BarangController@postAddSparepart')->name('postAdd.sparepart');


	/*========================================================
		Sparepart route
	=========================================================*/
	Route::model('sparepart', 'App\Sparepart');
	Route::get('sparepart', 'SparepartController@getIndex')->name('sparepart.index');
	Route::post('sparepart', 'SparepartController@postIndex');

	Route::get('sparepart/new', 'SparepartController@getNewSparepart')->name('sparepart.new');
	Route::post('sparepart/new', 'SparepartController@postSparepart')->name('sparepart.post');

	Route::get('sparepart/{sparepart}', 'SparepartController@getEditSparepart')->name('sparepart.edit');
	Route::post('sparepart/{sparepart}', 'SparepartController@postSparepart')->name('sparepart.post');
	Route::delete('sparepart/delete/{sparepart}', 'SparepartController@deleteSparepart')->name('sparepart.delete');

	Route::get('sparepart/{sparepart}/details', 'SparepartController@getSparepartDetails')->name('sparepart.details');


	/*========================================================
		instalasi route
	=========================================================*/
	Route::model('instalasi', 'App\Instalasi');
	Route::get('instalasi', 'InstalasiController@getIndex')->name('instalasi.index');
	Route::post('instalasi', 'InstalasiController@postIndex');
	Route::post('instalasiPerminggu', 'InstalasiController@postIndexInstalasiPerminggu')->name('instalasi.perminggu');

	

	Route::get('inputTeknisiInstalasi/{id}', 'InstalasiController@getDataInstalasi')->name('inputTeknisiInstalasi');
	Route::post('instalasi/proses/simpan', 'InstalasiController@simpanProses');


	Route::post('instalasi/new', 'InstalasiController@postSparepart')->name('instalasi.post');

	Route::get('instalasi/{instalasi}', 'InstalasiController@getEditSparepart')->name('instalasi.edit');
	Route::post('instalasi/{instalasi}', 'InstalasiController@postSparepart')->name('instalasi.post');
	Route::delete('instalasi/delete/{instalasi}', 'InstalasiController@deleteSparepart')->name('instalasi.delete');

	Route::get('instalasi/{instalasi}/details', 'InstalasiController@getSparepartDetails')->name('instalasi.details');	
	
	/*========================================================
		Delivery Order route
	=========================================================*/
	Route::model('DeliveryOrder', 'App\DeliveryOrder');
	Route::get('delivery', 'DeliveryOrderController@getIndex')->name('delivery.index');
	Route::post('delivery', 'DeliveryOrderController@postIndex');
	Route::post('deliveryPerminggu', 'DeliveryOrderController@postIndexDeliveryPerminggu')->name('delivery.perminggu');

	Route::get('delivery/new', 'DeliveryOrderController@getNewDelivery')->name('delivery.new');
	Route::post('delivery/new', 'DeliveryOrderController@postDelivery')->name('delivery.post');

	Route::get('delivery_preview/{delivery}', 'DeliveryOrderController@getDeliveryPreview')->name('delivery.preview');

	Route::get('delivery/proses/{delivery}', 'DeliveryOrderController@getProsesDelivery')->name('delivery.proses');
	Route::get('delivery/{delivery}', 'DeliveryOrderController@getEditDelivery')->name('delivery.edit');

	Route::post('deliveryOrder/proses/simpan', 'DeliveryOrderController@simpanProses');

	Route::post('delivery/{delivery}', 'DeliveryOrderController@postDelivery')->name('delivery.post');
	Route::delete('delivery/delete/{delivery}', 'DeliveryOrderController@deleteDelivery')->name('delivery.delete');

	Route::get('delivery/{delivery}/details', 'DeliveryOrderController@getDeliverytDetails')->name('delivery.details');

	Route::get('printDO/{id}', 'DeliveryOrderController@cetakDO');

	/*========================================================
		maintenance route
	=========================================================*/
	Route::model('maintenance', 'App\Maintenance');
	Route::get('maintenance', 'MaintenanceController@getIndex')->name('maintenance.index');
	Route::post('maintenance', 'MaintenanceController@postIndex');
	Route::post('simpanInputTeknisiMaintenance', 'MaintenanceController@simpanInputTeknisiMaintenance');
	Route::post('simpanUbahJadwalMaintenance', 'MaintenanceController@simpanUbahJadwalMaintenance');
	Route::post('maintenancePerminggu', 'MaintenanceController@postIndexMaintenancePerminggu')->name('maintenance.perminggu');
	Route::get('inputTeknisiMaintenance/{id_sales_order}', 'MaintenanceController@inputTeknisiMaintenance');
	Route::get('ubahJadwalMaintenance/{id_sales_order}', 'MaintenanceController@ubahJadwalMaintenance');
	Route::get('daftarMaintenanceTempo', 'MaintenanceController@daftarMaintenanceTempo');


	/*========================================================
		laporan teknisi route
	=========================================================*/
	Route::model('slipOrder', 'App\SlipOrder');
	Route::get('laporanTeknisi', 'TeknisiController@getIndex')->name('teknisi.index');
	Route::post('laporanTeknisi', 'TeknisiController@postIndex');
	Route::post('laporanTeknisi/SO', 'TeknisiController@getLaporanTeknisi')->name('laporanTeknisi/SO');
	Route::post('storeLaporanTeknisi', 'TeknisiController@storeLaporanTeknisi');
	
	

	/*========================================================
		Reward route
	=========================================================*/
	Route::model('reward', 'App\Reward');
	Route::get('reward', 'RewardController@getIndex')->name('reward.index');
	Route::post('reward', 'RewardController@postIndex');

	Route::get('reward/new', 'RewardController@getNewReward')->name('reward.new');
	Route::post('reward/new', 'RewardController@postReward')->name('reward.post');

	Route::get('reward/{reward}', 'RewardController@getEditReward')->name('reward.edit');
	Route::post('reward/{reward}', 'RewardController@postReward')->name('reward.post');
	Route::delete('reward/delete/{reward}', 'RewardController@deleteReward')->name('reward.delete');

	Route::get('reward/{reward}/details', 'RewardController@getRewardDetails')->name('reward.details');

	/*========================================================
		temporary route
	=========================================================*/
	Route::model('temporarySO', 'App\TemporaryInvoice');

	Route::get('temporarySO', 'TemporaryInvoiceController@getIndex')->name('temporarySO.index');

	Route::get('temporarySO/{temporary}/details', 'TemporaryInvoiceController@getSlipOrderDetails')->name('temporarySO.details');

	Route::post('temporarySO/tolak/{id}', 'TemporaryInvoiceController@tolak')->name('temporary.tolak');
	Route::post('temporarySO/terima/{id}', 'TemporaryInvoiceController@terima')->name('temporary.terima');
	
	/*========================================================
		data route
	=========================================================*/
	Route::get('dataTerpasang', 'InstalasiController@getIndexDataTerpasang')->name('dataTerpasang');	
	Route::post('dataTerpasang', 'InstalasiController@postIndexDataTerpasang');

	Route::get('dataTarikan', 'CustomerController@getIndexDataTarikan')->name('dataTarikan');	
	Route::post('dataTarikan', 'CustomerController@postIndexDataTarikan');

	/*========================================================
		Import Data Excel route
	=========================================================*/
	// import user
	Route::get('/getImportUser', 'StafController@getImportUser')->name('getImportUser');
	Route::post('/simpanUploadUser','StafController@postImportUser');
	// import customer
	Route::get('/getImportCustomer', 'CustomerController@getImportCustomer')->name('getImportCustomer');
	Route::post('/simpanUploadCustomer','CustomerController@postImportCustomer');
	// import barang
	Route::get('/getImportBarang', 'BarangController@getImportBarang')->name('getImportBarang');
	Route::post('/simpanUploadBarang','BarangController@postImportBarang');
	// import teknisi
	Route::get('/getImportTeknisi', 'TeknisiController@getImportTeknisi')->name('getImportTeknisi');
	Route::post('/simpanUploadTeknisi','TeknisiController@postImportTeknisi');
	// import master bank
	Route::get('/getImportMasterBank', 'MasterBankController@getImportMasterBank')->name('getImportMasterBank');
	Route::post('/simpanUploadMasterBank','MasterBankController@postImportMasterBank');
	// import manajer sales
	Route::get('/getImportSalesManager', 'SalesManagerController@getImportSalesManager')->name('getImportSalesManager');
	Route::post('/simpanUploadSalesManager','SalesManagerController@postImportSalesManager');
	// import sales
	Route::get('/getImportSales', 'SalesController@getImportSales')->name('getImportSales');
	Route::post('/simpanUploadSales','SalesController@postImportSales');
	// import sales order
	Route::get('/getImportSO', 'SlipOrderController@getImportSO')->name('getImportSO');
	Route::post('/simpanUploadSO','SlipOrderController@postImportSO');

	// import sales order detail
	Route::get('/getImportSODetail', 'SlipOrderController@getImportSODetail')->name('getImportSODetail');
	Route::post('/simpanUploadSODetail','SlipOrderController@postImportSODetail');
	// import pembayaran
	Route::get('/getImportPembayaran', 'PembayaranController@getImportPembayaran')->name('getImportPembayaran');
	Route::post('/simpanUploadPembayaran','PembayaranController@postImportPembayaran');
	// import instalasi
	Route::get('/getImportInstalasi', 'InstalasiController@getImportInstalasi')->name('getImportInstalasi');
	Route::post('/simpanUploadInstalasi','InstalasiController@postImportInstalasi');
	// import maintenance
	Route::get('/getImportMaintenance', 'MaintenanceController@getImportMaintenance')->name('getImportMaintenance');
	Route::post('/simpanUploadMaintenance','MaintenanceController@postImportMaintenance');
	// import laporan teknisi
	Route::get('/getImportLaporanTeknisi', 'TeknisiController@getImportLaporanTeknisi')->name('getImportLaporanTeknisi');
	Route::post('/simpanUploadLaporanTeknisi','TeknisiController@postImportLaporanTeknisi');

	Route::get('/allData', 'AllDataController@getIndex')->name('allData');
	Route::post('allData', 'AllDataController@postIndex');
	Route::post('allDataDetail', 'AllDataController@allDataDetail');
	Route::post('simpanUbahAllData', 'AllDataController@simpanUbahAllData');

	Route::get('/cekLaporanInstalasi', 'AllDataController@laporanInstalasi')->name('allData');
	
});




Addchat::routes();
