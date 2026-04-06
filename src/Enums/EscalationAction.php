<?php

namespace Wezlo\FilamentApproval\Enums;

use Filament\Support\Contracts\HasLabel;

enum EscalationAction: string implements HasLabel
{
    case Notify = 'notify';
    case AutoApprove = 'auto_approve';
    case Reassign = 'reassign';
    case Reject = 'reject';

    public function getLabel(): string
    {
        return __('filament-approval::approval.escalation.'.$this->value);
    }
}
