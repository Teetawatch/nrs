<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurriculumResource\Pages;
use App\Models\Curriculum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CurriculumResource extends Resource
{
    protected static ?string $model = Curriculum::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'หลักสูตร';
    protected static ?string $navigationGroup = 'เกี่ยวกับ';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'หลักสูตร';
    protected static ?string $pluralModelLabel = 'หลักสูตร';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->label('ชื่อหลักสูตร')->required()->maxLength(200)->columnSpanFull(),
                Forms\Components\Select::make('level')
                    ->label('ระดับ')
                    ->options(['certificate' => 'ปวช.', 'diploma' => 'ปวส.', 'short' => 'ระยะสั้น'])
                    ->required(),
                Forms\Components\TextInput::make('order')->label('ลำดับ')->numeric()->default(0),
                Forms\Components\Textarea::make('description')->label('คำอธิบาย')->rows(3)->columnSpanFull(),
                Forms\Components\FileUpload::make('image')->label('ภาพ')->image()->directory('curriculum')->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')->label('เปิดใช้งาน')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('ชื่อหลักสูตร')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('level')->label('ระดับ')->badge()
                    ->formatStateUsing(fn ($s) => match ($s) { 'certificate' => 'ปวช.', 'diploma' => 'ปวส.', default => 'ระยะสั้น' }),
                Tables\Columns\TextColumn::make('order')->label('ลำดับ')->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('เปิดใช้งาน'),
            ])
            ->reorderable('order')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCurriculums::route('/'),
            'create' => Pages\CreateCurriculum::route('/create'),
            'edit'   => Pages\EditCurriculum::route('/{record}/edit'),
        ];
    }
}
