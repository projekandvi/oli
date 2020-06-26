<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\SalesManager;
use App\MasterSewa;
use App\SlipOrder;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $sm =  SalesManager::orderBy('nama_manajer', 'asc')->pluck('nama_manajer', 'id');
        $biaya_sewa = MasterSewa::first();

        $bulannya = (Carbon::now()->addMonth()->format('m')) - 1;
        $tahunnya = Carbon::now()->format('Y');
        $reminderTempoMaintenance = SlipOrder::whereMonth('tempo_maintenance', $bulannya)->whereYear('tempo_maintenance', $tahunnya)->take(5)->get();
        $reminder5thnRecurring = SlipOrder::whereMonth('tempo_maintenance', $bulannya)->whereYear('tempo_maintenance', $tahunnya)->take(5)->get();

        // Sharing is caring
        
        View::share('sm', $sm);
        View::share('biaya_sewa', $biaya_sewa);
        View::share('reminderTempoMaintenance', $reminderTempoMaintenance);
        Schema::defaultStringLength(191);
    }
}
