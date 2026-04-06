<?php

namespace Wezlo\FilamentApproval\Contracts;

use Wezlo\FilamentApproval\Models\ApprovalStepInstance;

interface EscalationHandler
{
    /**
     * Handle escalation for a breached step instance.
     */
    public function handle(ApprovalStepInstance $stepInstance): void;
}
