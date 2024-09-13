<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\CustomerReview;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Mokhosh\FilamentRating\Components\Rating;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerReviewResource\Pages;
use App\Filament\Resources\CustomerReviewResource\RelationManagers;

class CustomerReviewResource extends Resource
{
    protected static ?string $model = CustomerReview::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Rating::make('rating')
                        ->label(__('Customer Reting'))
                        ->default(5),
                        // ->theme(RatingTheme::HalfStars),
                        
                    TextInput::make('content')
                        ->label(__('Content'))
                        ->required(),

                    FileUpload::make('img')
                        ->label(__('Customer Reviews Img '))
                        ->image() // Validate as an image
                        ->maxSize(2048) // Max size 2MB
                        ->required()
                        ->rules(['mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048']) // Additional validation rules
                        // ->multiple() // Allow multiple file uploads
                        ->directory('CustomerReview'),    
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                RatingColumn::make('rating')
                ->label(__('Customer Rating'))
                ->sortable(),

                ImageColumn::make('img')
                ->label(__('Our Partners')),

                TextColumn::make('content')
                ->label(__('Content'))
                ->searchable()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    EditAction::make(),
                    ViewAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCustomerReviews::route('/'),
        ];
    }
}
