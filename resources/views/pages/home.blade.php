@extends('layouts.app')

@section('title', config('app.name') . ' — เว็บไซต์โรงเรียน')
@section('description', 'ยินดีต้อนรับสู่เว็บไซต์ ' . config('app.name'))

@push('styles')
<style>
    :root {
        --navy: #27456B;
        --navy-dark: #1a2f4a;
        --navy-light: #3a5f8a;
        --emerald: #10B981;
        --emerald-dark: #059669;
        --gold: #F59E0B;
    }

    /* ── Hero ── */
    .hero-slide-img { transform: scale(1.04); transition: transform 8s ease-out; }
    .hero-slide-img.active { transform: scale(1.10); }
    @keyframes heroProgress { from { width: 0% } to { width: 100% } }
    .hero-progress-bar { animation: heroProgress 6s linear forwards; }

    /* ── Section accents ── */
    .section-pill {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 11px; font-weight: 700; letter-spacing: .1em;
        text-transform: uppercase; padding: 5px 14px;
        border-radius: 999px;
    }
    .divider-line {
        display: block; width: 48px; height: 3px;
        border-radius: 2px; margin-top: 10px;
        background: linear-gradient(90deg, var(--emerald), #34D399);
    }

    /* ── Cards ── */
    .policy-card { transition: transform .35s ease, box-shadow .35s ease; }
    .policy-card:hover { transform: translateY(-6px); box-shadow: 0 24px 48px -12px rgba(0,0,0,.12); }

    .news-card { transition: transform .3s ease, box-shadow .3s ease; }
    .news-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -10px rgba(0,0,0,.1); }

    /* ── Stats counter ── */
    .stat-block { background: linear-gradient(135deg, #F0F7FF 0%, #fff 100%); }
    .stat-block.accent-stat { background: linear-gradient(135deg, #ECFDF5 0%, #fff 100%); }

    /* ── Systems grid ── */
    .system-tile {
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.1);
        transition: background .3s ease, border-color .3s ease, transform .3s ease, box-shadow .3s ease;
    }
    .system-tile:hover {
        background: rgba(255,255,255,.18);
        border-color: rgba(255,255,255,.25);
        transform: translateY(-4px);
        box-shadow: 0 16px 32px rgba(0,0,0,.15);
    }

    /* ── PR cards ── */
    .pr-card { transition: transform .3s ease, box-shadow .3s ease; }
    .pr-card:hover { transform: translateY(-5px); box-shadow: 0 22px 44px -10px rgba(0,0,0,.13); }
    .pr-card:hover .pr-img { transform: scale(1.07); }
    .pr-img { transition: transform .5s ease; }

    /* ── Contact ── */
    .contact-row { transition: transform .25s ease, box-shadow .25s ease; }
    .contact-row:hover { transform: translateY(-2px); box-shadow: 0 8px 24px -6px rgba(0,0,0,.08); }

    /* ── Floating badge ── */
    @keyframes floatBadge { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
    .float-badge { animation: floatBadge 5s ease-in-out infinite; }

    /* ── Pattern ── */
    .dots-pattern {
        background-image: radial-gradient(circle, rgba(39,69,107,.06) 1px, transparent 1px);
        background-size: 22px 22px;
    }
</style>
@endpush

@section('content')

{{-- ===== 1. HERO SLIDER ===== --}}
<section aria-label="แบนเนอร์หลัก" x-data="heroSlider()" x-init="start()" class="relative overflow-hidden h-[600px] md:h-[700px]" style="background-color:#0d1b2e;">

    @if($sliderPosts->isNotEmpty())
        {{-- Slides: News Posts --}}
        @foreach($sliderPosts as $i => $post)
        <div x-show="current === {{ $i }}"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-700"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0"
             x-cloak>
            {{-- Background image --}}
            <div class="absolute inset-0 overflow-hidden">
                <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}"
                     class="w-full h-full object-cover hero-slide-img"
                     :class="current === {{ $i }} ? 'active' : ''"
                     style="transform-origin: center center;">
            </div>
            {{-- Cinematic layered overlay --}}
            <div class="absolute inset-0" style="background: linear-gradient(105deg, rgba(13,27,46,0.92) 0%, rgba(13,27,46,0.65) 50%, rgba(13,27,46,0.20) 100%);"></div>
            <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(13,27,46,0.75) 0%, transparent 55%);"></div>
            {{-- Accent left stripe --}}
            <div class="absolute top-0 left-0 bottom-0 w-1" style="background: linear-gradient(to bottom, var(--emerald), transparent);"></div>

            {{-- Content --}}
            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-14 w-full">
                    <div class="max-w-2xl"
                         x-show="current === {{ $i }}"
                         x-transition:enter="transition ease-out duration-700 delay-150"
                         x-transition:enter-start="opacity-0 translate-y-8"
                         x-transition:enter-end="opacity-100 translate-y-0">

                        {{-- School label --}}
                        <div class="flex items-center gap-3 mb-4">
                            <span class="section-pill text-white/90" style="background: rgba(16,185,129,0.18); border: 1px solid rgba(16,185,129,0.35);">
                                <svg class="w-3 h-3 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z"/></svg>
                                @if($post->category){{ $post->category->name }}@else โรงเรียนพลาธิการทหารเรือ @endif
                            </span>
                            @if($post->published_at)
                            <span class="text-white/40 text-xs flex items-center gap-1.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $post->published_at->translatedFormat('d F Y') }}
                            </span>
                            @endif
                        </div>

                        <h1 class="text-[29px] font-bold text-white mb-5 leading-[1.2] line-clamp-3"
                            style="text-shadow: 0 2px 20px rgba(0,0,0,0.4); font-family: 'Kanit', sans-serif;">
                            {{ $post->title }}
                        </h1>

                        @if($post->excerpt)
                        <p class="text-white/60 text-base md:text-lg mb-8 leading-relaxed line-clamp-2 max-w-xl">
                            {{ $post->excerpt }}
                        </p>
                        @endif

                        <div class="flex items-center gap-4 flex-wrap">
                            <a href="{{ route('news.show', $post->slug) }}"
                               class="inline-flex items-center gap-2.5 px-7 py-3.5 font-semibold rounded-xl transition-all duration-200 cursor-pointer hover:-translate-y-0.5 group text-white shadow-lg"
                               style="background: var(--emerald);">
                                <span data-translate="homeReadMore">อ่านเพิ่มเติม</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                            <a href="{{ route('news') }}"
                               class="inline-flex items-center gap-2 px-6 py-3.5 text-white/80 hover:text-white font-medium rounded-xl border border-white/20 hover:border-white/40 backdrop-blur-sm transition-all duration-200">
                                <span data-translate="homeViewAll">ดูทั้งหมด</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Slide Navigation --}}
        @if($sliderPosts->count() > 1)
        <button @click="prev()" class="absolute left-4 md:left-7 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full flex items-center justify-center transition-all duration-200 cursor-pointer backdrop-blur-sm text-white" style="background:rgba(255,255,255,0.10); border:1px solid rgba(255,255,255,0.15);" onmouseover="this.style.background='rgba(255,255,255,0.22)'" onmouseout="this.style.background='rgba(255,255,255,0.10)'" aria-label="สไลด์ก่อนหน้า">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button @click="next()" class="absolute right-4 md:right-7 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full flex items-center justify-center transition-all duration-200 cursor-pointer backdrop-blur-sm text-white" style="background:rgba(255,255,255,0.10); border:1px solid rgba(255,255,255,0.15);" onmouseover="this.style.background='rgba(255,255,255,0.22)'" onmouseout="this.style.background='rgba(255,255,255,0.10)'" aria-label="สไลด์ถัดไป">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
        </button>

        {{-- Bottom bar --}}
        <div class="absolute bottom-0 left-0 right-0 z-20 px-6 sm:px-10 lg:px-14 pb-8 pt-20" style="background:linear-gradient(to top, rgba(13,27,46,0.7) 0%, transparent 100%);">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-6">
                <div class="flex items-center gap-2">
                    @foreach($sliderPosts as $i => $post)
                    <button @click="goTo({{ $i }})"
                            class="relative h-[3px] rounded-full overflow-hidden cursor-pointer transition-all duration-500 focus:outline-none"
                            :class="current === {{ $i }} ? 'w-12 bg-white/20' : 'w-3 bg-white/25 hover:bg-white/40'"
                            aria-label="สไลด์ที่ {{ $i + 1 }}">
                        <span x-show="current === {{ $i }}" class="absolute inset-y-0 left-0 rounded-full hero-progress-bar" style="background:var(--emerald);"></span>
                    </button>
                    @endforeach
                </div>
                <div class="hidden md:flex items-center gap-1.5 text-white/40 text-sm font-mono tracking-wider">
                    <span class="text-white font-bold text-lg leading-none" x-text="String(current + 1).padStart(2, '0')"></span>
                    <span class="text-white/20 text-xs">/</span>
                    <span x-text="String(total).padStart(2, '0')"></span>
                </div>
            </div>
        </div>
        @endif

    @elseif($banners->isNotEmpty())
        {{-- Slides: Banners --}}
        @foreach($banners as $i => $banner)
        <div x-show="current === {{ $i }}"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-700"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0"
             x-cloak>
            <div class="absolute inset-0 overflow-hidden">
                <img src="{{ $banner->image_url }}" alt="{{ $banner->title ?? config('app.name') }}"
                     class="w-full h-full object-cover hero-slide-img"
                     :class="current === {{ $i }} ? 'active' : ''">
            </div>
            <div class="absolute inset-0" style="background: linear-gradient(105deg, rgba(13,27,46,0.90) 0%, rgba(13,27,46,0.60) 50%, rgba(13,27,46,0.15) 100%);"></div>
            <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(13,27,46,0.70) 0%, transparent 55%);"></div>
            <div class="absolute top-0 left-0 bottom-0 w-1" style="background: linear-gradient(to bottom, var(--emerald), transparent);"></div>

            @if($banner->title || $banner->subtitle)
            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-14 w-full">
                    <div class="max-w-2xl"
                         x-show="current === {{ $i }}"
                         x-transition:enter="transition ease-out duration-700 delay-150"
                         x-transition:enter-start="opacity-0 translate-y-8"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        @if($banner->title)
                        <h1 class="text-3xl md:text-4xl lg:text-[42px] font-bold text-white mb-5 leading-[1.2]"
                            style="text-shadow: 0 2px 20px rgba(0,0,0,0.4); font-family: 'Kanit', sans-serif;">
                            {{ $banner->title }}
                        </h1>
                        @endif
                        @if($banner->subtitle)
                        <p class="text-white/60 text-base md:text-lg mb-8 leading-relaxed max-w-xl">
                            {{ $banner->subtitle }}
                        </p>
                        @endif
                        @if($banner->button_text && $banner->button_url)
                        <a href="{{ $banner->button_url }}"
                           class="inline-flex items-center gap-2.5 px-7 py-3.5 font-semibold rounded-xl text-white transition-all duration-200 cursor-pointer hover:-translate-y-0.5 group shadow-lg"
                           style="background: var(--emerald); box-shadow: 0 8px 24px rgba(16,185,129,0.35);">
                            {{ $banner->button_text }}
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endforeach

        @if($banners->count() > 1)
        <button @click="prev()" class="absolute left-4 md:left-7 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full flex items-center justify-center transition-all duration-200 cursor-pointer backdrop-blur-sm text-white" style="background:rgba(255,255,255,0.10); border:1px solid rgba(255,255,255,0.15);" aria-label="สไลด์ก่อนหน้า">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button @click="next()" class="absolute right-4 md:right-7 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full flex items-center justify-center transition-all duration-200 cursor-pointer backdrop-blur-sm text-white" style="background:rgba(255,255,255,0.10); border:1px solid rgba(255,255,255,0.15);" aria-label="สไลด์ถัดไป">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
        </button>
        <div class="absolute bottom-0 left-0 right-0 z-20 px-6 sm:px-10 lg:px-14 pb-8 pt-20" style="background:linear-gradient(to top, rgba(13,27,46,0.7) 0%, transparent 100%);">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-6">
                <div class="flex items-center gap-2">
                    @foreach($banners as $i => $banner)
                    <button @click="goTo({{ $i }})"
                            class="relative h-[3px] rounded-full overflow-hidden cursor-pointer transition-all duration-500 focus:outline-none"
                            :class="current === {{ $i }} ? 'w-12 bg-white/20' : 'w-3 bg-white/25 hover:bg-white/40'"
                            aria-label="สไลด์ที่ {{ $i + 1 }}">
                        <span x-show="current === {{ $i }}" class="absolute inset-y-0 left-0 rounded-full hero-progress-bar" style="background:var(--emerald);"></span>
                    </button>
                    @endforeach
                </div>
                <div class="hidden md:flex items-center gap-1.5 text-white/40 text-sm font-mono tracking-wider">
                    <span class="text-white font-bold text-lg leading-none" x-text="String(current + 1).padStart(2, '0')"></span>
                    <span class="text-white/20 text-xs">/</span>
                    <span x-text="String(total).padStart(2, '0')"></span>
                </div>
            </div>
        </div>
        @endif

    @else
    {{-- Fallback: gradient with school name --}}
    <div class="absolute inset-0">
        <div class="absolute inset-0" style="background: linear-gradient(135deg, #0d1b2e 0%, #27456B 50%, #1a3a5c 100%);"></div>
        <div class="absolute inset-0 dots-pattern opacity-30"></div>
        <div class="absolute top-1/4 right-1/4 w-96 h-96 rounded-full blur-[120px]" style="background:rgba(16,185,129,0.12);"></div>
        <div class="absolute bottom-1/4 left-1/4 w-80 h-80 rounded-full blur-[100px]" style="background:rgba(39,69,107,0.4);"></div>
        <div class="absolute top-0 left-0 bottom-0 w-1" style="background: linear-gradient(to bottom, var(--emerald), transparent);"></div>
        <div class="absolute inset-0 flex items-center">
            <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-14 w-full">
                <div class="max-w-2xl">
                    <div class="section-pill mb-5 text-white/80" style="background: rgba(16,185,129,0.18); border: 1px solid rgba(16,185,129,0.30);">
                        <svg class="w-3 h-3" style="color:var(--emerald);" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/></svg>
                        สถาบันการศึกษา
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-5 leading-tight"
                        style="text-shadow: 0 4px 30px rgba(0,0,0,0.3); font-family: 'Kanit', sans-serif;">
                        {{ config('app.name') }}
                    </h1>
                    <div class="w-14 h-[3px] mb-6 rounded-full" style="background:var(--emerald);"></div>
                    <p class="text-white/60 text-lg md:text-xl max-w-lg leading-relaxed" data-translate="homeHeroDefault">
                        มุ่งมั่นพัฒนาผู้เรียนสู่ความเป็นเลิศ
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

