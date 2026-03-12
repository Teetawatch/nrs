<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrgUnitResource\Pages;
use App\Models\OrgUnit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrgUnitResource extends Resource
{
    protected static ?string $model = OrgUnit::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'โครงสร้างองค์กร';
    protected static ?string $navigationGroup = 'เกี่ยวกับ';
    protected static ?int $navigationSort = 5;
    protected static ?string $modelLabel = 'หน่วยงาน';
    protected static ?string $pluralModelLabel = 'โครงสร้างองค์กร';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->label('ชื่อหน่วยงาน')->required()->maxLength(200)->columnSpanFull(),
                Forms\Components\TextInput::make('short_name')->label('ชื่อย่อ')->maxLength(50),
                Forms\Components\TextInput::make('order')->label('ลำดับ')->numeric()->default(0),
                Forms\Components\Select::make('parent_id')
                    ->label('สังกัด')
                    ->options(OrgUnit::pluck('name', 'id'))
                    ->searchable()
                    ->nullable()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')->label('คำอธิบาย')->rows(2)->columnSpanFull(),
                Forms\Components\FileUpload::make('image')->label('ภาพ')->image()->directory('org')->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('ชื่อหน่วยงาน')->searchable(),
                Tables\Columns\TextColumn::make('short_name')->label('ชื่อย่อ'),
                Tables\Columns\TextColumn::make('parent.name')->label('สังกัด')->badge(),
                Tables\Columns\TextColumn::make('order')->label('ลำดับ')->sortable(),
            ])
            ->reorderable('order')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOrgUnits::route('/'),
            'create' => Pages\CreateOrgUnit::route('/create'),
            'edit'   => Pages\EditOrgUnit::route('/{record}/edit'),
        ];
    }
}
