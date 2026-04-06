<?php

namespace Wezlo\FilamentApproval\Concerns;

use Filament\Actions\Action;
use Wezlo\FilamentApproval\Actions\ApproveAction;
use Wezlo\FilamentApproval\Actions\CommentAction;
use Wezlo\FilamentApproval\Actions\DelegateAction;
use Wezlo\FilamentApproval\Actions\RejectAction;
use Wezlo\FilamentApproval\Actions\SubmitForApprovalAction;

trait HasApprovalsResource
{
    /**
     * @return array<Action>
     */
    protected function getApprovalHeaderActions(): array
    {
        return [
            SubmitForApprovalAction::make(),
            ApproveAction::make(),
            RejectAction::make(),
            CommentAction::make(),
            DelegateAction::make(),
        ];
    }
}