</section>

{{-- ===== 2. IMPORTANT POLICIES ===== --}}
<section class="relative py-20 overflow-hidden" aria-labelledby="policies-heading"
         style="background:linear-gradient(160deg,#F8FAFC 0%,#F1F5F9 55%,#E8F5E8 100%);">
    {{-- Animated Background Orbs --}}
    <div class="absolute top-0 left-1/4 w-96 h-96 rounded-full pointer-events-none"
         style="background:radial-gradient(circle,rgba(37,99,235,0.06) 0%,transparent 70%); filter:blur(60px);"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 rounded-full pointer-events-none"
         style="background:radial-gradient(circle,rgba(16,185,129,0.05) 0%,transparent 70%); filter:blur(60px);"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full pointer-events-none"
         style="background:radial-gradient(circle,rgba(0,0,0,0.01) 0%,transparent 70%); filter:blur(40px);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        {{-- Section Header --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-5"
                 style="background:rgba(37,99,235,0.08); color:var(--navy); border:1px solid rgba(37,99,235,0.15);">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944z" clip-rule="evenodd"/></svg>
                <span data-translate="policies_heading">นโยบายสำคัญ</span>
            </div>
            <h2 id="policies-heading" class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-5 leading-tight"
                style="font-family:'Kanit',sans-serif; color:var(--navy);" data-translate="policies_heading">นโยบายสำคัญ</h2>
            <div class="flex items-center justify-center gap-3 mb-5">
                <div class="h-px w-16" style="background:linear-gradient(90deg,transparent,rgba(37,99,235,0.2));"></div>
                <div class="w-2 h-2 rounded-full" style="background:linear-gradient(135deg,#60A5FA,#34D399);"></div>
                <div class="h-px w-16" style="background:linear-gradient(90deg,rgba(37,99,235,0.2),transparent);"></div>
            </div>
            <p class="text-slate-600 text-base max-w-xl mx-auto leading-relaxed" data-translate="policies_desc">นโยบายที่สำคัญในการกำหนดทิศทางและแนวปฏิบัติของหน่วยงาน</p>
        </div>

        {{-- Policy Cards - 3 columns --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

            {{-- Policy 1: Commander-in-Chief --}}
            <div class="group relative overflow-hidden rounded-2xl cursor-pointer transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                 style="background:rgba(255,255,255,0.8); border:1px solid rgba(37,99,235,0.1); backdrop-filter:blur(20px);"
                 data-aos="fade-up" data-aos-delay="100"
                 onmouseover="this.style.background='rgba(255,255,255,0.95)'; this.style.borderColor='rgba(96,165,250,0.3)';"
                 onmouseout="this.style.background='rgba(255,255,255,0.8)'; this.style.borderColor='rgba(37,99,235,0.1)';">
                {{-- Top gradient accent --}}
                <div class="absolute top-0 left-0 right-0 h-0.5 rounded-t-2xl" style="background:linear-gradient(90deg,#2563EB,#60A5FA);"></div>
                {{-- Glow effect --}}
                <div class="absolute -top-10 -right-10 w-40 h-40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                     style="background:radial-gradient(circle,rgba(37,99,235,0.15) 0%,transparent 70%); filter:blur(20px);"></div>

                <div class="p-7">
                    {{-- Logo --}}
                    <div class="flex justify-center mb-6">
                        <div class="w-28 h-28 rounded-2xl flex items-center justify-center"
                             style="background:linear-gradient(135deg,rgba(37,99,235,0.2),rgba(96,165,250,0.1)); border:1px solid rgba(96,165,250,0.2);">
                            <img src="{{ asset('uploads/logonavyhddd.png') }}"
                                 alt="นโยบายผู้บัญชาการทหารเรือ"
                                 class="w-20 h-20 object-contain group-hover:scale-110 transition-transform duration-500 drop-shadow-lg">
                        </div>
                    </div>
                    {{-- Title --}}
                    <h3 class="text-lg font-bold mb-3 leading-snug group-hover:text-blue-600 transition-colors duration-300 text-center" style="color:var(--navy);" data-translate="policy1_title">
                        นโยบายผู้บัญชาการทหารเรือ
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 text-center" data-translate="policy1_desc">
                        นโยบายระดับสูงสุดที่กำหนดทิศทางการปฏิบัติงานของกองทัพเรือไทย พร้อมยุทธศาสตร์การพัฒนาและปฏิรูประบบเพื่อความมั่นคงของชาติ
                    </p>
                    {{-- Footer --}}
                    <div class="flex items-center justify-between pt-4" style="border-top:1px solid rgba(37,99,235,0.08);">
                        <span class="text-xs text-slate-400 flex items-center gap-1.5">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                            15 มี.ค. 2568
                        </span>
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-400 hover:text-white transition-colors duration-300 group/btn">
                            <span data-translate="read_more">อ่านเพิ่มเติม</span>
                            <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Policy 2: Department Director --}}
            <div class="group relative overflow-hidden rounded-2xl cursor-pointer transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                 style="background:rgba(255,255,255,0.8); border:1px solid rgba(217,119,6,0.1); backdrop-filter:blur(20px);"
                 data-aos="fade-up" data-aos-delay="200"
                 onmouseover="this.style.background='rgba(255,255,255,0.95)'; this.style.borderColor='rgba(252,211,77,0.3)';"
                 onmouseout="this.style.background='rgba(255,255,255,0.8)'; this.style.borderColor='rgba(217,119,6,0.1)';">
                <div class="absolute top-0 left-0 right-0 h-0.5 rounded-t-2xl" style="background:linear-gradient(90deg,#D97706,#FCD34D);"></div>
                <div class="absolute -top-10 -right-10 w-40 h-40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                     style="background:radial-gradient(circle,rgba(217,119,6,0.15) 0%,transparent 70%); filter:blur(20px);"></div>

                <div class="p-7">
                    <div class="flex justify-center mb-6">
                        <div class="w-28 h-28 rounded-2xl flex items-center justify-center"
                             style="background:linear-gradient(135deg,rgba(217,119,6,0.2),rgba(252,211,77,0.1)); border:1px solid rgba(252,211,77,0.2);">
                            <img src="{{ asset('uploads/logo.webp') }}"
                                 alt="นโยบายเจ้ากรมพลาธิการทหารเรือ"
                                 class="w-20 h-20 object-contain group-hover:scale-110 transition-transform duration-500 drop-shadow-lg">
                        </div>
                    </div>
                    <h3 class="text-lg font-bold mb-3 leading-snug group-hover:text-amber-600 transition-colors duration-300 text-center" style="color:var(--navy);" data-translate="policy2_title">
                        นโยบายเจ้ากรมพลาธิการทหารเรือ
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 text-center" data-translate="policy2_desc">
                        นโยบายระดับกรมที่เน้นการพัฒนาและปรับปรุงการบริหารจัดการ ส่งเสริมนวัตกรรมและเทคโนโลยีเพื่อเพิ่มประสิทธิภาพการทำงาน
                    </p>
                    <div class="flex items-center justify-between pt-4" style="border-top:1px solid rgba(217,119,6,0.08);">
                        <span class="text-xs text-slate-400 flex items-center gap-1.5">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                            12 มี.ค. 2568
                        </span>
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm font-semibold text-amber-400 hover:text-white transition-colors duration-300 group/btn">
                            <span data-translate="read_more">อ่านเพิ่มเติม</span>
                            <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Policy 3: School Director --}}
            <div class="group relative overflow-hidden rounded-2xl cursor-pointer transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl md:col-span-2 lg:col-span-1"
                 style="background:rgba(255,255,255,0.8); border:1px solid rgba(16,185,129,0.1); backdrop-filter:blur(20px);"
                 data-aos="fade-up" data-aos-delay="300"
                 onmouseover="this.style.background='rgba(255,255,255,0.95)'; this.style.borderColor='rgba(52,211,153,0.3)';"
                 onmouseout="this.style.background='rgba(255,255,255,0.8)'; this.style.borderColor='rgba(16,185,129,0.1)';">
                <div class="absolute top-0 left-0 right-0 h-0.5 rounded-t-2xl" style="background:linear-gradient(90deg,#10B981,#34D399);"></div>
                <div class="absolute -top-10 -right-10 w-40 h-40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                     style="background:radial-gradient(circle,rgba(16,185,129,0.15) 0%,transparent 70%); filter:blur(20px);"></div>

                <div class="p-7">
                    <div class="flex justify-center mb-6">
                        <div class="w-28 h-28 rounded-2xl flex items-center justify-center"
                             style="background:linear-gradient(135deg,rgba(16,185,129,0.2),rgba(52,211,153,0.1)); border:1px solid rgba(52,211,153,0.2);">
                            <img src="{{ asset('uploads/logonavy-150x150.png') }}"
                                 alt="นโยบายผู้อำนวยการโรงเรียนพลาธิการทหารเรือ"
                                 class="w-20 h-20 object-contain group-hover:scale-110 transition-transform duration-500 drop-shadow-lg">
                        </div>
                    </div>
                    <h3 class="text-lg font-bold mb-3 leading-snug group-hover:text-emerald-600 transition-colors duration-300 text-center" style="color:var(--navy);" data-translate="policy3_title">
                        นโยบายผู้อำนวยการโรงเรียนพลาธิการทหารเรือ
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 text-center" data-translate="policy3_desc">
                        นโยบายเฉพาะของโรงเรียนที่สอดคล้องกับภารกิจและเป้าหมาย มุ่งเน้นการพัฒนาคุณภาพการศึกษาและการสร้างบุคลากรที่มีความสามารถ
                    </p>
                    <div class="flex items-center justify-between pt-4" style="border-top:1px solid rgba(16,185,129,0.08);">
                        <span class="text-xs text-slate-400 flex items-center gap-1.5">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                            8 มี.ค. 2568
                        </span>
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-400 hover:text-white transition-colors duration-300 group/btn">
                            <span data-translate="read_more">อ่านเพิ่มเติม</span>
                            <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- ===== 3. ABOUT / QA SECTION ===== --}}
