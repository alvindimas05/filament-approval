<?php

namespace Wezlo\FilamentApproval\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wezlo\FilamentApproval\Enums\ActionType;
use Wezlo\FilamentApproval\FilamentApprovalPlugin;

class ApprovalAction extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => ActionType::class,
            'metadata' => 'array',
        ];
    }

    public function approval(): BelongsTo
    {
        return $this->belongsTo(Approval::class);
    }

    public function stepInstance(): BelongsTo
    {
        return $this->belongsTo(ApprovalStepInstance::class, 'approval_step_instance_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(FilamentApprovalPlugin::resolveUserModel());
    }
}
