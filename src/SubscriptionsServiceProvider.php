<?php

namespace Samehdoush\Subscriptions;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Samehdoush\Subscriptions\Commands\SubscriptionsCommand;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

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
            // ->hasViews()
            ->hasMigrations(['2023_07_21_000001_create_plans_table', '2023_07_21_000002_create_plan_features_table', '2023_07_21_000003_create_plan_subscriptions_table', '2023_07_21_000004_create_plan_subscription_usage'])
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->startWith(function (InstallCommand $command) {
                        $command->info('Hello, and welcome to my great new package!');
                    })
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    // ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('samehdoush/subscriptions')
                    ->endWith(function (InstallCommand $command) {
                        $command->info('Have a great day!');
                    });
            });
        // ->hasCommand(SubscriptionsCommand::class);
    }
}
