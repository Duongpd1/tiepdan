<?php

namespace App\Http;

use App\Http\Middleware\checkChuyenVien;
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
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
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
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//            \App\Http\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'throttle:60,1',
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
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'checkChuyenVien' => \App\Http\Middleware\checkChuyenVien::class,
        'Permission2TabCongThongTin' => \App\Http\Middleware\Permission2TabCongThongTin::class,
        'Permission2TabTrangChu' => \App\Http\Middleware\Permission2TabTrangChu::class,
        'check_tabHeThong' => \App\Http\Middleware\check_tabHeThong::class,
        'check_tabBaoCao' => \App\Http\Middleware\check_tabBaoCao::class,
        'check_TabTiepDan' => \App\Http\Middleware\check_TabTiepDan::class,
        'Permission2TabNghiepVu' => \App\Http\Middleware\Permission2TabNghiepVu::class,
    ];
}