<section class="py-20 relative overflow-hidden" style="background:#F8FAFC;" aria-labelledby="about-heading">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full blur-[140px] pointer-events-none" style="background:rgba(39,69,107,0.05);"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 rounded-full blur-[120px] pointer-events-none" style="background:rgba(16,185,129,0.04);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Left: Text content --}}
            <div data-aos="fade-right">
                <span class="section-pill mb-5" style="background:rgba(16,185,129,0.10); color:var(--emerald);">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    การประกันคุณภาพการศึกษา
                </span>

                <h2 id="about-heading" class="text-3xl md:text-[36px] font-bold mb-5 leading-tight" style="color:var(--navy); font-family:'Kanit',sans-serif;">
                    สำนักงานรับรองมาตรฐาน<br>และประเมินคุณภาพการศึกษา<br>
                    <span class="text-xl font-medium" style="color:#64748B;">(องค์การมหาชน)</span>
                </h2>
                <p class="text-slate-600 text-base leading-relaxed mb-8">
                    เพื่อรับรองว่า <strong style="color:var(--navy);">"โรงเรียนพลาธิการ กรมพลาธิการทหารเรือ"</strong> ได้รับการประกันคุณภาพภายนอก
                </p>


                <a href="{{ route('about.history') }}"
                   class="inline-flex items-center gap-2.5 px-7 py-3.5 text-white font-semibold rounded-xl transition-all duration-200 cursor-pointer hover:-translate-y-0.5 group shadow-lg"
                   style="background:var(--navy); box-shadow:0 8px 24px rgba(39,69,107,0.25);">
                    <span data-translate="homeReadMore">อ่านเพิ่มเติม</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            {{-- Right: Certificate image --}}
            <div class="relative" data-aos="fade-left" data-aos-delay="150">
                <div class="rounded-3xl overflow-hidden shadow-2xl border border-slate-100" style="background:#fff;">
                    <img src="{{ asset('uploads/ONESQA_Certificate_of_Assessment_H89500_1.png') }}"
                         alt="ใบรับรองคุณภาพการศึกษา" class="w-full h-full object-contain">
                </div>
                {{-- Floating สมศ. badge --}}
                <div class="absolute -bottom-5 -left-5 bg-white rounded-2xl shadow-xl px-5 py-4 hidden md:flex items-center gap-4 float-badge border border-slate-100">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(16,185,129,0.12);">
                        <svg class="w-5 h-5" style="color:var(--emerald);" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-sm" style="color:var(--navy);">สมศ.</p>
                        <p class="text-xs text-slate-400 leading-snug max-w-[160px]">สำนักงานรับรองมาตรฐานและประเมินคุณภาพการศึกษา</p>
                    </div>
                </div>
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full blur-2xl pointer-events-none" style="background:rgba(16,185,129,0.15);"></div>
            </div>
        </div>
    </div>
