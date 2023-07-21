<?php

namespace Samehdoush\Subscriptions;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Samehdoush\Subscriptions\Commands\SubscriptionsCommand;

class SubscriptionsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('subscriptions')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_subscriptions_table')
            ->hasCommand(SubscriptionsCommand::class);
    }
}
