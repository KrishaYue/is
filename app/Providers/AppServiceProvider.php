<?php

namespace ICTDUInventory\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use ICTDUInventory\Borrower;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $penalty = Borrower::whereDate('deadline', '<', date("Y-m-d") );
        $penalty_num = $penalty->count();
        view()->share('penalty_num', $penalty_num);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
