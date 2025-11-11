<?php

namespace App\Filament\Admin\Resources\Projects\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('category')
                    ->required(),
                TextInput::make('subcategory')
                    ->default(null),
                Select::make('experience_level')
                    ->options(['entry' => 'Entry', 'intermediate' => 'Intermediate', 'expert' => 'Expert'])
                    ->required(),
                Select::make('project_type')
                    ->options(['one-time' => 'One time', 'ongoing' => 'Ongoing', 'contract' => 'Contract'])
                    ->required(),
                Textarea::make('skills_required')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('requirements')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('deliverables')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('attachments')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('budget_type')
                    ->options(['fixed' => 'Fixed', 'range' => 'Range', 'hourly' => 'Hourly'])
                    ->required(),
                TextInput::make('fixed_budget')
                    ->numeric()
                    ->default(null),
                TextInput::make('min_budget')
                    ->numeric()
                    ->default(null),
                TextInput::make('max_budget')
                    ->numeric()
                    ->default(null),
                TextInput::make('hourly_rate')
                    ->numeric()
                    ->default(null),
                TextInput::make('estimated_hours')
                    ->numeric()
                    ->default(null),
                TextInput::make('timeline')
                    ->required(),
                Select::make('urgency')
                    ->options(['normal' => 'Normal', 'urgent' => 'Urgent', 'asap' => 'Asap'])
                    ->default('normal')
                    ->required(),
                Textarea::make('milestones')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('additional_info')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
            'draft' => 'Draft',
            'open' => 'Open',
            'in_progress' => 'In progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'paused' => 'Paused',
        ])
                    ->default('open')
                    ->required(),
                DateTimePicker::make('posted_at'),
                DateTimePicker::make('deadline'),
            ]);
    }
}
