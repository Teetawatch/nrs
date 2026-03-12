@extends('layouts.app')
@section('title', $post->title . ' — ' . config('app.name'))
@section('description', $post->excerpt)

@section('content')
<div class="bg-slate-50 min-h-screen">
    <div class="bg-gradient-to-br from-primary-400 via-primary-500 to-primary-600 text-white py-12 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cpath d=&quot;M60 0H0v60&quot; fill=&quot;none&quot; stroke=&quot;%23fff&quot; stroke-width=&quot;0.5&quot;/%3E%3C/svg%3E');"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <nav class="text-sm text-white/60 mb-3" aria-label="Breadcrumb">
                <ol class="flex items-center gap-2 flex-wrap">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors cursor-pointer">หน้าแรก</a></li>
                    <li aria-hidden="true"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                    <li><a href="{{ route('news') }}" class="hover:text-white transition-colors cursor-pointer">ข่าวสาร</a></li>
                    <li aria-hidden="true"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                    <li class="text-white font-medium truncate max-w-xs">{{ $post->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-10">
            {{-- Article --}}
            <article class="flex-1 min-w-0">
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                    @if($post->cover_image_url)
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    </div>
                    @endif
                    <div class="p-8">
                        <div class="flex items-center gap-3 flex-wrap mb-4">
                            @if($post->category)
                            <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full"
                                  style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }}">
                                {{ $post->category->name }}
                            </span>
                            @endif
                            <time class="text-sm text-slate-500" datetime="{{ $post->published_at?->toIso8601String() }}">
                                {{ $post->published_at?->translatedFormat('d F Y') }}
                            </time>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 leading-tight mb-6">{{ $post->title }}</h1>
                        @if($post->excerpt)
                        <p class="text-lg text-slate-600 leading-relaxed mb-6 pb-6 border-b border-slate-100">{{ $post->excerpt }}</p>
                        @endif
                        <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed
                            [&>p]:mb-4 [&>h2]:text-2xl [&>h2]:font-bold [&>h2]:text-primary [&>h2]:mt-8 [&>h2]:mb-4
                            [&>h3]:text-xl [&>h3]:font-bold [&>h3]:mt-6 [&>h3]:mb-3
                            [&>ul]:list-disc [&>ul]:pl-6 [&>ul]:mb-4 [&>ol]:list-decimal [&>ol]:pl-6 [&>ol]:mb-4
                            [&>li]:mb-1 [&>img]:rounded-xl [&>img]:my-6 [&>blockquote]:border-l-4 [&>blockquote]:border-accent [&>blockquote]:pl-4 [&>blockquote]:italic [&>blockquote]:text-slate-600
                            [&>table]:w-full [&>table]:border-collapse [&>th]:border [&>th]:border-slate-300 [&>th]:p-2 [&>th]:bg-slate-50 [&>td]:border [&>td]:border-slate-300 [&>td]:p-2">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('news') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-primary transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        กลับไปหน้าข่าวสาร
                    </a>
                </div>
            </article>

            {{-- Sidebar --}}
            @if($related->isNotEmpty())
            <aside class="lg:w-80 flex-shrink-0" aria-label="ข่าวที่เกี่ยวข้อง">
                <div class="bg-white rounded-xl border border-slate-200 p-6 sticky top-20">
                    <h3 class="font-bold text-slate-900 mb-4">ข่าวที่เกี่ยวข้อง</h3>
                    <div class="space-y-4">
                        @foreach($related as $rel)
                        <a href="{{ route('news.show', $rel->slug) }}" class="flex gap-3 group cursor-pointer">
                            <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-slate-100">
                                @if($rel->cover_image_url)
                                <img src="{{ $rel->cover_image_url }}" alt="{{ $rel->title }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full bg-primary/10 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-900 line-clamp-2 group-hover:text-primary transition-colors">{{ $rel->title }}</p>
                                <time class="text-xs text-slate-400 mt-1 block">{{ $rel->published_at?->translatedFormat('d F Y') }}</time>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </aside>
            @endif
        </div>
    </div>
</div>
@endsection
