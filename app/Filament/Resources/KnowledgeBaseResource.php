<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KnowledgeBaseResource\Pages;
use App\Models\KnowledgeBase;
use App\Models\KnowledgeCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KnowledgeBaseResource extends Resource
{
    protected static ?string $model = KnowledgeBase::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'แหล่งความรู้';
    protected static ?string $navigationGroup = 'เนื้อหา';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'แหล่งความรู้';
    protected static ?string $pluralModelLabel = 'แหล่งความรู้';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')->label('หัวข้อ')->required()->maxLength(255)->columnSpanFull(),
                Forms\Components\TextInput::make('slug')->label('Slug')->unique(KnowledgeBase::class, 'slug', ignoreRecord: true)->columnSpanFull(),
                Forms\Components\Select::make('category_id')
                    ->label('หมวดหมู่')
                    ->options(KnowledgeCategory::pluck('name', 'id'))
                    ->required()->searchable(),
                Forms\Components\Select::make('type')
                    ->label('ประเภท')
                    ->options(['article' => 'บทความ', 'video' => 'วิดีโอ', 'link' => 'ลิงก์', 'file' => 'ไฟล์'])
                    ->required()->default('article'),
                Forms\Components\Select::make('status')
                    ->label('สถานะ')
                    ->options(['draft' => 'แบบร่าง', 'published' => 'เผยแพร่'])
                    ->required()->default('draft'),
                Forms\Components\TextInput::make('external_url')->label('URL ภายนอก')->url()->nullable()->columnSpanFull(),
                Forms\Components\FileUpload::make('cover_image')->label('ภาพปก')->image()->directory('knowledge')->columnSpanFull(),
                Forms\Components\Textarea::make('excerpt')->label('สรุปย่อ')->rows(3)->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->label('เนื้อหา')
                    ->toolbarButtons(['bold','italic','underline','strike','h2','h3','bulletList','orderedList','blockquote','link','attachFiles','undo','redo'])
                    ->fileAttachmentsDirectory('knowledge/attachments')
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')->label('ภาพ')->width(60)->height(40),
                Tables\Columns\TextColumn::make('title')->label('หัวข้อ')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('category.name')->label('หมวดหมู่')->badge(),
                Tables\Columns\TextColumn::make('type')
                    ->label('ประเภท')
                    ->badge()
                    ->formatStateUsing(fn ($s) => match ($s) { 'article' => 'บทความ', 'video' => 'วิดีโอ', 'link' => 'ลิงก์', default => 'ไฟล์' }),
                Tables\Columns\TextColumn::make('status')
                    ->label('สถานะ')
                    ->badge()
                    ->color(fn ($s) => match ($s) { 'published' => 'success', default => 'warning' })
                    ->formatStateUsing(fn ($s) => $s === 'published' ? 'เผยแพร่' : 'แบบร่าง'),
                Tables\Columns\TextColumn::make('view_count')->label('ผู้ชม')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options(['article' => 'บทความ', 'video' => 'วิดีโอ', 'link' => 'ลิงก์', 'file' => 'ไฟล์'])->label('ประเภท'),
                Tables\Filters\SelectFilter::make('status')
                    ->options(['draft' => 'แบบร่าง', 'published' => 'เผยแพร่'])->label('สถานะ'),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKnowledgeBases::route('/'),
            'create' => Pages\CreateKnowledgeBase::route('/create'),
            'edit'   => Pages\EditKnowledgeBase::route('/{record}/edit'),
        ];
    }
}
