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
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \App\Http\Middleware\UserActivity::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'checkingremark' => \App\Http\Middleware\CheckingRemark::class,
        'checkingexaminee' => \App\Http\Middleware\CheckingExaminee::class,
        'checkingaplicationfiles' => \App\Http\Middleware\CheckingAplication_files::class,
        'checkingBranch' => \App\Http\Middleware\CheckingBranch::class,
        'checkingBranchChecker' => \App\Http\Middleware\CheckingBranchChecker::class,
        'checkingUser' => \App\Http\Middleware\CheckingUser::class,
        'checkingFormRating' => \App\Http\Middleware\CheckingForm_rating::class,
        'checkingBranchHistory' => \App\Http\Middleware\CheckingBranchHistory::class,
        'checkingSession' => \App\Http\Middleware\CheckingSession::class,
        'checkingAplication_rating' => \App\Http\Middleware\CheckingAplication_rating::class,
        'checkingScore' => \App\Http\Middleware\CheckingScore::class,
        'checkingScoreUser' => \App\Http\Middleware\CheckingScoreUser::class,
        'checkingQuestion' => \App\Http\Middleware\CheckingQuestion::class,
        'checkingMedex' => \App\Http\Middleware\CheckingMedex::class,
        'checkingIelp' => \App\Http\Middleware\CheckingIelp::class,
        'checkingbranchgm' => \App\Http\Middleware\CheckingBranchGM::class,
        'checkingbranchfr' => \App\Http\Middleware\CheckingBranchFR::class,
        'checkingAplication_file' => \App\Http\Middleware\CheckingAplication_file::class,
        'checkingFormal_education' => \App\Http\Middleware\CheckingFormalEducation::class,
        'checkingCompetenceSertificate' => \App\Http\Middleware\CheckingCompetenceSertificate::class,
        'checkingLicense' => \App\Http\Middleware\CheckingLicense::class,
        'checkingLogbook' => \App\Http\Middleware\CheckingLogbook::class,
    ];
}
