<?php

use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\dashbordController;
use App\Http\Controllers\generalController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\addToCartController;
use App\Http\Controllers\singleProductController;
use App\Http\Controllers\userController;
use App\Http\Middleware\validUser;
use App\Http\Controllers\OrderController;

Route::controller(dashbordController::class)->group(function(){
    Route::get('/dashbord/uma-import-inc','viewDashbord')->name('dashbord')->middleware(validUser::class);
    Route::get('/dashbord/{id}/out-of-stock','editOutOFStockProduct')->name('out-of-stock')->middleware(validUser::class);
    Route::post('/dashbord/{id}/out-of-stock-store','updateOutOFStockProduct')->name('out-of-stock-store')->middleware(validUser::class);
    Route::get('/dashbord/{id}/out-of-stock-destroy','destroyOutOfStock')->name('out-of-stock-destroy')->middleware(validUser::class);
    Route::get('/dashbord/viewOrder','viewOrder')->name('viewOrder')->middleware(validUser::class);
    Route::get('/dashbord/allOrder','allOrder')->name('allOrder')->middleware(validUser::class);
    Route::get('/dashbord/viewallOrders/{id}','viewallOrders')->name('viewallOrders')->middleware(validUser::class);
    Route::get('/dashbord/viewTodayOrders/{id}','viewTodayOrders')->name('viewTodayOrders')->middleware(validUser::class);
    Route::get('/dashbord/deliverOrder/{id}','deliverOrder')->name('deliverOrder')->middleware(validUser::class);
    Route::get('/dashbord/cancelrOrder/{id}','cancelrOrder')->name('cancelrOrder')->middleware(validUser::class);
    Route::get('/dashbord/viewusertabele','viewusertabele')->name('viewusertabele')->middleware(validUser::class);
    Route::get('/dashbord/deleteUser/{id}','deleteUser')->name('deleteUser')->middleware(validUser::class);
});

Route::resource('dashbord/category',CategoryController::class)->middleware(validUser::class);
Route::resource('dashbord/sub-category',SubCategoryController::class)->middleware(validUser::class);
Route::resource('dashbord/brand',BrandController::class)->middleware(validUser::class);
Route::resource('dashbord/product',ProductController::class)->middleware(validUser::class);


Route::controller(StockController::class)->group(function(){
      Route::get('dashbord/product-stock','viewStockProduct')->name('viewStockProduct')->middleware(validUser::class);
});


Route::controller(generalController::class)->group(function(){
    Route::get('/dashbord/general-setting','viewGeneralSetting')->name('general-setting')->middleware(validUser::class);
    Route::post('/dashbord/{id}/store-general-setting','storeGeneralSetting')->name('store-general-setting')->middleware(validUser::class);
});

Route::controller(homeController::class)->group(function(){
    Route::get('/','viewHome')->name('home');
    Route::get('/login','login')->name('login');
    Route::get('/signup','signup')->name('signup');
    Route::post('/storesignup','storesignup')->name('storesignup');
    Route::post('/storeLogin','storeLogin')->name('storeLogin');
    Route::post('/logout','logout')->name('logout');
    Route::get('/about','viewAbout')->name('about');
    Route::get('/search','search')->name('search');
    Route::get('/search-category/{id}','searchByCategory')->name('searchByCategory');
});


Route::controller(addToCartController::class)->group(function(){
    Route::get('/mycart','mycart')->name('mycart');
    Route::post('/addToCart','addToCart')->name('cart.add');
    Route::post('/update-cart','update')->name('cart.update');
    Route::post('/remove-cart','remove')->name('cart.remove');
});

Route::controller(singleProductController::class)->group(function(){
    Route::get('view-product/{id}','viewSingleProduct')->name('view-product');
});

Route::controller(userController::class)->group(function(){
    Route::get('/user-profile','viewProfile')->name('viewProfile');
    Route::post('/updateUserImg/{id}','updateUserImg')->name('updateUserImg');
    Route::get('/viewEditPage/{id}','viewEditPage')->name('viewEditPage');
    Route::post('/storeUser/{id}','storeUser')->name('storeUser');
    Route::get('/AllOrers','viewAllOrders')->name('viewAllOrders');
});

Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/removeOrder/{id}', [OrderController::class, 'removeOrder'])->name('removeOrder');


Route::get('nav',function(){
    return view('fornt.nav');
});
// Route::get('about',function(){
//     return view('fornt.about');
// })->name('about');