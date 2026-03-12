@extends('layouts.app')

@section('title', config('app.name') . ' — เว็บไซต์โรงเรียน')
@section('description', 'ยินดีต้อนรับสู่เว็บไซต์ ' . config('app.name'))

@section('content')

{{-- ===== 1. HERO SLIDER ===== --}}
<section aria-label="แบนเนอร์หลัก" x-data="heroSlider()" x-init="start()" class="relative overflow-hidden bg-primary h-[540px] md:h-[650px]">
    {{-- Decorative grid pattern --}}
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cpath d=&quot;M60 0H0v60&quot; fill=&quot;none&quot; stroke=&quot;%23fff&quot; stroke-width=&quot;0.5&quot;/%3E%3C/svg%3E');"></div>

    @if($banners->isNotEmpty())
        @foreach($banners as $i => $banner)
        <div x-show="current === {{ $i }}"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 scale-105"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-700"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute inset-0"
             x-cloak>
            <img src="{{ $banner->image_url }}" alt="{{ $banner->title ?? config('app.name') }}"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/90 via-primary/60 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/50 via-transparent to-transparent"></div>
            @if($banner->title || $banner->subtitle)
            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-2xl">
                        @if($banner->title)
                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-5 leading-tight animate-fade-up" style="text-shadow: 0 2px 20px rgba(0,0,0,0.3);">
                            {{ $banner->title }}
                        </h1>
                        @endif
                        @if($banner->subtitle)
                        <p class="text-white/80 text-lg md:text-xl mb-8 leading-relaxed animate-fade-up max-w-xl" style="animation-delay: 0.2s;">
                            {{ $banner->subtitle }}
                        </p>
                        @endif
                        @if($banner->button_text && $banner->button_url)
                        <div class="animate-fade-up" style="animation-delay: 0.4s;">
                            <a href="{{ $banner->button_url }}"
                               class="inline-flex items-center gap-2 px-7 py-3.5 bg-accent hover:bg-accent-dark text-white font-semibold rounded-xl transition-all duration-200 cursor-pointer shadow-xl shadow-accent/30 hover:shadow-accent/50 hover:-translate-y-0.5 group">
                                {{ $banner->button_text }}
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endforeach

        {{-- Slider Controls --}}
        @if($banners->count() > 1)
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex items-center gap-4 z-10">
            <button @click="prev()" class="w-10 h-10 rounded-full glass-dark hover:bg-white/20 text-white flex items-center justify-center transition-all cursor-pointer" aria-label="สไลด์ก่อนหน้า">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <div class="flex gap-2">
                @foreach($banners as $i => $banner)
                <button @click="goTo({{ $i }})"
                        :class="current === {{ $i }} ? 'bg-accent w-8' : 'bg-white/40 w-2 hover:bg-white/60'"
                        class="h-2 rounded-full transition-all duration-500 cursor-pointer"
                        aria-label="ไปยังสไลด์ที่ {{ $i + 1 }}"></button>
                @endforeach
            </div>
            <button @click="next()" class="w-10 h-10 rounded-full glass-dark hover:bg-white/20 text-white flex items-center justify-center transition-all cursor-pointer" aria-label="สไลด์ถัดไป">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
        @endif

        {{-- Slide counter --}}
        @if($banners->count() > 1)
        <div class="absolute bottom-8 right-8 z-10 hidden md:block">
            <span class="text-white/40 text-sm font-mono" x-text="String(current + 1).padStart(2, '0') + ' / ' + String(total).padStart(2, '0')"></span>
        </div>
        @endif
    @else
    <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-primary via-primary-600 to-accent/30">
        <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cpath d=&quot;M60 0H0v60&quot; fill=&quot;none&quot; stroke=&quot;%23fff&quot; stroke-width=&quot;0.5&quot;/%3E%3C/svg%3E');"></div>
        <div class="text-center text-white px-4 relative">
            <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-white/10 flex items-center justify-center animate-float">
                <svg class="w-10 h-10 text-accent-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-4 animate-fade-up">{{ config('app.name') }}</h1>
            <p class="text-white/60 text-xl animate-fade-up" style="animation-delay: 0.2s;">มุ่งมั่นพัฒนาผู้เรียนสู่ความเป็นเลิศ</p>
        </div>
    </div>
    @endif

