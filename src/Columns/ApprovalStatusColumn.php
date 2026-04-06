<?php

namespace Wezlo\FilamentApproval\Columns;

use Filament\Tables\Columns\TextColumn;

class ApprovalStatusColumn extends TextColumn
{
    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'approval_status')
            ->label(__('filament-approval::approval.column.label'))
            ->getStateUsing(function ($record): ?string {
                if (! method_exists($record, 'approvals')) {
                    return null;
                }

                return $record->latestApproval()?->status?->value;
            })
            ->badge()
            ->color(fn (?string $state): string => match ($state) {
                'pending' => 'warning',
                'approved' => 'success',
                'rejected' => 'danger',
                'cancelled' => 'gray',
                default => 'gray',
            })
            ->formatStateUsing(fn (?string $state): string => $state
                ? __('filament-approval::approval.status.'.$state)
                : __('filament-approval::approval.column.no_approval')
            );
    }
}
