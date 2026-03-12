<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolHistoryResource\Pages;
use App\Models\SchoolHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SchoolHistoryResource extends Resource
{
    protected static ?string $model = SchoolHistory::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'ประวัติสถานศึกษา';
    protected static ?string $navigationGroup = 'เกี่ยวกับ';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'ประวัติสถานศึกษา';
    protected static ?string $pluralModelLabel = 'ประวัติสถานศึกษา';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')->label('หัวข้อ')->required()->maxLength(200)->columnSpanFull(),
                Forms\Components\FileUpload::make('cover_image')
                    ->label('ภาพหน้าปก')->image()->directory('about')->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->label('เนื้อหา')->required()->columnSpanFull()
                    ->fileAttachmentsDirectory('about/attachments'),
                Forms\Components\Toggle::make('is_active')->label('เปิดใช้งาน')->default(true),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('หัวข้อ')->limit(60)->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('เปิดใช้งาน'),
                Tables\Columns\TextColumn::make('updated_at')->label('แก้ไขล่าสุด')->dateTime('d/m/Y H:i')->sortable(),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSchoolHistories::route('/'),
            'create' => Pages\CreateSchoolHistory::route('/create'),
            'edit'   => Pages\EditSchoolHistory::route('/{record}/edit'),
        ];
    }
}
