<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Providers\Admin\BasicSettingsProvider;
use Pusher\PushNotifications\PushNotifications;
use App\Http\Controllers\Admin\CookieController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\AddMoneyController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\MoneyOutController;
use App\Http\Controllers\Admin\SetupKycController;
use App\Http\Controllers\Admin\UserCareController;
use App\Http\Controllers\Admin\AdminCareController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SendMoneyController;
use App\Http\Controllers\Admin\ExtensionsController;
use App\Http\Controllers\Admin\ServerInfoController;
use App\Http\Controllers\Admin\SetupEmailController;
use App\Http\Controllers\Admin\SetupPagesController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\UsefulLinkController;
use App\Http\Controllers\Admin\AppSettingsController;
use App\Http\Controllers\Admin\CryptoAssetController;
use App\Http\Controllers\Admin\MakePaymentController;
use App\Http\Controllers\Admin\TrxSettingsController;
use App\Http\Controllers\Admin\WebSettingsController;
use App\Http\Controllers\Admin\BroadcastingController;
use App\Http\Controllers\Admin\RequestMoneyController;
use App\Http\Controllers\Admin\ExchangeMoneyController;
use App\Http\Controllers\Admin\SupportTicketController;
use App\Http\Controllers\Admin\SetupSectionsController; 
use App\Http\Controllers\Admin\ContactMessageController; 
use App\Http\Controllers\Admin\PaymentGatewaysController;
use App\Http\Controllers\Frontend\AnnouncementController;
use App\Http\Controllers\Admin\PushNotificationController;
use App\Http\Controllers\Admin\AppOnboardScreensController;
use App\Http\Controllers\Admin\MerchantConfigurationController;
use App\Http\Controllers\Admin\PaymentGatewayCurrencyController;

