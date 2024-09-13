<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\OurTrip;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OurTripResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OurTripResource\RelationManagers;

class OurTripResource extends Resource
{
    protected static ?string $model = OurTrip::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    FileUpload::make('img')
                        ->label(__('Img Our Trips'))
                        ->image() // التأكد من أن الملف هو صورة
                        ->maxSize(2048) // الحد الأقصى للحجم 2 ميجابايت
                        ->required() // اجعل الحقل مطلوبًا
                        ->rules(['mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048']) // قواعد التحقق الإضافية
                        ->directory('Ourtrips') // تحديد المجلد للتخزين
                        ->visibility('public'),// تأكد من أن الصورة عامة ويمكن عرضها
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('img')
                ->label(__('Our Partners'))
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
            'index' => Pages\ManageOurTrips::route('/'),
        ];
    }

        // start tranlation of models 
        public static function getNavigationLabel(): string
        {
            return __('OurTrips');
        }
        public static function getPluralLabel(): string
        {
            return  __('OurTrips'); 
        }
        public static function getModelLabel(): string
        {
            return  __('OurTrip'); 
        }
    // end tranlation of models 
}
