<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use App\Models\DocumentCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';
    protected static ?string $navigationLabel = 'เอกสาร';
    protected static ?string $navigationGroup = 'เนื้อหา';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'เอกสาร';
    protected static ?string $pluralModelLabel = 'เอกสาร';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')->label('ชื่อเอกสาร')->required()->maxLength(255)->columnSpanFull(),
                Forms\Components\TextInput::make('slug')->label('Slug')->unique(Document::class, 'slug', ignoreRecord: true)->columnSpanFull(),
                Forms\Components\Select::make('category_id')
                    ->label('หมวดหมู่')
                    ->options(DocumentCategory::pluck('name', 'id'))
                    ->required()->searchable(),
                Forms\Components\TextInput::make('year')->label('ปี (พ.ศ.)')->numeric()->nullable(),
                Forms\Components\Textarea::make('description')->label('คำอธิบาย')->rows(2)->columnSpanFull(),
                Forms\Components\FileUpload::make('file_path')
                    ->label('ไฟล์เอกสาร')
                    ->required()
                    ->directory('documents')
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip'])
                    ->maxSize(20480)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('file_name')->label('ชื่อไฟล์')->maxLength(255),
                Forms\Components\TextInput::make('file_type')->label('ประเภทไฟล์')->maxLength(20),
                Forms\Components\TextInput::make('file_size')->label('ขนาดไฟล์ (bytes)')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->label('เปิดใช้งาน')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('ชื่อเอกสาร')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('category.name')->label('หมวดหมู่')->badge(),
                Tables\Columns\TextColumn::make('file_type')->label('ประเภท')->badge()->formatStateUsing(fn ($state) => strtoupper($state)),
                Tables\Columns\TextColumn::make('year')->label('ปี'),
                Tables\Columns\TextColumn::make('download_count')->label('ดาวน์โหลด')->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('เปิดใช้งาน'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->options(DocumentCategory::pluck('name', 'id'))->label('หมวดหมู่'),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit'   => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