// All Admin Route Is Here
Route::prefix('admin')->name('admin.')->group(function () { 
    // Dashboard Section
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::post('logout', 'logout')->name('logout');
        Route::post('notifications/clear','notificationsClear')->name('notifications.clear');
    }); 
    // Admin Profile
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('change-password', 'changePassword')->name('change.password');
        Route::put('change-password', 'updatePassword')->name('change.password.update');
        Route::put('update', 'update')->name('update');
    }); 
    // Setup Currency Section
    Route::controller(CurrencyController::class)->prefix('currency')->name('currency.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::put('status/update', 'statusUpdate')->name('status.update');
        Route::put('update', 'update')->name('update');
        Route::delete('delete','delete')->name('delete');
        Route::post('search','search')->name("search");
    }); 
    // Fees & Charges Section
    Route::controller(TrxSettingsController::class)->prefix('trx-settings')->name('trx.settings.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::put('charges/update', 'trxChargeUpdate')->name('charges.update');
    }); 
    // Add Money Logs
    Route::controller(AddMoneyController::class)->prefix('add-money')->name('add.money.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('pending', 'pending')->name('pending');
        Route::get('complete', 'complete')->name('complete');
        Route::get('canceled', 'canceled')->name('canceled');
        Route::get('details/{id}', 'addMoneyDetails')->name('details');
        Route::put('approved', 'approved')->name('approved');
        Route::put('rejected', 'rejected')->name('rejected');
        Route::post('search','search')->name("search");
    }); 
    // Money Out Logs
    Route::controller(MoneyOutController::class)->prefix('withdraw-money')->name('money.out.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('pending', 'pending')->name('pending');
        Route::get('complete', 'complete')->name('complete');
        Route::get('canceled', 'canceled')->name('canceled');
        Route::get('details/{id}', 'moneyOutDetails')->name('details');
        Route::put('approved', 'approved')->name('approved');
        Route::put('rejected', 'rejected')->name('rejected');
        Route::post('search','search')->name("search");
    });
    // Make Payment Logs
    Route::controller(MakePaymentController::class)->prefix('make-payment')->name('make.payment.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('details/{trx_id}','details')->name('details');
    });
    // Send Money Logs
    Route::controller(SendMoneyController::class)->prefix('send-money')->name('send.money.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('details/{id}', 'sendMoneyDetails')->name('details');
        Route::post('search','search')->name("search");
    });
    // exchange Money Logs
    Route::controller(ExchangeMoneyController::class)->prefix('exchange-money')->name('exchange.money.')->group(function () {
        Route::get('index', 'index')->name('index'); 
        Route::get('details/{id}', 'exchangeMoneyDetails')->name('details');
        Route::post('search','search')->name("search");
    });
    // Request Money Logs
    Route::controller(RequestMoneyController::class)->prefix('request-money')->name('request.money.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('pending', 'pending')->name('pending');
        Route::get('complete', 'complete')->name('complete');
        Route::get('canceled', 'canceled')->name('canceled');
        Route::get('details/{id}', 'requestMoneyDetails')->name('details');
        Route::post('search','search')->name("search");
    });
    // Voucher Logs
    Route::controller(VoucherController::class)->prefix('voucher-money')->name('voucher.money.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('pending', 'pending')->name('pending');
        Route::get('complete', 'complete')->name('complete');
        Route::get('canceled', 'canceled')->name('canceled');
        Route::get('details/{id}', 'VoucherDetails')->name('details');
        Route::post('search','search')->name("search");
    });
    // User Care Section
    Route::controller(UserCareController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('active', 'active')->name('active');
        Route::get('banned', 'banned')->name('banned');
        Route::get('email/unverified', 'emailUnverified')->name('email.unverified');
        Route::get('sms/unverified', 'SmsUnverified')->name('sms.unverified');
        Route::get('kyc/unverified', 'KycUnverified')->name('kyc.unverified');
        Route::get('kyc/details/{username}', 'kycDetails')->name('kyc.details');
        Route::get('email-user', 'emailAllUsers')->name('email.users');
        Route::post('email-users/send', 'sendMailUsers')->name('email.users.send')->middleware("mail");
        Route::get('details/{username}', 'userDetails')->name('details');
        Route::post('details/update/{username}', 'userDetailsUpdate')->name('details.update');
        Route::get('login/logs/{username}', 'loginLogs')->name('login.logs');
        Route::get('mail/logs/{username}', 'mailLogs')->name('mail.logs');
        Route::post('send/mail/{username}', 'sendMail')->name('send.mail')->middleware("mail");
        Route::post('login-as-member/{username?}','loginAsMember')->name('login.as.member');
        Route::post('kyc/approve/{username}','kycApprove')->name('kyc.approve');
        Route::post('kyc/reject/{username}','kycReject')->name('kyc.reject');
        Route::post('search','search')->name('search');
        Route::post('wallet/balance/update/{username}','walletBalanceUpdate')->name('wallet.balance.update');
    }); 
    // Merchant Configuration (Developer API)
    Route::controller(MerchantConfigurationController::class)->prefix('merchant/configuration')->name('merchant.config.')->group(function(){
        Route::get('index','index')->name('index');
        Route::post('update','update')->name('update');
    });
    // Admin Care Section
    Route::controller(AdminCareController::class)->prefix('admins')->name('admins.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('email-admin', 'emailAllAdmins')->name('email.admins');
        Route::delete('admin/delete','deleteAdmin')->name('admin.delete')->middleware('admin.delete.guard');
        Route::post('send/email','sendEmail')->name('send.email')->middleware("mail");
        Route::post('admin/search','adminSearch')->name('search');

        Route::post("store","store")->name("admin.store");
        Route::put("update","update")->name("admin.update");
        Route::put('status/update','statusUpdate')->name('admin.status.update');

        Route::get('role/index','roleIndex')->name('role.index');
        Route::post('role/store','roleStore')->name('role.store');
        Route::put('role/update','roleUpdate')->name('role.update');
        Route::delete('role/remove','roleRemove')->name('role.delete')->middleware('admin.role.delete.guard');

        Route::get('role/permission/index','rolePermissionIndex')->name('role.permission.index');
        Route::post('role/permission/store','rolePermissionStore')->name('role.permission.store');
        Route::put('role/permission/update','rolePermissionUpdate')->name('role.permission.update');
        Route::delete('role/permission/delete','rolePermissionDelete')->name('role.permission.dalete');
        Route::delete('role/permission/assign/delete/{slug}','rolePermissionAssignDelete')->name('role.permission.assign.delete');

        Route::get('role/permission/{slug}','viewRolePermission')->name('role.permission');
        Route::post('role/permission/assign/{slug}','rolePermissionAssign')->name('role.permission.assign');
    }); 
    // Web Settings Section
    Route::controller(WebSettingsController::class)->prefix('web-settings')->name('web.settings.')->group(function(){
        Route::get('basic-settings','basicSettings')->name('basic.settings');
        Route::put('basic-settings/update','basicSettingsUpdate')->name('basic.settings.update');
        Route::put('basic-settings/activation/update','basicSettingsActivationUpdate')->name('basic.settings.activation.update');
        Route::get('image-assets','imageAssets')->name('image.assets');
        Route::put('image-assets/update','imageAssetsUpdate')->name('image.assets.update');
        Route::get('setup-seo','setupSeo')->name('setup.seo');
        Route::put('setup-seo/update','setupSeoUpdate')->name('setup.seo.update');
    }); 
    // App Settings Section
    Route::prefix('app-settings')->name('app.settings.')->group(function () {
        Route::controller(AppSettingsController::class)->group(function () {
            Route::get('splash-screen', 'splashScreen')->name('splash.screen');
            Route::put('splash-screen/update', 'splashScreenUpdate')->name('splash.screen.update');
            Route::get('urls', 'urls')->name('urls');
            Route::put('urls/update', 'urlsUpdate')->name('urls.update');
        }); 
        Route::controller(AppOnboardScreensController::class)->name('onboard.')->group(function () {
            Route::get('onboard-screens', 'onboardScreens')->name('screens');
            Route::post('onboard-screens/store', 'onboardScreenStore')->name('screen.store');
            Route::put('onboard-screen/update', 'onboardScreenUpdate')->name('screen.update');
            Route::put('onboard-screen/status/update', 'onboardScreenStatusUpdate')->name('screen.status.update');
            Route::delete('onboard-screen/delete','onboardScreenDelete')->name('screen.delete');
        });
    }); 
    // Language Section
    Route::controller(LanguageController::class)->prefix('languages')->name('languages.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store','store')->name('store');
        Route::put('update','update')->name('update');
        Route::put('status/update','statusUpdate')->name('status.update');
        Route::get('info/{code}','info')->name('info');
        Route::post('import','import')->name('import');
        Route::delete('delete','delete')->name('delete');
        Route::post('switch','switch')->name('switch');
        Route::get('download','download')->name('download');
    }); 
    // Setup Email Section
    Route::controller(SetupEmailController::class)->prefix('setup-email')->name('setup.email.')->group(function () {
        Route::get('config', 'configuration')->name('config');
        Route::put('config/update', 'update')->name('config.update');
        Route::post('test-mail/send','sendTestMail')->name('test.mail.send')->middleware('mail');
    }); 
    // Setup KYC Section
    Route::controller(SetupKycController::class)->prefix('setup-kyc')->name('setup.kyc.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('edit/{slug}', 'edit')->name('edit');
        Route::put('update/{slug}', 'update')->name('update');
        Route::put('status/update', 'statusUpdate')->name('status.update');
    }); 
    // Setup Section
    Route::controller(SetupSectionsController::class)->prefix('setup-sections')->name('setup.sections.')->group(function () {
        Route::get('{slug}', 'sectionView')->name('section');
        Route::post('update/{slug}','sectionUpdate')->name('section.update');
        Route::post('item/store/{slug}','sectionItemStore')->name('section.item.store');
        Route::post('item/update/{slug}','sectionItemUpdate')->name('section.item.update');
        Route::delete('item/delete/{slug}','sectionItemDelete')->name('section.item.delete'); 
        // Announcement Section
        Route::controller(AnnouncementController::class)->prefix("announcement")->name('announcement.')->group(function(){
            Route::get('categories','categoryIndex')->name('category.index');
            Route::post('category/store','categoryStore')->name('category.store');
            Route::post('category/update','categoryUpdate')->name('category.update');
            Route::delete('category/delete','categoryDelete')->name('category.delete');
            Route::put('category/status/update','categoryStatusUpdate')->name('category.status.update');

            Route::get('index','announcementIndex')->name('index');
            Route::get('create','announcementCreate')->name('create');
            Route::post('store','announcementStore')->name('store');
            Route::put('status/update','announcementStatusUpdate')->name('status.update');
            Route::delete('delete','announcementDelete')->name('delete');
            Route::get('edit/{id}','announcementEdit')->name('edit');
            Route::post('update/{id}','announcementUpdate')->name('update');
        });
    }); 
    // Setup Pages Controller
    Route::controller(SetupPagesController::class)->prefix('setup-pages')->name('setup.pages.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::put('status/update','statusUpdate')->name('status.update');
    }); 
    // Extensions Section
    Route::controller(ExtensionsController::class)->prefix('extensions')->name('extensions.')->group(function () {
        Route::get('index', 'index')->name('index');
    }); 
    // Useful Links
    Route::controller(UsefulLinkController::class)->prefix('useful-links')->name('useful.links.')->group(function(){
        Route::get("index","index")->name("index");
        Route::post("store","store")->name("store");
        Route::put("status/update","statusUpdate")->name("status.update");
        Route::get("edit/{slug}","edit")->name("edit");
        Route::post("update/{slug}","update")->name("update");
        Route::delete("delete","delete")->name("delete");
    }); 
    // Payment Method Section
    Route::prefix('payment-gateways')->name('payment.gateway.')->group(function () {
        Route::controller(PaymentGatewaysController::class)->group(function () {
            Route::get('{slug}/{type}/create', 'paymentGatewayCreate')->name('create')->whereIn('type', ['automatic', 'manual']);
            Route::post('{slug}/{type}', 'paymentGatewayStore')->name('store')->whereIn('type', ['automatic', 'manual']);
            Route::get('{slug}/{type}', 'paymentGatewayView')->name('view')->whereIn('type', ['automatic', 'manual']); // View Gateway Index Page
            Route::get('{slug}/{type}/{alias}', 'paymentGatewayEdit')->name('edit')->whereIn('type', ['automatic', 'manual']);
            Route::put('{slug}/{type}/{alias}', 'paymentGatewayUpdate')->name('update')->whereIn('type', ['automatic', 'manual']);
            Route::put('status/update', 'paymentGatewayStatusUpdate')->name('status.update');
            Route::delete('remove', 'remove')->name('remove');
        });

        Route::controller(PaymentGatewayCurrencyController::class)->group(function () {
            Route::delete('currency/remove', 'paymentGatewayCurrencyRemove')->name('currency.remove');
        });
    }); 
    // Push Notification Setup Section
    Route::controller(PushNotificationController::class)->prefix('push-notification')->name('push.notification.')->group(function(){
        Route::get('config','configuration')->name('config');
        Route::put('update','update')->name('update');

        Route::get('/','index')->name('index');
        Route::post('send','send')->name('send');
    }); 
    // Broadcasting Setup Section
    Route::controller(BroadcastingController::class)->prefix('broadcast')->name('broadcast.')->group(function(){
        Route::put("config/update","configUpdate")->name('config.update');
    }); 
    //  GDPR Cookie Section
    Route::controller(CookieController::class)->prefix('cookie')->name('cookie.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::put('update', 'update')->name('update');
    }); 
    // Server Info Section
    Route::controller(ServerInfoController::class)->prefix('server-info')->name('server.info.')->group(function () {
        Route::get('index', 'index')->name('index');
    }); 
    // Support Ticked Section
    Route::controller(SupportTicketController::class)->prefix('support-ticket')->name('support.ticket.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('active', 'active')->name('active');
        Route::get('pending', 'pending')->name('pending');
        Route::get('solved', 'solved')->name('solved');
        Route::get('conversation/{ticket_id}', 'conversation')->name('conversation');
        Route::post('message/reply','messageReply')->name('messaage.reply');
        Route::post('solve','solve')->name('solve');
    }); 
    // Extension Section
    Route::controller(ExtensionsController::class)->prefix('extension')->name('extension.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('update/{id}', 'update')->name('update');
        Route::put('status/update', 'statusUpdate')->name('status.update');
    }); 
    // Cache Clear Section
    Route::get('cache/clear', function () {
        Artisan::all('cache:clear');
        Artisan::all('route:clear');
        Artisan::all('view:clear');
        Artisan::all('config:clear');
        return redirect()->back()->with(['success' => ['Cache Clear Successfully!']]);
    })->name('cache.clear'); 
    Route::controller(SubscriberController::class)->prefix("subscriber")->name("subscriber.")->group(function(){
        Route::get('index','index')->name('index');
        Route::post('send/mail','sendMail')->name('send.mail');
    }); 
    Route::controller(ContactMessageController::class)->prefix('contact/message')->name('contact.messages.')->group(function(){
        Route::get('index','index')->name('index');
        Route::post('reply','reply')->name('reply');
        Route::delete('delete','delete')->name('delete');
    }); 
    Route::controller(CryptoAssetController::class)->prefix('crypto/assets')->name('crypto.assets.')->group(function() {
        Route::get('gateway/{alias}','gatewayAssets')->name('gateway.index');
        Route::get('gateway/{alias}/generate/wallet','generateWallet')->name('generate.wallet');

        Route::get('wallet/balance/update/{crypto_asset_id}/{wallet_id}','walletBalanceUpdate')->name('wallet.balance.update');
        Route::post('wallet/store','walletStore')->name("wallet.store");
        Route::delete('wallet/delete','walletDelete')->name('wallet.delete');
        Route::put('wallet/status/update','walletStatusUpdate')->name('wallet.status.update');
        Route::get('wallet/transactions/{crypto_asset_id}/{wallet_id}','walletTransactions')->name('wallet.transactions');
        Route::post('wallet/transactions/search/{crypto_asset_id}/{wallet_id}','walletTransactionSearch')->name('wallet.transaction.search');
    });
});

Route::get('pusher/beams-auth', function (Request $request) {
    if(Auth::check() == false) {
        return response(['Inconsistent request'], 401);
    }
    $userID = Auth::user()->id;

    $basic_settings = BasicSettingsProvider::get();
    if(!$basic_settings) {
        return response('Basic setting not found!', 404);
    }

    $notification_config = $basic_settings->push_notification_config;

    if(!$notification_config) {
        return response('Notification configuration not found!', 404);
    }

    $instance_id    = $notification_config->instance_id ?? null;
    $primary_key    = $notification_config->primary_key ?? null;
    if($instance_id == null || $primary_key == null) {
        return response('Sorry! You have to configure first to send push notification.', 404);
    }
    $beamsClient = new PushNotifications(
        array(
            "instanceId" => $notification_config->instance_id,
            "secretKey" => $notification_config->primary_key,
        )
    );
    $publisherUserId = "admin-".$userID;
    try{
        $beamsToken = $beamsClient->generateToken($publisherUserId);
    }catch(Exception $e) {
        return response(['Server Error. Faild to generate beams token.'], 500);
    }

    return response()->json($beamsToken);
})->name('pusher.beams.auth');