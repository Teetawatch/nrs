<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make()->schema([
                ImageEntry::make('cover_image')
                    ->label('ภาพปก')
                    ->disk('uploads')
                    ->height(300)
                    ->extraImgAttributes(['class' => 'rounded-xl object-cover w-full'])
                    ->columnSpanFull()
                    ->visible(fn ($record) => filled($record->cover_image)),

                TextEntry::make('title')
                    ->label('หัวข้อ')
                    ->size(TextEntry\TextEntrySize::Large)
                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                    ->columnSpanFull(),

                TextEntry::make('category.name')
                    ->label('หมวดหมู่')
                    ->badge(),

                TextEntry::make('status')
                    ->label('สถานะ')
                    ->badge()
                    ->color(fn ($state) => match ($state) { 'published' => 'success', default => 'warning' })
                    ->formatStateUsing(fn ($state) => $state === 'published' ? 'เผยแพร่' : 'แบบร่าง'),

                TextEntry::make('published_at')
                    ->label('วันที่เผยแพร่')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('ยังไม่กำหนด'),

                TextEntry::make('user.name')
                    ->label('ผู้เขียน'),

                TextEntry::make('excerpt')
                    ->label('สรุปย่อ')
                    ->columnSpanFull()
                    ->placeholder('ไม่มีสรุปย่อ'),

                TextEntry::make('content')
                    ->label('เนื้อหา')
                    ->html()
                    ->columnSpanFull(),
            ])->columns(3),
        ]);
    }
}
