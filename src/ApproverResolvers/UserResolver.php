<?php

namespace Wezlo\FilamentApproval\ApproverResolvers;

use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Wezlo\FilamentApproval\Contracts\ApproverResolver;
use Wezlo\FilamentApproval\FilamentApprovalPlugin;

class UserResolver implements ApproverResolver
{
    public function resolve(array $config, Model $approvable): array
    {
        return $config['user_ids'] ?? [];
    }

    public static function label(): string
    {
        return __('filament-approval::approval.resolvers.user');
    }

    public static function configSchema(): array
    {
        $userModel = FilamentApprovalPlugin::resolveUserModel();

        return [
            Select::make('approver_config.user_ids')
                ->label(__('filament-approval::approval.resolver_config.users'))
                ->multiple()
                ->searchable()
                ->options(fn () => $userModel::pluck('name', 'id'))
                ->required(),
        ];
    }
}
