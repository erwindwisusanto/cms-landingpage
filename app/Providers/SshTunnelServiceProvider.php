<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use phpseclib3\Net\SSH2;

class SshTunnelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
