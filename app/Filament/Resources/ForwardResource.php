<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForwardResource\Pages;
use App\Models\Forward;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class ForwardResource extends Resource
{
    protected static ?string $model = Forward::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-uturn-right';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->id()),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('content')
                    ->required()
                    ->url()
                    ->prefixIcon('heroicon-m-globe-alt')
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->maxLength(255),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')
                    ->copyableState(fn (string $state): string => "URL: {$state}"),
                Tables\Columns\TextColumn::make('url')
                    ->label('Link')
                    ->copyable()
                    ->copyableState(fn (string $state): string => "{$state}"),
                Tables\Columns\IconColumn::make('view_description')
                    ->icon('heroicon-o-eye') // Eye icon to open the modal
                    ->action(
                        Action::make('viewDescription')
                            ->modalHeading('Description')
                            ->modalContent(fn (Forward $record) => new HtmlString($record->description)) // Display the description in the modal
                            ->modalWidth('xl') // Set the modal size (e.g., 'sm', 'md', 'lg', 'xl')
                            ->modalCloseButton(false) // Optionally hide the close button
                            ->modalCancelActionLabel('Close')), // Customize the close button labe
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageForwards::route('/'),
        ];
    }
}
