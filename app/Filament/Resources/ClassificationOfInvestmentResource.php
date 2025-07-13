<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassificationOfInvestmentResource\Pages;
use App\Filament\Resources\ClassificationOfInvestmentResource\RelationManagers;
use App\Models\ClassificationOfInvestment;
use App\Models\User;
use Filament\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ClassificationOfInvestmentResource extends Resource
{
    protected static ?string $model = ClassificationOfInvestment::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('classification_name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function canAccess(): bool
    {
        return Auth::user()?->role === 'admin';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('classification_name')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListClassificationOfInvestments::route('/'),
            'create' => Pages\CreateClassificationOfInvestment::route('/create'),
            'edit' => Pages\EditClassificationOfInvestment::route('/{record}/edit'),
        ];
    }
}
