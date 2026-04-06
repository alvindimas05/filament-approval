<?php

namespace Wezlo\FilamentApproval;

use Illuminate\Console\Scheduling\Schedule;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Wezlo\FilamentApproval\Commands\ProcessApprovalSlaCommand;
use Wezlo\FilamentApproval\Services\ApprovalEngine;

class FilamentApprovalServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-approval';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations([
                'create_approval_flows_table',
                'create_approval_steps_table',
                'create_approvals_table',
                'create_approval_step_instances_table',
                'create_approval_actions_table',
                'create_approval_delegations_table',
            ])
            ->hasTranslations()
            ->hasCommand(ProcessApprovalSlaCommand::class);
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(ApprovalEngine::class);
    }

    public function packageBooted(): void
    {
        if (config('filament-approval.schedule_sla_command', true)) {
            $this->app->booted(function () {
                $schedule = $this->app->make(Schedule::class);
                $schedule->command('approval:process-sla')
                    ->everyMinute()
                    ->withoutOverlapping();
            });
        }
    }
}
