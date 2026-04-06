<?php

namespace Wezlo\FilamentApproval\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Wezlo\FilamentApproval\Models\ApprovalStepInstance;

class ApprovalEscalated
{
    use Dispatchable;

    public function __construct(
        public readonly ApprovalStepInstance $stepInstance,
    ) {}
}
