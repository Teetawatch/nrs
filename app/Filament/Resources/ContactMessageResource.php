<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'ข้อความติดต่อ';
    protected static ?string $navigationGroup = 'การตั้งค่า';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'ข้อความติดต่อ';
    protected static ?string $pluralModelLabel = 'ข้อความติดต่อ';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->label('ชื่อ')->disabled(),
                Forms\Components\TextInput::make('email')->label('อีเมล')->email()->disabled(),
                Forms\Components\TextInput::make('phone')->label('โทรศัพท์')->disabled(),
                Forms\Components\TextInput::make('subject')->label('เรื่อง')->disabled()->columnSpanFull(),
                Forms\Components\Textarea::make('message')->label('ข้อความ')->disabled()->rows(5)->columnSpanFull(),
                Forms\Components\Toggle::make('is_read')->label('อ่านแล้ว'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('ชื่อ')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('อีเมล')->searchable(),
                Tables\Columns\TextColumn::make('subject')->label('เรื่อง')->limit(40),
                Tables\Columns\IconColumn::make('is_read')
                    ->label('อ่านแล้ว')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('วันที่')->dateTime('d/m/Y H:i')->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')->label('สถานะการอ่าน')
                    ->trueLabel('อ่านแล้ว')->falseLabel('ยังไม่อ่าน'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('mark_read')
                    ->label('ทำเครื่องหมายอ่านแล้ว')
                    ->icon('heroicon-o-check')
                    ->action(fn (ContactMessage $record) => $record->markAsRead())
                    ->visible(fn (ContactMessage $record) => !$record->is_read),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'view'  => Pages\ViewContactMessage::route('/{record}'),
        ];
    }
}
