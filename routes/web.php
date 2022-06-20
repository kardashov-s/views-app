<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'OK';
});

Route::group(['prefix' => 'google-ads-scripts'], function () {
    Route::get('update-balance', [App\Http\Controllers\GoogleAdsScriptsController::class, 'updateBalance']);
    Route::get('create-campaigns', [App\Http\Controllers\GoogleAdsScriptsController::class, 'createCampaigns']);
    Route::get('create-ad-groups', [App\Http\Controllers\GoogleAdsScriptsController::class, 'createAdGroups']);
    Route::get('create-in-stream-ads', [
        App\Http\Controllers\GoogleAdsScriptsController::class,
        'createInStreamAds',
    ]);
    Route::get('confirm-campaigns-create', [
        App\Http\Controllers\GoogleAdsScriptsController::class,
        'confirmCampaignsCreate',
    ]);
    Route::get('get-report', [App\Http\Controllers\GoogleAdsScriptsController::class, 'getReport']);
    Route::get('get-policy-approval-status', [
        App\Http\Controllers\GoogleAdsScriptsController::class,
        'getPolicyApprovalStatus',
    ]);
    Route::get('execute', [App\Http\Controllers\GoogleAdsScriptsController::class, 'execute']);
    Route::get('get-ad-group-statistic', [
        App\Http\Controllers\GoogleAdsScriptsController::class,
        'getAdGroupStatistic',
    ]);
    Route::get('dispatcher', [App\Http\Controllers\GoogleAdsScriptsController::class, 'dispatcher']);
    Route::get('update-script-success-executed-at', [
        App\Http\Controllers\GoogleAdsScriptsController::class,
        'updateScriptSuccessExecutedAt',
    ]);
});

Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'orders'], function () {
        Route::get('', [App\Http\Controllers\Admin\OrdersController::class, 'index'])->name('orders.index');
        Route::get('{order}', [App\Http\Controllers\Admin\OrdersController::class, 'show'])->name('orders.show');
        Route::post('{order}/cancel', [App\Http\Controllers\Admin\OrdersController::class, 'cancel'])
            ->name('orders.cancel');
        Route::post('{order}/cancel-and-ban', [App\Http\Controllers\Admin\OrdersController::class, 'cancelAndBan'])
            ->name('orders.cancel-and-ban');
        Route::post('bulk-cancel', [App\Http\Controllers\Admin\OrdersController::class, 'bulkCancel'])
            ->name('orders.bulk-cancel');
        Route::post('{order}/speed-up', [App\Http\Controllers\Admin\OrdersController::class, 'speedUp'])
            ->name('orders.speed-up');
        Route::post('bulk-speed-up', [App\Http\Controllers\Admin\OrdersController::class, 'bulkSpeedUp'])
            ->name('orders.bulk-speed-up');
        Route::post('{order}/transfer', [App\Http\Controllers\Admin\OrdersController::class, 'transfer'])
            ->name('orders.transfer');
        Route::post('bulk-transfer', [App\Http\Controllers\Admin\OrdersController::class, 'bulkTransfer'])
            ->name('orders.bulk-transfer');
    });
    Route::group(['prefix' => 'services'], function () {
        Route::get('', [App\Http\Controllers\Admin\ServicesController::class, 'index'])->name('services.index');
        Route::get('{service}/edit', [App\Http\Controllers\Admin\ServicesController::class, 'edit'])
            ->name('services.edit');
        Route::put('{service}', [App\Http\Controllers\Admin\ServicesController::class, 'update'])
            ->name('services.update');
    });
    Route::resource('labels', App\Http\Controllers\Admin\LabelsController::class)
        ->except(['show', 'destroy']);
    Route::group(['prefix' => 'labels'], function () {
        Route::post(
            '{order}/assign-labels',
            [App\Http\Controllers\Admin\LabelsController::class, 'assignLabels']
        )->name('orders.assign-labels');
    });
    Route::group(['prefix' => 'settings'], function () {
        Route::get('', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
        Route::put('', [App\Http\Controllers\Admin\SettingsController::class, 'put'])->name('settings');
    });
    Route::group(['prefix' => 'google-ads'], function () {
        Route::group(['prefix' => 'google-ads-accounts'], function () {
            Route::get('', [App\Http\Controllers\Admin\GoogleAdsAccountsController::class, 'index'])
                ->name('google-ads.google-ads-accounts.index');
            Route::get('{googleAdsAccount}', [
                App\Http\Controllers\Admin\GoogleAdsAccountsController::class,
                'show',
            ])->name('google-ads.google-ads-accounts.show');
            Route::get('{googleAdsAccount}/graphic', [
                App\Http\Controllers\Admin\GoogleAdsAccountsController::class,
                'graphic',
            ])->name('google-ads.google-ads-accounts.graphic');
            Route::post('{googleAdsAccount}/update', [
                App\Http\Controllers\Admin\GoogleAdsAccountsController::class,
                'update',
            ])->name('google-ads.google-ads-accounts.update');
            Route::post('{googleAdsAccount}/suspend', [
                App\Http\Controllers\Admin\GoogleAdsAccountsController::class,
                'suspend',
            ])->name('google-ads.google-ads-accounts.suspend');
        });
    });
    Route::resource('blacklist-keywords', App\Http\Controllers\Admin\BlacklistKeywordsController::class)
        ->except(['show', 'destroy']);
});
