<?php
Route::group(['prefix' => 'business'], function () {
	Route::get('login', 'Business\LoginController@showLoginForm')->name('business.login');
    Route::post('login', 'Business\LoginController@login')->name('business.login.post');
	Route::get('logout', 'Business\LoginController@logout')->name('business.logout');
    Route::post('update-profile', 'Business\LoginController@updateProfile')->name('business.dashboard.updateProfile');
	Route::group(['middleware' => ['auth:business']], function () {
		Route::get('/', function () {
	      	return view('business.dashboard.index');
	    })->name('business.dashboard');
        Route::get('/profile', function () {
            return view('business.auth.edit_profile');
      })->name('business.profile');
        //profile management
       // Route::get('/profile', 'Business\LoginController@editUserProfile')->name('business.profile');

        Route::get('notification-list', 'Business\LoginController@notificationList')->name('dashboard.notificationList');


        Route::group(['prefix'  =>   'notification'], function() {
			Route::get('/', 'Business\LoginController@notificationList')->name('business.notification.index');
			// Route::get('/create', 'Admin\NotificationController@create')->name('admin.notification.create');
			// Route::post('/store', 'Admin\NotificationController@store')->name('admin.notification.store');
			// Route::get('/{id}/delete', 'Admin\NotificationController@delete')->name('admin.notification.delete');
		});
        //event
        Route::group(['prefix' => 'event'], function() {
        Route::get('/', 'Business\EventController@index')->name('business.event.index');
        Route::get('/create', 'Business\EventController@create')->name('business.event.create');
        Route::post('/store', 'Business\EventController@store')->name('business.event.store');
        Route::get('/{id}/edit', 'Business\EventController@edit')->name('business.event.edit');
        Route::post('/update', 'Business\EventController@update')->name('business.event.update');
        Route::get('/{id}/delete', 'Business\EventController@delete')->name('business.event.delete');
        Route::get('/{id}/details', 'Business\EventController@details')->name('business.event.details');
        Route::post('/csv-store', 'Business\EventController@csvStore')->name('business.event.data.csv.store');
        Route::get('/export', 'Business\EventController@export')->name('business.event.data.csv.export');
    });

		Route::group(['prefix' => 'deal'], function() {
			Route::get('/', 'Business\DealController@index')->name('business.deal.index');
			Route::get('/create', 'Business\DealController@create')->name('business.deal.create');
			Route::post('/store', 'Business\DealController@store')->name('business.deal.store');
			Route::get('/{id}/edit', 'Business\DealController@edit')->name('business.deal.edit');
			Route::post('/update', 'Business\DealController@update')->name('business.deal.update');
			Route::get('/{id}/delete', 'Business\DealController@delete')->name('business.deal.delete');
			Route::get('/{id}/details', 'Business\DealController@details')->name('business.deal.details');
            Route::post('/csv-store', 'Business\DealController@csvStore')->name('business.deal.data.csv.store');
            Route::get('/export', 'Business\DealController@export')->name('business.deal.data.csv.export');
		});
        Route::group(['prefix' => 'directory'], function() {
			Route::get('/', 'Business\DirectoryController@review')->name('business.directory.review');
			Route::get('/create', 'Business\DirectoryController@create')->name('business.directory.create');
			Route::post('/store', 'Business\DirectoryController@store')->name('business.directory.store');
			Route::get('/{id}/edit', 'Business\DirectoryController@edit')->name('business.directory.edit');
			Route::post('/update', 'Business\DirectoryController@update')->name('business.directory.update');
			Route::get('/{id}/delete', 'Business\DirectoryController@delete')->name('business.directory.delete');
			Route::get('/{id}/details', 'Business\DirectoryController@details')->name('business.directory.details');
            Route::post('/csv-store', 'Business\DirectoryController@csvStore')->name('business.directory.data.csv.store');
            Route::get('/export', 'Business\DirectoryController@export')->name('business.directory.data.csv.export');
		});

		Route::group(['prefix' => 'advertisement'], function() {
			Route::get('/', 'Business\AdvertisementController@index')->name('business.advertisement.index');
			Route::get('/create', 'Business\AdvertisementController@create')->name('business.advertisement.create');
			Route::post('/store', 'Business\AdvertisementController@store')->name('business.advertisement.store');
			Route::get('/{id}/edit', 'Business\AdvertisementController@edit')->name('business.advertisement.edit');
			Route::post('/update', 'Business\AdvertisementController@update')->name('business.advertisement.update');
			Route::get('/{id}/delete', 'Business\AdvertisementController@delete')->name('business.advertisement.delete');
			Route::get('/{id}/details', 'Business\AdvertisementController@details')->name('business.advertisement.details');
		});


        Route::group(['prefix' => 'advertisementreport'], function() {
			Route::get('/', 'Business\AdvertisementController@report')->name('business.advertisementreport.index');
            Route::get('/advertisement-view/{id}', 'Business\AdvertisementController@userview')->name('business.advertisement.views');
		});


        Route::group(['prefix' => 'product'], function() {
			Route::get('/', 'Business\ProductController@index')->name('business.market-product.index');
			Route::get('/create', 'Business\ProductController@create')->name('business.market-product.create');
			Route::post('/store', 'Business\ProductController@store')->name('business.market-product.store');
			Route::get('/{id}/edit', 'Business\ProductController@edit')->name('business.market-product.edit');
			Route::post('/update', 'Business\ProductController@update')->name('business.market-product.update');
			Route::get('/{id}/delete', 'Business\ProductController@delete')->name('business.market-product.delete');
			Route::get('/{id}/details', 'Business\ProductController@details')->name('business.market-product.details');
            Route::post('/csv-store', 'Business\ProductController@csvStore')->name('business.market-product.data.csv.store');
            Route::get('/export', 'Business\ProductController@export')->name('business.market-product.data.csv.export');
		});


//order
        Route::group(['prefix' => 'order'], function() {
			Route::get('/', 'Business\OrderController@index')->name('business.market-order.index');
			Route::get('/create', 'Business\OrderController@create')->name('business.market-order.create');
			Route::post('/store', 'Business\OrderController@store')->name('business.market-order.store');
			Route::get('/{id}/edit', 'Business\OrderController@edit')->name('business.market-order.edit');
			Route::post('/update', 'Business\OrderController@update')->name('business.market-order.update');
			Route::get('/{id}/delete', 'Business\OrderController@delete')->name('business.market-order.delete');
			Route::get('/{id}/details', 'Business\OrderController@details')->name('business.market-order.details');
		});


//coupon
        Route::group(['prefix' => 'coupon'], function() {
			Route::get('/', 'Business\CouponController@index')->name('business.market-coupon.index');
			Route::get('/create', 'Business\CouponController@create')->name('business.market-coupon.create');
			Route::post('/store', 'Business\CouponController@store')->name('business.market-coupon.store');
			Route::get('/{id}/edit', 'Business\CouponController@edit')->name('business.market-coupon.edit');
			Route::post('/{id}/update', 'Business\CouponController@update')->name('business.market-coupon.update');
			Route::get('/{id}/delete', 'Business\CouponController@delete')->name('business.market-coupon.delete');
			Route::get('/{id}/details', 'Business\CouponController@details')->name('business.market-coupon.details');
            Route::get('/{id}/status', 'Business\CouponController@status')->name('business.market-coupon.status');
		});

        Route::group(['prefix' => 'trade'], function() {
			Route::get('/', 'Business\LocalTradeController@index')->name('business.trade.index');
			Route::get('/create', 'Business\LocalTradeController@create')->name('business.trade.create');
			Route::post('/store', 'Business\LocalTradeController@store')->name('business.trade.store');
			Route::get('/{id}/edit', 'Business\LocalTradeController@edit')->name('business.trade.edit');
			Route::post('/update', 'Business\LocalTradeController@update')->name('business.trade.update');
			Route::get('/{id}/delete', 'Business\LocalTradeController@delete')->name('business.trade.delete');
			Route::get('/{id}/details', 'Business\LocalTradeController@details')->name('business.trade.details');
		});


	});
});


?>
