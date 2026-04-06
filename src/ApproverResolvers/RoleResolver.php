<?php

namespace Wezlo\FilamentApproval\ApproverResolvers;

use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Wezlo\FilamentApproval\Contracts\ApproverResolver;
use Wezlo\FilamentApproval\FilamentApprovalPlugin;

class RoleResolver implements ApproverResolver
{
    public function resolve(array $config, Model $approvable): array
    {
        $userModel = FilamentApprovalPlugin::resolveUserModel();
        $roleName = $config['role'] ?? null;

        if (! $roleName) {
            return [];
        }

        $query = $userModel::role($roleName);

        if (isset($approvable->company_id) && config('filament-approval.scope_approvers_to_company', true)) {
            $query->where('company_id', $approvable->company_id);
        }

        return $query->pluck('id')->all();
    }

    public static function label(): string
    {
        return __('filament-approval::approval.resolvers.role');
    }

    public static function configSchema(): array
    {
        return [
            Select::make('approver_config.role')
                ->label(__('filament-approval::approval.resolver_config.role'))
                ->searchable()
                ->options(fn () => Role::pluck('name', 'name'))
                ->required(),
        ];
    }
}
