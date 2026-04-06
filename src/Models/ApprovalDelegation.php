<?php

namespace Wezlo\FilamentApproval\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wezlo\FilamentApproval\FilamentApprovalPlugin;

class ApprovalDelegation extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'delegated_at' => 'datetime',
        ];
    }

    public function stepInstance(): BelongsTo
    {
        return $this->belongsTo(ApprovalStepInstance::class, 'approval_step_instance_id');
    }

    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(FilamentApprovalPlugin::resolveUserModel(), 'from_user_id');
    }

    public function toUser(): BelongsTo
    {
        return $this->belongsTo(FilamentApprovalPlugin::resolveUserModel(), 'to_user_id');
    }
}
