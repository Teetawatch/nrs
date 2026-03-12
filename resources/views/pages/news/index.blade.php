@extends('layouts.app')
@section('title', 'ข่าวสาร — ' . config('app.name'))

@section('content')
<div class="bg-slate-50 min-h-screen">
    {{-- Page Header --}}
    <div class="bg-gradient-to-br from-primary-400 via-primary-500 to-primary-600 text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cpath d=&quot;M60 0H0v60&quot; fill=&quot;none&quot; stroke=&quot;%23fff&quot; stroke-width=&quot;0.5&quot;/%3E%3C/svg%3E');"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent/15 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <nav class="text-sm text-white/60 mb-4" aria-label="Breadcrumb">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors cursor-pointer">หน้าแรก</a></li>
                    <li aria-hidden="true"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                    <li class="text-white font-medium">ข่าวสาร</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-up">ข่าวสารและประชาสัมพันธ์</h1>
            <p class="text-white/70 mt-3 text-lg animate-fade-up" style="animation-delay: 0.1s;">ติดตามข่าวสาร กิจกรรม และประชาสัมพันธ์ของโรงเรียน</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Main --}}
            <div class="flex-1">
                @if($posts->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                    @foreach($posts as $idx => $post)
                    <article class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden card-hover group" data-aos="fade-up" data-aos-delay="{{ ($idx % 4) * 80 }}">
                        <a href="{{ route('news.show', $post->slug) }}" class="block cursor-pointer">
                            <div class="aspect-video overflow-hidden bg-slate-100 relative">
                                @if($post->cover_image_url)
                                <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                <div class="w-full h-full bg-gradient-to-br from-primary/5 to-accent/5 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-primary/20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="p-6">
                                @if($post->category)
                                <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full mb-3"
                                      style="background-color: {{ $post->category->color }}15; color: {{ $post->category->color }}">
                                    {{ $post->category->name }}
                                </span>
                                @endif
                                <h2 class="font-bold text-slate-900 leading-snug mb-2.5 line-clamp-2 group-hover:text-accent transition-colors duration-200">
                                    {{ $post->title }}
                                </h2>
                                @if($post->excerpt)
                                <p class="text-sm text-slate-500 line-clamp-2 mb-4">{{ $post->excerpt }}</p>
                                @endif
                                <div class="flex items-center justify-between">
                                    <time class="text-xs text-slate-400 flex items-center gap-1.5" datetime="{{ $post->published_at?->toIso8601String() }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $post->published_at?->translatedFormat('d F Y') ?? '' }}
                                    </time>
                                    <span class="text-accent text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center gap-1">
                                        อ่านต่อ <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                    @endforeach
                </div>
                <div class="mt-10">{{ $posts->links() }}</div>
                @else
                <div class="text-center py-20 text-slate-400">
                    <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <p class="text-lg">ยังไม่มีข่าวสาร</p>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="lg:w-72 flex-shrink-0" aria-label="หมวดหมู่ข่าว" data-aos="fade-left">
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm sticky top-24">
                    <h3 class="font-bold text-slate-900 mb-5 flex items-center gap-2">
                        <div class="w-1 h-5 rounded-full bg-accent"></div>
                        หมวดหมู่
                    </h3>
                    <ul class="space-y-1">
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('news') }}?cat={{ $cat->slug }}"
                               class="flex items-center justify-between text-sm text-slate-600 hover:text-accent hover:bg-accent/5 transition-all cursor-pointer py-2.5 px-3 rounded-xl group">
                                <span class="group-hover:translate-x-1 transition-transform">{{ $cat->name }}</span>
                                <span class="text-xs text-slate-400 bg-slate-100 group-hover:bg-accent/10 group-hover:text-accent px-2.5 py-0.5 rounded-full transition-colors">{{ $cat->posts_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
