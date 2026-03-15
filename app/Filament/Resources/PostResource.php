<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\PostCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'ข่าวสาร';
    protected static ?string $navigationGroup = 'เนื้อหา';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'ข่าวสาร';
    protected static ?string $pluralModelLabel = 'ข่าวสาร';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')
                    ->label('หัวข้อ')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug (URL)')
                    ->required()
                    ->unique(Post::class, 'slug', ignoreRecord: true)
                    ->columnSpanFull(),

                Forms\Components\Select::make('category_id')
                    ->label('หมวดหมู่')
                    ->options(PostCategory::pluck('name', 'id'))
                    ->required()
                    ->searchable(),

                Forms\Components\Select::make('status')
                    ->label('สถานะ')
                    ->options(['draft' => 'แบบร่าง', 'published' => 'เผยแพร่'])
                    ->required()
                    ->default('draft'),

                Forms\Components\DateTimePicker::make('published_at')
                    ->label('วันที่เผยแพร่')
                    ->nullable(),

                Forms\Components\FileUpload::make('cover_image')
                    ->label('ภาพปก')
                    ->image()
                    ->imagePreviewHeight('200')
                    ->loadingIndicatorPosition('left')
                    ->panelAspectRatio('16:9')
                    ->panelLayout('integrated')
                    ->removeUploadedFileButtonPosition('right')
                    ->uploadButtonPosition('left')
                    ->uploadProgressIndicatorPosition('left')
                    ->directory('posts')
                    ->disk('uploads')
                    ->visibility('public')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('excerpt')
                    ->label('สรุปย่อ')
                    ->rows(3)
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('content')
                    ->label('เนื้อหา')
                    ->required()
                    ->toolbarButtons([
                        'bold', 'italic', 'underline', 'strike',
                        'h2', 'h3', 'bulletList', 'orderedList',
                        'blockquote', 'link', 'attachFiles', 'undo', 'redo',
                    ])
                    ->fileAttachmentsDirectory('posts/attachments')
                    ->fileAttachmentsDisk('uploads')
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')->label('ภาพ')->width(60)->height(40)->disk('uploads'),
                Tables\Columns\TextColumn::make('title')->label('หัวข้อ')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('category.name')->label('หมวดหมู่')->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label('สถานะ')
                    ->badge()
                    ->color(fn ($state) => match ($state) { 'published' => 'success', default => 'warning' })
                    ->formatStateUsing(fn ($state) => $state === 'published' ? 'เผยแพร่' : 'แบบร่าง'),
                Tables\Columns\TextColumn::make('published_at')->label('วันที่')->dateTime('d/m/Y')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('สร้างเมื่อ')->dateTime('d/m/Y')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['draft' => 'แบบร่าง', 'published' => 'เผยแพร่'])
                    ->label('สถานะ'),
                Tables\Filters\SelectFilter::make('category_id')
                    ->options(PostCategory::pluck('name', 'id'))
                    ->label('หมวดหมู่'),
            ])
            ->actions([Tables\Actions\ViewAction::make(), Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view'   => Pages\ViewPost::route('/{record}'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
