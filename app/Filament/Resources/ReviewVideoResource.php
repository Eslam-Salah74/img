<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ReviewVideo;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ReviewVideoResource\Pages;
use App\Filament\Resources\ReviewVideoResource\RelationManagers;

class ReviewVideoResource extends Resource
{
    protected static ?string $model = ReviewVideo::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    FileUpload::make('video')
                        ->label(__('Upload Video'))
                        ->acceptedFileTypes(['video/mp4', 'video/mov', 'video/avi']) // Define acceptable video types
                        ->maxSize(102400) // Set max size in KB (100 MB in this example)
                        ->directory('ReviewVideos') // Define directory to store the videos
                        ->required(), // Optional: mark as required

                        FileUpload::make('thumbnail')
                        ->label(__('thumbnail'))
                        ->image() // Validate as an image
                        ->maxSize(2048) // Max size 2MB
                        ->required()
                        ->rules(['mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048']) // Additional validation rules
                        // ->multiple() // Allow multiple file uploads
                        ->directory('Thumbnail'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('video')
                ->label(__('Video Name'))
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn ($state) => basename($state)), // Display the file name only

            IconColumn::make('video')
                ->label(__('Preview'))
                ->options([
                    'heroicon-o-play' => fn ($record) => !empty($record->video), // Display a play icon if the video exists
                ])
                ->url(fn ($record) => asset('storage/videos/' . $record->video), true) // Adjust path based on your storage setup
                ->openUrlInNewTab(), // Open the video in a new tab when clicked

            // Alternatively, use ImageColumn if you have thumbnails for the videos
            ImageColumn::make('thumbnail')
                ->label(__('Video Thumbnail'))
                ->disk('public')
                ->height(50)
                ->width(50),
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
            'index' => Pages\ManageReviewVideos::route('/'),
        ];
    }

        //  لاخفاء زرار الاضافة بعد اضافه اول صف فى الداتا بيز
        public static function canCreate(): bool
        {
            return ReviewVideo::count() === 0;
        }
}
