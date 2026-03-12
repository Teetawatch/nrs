<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolSystemResource\Pages;
use App\Models\SchoolSystem;
use App\Models\SystemCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SchoolSystemResource extends Resource
{
    protected static ?string $model = SchoolSystem::class;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'ระบบงาน';
    protected static ?string $navigationGroup = 'การตั้งค่า';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'ระบบงาน';
    protected static ?string $pluralModelLabel = 'ระบบงาน';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->label('ชื่อระบบ')->required()->maxLength(100)->columnSpanFull(),
                Forms\Components\Textarea::make('description')->label('คำอธิบาย')->rows(2)->columnSpanFull(),
                Forms\Components\TextInput::make('url')->label('URL')->required()->url()->columnSpanFull(),
                Forms\Components\Select::make('category_id')
                    ->label('หมวดหมู่')
                    ->options(SystemCategory::pluck('name', 'id'))
                    ->nullable()->searchable(),
                Forms\Components\TextInput::make('color')->label('สี (#hex)')->maxLength(10)->default('#1E3A5F'),
                Forms\Components\FileUpload::make('logo')
                    ->label('โลโก้')
                    ->image()
                    ->directory('systems')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('order')->label('ลำดับ')->numeric()->default(0),
                Forms\Components\Toggle::make('open_new_tab')->label('เปิดแท็บใหม่')->default(true),
                Forms\Components\Toggle::make('is_active')->label('เปิดใช้งาน')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')->label('โลโก้')->width(40)->height(40),
                Tables\Columns\TextColumn::make('name')->label('ชื่อระบบ')->searchable(),
                Tables\Columns\TextColumn::make('category.name')->label('หมวดหมู่')->badge(),
                Tables\Columns\TextColumn::make('url')->label('URL')->limit(40)->url(fn ($record) => $record->url),
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
            'index'  => Pages\ListSchoolSystems::route('/'),
            'create' => Pages\CreateSchoolSystem::route('/create'),
            'edit'   => Pages\EditSchoolSystem::route('/{record}/edit'),
        ];
    }
}
