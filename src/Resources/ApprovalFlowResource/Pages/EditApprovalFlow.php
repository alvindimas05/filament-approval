<?php

namespace Wezlo\FilamentApproval\Resources\ApprovalFlowResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Wezlo\FilamentApproval\Resources\ApprovalFlowResource;

class EditApprovalFlow extends EditRecord
{
    protected static string $resource = ApprovalFlowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
