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
        $ssh = new SSH2('34.101.68.40', 2222);
        $username = 'root';
        $password = 'n0g3mb0k.';

        if (!$ssh->login($username, $password)) {
            throw new \Exception('SSH login failed');
        }

        $ssh->exec('autossh -M 0 -f -N -L 1836:localhost:1626');

        if (!$ssh->isConnected()) {
            throw new \Exception('SSH tunnel setup failed');
        }
    }
}
