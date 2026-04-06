<?php

namespace Wezlo\FilamentApproval\Enums;

use Filament\Support\Contracts\HasLabel;

enum StepType: string implements HasLabel
{
    case Single = 'single';
    case Sequential = 'sequential';
    case Parallel = 'parallel';

    public function getLabel(): string
    {
        return __('filament-approval::approval.step_type.'.$this->value);
    }
}
