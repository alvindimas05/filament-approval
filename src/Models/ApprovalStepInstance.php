<?php

namespace Wezlo\FilamentApproval\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Wezlo\FilamentApproval\Enums\ActionType;
use Wezlo\FilamentApproval\Enums\StepInstanceStatus;
use Wezlo\FilamentApproval\Enums\StepType;

class ApprovalStepInstance extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => StepType::class,
            'status' => StepInstanceStatus::class,
            'assigned_approver_ids' => 'array',
            'activated_at' => 'datetime',
            'sla_deadline' => 'datetime',
            'completed_at' => 'datetime',
            'sla_warning_sent' => 'boolean',
            'sla_breached' => 'boolean',
            'metadata' => 'array',
        ];
    }

    public function approval(): BelongsTo
    {
        return $this->belongsTo(Approval::class);
    }

    public function step(): BelongsTo
    {
        return $this->belongsTo(ApprovalStep::class, 'approval_step_id');
    }

    public function actions(): HasMany
    {
        return $this->hasMany(ApprovalAction::class);
    }

    public function delegations(): HasMany
    {
        return $this->hasMany(ApprovalDelegation::class);
    }

    public function canUserAct(int $userId): bool
    {
        if (in_array($userId, $this->assigned_approver_ids)) {
            return true;
        }

        return $this->delegations()
            ->where('to_user_id', $userId)
            ->exists();
    }

    public function hasUserActed(int $userId): bool
    {
        return $this->actions()
            ->where('user_id', $userId)
            ->whereIn('type', [ActionType::Approved, ActionType::Rejected])
            ->exists();
    }
}
