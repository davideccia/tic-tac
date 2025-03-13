<?php

namespace Davideccia\TicTac;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Davideccia\TicTac\Commands\TicTacCommand;

class TicTacServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('tic-tac')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_tic_tac_table')
            ->hasCommand(TicTacCommand::class);
    }
}
