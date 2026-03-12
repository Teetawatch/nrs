<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'แผนก/ฝ่าย';
    protected static ?string $navigationGroup = 'ตั้งค่าหมวดหมู่';
    protected static ?int $navigationSort = 5;
    protected static ?string $modelLabel = 'แผนก';
    protected static ?string $pluralModelLabel = 'แผนก/ฝ่าย';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->label('ชื่อแผนก/ฝ่าย')->required()->maxLength(200),
                Forms\Components\TextInput::make('slug')->label('Slug')
                    ->unique(Department::class, 'slug', ignoreRecord: true)->maxLength(100),
                Forms\Components\Textarea::make('description')->label('คำอธิบาย')->rows(2)->columnSpanFull(),
                Forms\Components\TextInput::make('order')->label('ลำดับ')->numeric()->default(0),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('ชื่อแผนก/ฝ่าย')->searchable(),
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
            'index'  => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit'   => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
