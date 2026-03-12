<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentCategoryResource\Pages;
use App\Models\DocumentCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentCategoryResource extends Resource
{
    protected static ?string $model = DocumentCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationLabel = 'หมวดหมู่เอกสาร';
    protected static ?string $navigationGroup = 'ตั้งค่าหมวดหมู่';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'หมวดหมู่';
    protected static ?string $pluralModelLabel = 'หมวดหมู่เอกสาร';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->label('ชื่อหมวดหมู่')->required()->maxLength(100),
                Forms\Components\TextInput::make('slug')->label('Slug')
                    ->unique(DocumentCategory::class, 'slug', ignoreRecord: true)->maxLength(100),
                Forms\Components\TextInput::make('icon')->label('ไอคอน (heroicon)')->maxLength(100)->placeholder('heroicon-o-folder'),
                Forms\Components\TextInput::make('color')->label('สี (#hex)')->maxLength(20)->placeholder('#1E3A5F'),
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
                Tables\Columns\TextColumn::make('documents_count')->label('เอกสาร')
                    ->counts('documents')->sortable(),
            ])
            ->reorderable('order')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDocumentCategories::route('/'),
            'create' => Pages\CreateDocumentCategory::route('/create'),
            'edit'   => Pages\EditDocumentCategory::route('/{record}/edit'),
        ];
    }
}
