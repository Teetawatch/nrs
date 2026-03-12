<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolSymbolResource\Pages;
use App\Models\SchoolSymbol;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SchoolSymbolResource extends Resource
{
    protected static ?string $model = SchoolSymbol::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'สัญลักษณ์';
    protected static ?string $navigationGroup = 'เกี่ยวกับ';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'สัญลักษณ์';
    protected static ?string $pluralModelLabel = 'สัญลักษณ์';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->label('ชื่อ')->required()->maxLength(200),
                Forms\Components\TextInput::make('order')->label('ลำดับ')->numeric()->default(0),
                Forms\Components\Textarea::make('description')->label('คำอธิบายสั้น')->rows(2)->columnSpanFull(),
                Forms\Components\RichEditor::make('content')->label('เนื้อหา')->columnSpanFull()
                    ->fileAttachmentsDirectory('symbols/attachments'),
                Forms\Components\FileUpload::make('image')->label('ภาพ')->image()->directory('symbols')->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('ภาพ')->width(60)->height(60),
                Tables\Columns\TextColumn::make('name')->label('ชื่อ')->searchable(),
                Tables\Columns\TextColumn::make('order')->label('ลำดับ')->sortable(),
            ])
            ->reorderable('order')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSchoolSymbols::route('/'),
            'create' => Pages\CreateSchoolSymbol::route('/create'),
            'edit'   => Pages\EditSchoolSymbol::route('/{record}/edit'),
        ];
    }
}
