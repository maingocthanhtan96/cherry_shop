<?php

// Send reset password mail
Route::post('/forgot-password', 'AuthController@forgotPassword');
// Handle reset password form process
Route::post('/reset-password', 'AuthController@resetPassword');
// START - Auth
Route::post('/logging', 'AuthController@logging');
Route::post('/fe-login', 'AuthController@feLogin');
Route::post('/refresh-token', 'AuthController@refreshToken');
Route::post('/login', 'AuthController@login');
// END - Auth
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/fe-logout', 'AuthController@feLogout');
    Route::get('/user-info', 'UserController@userInfo');
    Route::get('/logout', 'AuthController@logout');
    Route::group(['middleware' => 'verify_request'], function () {});
    // permission manage permission
    Route::group(
        [
            'middleware' => 'permission:' . \ACL::PERMISSION_PERMISSION_MANAGE,
        ],
        function () {
            Route::apiResource('roles', 'RoleController');
            Route::apiResource('permissions', 'PermissionController');
        }
    );
    Route::group(['middleware' => 'role:' . \ACL::ROLE_ADMIN], function () {
        Route::apiResource('users', 'UserController');
        //{{ROUTE_ADMIN_NOT_DELETE_THIS_LINE}}
    });

    /*<==> Category Route - 2021-08-02 21:49:15 <==>*/
    Route::get('/categories/get-categories', 'CategoryController@getCategory');
    Route::apiResource('categories', 'CategoryController');
    /*<==> Product Route - 2021-08-02 21:53:12 <==>*/
    Route::get('/products/{product}/detail', 'ProductController@detail');
    Route::get('/products/get-products', 'ProductController@getProduct');
    Route::apiResource('products', 'ProductController');
    /*<==> Color Route - 2021-08-02 21:55:13 <==>*/
    Route::get('/colors/get-colors', 'ColorController@getColor');
    Route::apiResource('colors', 'ColorController');
    /*<==> Size Route - 2021-08-02 21:55:43 <==>*/
    Route::get('/sizes/get-sizes', 'SizeController@getSize');
    Route::apiResource('sizes', 'SizeController');
    /*<==> ProductPayment Route - 2021-08-02 21:58:19 <==>*/
    Route::delete('/product-payments/{product_payment}/rollback', 'ProductPaymentController@rollback');
    Route::get('/product-payments/export-excel', 'ProductPaymentController@exportExcel');
    Route::get('/product-payments/total-money', 'ProductPaymentController@totalMoney');
    Route::get('/product-payments/chart', 'ProductPaymentController@chart');
    Route::apiResource('product-payments', 'ProductPaymentController');
    /*<==> ProductReject Route - 2021-08-02 22:00:29 <==>*/
    Route::apiResource('product-rejects', 'ProductRejectController');
    /*<==> Member Route - 2021-08-02 22:02:10 <==>*/
    Route::get('/members/search', 'MemberController@search');
    Route::get('/members/get-members', 'MemberController@getMember');
    Route::apiResource('members', 'MemberController');
    /*<==> ProductDetail Route - 2021-08-05 21:05:22 <==>*/
    Route::get('/product-details/get-product-details', 'ProductDetailController@getProductDetail');
    Route::apiResource('product-details', 'ProductDetailController');
    //{{ROUTE_USER_NOT_DELETE_THIS_LINE}}
});

Route::fallback(function () {
    return response()->json(
        [
            'message' => trans('error.404'),
        ],
        404
    );
});
