<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonnelResource\Pages;
use App\Models\Department;
use App\Models\Personnel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PersonnelResource extends Resource
{
    protected static ?string $model = Personnel::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'บุคลากร';
    protected static ?string $navigationGroup = 'เนื้อหา';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'บุคลากร';
    protected static ?string $pluralModelLabel = 'บุคลากร';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\Select::make('prefix')
                    ->label('คำนำหน้า')
                    ->options(['นาย' => 'นาย', 'นาง' => 'นาง', 'นางสาว' => 'นางสาว', 'ว่าที่ร้อยตรี' => 'ว่าที่ร้อยตรี'])
                    ->required(),

                Forms\Components\TextInput::make('first_name')->label('ชื่อ')->required()->maxLength(100),
                Forms\Components\TextInput::make('last_name')->label('นามสกุล')->required()->maxLength(100),
                Forms\Components\TextInput::make('slug')->label('Slug')->unique(Personnel::class, 'slug', ignoreRecord: true)->required(),
                Forms\Components\TextInput::make('position')->label('ตำแหน่ง')->required()->maxLength(200),
                Forms\Components\TextInput::make('rank')->label('ยศ/วุฒิ')->maxLength(100),

                Forms\Components\Select::make('role_type')
                    ->label('ประเภท')
                    ->options([
                        'commander'  => 'ผู้บังคับบัญชา',
                        'unit_head'  => 'หัวหน้าหน่วย',
                        'teacher'    => 'ครู',
                        'staff'      => 'เจ้าหน้าที่',
                    ])
                    ->required()
                    ->default('teacher'),

                Forms\Components\Select::make('department_id')
                    ->label('แผนก/ฝ่าย')
                    ->options(Department::pluck('name', 'id'))
                    ->nullable()
                    ->searchable(),

                Forms\Components\TextInput::make('email')->label('อีเมล')->email()->maxLength(100),
                Forms\Components\TextInput::make('phone')->label('โทรศัพท์')->maxLength(20),
                Forms\Components\TextInput::make('order')->label('ลำดับ')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->label('เปิดใช้งาน')->default(true),

                Forms\Components\FileUpload::make('photo')
                    ->label('รูปภาพ')
                    ->image()
                    ->directory('personnel')
                    ->disk('public')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('bio')
                    ->label('ประวัติ')
                    ->rows(4)
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')->label('รูป')->circular()->width(40)->height(40),
                Tables\Columns\TextColumn::make('full_name')->label('ชื่อ-นามสกุล')->searchable(['first_name', 'last_name'])->sortable(),
                Tables\Columns\TextColumn::make('position')->label('ตำแหน่ง')->limit(40),
                Tables\Columns\TextColumn::make('department.name')->label('แผนก')->badge(),
                Tables\Columns\TextColumn::make('role_type')
                    ->label('ประเภท')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'commander' => 'ผู้บังคับบัญชา', 'unit_head' => 'หัวหน้าหน่วย',
                        'teacher' => 'ครู', default => 'เจ้าหน้าที่',
                    }),
                Tables\Columns\ToggleColumn::make('is_active')->label('เปิดใช้งาน'),
                Tables\Columns\TextColumn::make('order')->label('ลำดับ')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role_type')
                    ->options(['commander' => 'ผู้บังคับบัญชา', 'unit_head' => 'หัวหน้าหน่วย', 'teacher' => 'ครู', 'staff' => 'เจ้าหน้าที่'])
                    ->label('ประเภท'),
                Tables\Filters\SelectFilter::make('department_id')
                    ->options(Department::pluck('name', 'id'))
                    ->label('แผนก'),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('order');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPersonnel::route('/'),
            'create' => Pages\CreatePersonnel::route('/create'),
            'edit'   => Pages\EditPersonnel::route('/{record}/edit'),
        ];
    }
}
