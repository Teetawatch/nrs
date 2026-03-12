<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SystemCategoryResource\Pages;
use App\Models\SystemCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SystemCategoryResource extends Resource
{
    protected static ?string $model = SystemCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'หมวดหมู่ระบบงาน';
    protected static ?string $navigationGroup = 'ตั้งค่าหมวดหมู่';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'หมวดหมู่';
    protected static ?string $pluralModelLabel = 'หมวดหมู่ระบบงาน';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->label('ชื่อหมวดหมู่')->required()->maxLength(100),
                Forms\Components\TextInput::make('order')->label('ลำดับ')->numeric()->default(0),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('ชื่อหมวดหมู่')->searchable(),
                Tables\Columns\TextColumn::make('order')->label('ลำดับ')->sortable(),
            ])
            ->reorderable('order')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSystemCategories::route('/'),
            'create' => Pages\CreateSystemCategory::route('/create'),
            'edit'   => Pages\EditSystemCategory::route('/{record}/edit'),
        ];
    }
}
