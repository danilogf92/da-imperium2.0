<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Filament\Resources\ProjectResource\Widgets\StatsOverview;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Support\Facades\Auth;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pda_code')
                    ->minLength(3)
                    ->maxLength(255)
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('data_uploaded')
                    ->disabled()
                    ->required(),
                Forms\Components\TextInput::make('rate')
                    ->minValue(0)
                    ->maxValue(5)
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                Forms\Components\Select::make('state_id')
                    ->relationship('state', 'state_name')
                    ->required(),
                Forms\Components\Select::make('investment_id')
                    ->relationship('investment', 'investment_name')
                    ->required(),
                Forms\Components\Select::make('classification_of_investment_id')
                    ->relationship('classificationOfInvestment', 'classification_name')
                    ->required(),
                Forms\Components\Select::make('justification_id')
                    ->relationship('justification', 'justification_name')
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('finish_date')
                    ->required(),
            ]);
    }

    public static function canAccess(): bool
    {
        return Auth::user()?->role === 'user' || Auth::user()?->role === 'admin';
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

        return parent::getEloquentQuery()
            ->when(
                $user->role === 'user',
                fn($query) =>
                $query->where('company_id', $user->company_id)
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('pda_code')
                    ->searchable(),
                Tables\Columns\IconColumn::make('data_uploaded')
                    ->boolean(),
                Tables\Columns\TextColumn::make('rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company.name')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('state_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('state.state_name')
                    ->label('State')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Finished' => 'success',
                        'Planification' => 'warning',
                        'Execution' => 'info',
                    }),
                // Tables\Columns\TextColumn::make('investment_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('investment.investment_name')
                    ->label('Investment')
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('classification_of_investment_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('classificationOfInvestment.classification_name')
                    ->label('Classification Of Investment')
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('justification_id')
                //     ->numeric()
                //     ->sortable(),

                Tables\Columns\TextColumn::make('justification.justification_name')
                    ->label('Justification')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('finish_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
