<?php

Route::post('login', 'Api\AuthController@authenticate');
Route::post('register', 'Api\AuthController@register');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'Api\AuthController@getAuthenticatedUser');
    Route::post('profile/update', 'Api\AuthController@updateProfile');

    Route::get('categories', 'Api\ApiController@getCategories');
    Route::post('home/data', 'Api\ApiController@getAllHomeData');
    Route::get('saved/data/{id}', 'Api\ApiController@getUserSavedData');

    Route::group(['prefix'  =>   'deals'], function() {
		Route::get('list', 'Api\DealController@index');
	    Route::get('details/{id}', 'Api\DealController@details');
	    Route::post('filter', 'Api\DealController@filter');
	    Route::post('category-wise', 'Api\DealController@categoryWiseDeals');
	    Route::post('user/save', 'Api\DealController@saveUserDeal');
	    Route::post('user/delete', 'Api\DealController@deleteUserDeal');
	    Route::post('user/check', 'Api\DealController@checkUserDeals');
	});

	Route::group(['prefix'  =>   'events'], function() {
		Route::get('list', 'Api\EventController@index');
	    Route::get('details/{id}', 'Api\EventController@details');
	    Route::post('filter', 'Api\EventController@filter');
	    Route::post('category-wise', 'Api\EventController@categoryWiseDeals');
	    Route::post('user/save', 'Api\EventController@saveUserEvent');
	    Route::post('user/delete', 'Api\EventController@deleteUserEvent');
	    Route::post('user/check', 'Api\EventController@checkUserEvents');
	});

	Route::group(['prefix'  =>   'loop'], function() {
		Route::get('list', 'Api\LoopController@index');
	    Route::get('details/{id}', 'Api\LoopController@details');
	    Route::post('create', 'Api\LoopController@create');
	    Route::post('update', 'Api\LoopController@update');
	    Route::get('user/{id}', 'Api\LoopController@userLoops');
	    Route::get('delete/{id}', 'Api\LoopController@delete');
	    Route::get('comments/{id}', 'Api\LoopController@comments');
	    Route::post('comments/create', 'Api\LoopController@createComment');
	    Route::get('comments/delete/{id}', 'Api\LoopController@deleteComment');
	    Route::post('like', 'Api\LoopController@likeLoop');
	});

	Route::get('notifications', 'Api\ApiController@notifications');

	Route::group(['prefix'  =>   'directories'], function() {
		Route::get('list', 'Api\BusinessController@index');
	    Route::get('details/{id}', 'Api\BusinessController@details');
	    Route::post('category-wise', 'Api\BusinessController@categoryWiseBusiness');
	    Route::post('user/save', 'Api\BusinessController@saveUserBusiness');
	    Route::post('user/delete', 'Api\BusinessController@deleteUserBusiness');
	    Route::post('user/check', 'Api\BusinessController@checkUserBusinesses');
	});

});
//Local Trade Question

Route::group(['prefix'  =>   'localtrade'], function() {
    Route::get('list', 'Api\TradeController@index');
    Route::get('details/{id}', 'Api\TradeController@details');
    Route::get('category-list', 'Api\TradeController@category');
    Route::post('save', 'Api\TradeController@create');
    Route::post('user/delete', 'Api\TradeController@deleteUserBusiness');
    Route::post('user/check', 'Api\TradeController@checkUserBusinesses');
});




//Collection
Route::group(['prefix'  =>   'collection'], function() {
    Route::get('list', 'Api\CollectionController@index');
    Route::get('details/{id}', 'Api\CollectionController@details');
    Route::get('directory-list/{id}', 'Api\CollectionController@collectionwiseDirectory');

});


//Article
Route::group(['prefix'  =>   'article'], function() {
    Route::get('list', 'Api\ArticleController@index');
    Route::get('details/{id}', 'Api\ArticleController@details');
    Route::post('filter', 'Api\ArticleController@filter');

});
