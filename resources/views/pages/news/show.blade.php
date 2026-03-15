@extends('layouts.app')
@section('title', $post->title . ' — ' . config('app.name'))
@section('description', $post->excerpt)

@section('content')

{{-- Reading Progress Bar --}}
<div id="reading-progress" class="fixed top-0 left-0 z-[60] h-1 bg-gradient-to-r from-primary via-accent to-primary/80 transition-all duration-100 ease-linear" style="width: 0%;"></div>

<div class="bg-[#F5F7FA] min-h-screen">

    {{-- Hero Section --}}
    <div class="relative w-full overflow-hidden" style="min-height: 520px; background-color: #0a0f1e;">

        {{-- Background Image with Ken Burns --}}
        @if($post->cover_image_url)
        <div id="hero-bg" class="absolute inset-0 bg-cover bg-center scale-105"
             style="background-image: url('{{ $post->cover_image_url }}'); transition: transform 8s ease-out;"></div>
        @endif

        {{-- Layered Gradients --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-black/20"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-transparent to-transparent"></div>

        {{-- Breadcrumb (top) --}}
        <div class="absolute top-0 left-0 right-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <nav class="text-sm text-white/60" aria-label="Breadcrumb">
                    <ol class="flex items-center gap-1.5 flex-wrap">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors duration-200">หน้าแรก</a></li>
                        <li aria-hidden="true"><svg class="w-3 h-3 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                        <li><a href="{{ route('news') }}" class="hover:text-white transition-colors duration-200">ข่าวสาร</a></li>
                        <li aria-hidden="true"><svg class="w-3 h-3 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                        <li class="text-white/80 truncate max-w-xs font-medium">{{ Str::limit($post->title, 40) }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- Hero Content --}}
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-end pb-14 pt-28" style="min-height: 520px;">
            <div class="max-w-3xl" data-aos="fade-up">
                {{-- Category Badge --}}
                @if($post->category)
                <div class="mb-5">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3.5 py-1.5 rounded-full text-white uppercase tracking-wider backdrop-blur-sm shadow-lg"
                          style="background-color: {{ $post->category->color }}cc; border: 1px solid {{ $post->category->color }}60;">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                        {{ $post->category->name }}
                    </span>
                </div>
                @endif

                {{-- Title --}}
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[2.4rem] font-bold text-white leading-tight drop-shadow-xl mb-6 tracking-tight">
                    {{ $post->title }}
                </h1>

                {{-- Meta Row --}}
                <div class="flex flex-wrap items-center gap-4 text-sm text-white/70">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <time datetime="{{ $post->published_at?->toIso8601String() }}">
                            {{ $post->published_at?->translatedFormat('d F Y') }}
                        </time>
                    </span>
                    <span class="flex items-center gap-1.5" id="reading-time-badge">
                        <svg class="w-4 h-4 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span id="reading-time-text">กำลังโหลด...</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Layout --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-8 items-start">

            {{-- Article Column --}}
            <div class="flex-1 min-w-0">
                <article>
                    {{-- Article Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/70 overflow-hidden">

                        {{-- Excerpt Lead --}}
                        @if($post->excerpt)
                        <div class="px-7 sm:px-10 pt-9 pb-7 border-b border-slate-100 bg-gradient-to-br from-slate-50 to-white">
                            <p class="text-lg sm:text-xl text-slate-600 leading-relaxed font-normal">
                                <span class="text-4xl text-primary/30 font-serif leading-none mr-1 float-left mt-1">&ldquo;</span>{{ $post->excerpt }}
                            </p>
                        </div>
                        @endif

                        {{-- Content --}}
                        <div class="px-7 sm:px-10 py-9">
                            <div class="article-content prose prose-lg max-w-none text-slate-700 leading-relaxed">
                                {!! $post->content !!}
                            </div>
                        </div>

                        {{-- Footer: Tags & Share --}}
                        <div class="px-7 sm:px-10 py-6 border-t border-slate-100 bg-slate-50/50">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                @if($post->category)
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-xs text-slate-400 font-medium uppercase tracking-wider">หมวดหมู่:</span>
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1 rounded-full"
                                          style="background-color: {{ $post->category->color }}18; color: {{ $post->category->color }}; border: 1px solid {{ $post->category->color }}30;">
                                        {{ $post->category->name }}
                                    </span>
                                </div>
                                @endif
                                {{-- Share Buttons --}}
                                <div class="flex items-center gap-2">
                                    <span class="text-xs text-slate-400 font-medium uppercase tracking-wider mr-1">แชร์:</span>
                                    <button onclick="shareArticle('facebook')" title="แชร์บน Facebook"
                                            class="w-8 h-8 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 cursor-pointer bg-[#1877f2]/10 hover:bg-[#1877f2] text-[#1877f2] hover:text-white">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </button>
                                    <button onclick="shareArticle('line')" title="แชร์บน LINE"
                                            class="w-8 h-8 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 cursor-pointer bg-[#06c755]/10 hover:bg-[#06c755] text-[#06c755] hover:text-white">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                                    </button>
                                    <button onclick="copyLink()" title="คัดลอกลิงก์"
                                            class="w-8 h-8 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 cursor-pointer bg-slate-100 hover:bg-slate-700 text-slate-500 hover:text-white">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Back Link --}}
                    <div class="mt-8 flex items-center justify-between">
                        <a href="{{ route('news') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-primary transition-colors duration-200 cursor-pointer group bg-white hover:bg-primary/5 border border-slate-200 hover:border-primary/30 px-5 py-2.5 rounded-xl shadow-sm">
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            กลับไปหน้าข่าวสาร
                        </a>
                        {{-- Copy toast --}}
                        <div id="copy-toast" class="opacity-0 transition-opacity duration-300 text-xs font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 px-4 py-2 rounded-full">
                            ✓ คัดลอกลิงก์แล้ว
                        </div>
                    </div>
                </article>

                {{-- Related News Section --}}
                @if($related->isNotEmpty())
                <section class="mt-16" aria-label="ข่าวที่เกี่ยวข้อง">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-1 h-7 rounded-full bg-gradient-to-b from-primary to-accent flex-shrink-0"></div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-extrabold text-slate-900">ข่าวที่เกี่ยวข้อง</h2>
                            <p class="text-sm text-slate-400 mt-0.5">ข่าวสารอื่นๆ ที่คุณอาจสนใจ</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach($related as $rel)
                        <article class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden group cursor-pointer shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <a href="{{ route('news.show', $rel->slug) }}" class="block">
                                <div class="aspect-video overflow-hidden bg-slate-100 relative">
                                    @if($rel->cover_image_url)
                                    <img src="{{ $rel->cover_image_url }}" alt="{{ $rel->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary/5 to-accent/5 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-primary/20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                    @endif
                                    @if($rel->category)
                                    <div class="absolute top-3 left-3">
                                        <span class="inline-block text-[10px] font-bold px-2.5 py-1 rounded-full text-white backdrop-blur-sm uppercase tracking-wide"
                                              style="background-color: {{ $rel->category->color }}cc;">
                                            {{ $rel->category->name }}
                                        </span>
                                    </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                                <div class="p-5">
                                    <h3 class="font-bold text-slate-900 leading-snug mb-3 line-clamp-2 group-hover:text-primary transition-colors duration-200 text-[0.95rem]">
                                        {{ $rel->title }}
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <time class="text-xs text-slate-400 flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $rel->published_at?->translatedFormat('d F Y') }}
                                        </time>
                                        <span class="text-xs font-semibold text-primary flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            อ่านต่อ <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </article>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            {{-- Sticky Sidebar --}}
            <aside class="hidden lg:block w-72 flex-shrink-0" aria-label="สารบัญและข้อมูลเพิ่มเติม">
                <div class="sticky top-24 space-y-5">

                    {{-- Article Info Card --}}
                    <div class="bg-white rounded-2xl border border-slate-200/70 shadow-sm overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2">
                            <div class="w-1 h-4 rounded-full bg-primary flex-shrink-0"></div>
                            <span class="text-sm font-bold text-slate-800">ข้อมูลบทความ</span>
                        </div>
                        <div class="px-5 py-4 space-y-3.5 text-sm text-slate-600">
                            @if($post->published_at)
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-primary/8 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <div class="text-xs text-slate-400 mb-0.5">วันที่เผยแพร่</div>
                                    <div class="font-semibold text-slate-700">{{ $post->published_at->translatedFormat('d F Y') }}</div>
                                </div>
                            </div>
                            @endif
                            @if($post->category)
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5" style="background-color: {{ $post->category->color }}18;">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $post->category->color }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                </div>
                                <div>
                                    <div class="text-xs text-slate-400 mb-0.5">หมวดหมู่</div>
                                    <div class="font-semibold" style="color: {{ $post->category->color }};">{{ $post->category->name }}</div>
                                </div>
                            </div>
                            @endif
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <div class="text-xs text-slate-400 mb-0.5">เวลาอ่านประมาณ</div>
                                    <div class="font-semibold text-slate-700" id="sidebar-reading-time">—</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Table of Contents --}}
                    <div id="toc-card" class="bg-white rounded-2xl border border-slate-200/70 shadow-sm overflow-hidden hidden">
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2">
                            <div class="w-1 h-4 rounded-full bg-accent flex-shrink-0"></div>
                            <span class="text-sm font-bold text-slate-800">สารบัญ</span>
                        </div>
                        <nav id="toc-list" class="px-4 py-3 space-y-0.5 max-h-72 overflow-y-auto" aria-label="สารบัญบทความ"></nav>
                    </div>

                    {{-- Share Card --}}
                    <div class="bg-white rounded-2xl border border-slate-200/70 shadow-sm overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2">
                            <div class="w-1 h-4 rounded-full bg-emerald-500 flex-shrink-0"></div>
                            <span class="text-sm font-bold text-slate-800">แชร์บทความ</span>
                        </div>
                        <div class="px-5 py-4 flex items-center gap-3">
                            <button onclick="shareArticle('facebook')" title="แชร์บน Facebook"
                                    class="flex-1 flex items-center justify-center gap-2 text-xs font-semibold py-2 rounded-xl transition-all duration-200 hover:scale-105 cursor-pointer bg-[#1877f2]/10 hover:bg-[#1877f2] text-[#1877f2] hover:text-white">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                Facebook
                            </button>
                            <button onclick="shareArticle('line')" title="แชร์บน LINE"
                                    class="flex-1 flex items-center justify-center gap-2 text-xs font-semibold py-2 rounded-xl transition-all duration-200 hover:scale-105 cursor-pointer bg-[#06c755]/10 hover:bg-[#06c755] text-[#06c755] hover:text-white">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                                LINE
                            </button>
                            <button onclick="copyLink()" title="คัดลอกลิงก์"
                                    class="w-9 h-9 flex items-center justify-center rounded-xl transition-all duration-200 hover:scale-105 cursor-pointer bg-slate-100 hover:bg-slate-700 text-slate-500 hover:text-white flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </div>
                    </div>

                </div>
            </aside>
        </div>
    </div>
