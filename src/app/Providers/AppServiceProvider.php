<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Events\QueryExecuted;
use App\Listeners\QueryListener;
use Illuminate\Support\Facades\Response;


use App\Contracts\Admin\IAdminRepository;
use App\Contracts\Admin\IAdminService;
use App\Contracts\User\IUserRepository;
use App\Contracts\User\IUserService;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\User\UserRepository;
use App\Services\CustomPaginate;
use App\Services\Admin\AdminService;
use App\Services\User\UserService;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Repository
        $this->app->bind(IAdminRepository::class, AdminRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);

        //Service
        $this->app->bind(IAdminService::class, AdminService::class);
        $this->app->bind(IUserService::class, UserService::class);

        //Page
        $this->app->bind(LengthAwarePaginator::class, CustomPaginate::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the query executed listener
        Event::listen(
            QueryExecuted::class,
            QueryListener::class
        );

        Response::macro('api', function ($data = null, $status = 200, $headers = [], $options = 0) {
            $responseData = [
                'success' => true,
                'data' => $data,
            ];

            return response()->json($responseData, $status, $headers, $options);
        });
    }
}