</section>


{{-- ===== 4. LATEST NEWS ===== --}}
<section aria-labelledby="news-heading" style="background:#ffffff;">

    @if($latestPosts->isNotEmpty())
    @php
        $featuredPost   = $latestPosts->first();
        $importantPosts = $latestPosts->skip(1)->take(2);
        $generalPosts   = $latestPosts->skip(3)->take(2);
    @endphp

    {{-- TOP: White hero area --}}
    <div class="bg-white pt-16 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header Row --}}
            <div class="flex items-center justify-between mb-8" data-aos="fade-up">
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-lg" style="background:rgba(26,42,78,0.08); color:#1a2a4e;">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"/><path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"/></svg>
                    </div>
                    <h2 id="news-heading" class="text-2xl font-semibold" style="color:#1a2a4e; font-family:'Kanit',sans-serif;" data-translate="homeNewsLabel">ข่าวสารล่าสุด</h2>
                </div>
                <a href="{{ route('news') }}"
                   class="flex items-center gap-2 px-5 py-2 rounded-full text-sm font-medium text-white transition-opacity hover:opacity-90"
                   style="background:#d4a035;">
                    <span data-translate="homeViewAllNews">ดูทั้งหมด</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>

            {{-- Featured Post: horizontal card (overlaps down into navy) --}}
            <div data-aos="fade-up" class="relative z-10 -mb-32">
                <article class="group rounded-xl shadow-xl overflow-hidden flex flex-col md:flex-row">
                    {{-- Image side with navy overlay --}}
                    <a href="{{ route('news.show', $featuredPost->slug) }}" class="md:w-3/5 block relative overflow-hidden" style="min-height:400px; background:#1a2a4e;">
                        @if($featuredPost->cover_image_url)
                        <img src="{{ $featuredPost->cover_image_url }}" alt="{{ $featuredPost->title }}"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        @endif
                    </a>
                    {{-- Content side --}}
                    <div class="md:w-2/5 p-10 flex flex-col justify-center bg-white">
                        @if($featuredPost->category)
                        <span class="text-xs font-bold uppercase tracking-widest mb-3 block" style="color:#d4a035;">
                            {{ $featuredPost->category->name }}
                        </span>
                        @endif
                        <a href="{{ route('news.show', $featuredPost->slug) }}">
                            <h3 class="text-2xl font-semibold leading-snug mb-5 transition-colors duration-200 group-hover:opacity-80 line-clamp-3"
                                style="color:#1a2a4e; font-family:'Kanit',sans-serif;">
                                {{ $featuredPost->title }}
                            </h3>
                        </a>
                        @if($featuredPost->excerpt)
                        <p class="text-sm leading-relaxed mb-5 line-clamp-2" style="color:#6b7280;">{{ $featuredPost->excerpt }}</p>
                        @endif
                        <div class="flex items-center gap-2 text-sm" style="color:#9ca3af;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <time datetime="{{ $featuredPost->published_at->toIso8601String() }}">
                                {{ $featuredPost->published_at?->translatedFormat('d F Y') ?? '' }}
                            </time>
                        </div>
                    </div>
                </article>
            </div>

        </div>
    </div>

    {{-- BOTTOM: Navy dark grid area --}}
    <div class="pb-32 pt-40" style="background:#1a2a4e;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                {{-- Column 1: ข่าวสำคัญ --}}
                <section data-aos="fade-up">
                    <div class="flex items-center justify-between mb-8 pb-4" style="border-bottom:1px solid rgba(255,255,255,0.12);">
                        <h2 class="text-2xl font-medium text-white" style="font-family:'Kanit',sans-serif;" data-translate="homeImportantNews">ข่าวสำคัญ</h2>
                        <a href="{{ route('news') }}"
                           class="flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-medium text-white transition-opacity hover:opacity-90"
                           style="background:#d4a035;">
                            <span data-translate="homeViewAllNews">ดูทั้งหมด</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($importantPosts as $post)
                        <article class="flex flex-col group cursor-pointer">
                            <a href="{{ route('news.show', $post->slug) }}" class="flex flex-col h-full">
                                <div class="rounded-lg overflow-hidden mb-3 aspect-video bg-slate-700">
                                    @if($post->cover_image_url)
                                    <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center" style="background:rgba(255,255,255,0.05);">
                                        <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                                <h4 class="text-white text-sm font-light leading-relaxed mb-3 line-clamp-2 flex-1 group-hover:text-yellow-300 transition-colors duration-200"
                                    style="font-family:'Kanit',sans-serif;">
                                    {{ $post->title }}
                                </h4>
                                <div class="flex items-center gap-4 text-xs mt-auto" style="color:#9ca3af;">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <time datetime="{{ $post->published_at->toIso8601String() }}">{{ $post->published_at?->translatedFormat('d F Y') ?? '' }}</time>
                                    </span>
                                </div>
                            </a>
                        </article>
                        @endforeach
                    </div>
                </section>

                {{-- Column 2: ข่าวทั่วไป --}}
                <section data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center justify-between mb-8 pb-4" style="border-bottom:1px solid rgba(255,255,255,0.12);">
                        <h2 class="text-2xl font-medium text-white" style="font-family:'Kanit',sans-serif;" data-translate="homeGeneralNews">ข่าวทั่วไป</h2>
                        <a href="{{ route('news') }}"
                           class="flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-medium text-white transition-opacity hover:opacity-90"
                           style="background:#d4a035;">
                            <span data-translate="homeViewAllNews">ดูทั้งหมด</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($generalPosts as $post)
                        <article class="flex flex-col group cursor-pointer">
                            <a href="{{ route('news.show', $post->slug) }}" class="flex flex-col h-full">
                                <div class="rounded-lg overflow-hidden mb-3 aspect-video bg-slate-700">
                                    @if($post->cover_image_url)
                                    <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center" style="background:rgba(255,255,255,0.05);">
                                        <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                                <h4 class="text-white text-sm font-light leading-relaxed mb-3 line-clamp-2 flex-1 group-hover:text-yellow-300 transition-colors duration-200"
                                    style="font-family:'Kanit',sans-serif;">
                                    {{ $post->title }}
                                </h4>
                                <div class="flex items-center gap-4 text-xs mt-auto" style="color:#9ca3af;">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <time datetime="{{ $post->published_at->toIso8601String() }}">{{ $post->published_at?->translatedFormat('d F Y') ?? '' }}</time>
                                    </span>
                                </div>
                            </a>
                        </article>
                        @endforeach
                    </div>
                </section>

            </div>
        </div>
    </div>

    @else
    {{-- Empty state --}}
    <div class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center py-16 text-slate-400" data-aos="fade-up">
                <div class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-slate-100 flex items-center justify-center">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium" data-translate="homeNoNews">ยังไม่มีข่าวสาร</p>
            </div>
        </div>
    </div>
    @endif

