<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\Admin\Localization::class,
            \App\Http\Middleware\ForceScheme::class,
            \App\Http\Middleware\URLBlocker::class,
            \App\Http\Middleware\StartingPoint::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\Api\V1\HandleLocalization::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'personalAccountType' => \App\Http\Middleware\PersonalAccountTypeMiddleware::class,
        'businessAccountType' => \App\Http\Middleware\BusinessAccountTypeMiddleware::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'app.mode'  => \App\Http\Middleware\Admin\AppModeGuard::class,
        'admin.login.guard' => \App\Http\Middleware\Admin\LoginGuard::class,
        'admin.role.guard'  => \App\Http\Middleware\Admin\RoleGuard::class,
        'mail'              => \App\Http\Middleware\Admin\MailGuard::class,
        'admin.delete.guard'    => \App\Http\Middleware\Admin\AdminDeleteGuard::class,
        'admin.role.delete.guard'   => \App\Http\Middleware\Admin\RoleDeleteGuard::class,
        'verification.guard'  => \App\Http\Middleware\VerificationGuard::class,
        'user.google.two.factor'    => \App\Http\Middleware\User\GoogleTwoFactor::class,
        'merchant.google.two.factor'    => \App\Http\Middleware\Merchant\GoogleTwoFactor::class,
        'kyc.verification.guard'        => \App\Http\Middleware\KycVerificationGuard::class,

        // Api middleware
        'kyc.verification.api'        => \App\Http\Middleware\KycApi::class,
        'api.user.auth.guard'           => \App\Http\Middleware\Api\V1\User\AuthGuard::class,
    ];
}
