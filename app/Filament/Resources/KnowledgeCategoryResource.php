<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KnowledgeCategoryResource\Pages;
use App\Models\KnowledgeCategory;
use App\Models\KnowledgeBase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KnowledgeCategoryResource extends Resource
{
    protected static ?string $model = KnowledgeCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-bookmark';
    protected static ?string $navigationLabel = 'หมวดหมู่คลังความรู้';
    protected static ?string $navigationGroup = 'ตั้งค่าหมวดหมู่';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'หมวดหมู่';
    protected static ?string $pluralModelLabel = 'หมวดหมู่คลังความรู้';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->label('ชื่อหมวดหมู่')->required()->maxLength(100),
                Forms\Components\TextInput::make('slug')->label('Slug')
                    ->unique(KnowledgeCategory::class, 'slug', ignoreRecord: true)->maxLength(100),
                Forms\Components\TextInput::make('icon')->label('ไอคอน (heroicon)')->maxLength(100)->placeholder('heroicon-o-book-open'),
                Forms\Components\TextInput::make('order')->label('ลำดับ')->numeric()->default(0),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('ชื่อหมวดหมู่')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('Slug'),
                Tables\Columns\TextColumn::make('order')->label('ลำดับ')->sortable(),
            ])
            ->reorderable('order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Tables\Actions\DeleteAction $action, KnowledgeCategory $record) {
                        if ($record->knowledgeBases()->count() > 0) {
                            $action->failure();
                            $action->cancel();
                            \Filament\Notifications\Notification::make()
                                ->danger()
                                ->title('ไม่สามารถลบหมวดหมู่นี้ได้')
                                ->body("มี {$record->knowledgeBases()->count()} รายการความรู้ในหมวดหมู่นี้ กรุณาย้ายหรือลบรายการความรู้ก่อน")
                                ->send();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (Tables\Actions\DeleteBulkAction $action, \Illuminate\Support\Collection $records) {
                            $categoriesWithItems = $records->filter(function (KnowledgeCategory $category) {
                                return $category->knowledgeBases()->count() > 0;
                            });
                            
                            if ($categoriesWithItems->isNotEmpty()) {
                                $action->failure();
                                $action->cancel();
                                
                                $message = "ไม่สามารถลบหมวดหมู่ต่อไปนี้ได้:\n";
                                foreach ($categoriesWithItems as $category) {
                                    $message .= "- {$category->name} (มี {$category->knowledgeBases()->count()} รายการความรู้)\n";
                                }
                                $message .= "\nกรุณาย้ายหรือลบรายการความรู้ก่อน";
                                
                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('ไม่สามารถลบหมวดหมู่ได้')
                                    ->body($message)
                                    ->send();
                            }
                        }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKnowledgeCategories::route('/'),
            'create' => Pages\CreateKnowledgeCategory::route('/create'),
            'edit'   => Pages\EditKnowledgeCategory::route('/{record}/edit'),
        ];
    }
}