</section>

{{-- ===== 2. ABOUT SCHOOL SUMMARY ===== --}}
<section class="py-20 bg-white relative overflow-hidden" aria-labelledby="about-heading">
    {{-- Decorative blobs --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-accent/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-primary/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right">
                <p class="text-accent font-semibold text-sm uppercase tracking-wider mb-3 section-label">เกี่ยวกับเรา</p>
                <h2 id="about-heading" class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary mb-6 leading-tight">
                    ยินดีต้อนรับสู่<br><span class="text-gradient">{{ config('app.name') }}</span>
                </h2>
                <p class="text-slate-600 text-lg leading-relaxed mb-8">
                    โรงเรียนของเรามุ่งมั่นในการพัฒนาผู้เรียนให้มีความรู้ ทักษะ และคุณธรรม
                    สร้างสรรค์สังคมที่ดี พร้อมก้าวสู่โลกยุคใหม่อย่างมีคุณภาพ
                </p>
                <div class="grid grid-cols-3 gap-4 mb-10" x-data="{ shown: false }" x-intersect.once="shown = true">
                    <div class="text-center p-5 bg-gradient-to-br from-primary-50 to-white rounded-2xl border border-primary/5 shadow-sm">
                        <div class="text-3xl md:text-4xl font-bold text-primary mb-1" x-data="{ val: 0 }" x-init="if(shown) { let end=50; let dur=2000; let step=dur/end; let i=setInterval(()=>{val++;if(val>=end)clearInterval(i)},step) }" x-text="val + '+'">50+</div>
                        <div class="text-sm text-slate-500 font-medium">ปีที่ก่อตั้ง</div>
                    </div>
                    <div class="text-center p-5 bg-gradient-to-br from-accent/5 to-white rounded-2xl border border-accent/5 shadow-sm">
                        <div class="text-3xl md:text-4xl font-bold text-accent mb-1" x-data="{ val: 0 }" x-init="if(shown) { let end=500; let dur=2000; let step=dur/50; let inc=10; let i=setInterval(()=>{val+=inc;if(val>=end){val=end;clearInterval(i)}},step) }" x-text="val + '+'">500+</div>
                        <div class="text-sm text-slate-500 font-medium">นักเรียน</div>
                    </div>
                    <div class="text-center p-5 bg-gradient-to-br from-primary-50 to-white rounded-2xl border border-primary/5 shadow-sm">
                        <div class="text-3xl md:text-4xl font-bold text-primary mb-1" x-data="{ val: 0 }" x-init="if(shown) { let end=50; let dur=2000; let step=dur/end; let i=setInterval(()=>{val++;if(val>=end)clearInterval(i)},step) }" x-text="val + '+'">50+</div>
                        <div class="text-sm text-slate-500 font-medium">บุคลากร</div>
                    </div>
                </div>
                <a href="{{ route('about.history') }}"
                   class="inline-flex items-center gap-2 px-7 py-3.5 bg-primary text-white font-semibold rounded-xl hover:bg-primary-600 transition-all duration-200 cursor-pointer shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 group">
                    อ่านเพิ่มเติม
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <div class="relative" data-aos="fade-left" data-aos-delay="200">
                <div class="aspect-[4/3] rounded-3xl overflow-hidden bg-slate-100 shadow-2xl shadow-primary/10">
                    <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=800&auto=format&fit=crop&q=80"
                         alt="โรงเรียน" class="w-full h-full object-cover">
                </div>
                {{-- Floating accent card --}}
                <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-xl p-5 border border-slate-100 hidden md:flex items-center gap-4 animate-float">
                    <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-primary text-sm">สถานศึกษาคุณภาพ</p>
                        <p class="text-xs text-slate-500">มาตรฐานการศึกษาระดับดีเยี่ยม</p>
                    </div>
                </div>
                {{-- Decorative elements --}}
                <div class="absolute -top-6 -right-6 w-24 h-24 bg-accent/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-8 right-12 w-32 h-32 bg-gold/10 rounded-full blur-2xl"></div>
            </div>
        </div>
    </div>
</section>

{{-- ===== 3. COMMANDERS ===== --}}
@if($commanders->isNotEmpty())
<section class="py-20 bg-gradient-to-b from-slate-50 to-white relative" aria-labelledby="commanders-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <p class="text-accent font-semibold text-sm uppercase tracking-wider mb-3 section-label section-label-center">ผู้บังคับบัญชา</p>
            <h2 id="commanders-heading" class="text-3xl md:text-4xl font-bold text-primary">ผู้บริหารโรงเรียน</h2>
        </div>
        <div class="flex flex-wrap justify-center gap-10">
            @foreach($commanders as $idx => $person)
            <a href="{{ route('personnel.show', $person->slug) }}"
               class="group text-center cursor-pointer" data-aos="zoom-in" data-aos-delay="{{ $idx * 100 }}">
                <div class="relative mb-5">
                    <div class="w-40 h-40 mx-auto rounded-full overflow-hidden border-4 border-white shadow-xl group-hover:shadow-2xl group-hover:shadow-accent/20 transition-all duration-300">
                        <img src="{{ $person->photo_url }}" alt="{{ $person->full_name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-10 h-1 rounded-full bg-gradient-to-r from-accent to-accent-light opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <h3 class="font-bold text-slate-900 group-hover:text-primary transition-colors duration-200 text-base">{{ $person->full_name }}</h3>
                <p class="text-sm text-slate-500 mt-1">{{ $person->position }}</p>
                @if($person->rank)
                <p class="text-xs text-accent mt-1 font-medium">{{ $person->rank }}</p>
                @endif
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== 4. LATEST NEWS ===== --}}
<section class="py-20 bg-white relative overflow-hidden" aria-labelledby="news-heading">
    <div class="absolute top-0 left-0 w-72 h-72 bg-accent/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex items-end justify-between mb-14" data-aos="fade-up">
            <div>
                <p class="text-accent font-semibold text-sm uppercase tracking-wider mb-3 section-label">ข่าวสารล่าสุด</p>
                <h2 id="news-heading" class="text-3xl md:text-4xl font-bold text-primary">ข่าวสารและประชาสัมพันธ์</h2>
            </div>
            <a href="{{ route('news') }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-accent border border-accent/20 hover:bg-accent hover:text-white transition-all duration-200 cursor-pointer group">
                ดูทั้งหมด
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        @if($latestPosts->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($latestPosts as $idx => $post)
            <article class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden card-hover group cursor-pointer" data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                <a href="{{ route('news.show', $post->slug) }}" class="block">
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
                        <h3 class="font-bold text-slate-900 leading-snug mb-2.5 line-clamp-2 group-hover:text-accent transition-colors duration-200">
                            {{ $post->title }}
                        </h3>
                        @if($post->excerpt)
                        <p class="text-sm text-slate-500 line-clamp-2 mb-4">{{ $post->excerpt }}</p>
                        @endif
                        <div class="flex items-center justify-between">
                            <time class="text-xs text-slate-400 flex items-center gap-1.5" datetime="{{ $post->published_at->toIso8601String() }}">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $post->published_at?->translatedFormat('d F Y') ?? '' }}
                            </time>
                            <span class="text-accent text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center gap-1">
                                อ่านต่อ
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
        <div class="text-center mt-10 sm:hidden">
            <a href="{{ route('news') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-accent border border-accent/20 hover:bg-accent hover:text-white transition-all cursor-pointer">
                ดูทั้งหมด <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        @else
        <div class="text-center py-20 text-slate-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            <p>ยังไม่มีข่าวสาร</p>
        </div>
        @endif
    </div>
