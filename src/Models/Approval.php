<?php

namespace Wezlo\FilamentApproval\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Wezlo\FilamentApproval\Enums\ApprovalStatus;
use Wezlo\FilamentApproval\Enums\StepInstanceStatus;
use Wezlo\FilamentApproval\FilamentApprovalPlugin;

class Approval extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => ApprovalStatus::class,
            'submitted_at' => 'datetime',
            'completed_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function approvable(): MorphTo
    {
        return $this->morphTo();
    }

    public function flow(): BelongsTo
    {
        return $this->belongsTo(ApprovalFlow::class, 'approval_flow_id');
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(FilamentApprovalPlugin::resolveUserModel(), 'submitted_by');
    }

    public function stepInstances(): HasMany
    {
        return $this->hasMany(ApprovalStepInstance::class)->orderBy('order');
    }

    public function actions(): HasMany
    {
        return $this->hasMany(ApprovalAction::class)->orderByDesc('created_at');
    }

    public function currentStepInstance(): ?ApprovalStepInstance
    {
        return $this->stepInstances()
            ->where('status', StepInstanceStatus::Waiting)
            ->first();
    }

    public function isPending(): bool
    {
        return $this->status === ApprovalStatus::Pending;
    }
}
