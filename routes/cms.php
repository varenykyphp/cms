<?php


use App\Http\Kernel;
use Illuminate\Support\Facades\Route;

use Varenyky\Http\Controllers\DashboardController;
use Varenyky\Http\Controllers\AuthenticationController;
use Varenyky\Http\Controllers\FrontendController;
use Varenyky\Http\Controllers\MenuController;
use Varenyky\Http\Controllers\PageController;
use Varenyky\Http\Controllers\MenuItemsController;
use Varenyky\Http\Controllers\SettingController;
use Varenyky\Http\Middleware\Authenticate;

Route::prefix(config('varenyky.path'))->name('admin.')->middleware(resolve(Kernel::class)->getMiddlewareGroups()['web'])->group(function () {
    Route::group(['middleware' => [Authenticate::class]], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('pages/get-blocks', [PageController::class, 'getBlocks']);
        Route::resource('/pages', PageController::class);
        Route::resource('/menus', MenuController::class);
        Route::resource('/menu/{id}/items', MenuItemsController::class);
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings/update', [SettingController::class, 'update'])->name('settings.update');
    });

    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthenticationController::class, 'authenticate'])->name('authenticate');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::middleware(resolve(Kernel::class)->getMiddlewareGroups()['web'])->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('varenyky.home');
    Route::get('/{slug}', [FrontendController::class, 'show'])->name('varenyky.page');
});