</section>

{{-- ===== 5. CURRICULUMS ===== --}}
@if($curriculums->isNotEmpty())
<section class="py-20 bg-gradient-to-b from-slate-50 to-white pattern-dots relative" aria-labelledby="curriculum-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-14" data-aos="fade-up">
            <p class="text-accent font-semibold text-sm uppercase tracking-wider mb-3 section-label section-label-center">การศึกษา</p>
            <h2 id="curriculum-heading" class="text-3xl md:text-4xl font-bold text-primary">หลักสูตรของโรงเรียน</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @php
                $levelMap = ['primary' => 'ระดับประถมศึกษา', 'secondary' => 'ระดับมัธยมศึกษาตอนต้น', 'high' => 'ระดับมัธยมศึกษาตอนปลาย'];
                $levelColors = ['primary' => '#0369A1', 'secondary' => '#059669', 'high' => '#7C3AED'];
            @endphp
            @foreach($curriculums as $idx => $curriculum)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 card-hover group" data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                @if($curriculum->image_url)
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $curriculum->image_url }}" alt="{{ $curriculum->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                @else
                <div class="h-2 w-full rounded-t-2xl" style="background: linear-gradient(90deg, {{ $levelColors[$curriculum->level] ?? '#0F172A' }}, {{ $levelColors[$curriculum->level] ?? '#0F172A' }}80);"></div>
                @endif
                <div class="p-6">
                    <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-4 text-white shadow-sm"
                          style="background-color: {{ $levelColors[$curriculum->level] ?? '#0F172A' }}">
                        {{ $levelMap[$curriculum->level] ?? $curriculum->level }}
                    </span>
                    <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-accent transition-colors duration-200">{{ $curriculum->name }}</h3>
                    <div class="text-sm text-slate-600 leading-relaxed line-clamp-3">
                        {!! strip_tags($curriculum->description) !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10" data-aos="fade-up">
            <a href="{{ route('about.curriculum') }}" class="inline-flex items-center gap-2 px-7 py-3.5 border-2 border-primary text-primary font-semibold rounded-xl hover:bg-primary hover:text-white transition-all duration-200 cursor-pointer hover:-translate-y-0.5 hover:shadow-lg hover:shadow-primary/20 group">
                ดูหลักสูตรทั้งหมด
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ===== 6. SCHOOL SYSTEMS ===== --}}
@if($systems->isNotEmpty())
<section class="py-20 bg-gradient-to-br from-primary via-primary-600 to-primary-700 relative overflow-hidden" aria-labelledby="systems-heading">
    {{-- Decorative elements --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-accent/10 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-accent/5 rounded-full blur-3xl -translate-x-1/3 translate-y-1/3"></div>
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cpath d=&quot;M60 0H0v60&quot; fill=&quot;none&quot; stroke=&quot;%23fff&quot; stroke-width=&quot;0.5&quot;/%3E%3C/svg%3E');"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-14" data-aos="fade-up">
            <p class="text-accent-light font-semibold text-sm uppercase tracking-wider mb-3">ระบบงาน</p>
            <h2 id="systems-heading" class="text-3xl md:text-4xl font-bold text-white">รวมระบบงานออนไลน์</h2>
            <p class="text-white/50 mt-3 text-lg">เข้าถึงระบบงานต่าง ๆ ได้ที่นี่</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($systems as $idx => $system)
            <a href="{{ $system->url }}"
               @if($system->open_new_tab) target="_blank" rel="noopener noreferrer" @endif
               class="group flex flex-col items-center gap-3 p-5 bg-white/[0.07] hover:bg-white/[0.15] rounded-2xl transition-all duration-300 cursor-pointer border border-white/[0.08] hover:border-white/20 text-center hover:-translate-y-1 hover:shadow-xl hover:shadow-black/10"
               data-aos="zoom-in" data-aos-delay="{{ ($idx % 6) * 50 }}">
                @if($system->logo)
                <img src="{{ asset('storage/' . $system->logo) }}" alt="{{ $system->name }}" class="w-12 h-12 object-contain group-hover:scale-110 transition-transform duration-300">
                @else
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-xl group-hover:scale-110 transition-transform duration-300"
                     style="background-color: {{ $system->color }}">
                    {{ mb_substr($system->name, 0, 1) }}
                </div>
                @endif
                <span class="text-white/80 group-hover:text-white text-xs font-medium leading-snug transition-colors">{{ $system->name }}</span>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-10" data-aos="fade-up">
            <a href="{{ route('systems') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-primary font-semibold rounded-xl hover:bg-slate-100 transition-all duration-200 cursor-pointer shadow-lg hover:shadow-xl hover:-translate-y-0.5 group">
                ดูระบบงานทั้งหมด
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
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-accent/5 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-14" data-aos="fade-up">
            <p class="text-accent font-semibold text-sm uppercase tracking-wider mb-3 section-label section-label-center">ติดต่อ</p>
            <h2 id="contact-heading" class="text-3xl md:text-4xl font-bold text-primary">ติดต่อโรงเรียน</h2>
        </div>
        @php $contactInfo = \App\Models\ContactInfo::all()->keyBy('key'); @endphp
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <div class="space-y-5" data-aos="fade-right">
                @if(isset($contactInfo['address']))
                <div class="flex items-start gap-4 p-6 bg-gradient-to-r from-slate-50 to-white rounded-2xl border border-slate-100 card-hover cursor-default">
                    <div class="w-11 h-11 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-1">ที่อยู่</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $contactInfo['address']->value }}</p>
                    </div>
                </div>
                @endif
                @if(isset($contactInfo['phone']))
                <a href="tel:{{ $contactInfo['phone']->value }}" class="flex items-start gap-4 p-6 bg-gradient-to-r from-slate-50 to-white rounded-2xl border border-slate-100 card-hover cursor-pointer group">
                    <div class="w-11 h-11 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0 group-hover:bg-accent/20 transition-colors">
                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-1">โทรศัพท์</h3>
                        <p class="text-slate-600 text-sm group-hover:text-accent transition-colors">{{ $contactInfo['phone']->value }}</p>
                    </div>
                </a>
                @endif
                @if(isset($contactInfo['email']))
                <a href="mailto:{{ $contactInfo['email']->value }}" class="flex items-start gap-4 p-6 bg-gradient-to-r from-slate-50 to-white rounded-2xl border border-slate-100 card-hover cursor-pointer group">
                    <div class="w-11 h-11 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0 group-hover:bg-accent/20 transition-colors">
                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-1">อีเมล</h3>
                        <p class="text-slate-600 text-sm group-hover:text-accent transition-colors">{{ $contactInfo['email']->value }}</p>
                    </div>
                </a>
                @endif
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 px-7 py-3.5 bg-accent text-white font-semibold rounded-xl hover:bg-accent-dark transition-all duration-200 cursor-pointer w-full justify-center sm:w-auto shadow-lg shadow-accent/20 hover:shadow-accent/40 hover:-translate-y-0.5 group">
                    ส่งข้อความถึงเรา
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </a>
            </div>
            {{-- Map embed --}}
            <div class="rounded-2xl overflow-hidden border border-slate-200 h-80 bg-slate-100 flex items-center justify-center shadow-lg" data-aos="fade-left" data-aos-delay="200">
                @if(isset($contactInfo['map_url']))
                <iframe src="{{ $contactInfo['map_url']->value }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="แผนที่โรงเรียน"></iframe>
                @else
                <div class="text-center text-slate-400 p-8">
                    <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <p class="text-sm">กรุณาเพิ่ม Google Maps URL ในการตั้งค่า</p>
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
        total: {{ $banners->count() }},
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