</section>

{{-- ===== 4.5 PR / ANNOUNCEMENTS ===== --}}
<section class="py-20 relative overflow-hidden" aria-labelledby="pr-heading" style="background:#F8FAFC;">
    <div class="absolute top-0 left-0 w-96 h-96 rounded-full blur-[140px] -translate-x-1/2 -translate-y-1/2 pointer-events-none" style="background:rgba(26,42,78,0.05);"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full blur-[140px] translate-x-1/2 translate-y-1/2 pointer-events-none" style="background:rgba(212,160,53,0.07);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        {{-- Section Header --}}
        <div class="flex items-end justify-between mb-10" data-aos="fade-up">
            <div>
                <span class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full mb-3" style="background:rgba(26,42,78,0.08); color:#1a2a4e;">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" clip-rule="evenodd"/></svg>
                    <span data-translate="homePRLabel">ประชาสัมพันธ์</span>
                </span>
                <h2 id="pr-heading" class="text-3xl font-bold leading-tight" style="color:#1a2a4e; font-family:'Kanit',sans-serif;" data-translate="homePRTitle">ข่าวประชาสัมพันธ์</h2>
            </div>
            {{-- Nav Buttons --}}
            <div class="hidden sm:flex items-center gap-2">
                <button id="pr-prev" aria-label="Previous"
                    class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all duration-200"
                    style="border-color:#1a2a4e; color:#1a2a4e;"
                    onmouseover="this.style.background='#1a2a4e'; this.style.color='#fff';"
                    onmouseout="this.style.background='transparent'; this.style.color='#1a2a4e';">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button id="pr-next" aria-label="Next"
                    class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-200 text-white"
                    style="background:#1a2a4e;"
                    onmouseover="this.style.background='#d4a035';"
                    onmouseout="this.style.background='#1a2a4e';">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        {{-- Carousel Viewport --}}
        <div class="overflow-hidden" id="pr-viewport" data-aos="fade-up" data-aos-delay="100">
            <div id="pr-track" class="flex gap-6 transition-transform duration-500 ease-in-out will-change-transform">

                {{-- Card 1: Manual --}}
                <div class="pr-slide flex-shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 flex flex-col h-full border border-slate-100 hover:border-transparent">
                        <div class="relative overflow-hidden flex-shrink-0" style="aspect-ratio:16/9; background:#F0F4FF;">
                            <img src="{{ asset('uploads/คู่มือ.gif') }}" alt="คู่มือนักเรียนจ่าพรคคพิเศษ" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background:linear-gradient(to top, rgba(26,42,78,0.6), transparent);"></div>
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center gap-1 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-md" style="background:#1a2a4e;">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/></svg>
                                    <span data-translate="homePRManual">คู่มือ</span>
                                </span>
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="text-sm font-bold leading-snug mb-4 flex-1" style="color:#1E293B; font-family:'Kanit',sans-serif;">คู่มือนักเรียนจ่าพรคคพิเศษ เหล่าทหารพลาธิการ</h3>
                            <div class="flex items-center justify-between pt-3 border-t border-slate-100 mt-auto">
                                <span class="text-xs text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    <span data-translate="homePRDoc">เอกสาร</span>
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1.5 rounded-lg transition-all duration-200 cursor-pointer"
                                      style="color:#1a2a4e; background:rgba(26,42,78,0.07);"
                                      onmouseover="this.style.background='#1a2a4e'; this.style.color='#fff';"
                                      onmouseout="this.style.background='rgba(26,42,78,0.07)'; this.style.color='#1a2a4e';">
                                    <span data-translate="homePRView">ดูรายละเอียด</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Plan --}}
                <div class="pr-slide flex-shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 flex flex-col h-full border border-slate-100 hover:border-transparent">
                        <div class="relative overflow-hidden flex-shrink-0" style="aspect-ratio:16/9; background:#FFFBEB;">
                            <img src="{{ asset('uploads/testwsss.gif') }}" alt="แผนปฏิบัติราชการ" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background:linear-gradient(to top, rgba(217,119,6,0.6), transparent);"></div>
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center gap-1 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-md" style="background:#D97706;">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                                    <span data-translate="homePRPlan">แผนงาน</span>
                                </span>
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="text-sm font-bold leading-snug mb-4 flex-1" style="color:#1E293B; font-family:'Kanit',sans-serif;">แผนปฏิบัติราชการประจำปีการศึกษา</h3>
                            <div class="flex items-center justify-between pt-3 border-t border-slate-100 mt-auto">
                                <span class="text-xs text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    <span data-translate="homePRDoc">เอกสาร</span>
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1.5 rounded-lg transition-all duration-200 cursor-pointer"
                                      style="color:#D97706; background:rgba(217,119,6,0.08);"
                                      onmouseover="this.style.background='#D97706'; this.style.color='#fff';"
                                      onmouseout="this.style.background='rgba(217,119,6,0.08)'; this.style.color='#D97706';">
                                    <span data-translate="homePRView">ดูรายละเอียด</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 3: QA --}}
                <div class="pr-slide flex-shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 flex flex-col h-full border border-slate-100 hover:border-transparent">
                        <div class="relative overflow-hidden flex-shrink-0" style="aspect-ratio:16/9; background:#ECFDF5;">
                            <img src="{{ asset('uploads/งานประกันรร.พธ.gif') }}" alt="งานประกันคุณภาพ" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background:linear-gradient(to top, rgba(16,185,129,0.6), transparent);"></div>
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center gap-1 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-md" style="background:#10B981;">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    <span data-translate="homePRQA">ประกันคุณภาพ</span>
                                </span>
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="text-sm font-bold leading-snug mb-4 flex-1" style="color:#1E293B; font-family:'Kanit',sans-serif;">งานประกันคุณภาพ</h3>
                            <div class="flex items-center justify-between pt-3 border-t border-slate-100 mt-auto">
                                <span class="text-xs text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    <span data-translate="homePRDoc">เอกสาร</span>
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1.5 rounded-lg transition-all duration-200 cursor-pointer"
                                      style="color:#10B981; background:rgba(16,185,129,0.08);"
                                      onmouseover="this.style.background='#10B981'; this.style.color='#fff';"
                                      onmouseout="this.style.background='rgba(16,185,129,0.08)'; this.style.color='#10B981';">
                                    <span data-translate="homePRView">ดูรายละเอียด</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 4: Exam --}}
                <div class="pr-slide flex-shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 flex flex-col h-full border border-slate-100 hover:border-transparent">
                        <div class="relative overflow-hidden flex-shrink-0" style="aspect-ratio:16/9; background:#F5F3FF;">
                            <img src="{{ asset('uploads/เอกสารสอบจัดอันดับ.gif') }}" alt="เอกสารสอบจัดอันดับ" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background:linear-gradient(to top, rgba(124,58,237,0.6), transparent);"></div>
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center gap-1 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-md" style="background:#7C3AED;">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                                    <span data-translate="homePRExam">การสอบ</span>
                                </span>
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="text-sm font-bold leading-snug mb-4 flex-1" style="color:#1E293B; font-family:'Kanit',sans-serif;">เอกสารสอบจัดอันดับ</h3>
                            <div class="flex items-center justify-between pt-3 border-t border-slate-100 mt-auto">
                                <span class="text-xs text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    <span data-translate="homePRDoc">เอกสาร</span>
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1.5 rounded-lg transition-all duration-200 cursor-pointer"
                                      style="color:#7C3AED; background:rgba(124,58,237,0.08);"
                                      onmouseover="this.style.background='#7C3AED'; this.style.color='#fff';"
                                      onmouseout="this.style.background='rgba(124,58,237,0.08)'; this.style.color='#7C3AED';">
                                    <span data-translate="homePRView">ดูรายละเอียด</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 5: Admission --}}
                <div class="pr-slide flex-shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 flex flex-col h-full border border-slate-100 hover:border-transparent">
                        <div class="relative overflow-hidden flex-shrink-0" style="aspect-ratio:16/9; background:#FFF1F2;">
                            <img src="{{ asset('uploads/คำแนะนำ.png') }}" alt="คำแนะนำรับสมัคร" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background:linear-gradient(to top, rgba(225,29,72,0.6), transparent);"></div>
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center gap-1 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-md" style="background:#E11D48;">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                                    <span data-translate="homePRAdmission">การรับสมัคร</span>
                                </span>
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="text-sm font-bold leading-snug mb-4 flex-1" style="color:#1E293B; font-family:'Kanit',sans-serif;">คำแนะนำรับสมัครบุคคลเพื่อสอบคัดเลือกเข้าเป็นนักเรียนจ่าทหารเรือ</h3>
                            <div class="flex items-center justify-between pt-3 border-t border-slate-100 mt-auto">
                                <span class="text-xs text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    <span data-translate="homePRDoc">เอกสาร</span>
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1.5 rounded-lg transition-all duration-200 cursor-pointer"
                                      style="color:#E11D48; background:rgba(225,29,72,0.08);"
                                      onmouseover="this.style.background='#E11D48'; this.style.color='#fff';"
                                      onmouseout="this.style.background='rgba(225,29,72,0.08)'; this.style.color='#E11D48';">
                                    <span data-translate="homePRView">ดูรายละเอียด</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Dot Indicators --}}
        <div id="pr-dots" class="flex items-center justify-center gap-2 mt-8">
            <button class="pr-dot w-2.5 h-2.5 rounded-full transition-all duration-300" style="background:#1a2a4e;" data-index="0" aria-label="Slide 1"></button>
            <button class="pr-dot w-2 h-2 rounded-full transition-all duration-300" style="background:#cbd5e1;" data-index="1" aria-label="Slide 2"></button>
            <button class="pr-dot w-2 h-2 rounded-full transition-all duration-300" style="background:#cbd5e1;" data-index="2" aria-label="Slide 3"></button>
        </div>

    </div>
