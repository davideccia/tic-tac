<?php

namespace Davideccia\TicTac;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TicTacServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('tic-tac')
            ->hasConfigFile()
            ->hasMigration('create_tic_tac_expirations_table');
    }
}
