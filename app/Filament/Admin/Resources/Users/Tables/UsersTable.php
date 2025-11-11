<?php

namespace App\Filament\Admin\Resources\Users\Tables;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;




class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(
                User::query()->where('role', 'freelancer') // 🔑 hanya freelancer
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'secondary' => 'pending',
                        'success'   => 'approved',
                        'danger'    => 'rejected',
                    ]),
            ])
            ->actions([
                EditAction::make(),

                Action::make('approve')
                    ->label('Approve')
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->requiresConfirmation()
                    ->action(fn(User $record) => $record->update(['status' => 'approved'])),

                Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->requiresConfirmation()
                    ->action(fn(User $record) => $record->update(['status' => 'rejected'])),
            ]);
    }
}
