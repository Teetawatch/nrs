<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnouncementResource\Pages;
use App\Models\Announcement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;
    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'ประกาศ';
    protected static ?string $navigationGroup = 'การตั้งค่า';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'ประกาศ';
    protected static ?string $pluralModelLabel = 'ประกาศ';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')->label('หัวข้อ')->required()->maxLength(255)->columnSpanFull(),
                Forms\Components\Textarea::make('content')->label('เนื้อหา')->required()->rows(3)->columnSpanFull(),
                Forms\Components\Select::make('type')
                    ->label('ประเภท')
                    ->options(['info' => 'ข้อมูล', 'warning' => 'แจ้งเตือน', 'danger' => 'สำคัญ', 'success' => 'สำเร็จ'])
                    ->required()->default('info'),
                Forms\Components\DateTimePicker::make('expired_at')->label('หมดอายุเมื่อ')->nullable(),
                Forms\Components\Toggle::make('is_active')->label('เปิดใช้งาน')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('หัวข้อ')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('type')
                    ->label('ประเภท')
                    ->badge()
                    ->color(fn ($s) => match ($s) { 'info' => 'info', 'warning' => 'warning', 'danger' => 'danger', default => 'success' })
                    ->formatStateUsing(fn ($s) => match ($s) { 'info' => 'ข้อมูล', 'warning' => 'แจ้งเตือน', 'danger' => 'สำคัญ', default => 'สำเร็จ' }),
                Tables\Columns\TextColumn::make('expired_at')->label('หมดอายุ')->dateTime('d/m/Y H:i')->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('เปิดใช้งาน'),
                Tables\Columns\TextColumn::make('created_at')->label('สร้างเมื่อ')->dateTime('d/m/Y')->sortable(),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit'   => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }
}
