<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KnowledgeCategoryResource\Pages;
use App\Models\KnowledgeCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KnowledgeCategoryResource extends Resource
{
    protected static ?string $model = KnowledgeCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-bookmark';
    protected static ?string $navigationLabel = 'หมวดหมู่คลังความรู้';
    protected static ?string $navigationGroup = 'ตั้งค่าหมวดหมู่';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'หมวดหมู่';
    protected static ?string $pluralModelLabel = 'หมวดหมู่คลังความรู้';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->label('ชื่อหมวดหมู่')->required()->maxLength(100),
                Forms\Components\TextInput::make('slug')->label('Slug')
                    ->unique(KnowledgeCategory::class, 'slug', ignoreRecord: true)->maxLength(100),
                Forms\Components\TextInput::make('icon')->label('ไอคอน (heroicon)')->maxLength(100)->placeholder('heroicon-o-book-open'),
                Forms\Components\TextInput::make('order')->label('ลำดับ')->numeric()->default(0),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('ชื่อหมวดหมู่')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('Slug'),
                Tables\Columns\TextColumn::make('order')->label('ลำดับ')->sortable(),
            ])
            ->reorderable('order')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKnowledgeCategories::route('/'),
            'create' => Pages\CreateKnowledgeCategory::route('/create'),
            'edit'   => Pages\EditKnowledgeCategory::route('/{record}/edit'),
        ];
    }
}
