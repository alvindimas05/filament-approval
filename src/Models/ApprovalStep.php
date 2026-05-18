<?php

namespace Wezlo\FilamentApproval\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Wezlo\FilamentApproval\Enums\EscalationAction;
use Wezlo\FilamentApproval\Enums\StepType;

class ApprovalStep extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => StepType::class,
            'approver_config' => 'array',
            'escalation_action' => EscalationAction::class,
            'escalation_config' => 'array',
            'metadata' => 'array',
        ];
    }

    public function flow(): BelongsTo
    {
        return $this->belongsTo(ApprovalFlow::class, 'approval_flow_id');
    }

    public function instances(): HasMany
    {
        return $this->hasMany(ApprovalStepInstance::class);
    }

    /**
     * Resolve the approver IDs using the configured resolver.
     *
     * @return array<string|int>
     */
    public function resolveApproverIds(Model $approvable): array
    {
        $resolver = app($this->approver_resolver);

        return $resolver->resolve($this->approver_config ?? [], $approvable);
    }
}
