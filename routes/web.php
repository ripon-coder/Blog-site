<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\blogController;
use App\Http\Controllers\noticeController;


// Super Admin
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\OurTeachController;
use App\Http\Controllers\Admin\gallaryImageController;
use App\Http\Controllers\Admin\chairmanController;
use App\Http\Controllers\Admin\noticeControllerAdmin;







Auth::routes([
    'login'=>false,
    'register'=>false,
]);

Route::get('/pass', function () {
    return Hash::make('##@@pass_abd');
});
Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('blog', blogController::class);
Route::resource('notice', noticeController::class);

Route::get('/category/{slug}', [blogController::class, 'category'])->name('category');





// Super Admin
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('show.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.dashboard');
    Route::resource('slider', SliderController::class);
    Route::resource('admin-blog', AdminBlogController::class);
    Route::resource('category', AdminCategoryController::class);
    Route::resource('admin-teacher', OurTeachController::class);
    Route::resource('admin-gallary', gallaryImageController::class);
    Route::resource('chairman', chairmanController::class);
    Route::resource('admin-notice', noticeControllerAdmin::class);
    
    
    

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});