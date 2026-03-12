<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhilosophyResource\Pages;
use App\Models\Philosophy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PhilosophyResource extends Resource
{
    protected static ?string $model = Philosophy::class;
    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';
    protected static ?string $navigationLabel = 'ปรัชญา/วิสัยทัศน์';
    protected static ?string $navigationGroup = 'เกี่ยวกับ';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'รายการ';
    protected static ?string $pluralModelLabel = 'ปรัชญา/วิสัยทัศน์';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\Select::make('type')
                    ->label('ประเภท')
                    ->options([
                        'philosophy' => 'ปรัชญา', 'vision' => 'วิสัยทัศน์',
                        'mission' => 'พันธกิจ', 'goal' => 'เป้าหมาย',
                        'value' => 'ค่านิยม', 'identity' => 'อัตลักษณ์',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('icon')->label('ไอคอน (heroicon)')->maxLength(100)->placeholder('heroicon-o-star'),
                Forms\Components\TextInput::make('title')->label('หัวข้อ')->required()->maxLength(200)->columnSpanFull(),
                Forms\Components\Textarea::make('content')->label('เนื้อหา')->rows(3)->columnSpanFull(),
                Forms\Components\TextInput::make('order')->label('ลำดับ')->numeric()->default(0),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('ประเภท')->badge()
                    ->formatStateUsing(fn ($s) => match ($s) {
                        'philosophy' => 'ปรัชญา', 'vision' => 'วิสัยทัศน์',
                        'mission' => 'พันธกิจ', 'goal' => 'เป้าหมาย',
                        'value' => 'ค่านิยม', default => 'อัตลักษณ์',
                    }),
                Tables\Columns\TextColumn::make('title')->label('หัวข้อ')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('order')->label('ลำดับ')->sortable(),
            ])
            ->reorderable('order')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options(['philosophy' => 'ปรัชญา', 'vision' => 'วิสัยทัศน์', 'mission' => 'พันธกิจ', 'goal' => 'เป้าหมาย'])
                    ->label('ประเภท'),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPhilosophies::route('/'),
            'create' => Pages\CreatePhilosophy::route('/create'),
            'edit'   => Pages\EditPhilosophy::route('/{record}/edit'),
        ];
    }
}
