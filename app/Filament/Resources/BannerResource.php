<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'แบนเนอร์';
    protected static ?string $navigationGroup = 'การตั้งค่า';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'แบนเนอร์';
    protected static ?string $pluralModelLabel = 'แบนเนอร์';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')->label('หัวข้อ')->maxLength(255)->columnSpanFull(),
                Forms\Components\Textarea::make('subtitle')->label('คำบรรยาย')->rows(2)->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->label('รูปภาพแบนเนอร์')
                    ->image()
                    ->required()
                    ->directory('banners')
                    ->disk('public')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('button_text')->label('ข้อความปุ่ม')->maxLength(100),
                Forms\Components\TextInput::make('button_url')->label('ลิงก์ปุ่ม')->url(),
                Forms\Components\TextInput::make('order')->label('ลำดับ')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->label('เปิดใช้งาน')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('ภาพ')->width(120)->height(50),
                Tables\Columns\TextColumn::make('title')->label('หัวข้อ')->limit(40)->searchable(),
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
            'index'  => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit'   => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