</section>

@push('scripts')
<script>
(function() {
    const track    = document.getElementById('pr-track');
    const viewport = document.getElementById('pr-viewport');
    const slides   = Array.from(document.querySelectorAll('.pr-slide'));
    const dots     = Array.from(document.querySelectorAll('.pr-dot'));
    const btnPrev  = document.getElementById('pr-prev');
    const btnNext  = document.getElementById('pr-next');

    if (!track || !slides.length) return;

    let current = 0;
    let autoTimer = null;
    let perView = 3;

    function getPerView() {
        const w = window.innerWidth;
        if (w < 640)  return 1;
        if (w < 1024) return 2;
        return 3;
    }

    function totalSteps() {
        return Math.max(0, slides.length - perView);
    }

    function goTo(index) {
        perView = getPerView();
        const max = totalSteps();
        current = Math.max(0, Math.min(index, max));

        const slideW  = slides[0].getBoundingClientRect().width;
        const gapPx   = 24;
        const offset  = current * (slideW + gapPx);
        track.style.transform = `translateX(-${offset}px)`;

        dots.forEach((d, i) => {
            const active = i === Math.min(current, dots.length - 1);
            d.style.background = active ? '#1a2a4e' : '#cbd5e1';
            d.style.width      = active ? '20px'   : '8px';
            d.style.height     = active ? '8px'    : '8px';
            d.style.borderRadius = '9999px';
        });
    }

    function next() { goTo(current + 1 > totalSteps() ? 0 : current + 1); }
    function prev() { goTo(current - 1 < 0 ? totalSteps() : current - 1); }

    function startAuto() {
        stopAuto();
        autoTimer = setInterval(next, 4000);
    }
    function stopAuto() {
        if (autoTimer) clearInterval(autoTimer);
    }

    btnNext && btnNext.addEventListener('click', () => { next(); startAuto(); });
    btnPrev && btnPrev.addEventListener('click', () => { prev(); startAuto(); });

    dots.forEach(d => {
        d.addEventListener('click', () => { goTo(+d.dataset.index); startAuto(); });
    });

    viewport.addEventListener('mouseenter', stopAuto);
    viewport.addEventListener('mouseleave', startAuto);

    window.addEventListener('resize', () => goTo(0));

    goTo(0);
    startAuto();
})();
</script>
@endpush

