<?php

use App\Models\User;
use Wezlo\FilamentApproval\ApproverResolvers\CallbackResolver;
use Wezlo\FilamentApproval\ApproverResolvers\RoleResolver;
use Wezlo\FilamentApproval\ApproverResolvers\UserResolver;

return [

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    */
    'user_model' => User::class,

    /*
    |--------------------------------------------------------------------------
    | Approver Resolvers
    |--------------------------------------------------------------------------
    | Registered resolver classes available in the flow builder UI.
    */
    'approver_resolvers' => [
        UserResolver::class,
        RoleResolver::class,
        CallbackResolver::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Scope Approvers to Company
    |--------------------------------------------------------------------------
    | When true, role-based resolvers will scope to the approvable's company_id.
    */
    'scope_approvers_to_company' => true,

    /*
    |--------------------------------------------------------------------------
    | SLA Warning Threshold
    |--------------------------------------------------------------------------
    | Fraction of SLA time elapsed before sending a warning (0.75 = 75%).
    */
    'sla_warning_threshold' => 0.75,

    /*
    |--------------------------------------------------------------------------
    | Auto-register SLA Command Schedule
    |--------------------------------------------------------------------------
    | When true, the package registers `approval:process-sla` to run every minute.
    */
    'schedule_sla_command' => true,

    /*
    |--------------------------------------------------------------------------
    | Navigation Group
    |--------------------------------------------------------------------------
    */
    'navigation_group' => 'Approvals',

    /*
    |--------------------------------------------------------------------------
    | Database Table Prefix
    |--------------------------------------------------------------------------
    | Prefix for all package tables.
    */
    'table_prefix' => '',

];