</div>

{{-- Lightbox --}}
<div id="lightbox" class="fixed inset-0 z-[999] hidden items-center justify-center p-4"
     onclick="closeLightbox(event)" role="dialog" aria-modal="true" aria-label="ดูรูปภาพ">
    <div class="absolute inset-0 bg-black/90 backdrop-blur-md"></div>
    <button onclick="closeLightbox()" class="absolute top-4 right-4 z-10 w-10 h-10 bg-white/10 hover:bg-white/25 rounded-full flex items-center justify-center text-white transition-all duration-200 cursor-pointer hover:scale-110 hover:rotate-90" aria-label="ปิด">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    <div class="relative z-10 max-w-5xl w-full max-h-[90vh] flex flex-col items-center">
        <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[85vh] rounded-2xl shadow-2xl object-contain">
        <p id="lightbox-caption" class="mt-3 text-sm text-white/60 text-center"></p>
    </div>
</div>

@push('styles')
<style>
    .article-content p { margin-bottom: 1.1rem; }
    .article-content h2 { font-size: 1.5rem; font-weight: 800; color: var(--color-primary, #0369a1); margin-top: 2.25rem; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid var(--color-primary, #0369a1)18; scroll-margin-top: 5rem; }
    .article-content h3 { font-size: 1.2rem; font-weight: 700; margin-top: 1.75rem; margin-bottom: 0.75rem; color: #1e293b; scroll-margin-top: 5rem; }
    .article-content h4 { font-size: 1.05rem; font-weight: 700; margin-top: 1.25rem; margin-bottom: 0.5rem; color: #334155; scroll-margin-top: 5rem; }
    .article-content ul { list-style: none; padding-left: 0; margin-bottom: 1rem; }
    .article-content ul li { position: relative; padding-left: 1.5rem; margin-bottom: 0.4rem; }
    .article-content ul li::before { content: ''; position: absolute; left: 0; top: 0.55em; width: 7px; height: 7px; border-radius: 50%; background: var(--color-primary, #0369a1); opacity: 0.7; }
    .article-content ol { list-style: decimal; padding-left: 1.75rem; margin-bottom: 1rem; }
    .article-content li { margin-bottom: 0.35rem; line-height: 1.75; }
    .article-content blockquote { position: relative; border-left: 4px solid var(--color-primary, #0369a1); background: linear-gradient(to right, #f0f9ff, #f8fafc); padding: 1rem 1.25rem 1rem 1.5rem; border-radius: 0 0.75rem 0.75rem 0; font-style: italic; color: #475569; margin: 1.75rem 0; }
    .article-content blockquote::before { content: '"'; position: absolute; top: -0.5rem; left: 1rem; font-size: 3.5rem; color: var(--color-primary, #0369a1); opacity: 0.2; font-family: Georgia, serif; line-height: 1; }
    .article-content table { width: 100%; border-collapse: collapse; margin: 1.75rem 0; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
    .article-content th { border: 1px solid #e2e8f0; padding: 0.75rem 1rem; background: linear-gradient(to bottom, #f1f5f9, #e8edf5); font-weight: 700; text-align: left; color: #334155; font-size: 0.875rem; }
    .article-content td { border: 1px solid #e2e8f0; padding: 0.7rem 1rem; font-size: 0.9rem; color: #475569; }
    .article-content tr:nth-child(even) td { background: #f8fafc; }
    .article-content tr:hover td { background: #f0f9ff; transition: background 0.15s; }
    .article-content figure { 
        margin: 2rem 0; 
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        max-width: 100%;
    }
    .article-content figure img {
        flex: 0 0 calc(33.333% - 0.34rem);
        border-radius: 0.875rem;
        width: calc(33.333% - 0.34rem);
        height: 185px;
        object-fit: cover;
        cursor: zoom-in;
        transition: transform 0.35s cubic-bezier(.22,.68,0,1.2), box-shadow 0.3s ease;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        margin: 0;
    }
    .article-content figure img:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 36px rgba(0,0,0,0.16);
        z-index: 2;
        position: relative;
    }
    @media (max-width: 640px) {
        .article-content figure {
            gap: 0.4rem;
        }
        .article-content figure img {
            flex: 0 0 calc(50% - 0.2rem);
            width: calc(50% - 0.2rem);
            height: 140px;
        }
    }
    .article-content img:not(figure img) {
        border-radius: 1rem;
        margin: 1.75rem auto;
        display: block;
        max-width: 100%;
        cursor: zoom-in;
        transition: transform 0.35s cubic-bezier(.22,.68,0,1.2), box-shadow 0.3s ease;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .article-content img:not(figure img):hover {
        transform: scale(1.015);
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    }
    .article-content figcaption { display: none; }
    .article-content a { color: var(--color-primary, #0369a1); text-decoration: underline; text-decoration-color: transparent; transition: text-decoration-color 0.2s; }
    .article-content a:hover { text-decoration-color: var(--color-primary, #0369a1); }
    .article-content strong { color: #1e293b; }
    .article-content hr { border: none; border-top: 2px solid #e2e8f0; margin: 2.5rem 0; }
    .article-content code:not(pre code) { background: #f1f5f9; border: 1px solid #e2e8f0; padding: 0.15em 0.45em; border-radius: 0.35rem; font-size: 0.875em; color: #e11d48; }
    .article-content pre { background: #1e293b; color: #e2e8f0; padding: 1.25rem 1.5rem; border-radius: 1rem; overflow-x: auto; margin: 1.75rem 0; font-size: 0.875rem; }
    #lightbox.open { display: flex; animation: lbFadeIn 0.25s ease; }
    @keyframes lbFadeIn { from { opacity: 0; transform: scale(0.97); } to { opacity: 1; transform: scale(1); } }
    #reading-progress { box-shadow: 0 0 8px rgba(var(--color-primary-rgb, 3,105,161), 0.5); }
    .toc-link { display: block; padding: 0.35rem 0.75rem; border-radius: 0.5rem; font-size: 0.8125rem; color: #64748b; transition: all 0.2s; line-height: 1.5; }
    .toc-link:hover, .toc-link.active { background: var(--color-primary, #0369a1)0d; color: var(--color-primary, #0369a1); font-weight: 600; padding-left: 1rem; }
    .toc-link.toc-h3 { padding-left: 1.5rem; font-size: 0.78rem; }
    .toc-link.toc-h3.active { padding-left: 1.75rem; }
    @media (prefers-reduced-motion: reduce) {
        .article-content img, #lightbox.open, #reading-progress { transition: none; animation: none; }
    }
</style>
@endpush

@push('scripts')
<script>
    function openLightbox(src, alt) {
        const lb = document.getElementById('lightbox');
        const img = document.getElementById('lightbox-img');
        const cap = document.getElementById('lightbox-caption');
        img.src = src;
        img.alt = alt || '';
        if (cap) cap.textContent = alt || '';
        lb.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox(event) {
        if (event && event.target !== document.getElementById('lightbox') && !event.target.closest('button[onclick="closeLightbox()"]')) return;
        const lb = document.getElementById('lightbox');
        lb.classList.remove('open');
        document.body.style.overflow = '';
    }

    function shareArticle(platform) {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(document.title);
        const urls = {
            facebook: `https://www.facebook.com/sharer/sharer.php?u=${url}`,
            line: `https://social-plugins.line.me/lineit/share?url=${url}&text=${title}`
        };
        if (urls[platform]) window.open(urls[platform], '_blank', 'width=600,height=500,noopener');
    }

    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const toast = document.getElementById('copy-toast');
            if (toast) {
                toast.style.opacity = '1';
                setTimeout(() => toast.style.opacity = '0', 2200);
            }
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('lightbox').classList.remove('open');
            document.body.style.overflow = '';
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        /* --- Lightbox --- */
        document.querySelectorAll('.article-content img').forEach(function(img) {
            img.addEventListener('click', function() { openLightbox(img.src, img.alt); });
        });

        /* --- Reading Time --- */
        const articleText = document.querySelector('.article-content')?.innerText || '';
        const wordCount = articleText.replace(/\s+/g, ' ').trim().split(' ').length;
        const readMin = Math.max(1, Math.ceil(wordCount / 200));
        const rtText = `ประมาณ ${readMin} นาที`;
        const heroRt = document.getElementById('reading-time-text');
        const sideRt = document.getElementById('sidebar-reading-time');
        if (heroRt) heroRt.textContent = rtText;
        if (sideRt) sideRt.textContent = rtText;

        /* --- Reading Progress Bar --- */
        const bar = document.getElementById('reading-progress');
        const article = document.querySelector('article');
        function updateProgress() {
            if (!article || !bar) return;
            const rect = article.getBoundingClientRect();
            const total = article.offsetHeight - window.innerHeight;
            const scrolled = -rect.top;
            const pct = Math.min(100, Math.max(0, (scrolled / total) * 100));
            bar.style.width = pct + '%';
        }
        window.addEventListener('scroll', updateProgress, { passive: true });

        /* --- Hero Ken Burns --- */
        setTimeout(() => {
            const heroBg = document.getElementById('hero-bg');
            if (heroBg) heroBg.style.transform = 'scale(1)';
        }, 100);

        /* --- Table of Contents --- */
        const headings = document.querySelectorAll('.article-content h2, .article-content h3');
        const tocCard = document.getElementById('toc-card');
        const tocList = document.getElementById('toc-list');
        if (headings.length >= 2 && tocCard && tocList) {
            tocCard.classList.remove('hidden');
            headings.forEach((h, i) => {
                if (!h.id) h.id = 'section-' + i;
                const a = document.createElement('a');
                a.href = '#' + h.id;
                a.className = 'toc-link' + (h.tagName === 'H3' ? ' toc-h3' : '');
                a.textContent = h.textContent;
                a.addEventListener('click', e => {
                    e.preventDefault();
                    h.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
                tocList.appendChild(a);
            });

            /* Active TOC highlight */
            const tocLinks = tocList.querySelectorAll('.toc-link');
            const io = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    const link = tocList.querySelector(`a[href="#${entry.target.id}"]`);
                    if (link) link.classList.toggle('active', entry.isIntersecting);
                });
            }, { rootMargin: '-10% 0px -75% 0px' });
            headings.forEach(h => io.observe(h));
        }
    });
</script>
@endpush
@endsection