{{-- ===== 5. CURRICULUMS ===== --}}
@if($curriculums->isNotEmpty())
<section class="py-20 dots-pattern relative" style="background:#F8FAFC;" aria-labelledby="curriculum-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="section-pill mb-4" style="background:rgba(16,185,129,0.10); color:var(--emerald);">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/></svg>
                <span data-translate="homeCurriculumLabel">การศึกษา</span>
            </span>
            <h2 id="curriculum-heading" class="text-3xl md:text-4xl font-bold" style="color:var(--navy); font-family:'Kanit',sans-serif;" data-translate="homeCurriculumTitle">หลักสูตรของโรงเรียน</h2>
            <span class="divider-line mx-auto"></span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @php
                $levelMap = ['primary' => 'ระดับประถมศึกษา', 'secondary' => 'ระดับมัธยมศึกษาตอนต้น', 'high' => 'ระดับมัธยมศึกษาตอนปลาย'];
                $levelColors = ['primary' => '#2563EB', 'secondary' => '#10B981', 'high' => '#7C3AED'];
            @endphp
            @foreach($curriculums as $idx => $curriculum)
            <div class="policy-card group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm" data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                @if($curriculum->image_url)
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $curriculum->image_url }}" alt="{{ $curriculum->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                @else
                <div class="h-1.5 w-full" style="background: linear-gradient(90deg, {{ $levelColors[$curriculum->level] ?? '#27456B' }}, {{ $levelColors[$curriculum->level] ?? '#27456B' }}70);"></div>
                @endif
                <div class="p-6">
                    <span class="inline-block text-xs font-bold px-3 py-1.5 rounded-full mb-4 text-white shadow-sm"
                          style="background: {{ $levelColors[$curriculum->level] ?? '#27456B' }}">
                        {{ $levelMap[$curriculum->level] ?? $curriculum->level }}
                    </span>
                    <h3 class="text-base font-bold mb-3 leading-snug transition-colors duration-200" style="color:var(--navy); font-family:'Kanit',sans-serif;"
                        onmouseover="this.style.color='{{ $levelColors[$curriculum->level] ?? '#10B981' }}';"
                        onmouseout="this.style.color='#27456B';">{{ $curriculum->name }}</h3>
                    <div class="text-sm text-slate-500 leading-relaxed line-clamp-3">
                        {!! strip_tags($curriculum->description) !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('about.curriculum') }}"
               class="inline-flex items-center gap-2 px-7 py-3.5 font-semibold rounded-xl transition-all duration-200 cursor-pointer hover:-translate-y-0.5 group border-2"
               style="color:var(--navy); border-color:var(--navy);"
               onmouseover="this.style.background='#27456B'; this.style.color='#fff';"
               onmouseout="this.style.background='transparent'; this.style.color='#27456B';">
                <span data-translate="homeViewAllCurriculum">ดูหลักสูตรทั้งหมด</span>
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ===== 6. SCHOOL SYSTEMS ===== --}}
@if($systems->isNotEmpty())
<section class="py-20 relative overflow-hidden" style="background:linear-gradient(135deg, #0d1b2e 0%, #27456B 60%, #1a3a5c 100%);" aria-labelledby="systems-heading">
    <div class="absolute inset-0 dots-pattern opacity-10"></div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full blur-[140px] pointer-events-none" style="background:rgba(16,185,129,0.10);"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 rounded-full blur-[120px] pointer-events-none" style="background:rgba(16,185,129,0.06);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="section-pill mb-4 text-white/80" style="background:rgba(16,185,129,0.15); border:1px solid rgba(16,185,129,0.25);">
                <svg class="w-3.5 h-3.5" style="color:var(--emerald);" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd"/></svg>
                <span data-translate="homeSystemsLabel">ระบบงาน</span>
            </span>
            <h2 id="systems-heading" class="text-3xl md:text-4xl font-bold text-white" style="font-family:'Kanit',sans-serif;" data-translate="homeSystemsTitle">รวมระบบงานออนไลน์</h2>
            <div class="w-12 h-[3px] mx-auto mt-3 mb-4 rounded-full" style="background:var(--emerald);"></div>
            <p class="text-white/50 text-base" data-translate="homeSystemsDesc">เข้าถึงระบบงานต่าง ๆ ได้ที่นี่</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($systems as $idx => $system)
            <a href="{{ $system->url }}"
               @if($system->open_new_tab) target="_blank" rel="noopener noreferrer" @endif
               class="system-tile group flex flex-col items-center gap-3 p-5 rounded-2xl cursor-pointer text-center"
               data-aos="zoom-in" data-aos-delay="{{ ($idx % 6) * 50 }}">
                @if($system->logo)
                <img src="{{ asset('storage/' . $system->logo) }}" alt="{{ $system->name }}" class="w-12 h-12 object-contain group-hover:scale-110 transition-transform duration-300">
                @else
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-xl group-hover:scale-110 transition-transform duration-300"
                     style="background-color: {{ $system->color }}">
                    {{ mb_substr($system->name, 0, 1) }}
                </div>
                @endif
                <span class="text-white/75 group-hover:text-white text-xs font-medium leading-snug transition-colors">{{ $system->name }}</span>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('systems') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-white font-semibold rounded-xl hover:bg-slate-50 transition-all duration-200 cursor-pointer shadow-lg hover:shadow-xl hover:-translate-y-0.5 group"
               style="color:var(--navy);">
                <span data-translate="homeViewAllSystems">ดูระบบงานทั้งหมด</span>
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ===== 7. CONTACT SUMMARY ===== --}}
<section class="py-20 bg-white relative overflow-hidden" aria-labelledby="contact-heading">
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] rounded-full blur-[140px] pointer-events-none" style="background:rgba(16,185,129,0.04);"></div>
    <div class="absolute top-0 left-0 w-96 h-96 rounded-full blur-[120px] pointer-events-none" style="background:rgba(39,69,107,0.03);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="section-pill mb-4" style="background:rgba(16,185,129,0.10); color:var(--emerald);">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                <span data-translate="homeContactLabel">ติดต่อ</span>
            </span>
            <h2 id="contact-heading" class="text-3xl md:text-4xl font-bold" style="color:var(--navy); font-family:'Kanit',sans-serif;" data-translate="homeContactTitle">ติดต่อโรงเรียน</h2>
            <span class="divider-line mx-auto"></span>
        </div>

        @php $contactInfo = \App\Models\ContactInfo::all()->keyBy('key'); @endphp
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            {{-- Contact info --}}
            <div class="space-y-4" data-aos="fade-right">
                @if(isset($contactInfo['address']))
                <div class="contact-row flex items-start gap-4 p-5 rounded-2xl border border-slate-100 cursor-default" style="background:#F8FAFC;">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(16,185,129,0.12);">
                        <svg class="w-5 h-5" style="color:var(--emerald);" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-1" style="color:var(--navy);" data-translate="homeContactAddress">ที่อยู่</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $contactInfo['address']->value }}</p>
                    </div>
                </div>
                @endif

                @if(isset($contactInfo['phone']))
                <a href="tel:{{ $contactInfo['phone']->value }}" class="contact-row flex items-start gap-4 p-5 rounded-2xl border border-slate-100 cursor-pointer group block" style="background:#F8FAFC;">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(16,185,129,0.12);">
                        <svg class="w-5 h-5" style="color:var(--emerald);" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-1" style="color:var(--navy);" data-translate="homeContactPhone">โทรศัพท์</h3>
                        <p class="text-slate-500 text-sm group-hover:text-emerald-600 transition-colors">{{ $contactInfo['phone']->value }}</p>
                    </div>
                </a>
                @endif

                @if(isset($contactInfo['email']))
                <a href="mailto:{{ $contactInfo['email']->value }}" class="contact-row flex items-start gap-4 p-5 rounded-2xl border border-slate-100 cursor-pointer group block" style="background:#F8FAFC;">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(16,185,129,0.12);">
                        <svg class="w-5 h-5" style="color:var(--emerald);" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-1" style="color:var(--navy);" data-translate="homeContactEmail">อีเมล</h3>
                        <p class="text-slate-500 text-sm group-hover:text-emerald-600 transition-colors">{{ $contactInfo['email']->value }}</p>
                    </div>
                </a>
                @endif

                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 px-7 py-3.5 text-white font-semibold rounded-xl transition-all duration-200 cursor-pointer w-full justify-center sm:w-auto hover:-translate-y-0.5 group shadow-lg"
                   style="background:var(--emerald); box-shadow:0 8px 24px rgba(16,185,129,0.30);">
                    <span data-translate="homeSendMsg">ส่งข้อความถึงเรา</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </a>
            </div>

            {{-- Map embed --}}
            <div class="rounded-2xl overflow-hidden border border-slate-100 shadow-lg" style="height:360px; background:#F1F5F9;" data-aos="fade-left" data-aos-delay="150">
                @if(isset($contactInfo['map_url']))
                <iframe src="{{ $contactInfo['map_url']->value }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="แผนที่โรงเรียน"></iframe>
                @else
                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-4" style="background:rgba(39,69,107,0.06);">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-slate-400" data-translate="homeMapPlaceholder">กรุณาเพิ่ม Google Maps URL ในการตั้งค่า</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function heroSlider() {
    return {
        current: 0,
        total: {{ $sliderPosts->isNotEmpty() ? $sliderPosts->count() : ($banners->isNotEmpty() ? $banners->count() : 1) }},
        timer: null,
        start() {
            if (this.total > 1) {
                this.timer = setInterval(() => this.next(), 6000);
            }
        },
        next() { this.current = (this.current + 1) % this.total; },
        prev() { this.current = (this.current - 1 + this.total) % this.total; },
        goTo(i) { this.current = i; clearInterval(this.timer); this.timer = setInterval(() => this.next(), 6000); }
    }
}
</script>
@endpush
