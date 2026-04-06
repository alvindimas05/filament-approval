<?php

namespace Wezlo\FilamentApproval\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Wezlo\FilamentApproval\Models\Approval;

class ApprovalSubmitted
{
    use Dispatchable;

    public function __construct(
        public readonly Approval $approval,
    ) {}
}
