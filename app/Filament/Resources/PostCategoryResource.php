<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostCategoryResource\Pages;
use App\Models\PostCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostCategoryResource extends Resource
{
    protected static ?string $model = PostCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'หมวดหมู่ข่าว';
    protected static ?string $navigationGroup = 'ตั้งค่าหมวดหมู่';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'หมวดหมู่';
    protected static ?string $pluralModelLabel = 'หมวดหมู่ข่าว';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->label('ชื่อหมวดหมู่')->required()->maxLength(100),
                Forms\Components\TextInput::make('slug')->label('Slug')
                    ->unique(PostCategory::class, 'slug', ignoreRecord: true)->maxLength(100),
                Forms\Components\TextInput::make('color')->label('สี (#hex)')->maxLength(20)->placeholder('#1E3A5F'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('ชื่อหมวดหมู่')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('Slug'),
                Tables\Columns\TextColumn::make('posts_count')->label('จำนวนข่าว')
                    ->counts('posts')->sortable(),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPostCategories::route('/'),
            'create' => Pages\CreatePostCategory::route('/create'),
            'edit'   => Pages\EditPostCategory::route('/{record}/edit'),
        ];
    }
}
