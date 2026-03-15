@php $contactInfo = \App\Models\ContactInfo::all()->keyBy('key'); @endphp

{{-- ===== TOP UTILITY BAR (dark navy) ===== --}}
<div class="bg-[#1a2d4a] text-white hidden lg:block">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 text-sm">
            <div class="flex items-center gap-6 text-base">
                <a href="tel:52382" class="flex items-center gap-2 text-white/70 hover:text-white transition-colors cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    52382
                </a>
                <a href="mailto:nass.ac.th@navy.mi.th" class="flex items-center gap-2 text-white/70 hover:text-white transition-colors cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    nass.ac.th@navy.mi.th
                </a>
            </div>
            <div class="flex items-center gap-3">
                {{-- Search --}}
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-3.5 h-3.5 text-white/40 group-focus-within:text-white/80 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text"
                           data-translate-placeholder="search_placeholder"
                           placeholder="ค้นหาเนื้อหา..."
                           class="w-44 pl-9 pr-3 py-1.5 text-xs bg-white/5 border border-white/10 rounded-md text-white/80 placeholder-white/30 focus:outline-none focus:border-white/30 focus:bg-white/10 focus:text-white transition-all duration-200">
                </div>

                {{-- Separator --}}
                <div class="h-4 w-px bg-white/10"></div>

                {{-- Language Toggle --}}
                <div x-data="{ languageOpen: false }" class="relative">
                    <button @click="languageOpen = !languageOpen"
                            class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-md text-white/60 hover:text-white hover:bg-white/10 transition-all duration-200 cursor-pointer text-xs font-medium tracking-wide">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                        <span id="current-lang" class="uppercase">TH</span>
                        <svg class="w-2.5 h-2.5 text-white/30 transition-transform duration-200" :class="languageOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="languageOpen"
                         @click.away="languageOpen = false"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-xl border border-slate-100 overflow-hidden z-[9999]"
                         x-cloak>
                        <button onclick="setLanguage('th'); languageOpen = false"
                                id="lang-th-dropdown"
                                class="flex items-center gap-2.5 w-full px-3 py-2.5 text-xs text-slate-700 hover:bg-slate-50 transition-colors duration-150 cursor-pointer">
                            <span>🇹🇭</span>
                            <span class="font-medium">ภาษาไทย</span>
                        </button>
                        <div class="h-px bg-slate-100 mx-3"></div>
                        <button onclick="setLanguage('en'); languageOpen = false"
                                id="lang-en-dropdown"
                                class="flex items-center gap-2.5 w-full px-3 py-2.5 text-xs text-slate-700 hover:bg-slate-50 transition-colors duration-150 cursor-pointer">
                            <span>🇬🇧</span>
                            <span class="font-medium">English</span>
                        </button>
                    </div>
                </div>

                {{-- Separator --}}
                <div class="h-4 w-px bg-white/10"></div>

                {{-- Font Size Controls --}}
                <div class="flex items-center rounded-md overflow-hidden border border-white/10">
                    <button onclick="decreaseFontSize()"
                            class="px-2.5 py-1.5 text-white/50 hover:text-white hover:bg-white/10 transition-all duration-200 cursor-pointer text-xs font-bold leading-none"
                            title="ลดขนาดฟอนต์">A-</button>
                    <div class="w-px h-4 bg-white/10"></div>
                    <button onclick="resetFontSize()"
                            class="px-2.5 py-1.5 text-white/50 hover:text-white hover:bg-white/10 transition-all duration-200 cursor-pointer text-xs font-bold leading-none"
                            title="คืนค่าขนาดฟอนต์">A</button>
                    <div class="w-px h-4 bg-white/10"></div>
                    <button onclick="increaseFontSize()"
                            class="px-2.5 py-1.5 text-white/50 hover:text-white hover:bg-white/10 transition-all duration-200 cursor-pointer text-xs font-bold leading-none"
                            title="เพิ่มขนาดฟอนต์">A+</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let originalFontSizes = new Map();

function saveOriginalFontSizes() {
    document.body.querySelectorAll('*').forEach(el => {
        originalFontSizes.set(el, window.getComputedStyle(el).fontSize);
    });
}

function increaseFontSize() {
    if (originalFontSizes.size === 0) saveOriginalFontSizes();
    document.body.querySelectorAll('*').forEach(el => {
        const orig = originalFontSizes.get(el) || window.getComputedStyle(el).fontSize;
        if (window.getComputedStyle(el).fontSize === orig)
            el.style.fontSize = (parseFloat(orig) * 1.2) + 'px';
    });
    localStorage.setItem('fontSize', 'increased');
}

function decreaseFontSize() {
    if (originalFontSizes.size === 0) saveOriginalFontSizes();
    document.body.querySelectorAll('*').forEach(el => {
        const orig = originalFontSizes.get(el) || window.getComputedStyle(el).fontSize;
        if (window.getComputedStyle(el).fontSize === orig)
            el.style.fontSize = (parseFloat(orig) * 0.8) + 'px';
    });
    localStorage.setItem('fontSize', 'decreased');
}

function resetFontSize() {
    originalFontSizes.forEach((orig, el) => el.style.fontSize = orig);
    localStorage.removeItem('fontSize');
}

document.addEventListener('DOMContentLoaded', function () {
    saveOriginalFontSizes();
    const savedFontSize = localStorage.getItem('fontSize');
    if (savedFontSize === 'increased') increaseFontSize();
    else if (savedFontSize === 'decreased') decreaseFontSize();
    // Language is handled by translations.js (loaded after this script)
});
</script>

{{-- ===== MAIN NAVBAR (white, with blue bottom border) ===== --}}
<nav x-data="{ mobileOpen: false }"
     class="bg-white border-b-[3px]  shadow-sm sticky top-0 z-50"
     role="navigation" aria-label="เมนูหลัก">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0 group" aria-label="หน้าแรก - {{ config('app.name') }}">
                <div class="w-16 h-16 rounded-full overflow-hidden group-hover:ring-2 group-hover:ring-primary-100 transition-all duration-200">
                    <img src="{{ asset('images/logo/NSRS.webp') }}" alt="{{ config('app.name') }} Logo" class="w-full h-full object-cover">
                </div>
                <div class="hidden sm:block">
                    <span class="text-slate-800 font-heading font-bold text-base leading-tight block" data-translate="schoolName">โรงเรียนพลาธิการ กรมพลาธิการทหารเรือ</span>
                    <span class="text-slate-400 text-[10px] font-medium tracking-wider uppercase" data-translate="schoolType">Naval Supply School</span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center gap-0.5">
                <a href="{{ route('home') }}"
                   class="relative px-4 py-3 text-base font-heading font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('home') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}"
                   data-translate="home">
                    หน้าแรก
                    @if(request()->routeIs('home'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>

                {{-- About Dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button @click="open = !open"
                            class="relative flex items-center gap-1 px-4 py-3 text-base font-heading font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('about.*') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}"
                            aria-expanded="open" aria-haspopup="true"
                            data-translate="about">
                        เกี่ยวกับโรงเรียน
                        <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                        @if(request()->routeIs('about.*'))
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                        @endif
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute top-full left-0 mt-0 w-52 bg-white rounded-b-xl shadow-xl border border-slate-100 py-1.5 z-50"
                         x-cloak>
                        <a href="{{ route('about.history') }}"    class="flex items-center gap-3 px-4 py-2.5 text-sm font-heading text-slate-600 hover:bg-primary-50 hover:text-primary-600 transition-colors cursor-pointer" data-translate="aboutHistory">ประวัติความเป็นมา</a>
                        <a href="{{ route('about.structure') }}"  class="flex items-center gap-3 px-4 py-2.5 text-sm font-heading text-slate-600 hover:bg-primary-50 hover:text-primary-600 transition-colors cursor-pointer" data-translate="aboutStructure">โครงสร้างหน่วย</a>
                        <a href="{{ route('about.symbols') }}"    class="flex items-center gap-3 px-4 py-2.5 text-sm font-heading text-slate-600 hover:bg-primary-50 hover:text-primary-600 transition-colors cursor-pointer" data-translate="aboutSymbols">สัญลักษณ์สถานศึกษา</a>
                        <a href="{{ route('about.philosophy') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-heading text-slate-600 hover:bg-primary-50 hover:text-primary-600 transition-colors cursor-pointer" data-translate="aboutPhilosophy">ปรัชญา/วิสัยทัศน์</a>
                        <a href="{{ route('about.curriculum') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-heading text-slate-600 hover:bg-primary-50 hover:text-primary-600 transition-colors cursor-pointer" data-translate="aboutCurriculum">หลักสูตร</a>
                    </div>
                </div>

                <a href="{{ route('personnel') }}"
                   class="relative px-4 py-3 text-base font-heading font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('personnel*') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}"
                   data-translate="personnel">
                    ผู้บังคับบัญชา
                    @if(request()->routeIs('personnel*'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>
                <a href="{{ route('news') }}"
                   class="relative px-4 py-3 text-base font-heading font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('news*') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}"
                   data-translate="news">
                    ข่าวสาร
                    @if(request()->routeIs('news*'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>
                <a href="{{ route('documents') }}"
                   class="relative px-4 py-3 text-base font-heading font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('documents*') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}"
                   data-translate="documents">
                    เอกสาร
                    @if(request()->routeIs('documents*'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>
                <a href="{{ route('knowledge') }}"
                   class="relative px-4 py-3 text-base font-heading font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('knowledge*') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}"
                   data-translate="knowledge">
                    คลังความรู้
                    @if(request()->routeIs('knowledge*'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>
                <a href="{{ route('systems') }}"
                   class="relative px-4 py-3 text-base font-heading font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('systems') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}"
                   data-translate="systems">
                    ระบบงาน
                    @if(request()->routeIs('systems'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>
                <a href="{{ route('contact') }}"
                   class="relative px-4 py-3 text-base font-heading font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('contact') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}"
                   data-translate="contact">
                    ติดต่อเรา
                    @if(request()->routeIs('contact'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>
            </div>

            {{-- Mobile menu button --}}
            <button @click="mobileOpen = !mobileOpen"
                    class="lg:hidden p-2.5 rounded-lg text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer"
                    aria-expanded="mobileOpen" aria-controls="mobile-menu" aria-label="เปิด/ปิดเมนู">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" x-cloak>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" x-show="mobileOpen" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden bg-white border-t border-slate-100 shadow-lg">
        <div class="px-4 py-3 space-y-0.5">
            {{-- Mobile contact bar --}}
            <div class="flex items-center gap-4 text-xs text-slate-500 pb-3 mb-2 border-b border-slate-100">
                @if(isset($contactInfo['phone']))
                <a href="tel:{{ $contactInfo['phone']->value }}" class="flex items-center gap-1.5 hover:text-primary-600 cursor-pointer">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    {{ $contactInfo['phone']->value }}
                </a>
                @endif
                @if(isset($contactInfo['email']))
                <a href="mailto:{{ $contactInfo['email']->value }}" class="flex items-center gap-1.5 hover:text-primary-600 cursor-pointer">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    {{ $contactInfo['email']->value }}
                </a>
                @endif
            </div>
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-heading font-medium cursor-pointer transition-colors {{ request()->routeIs('home') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                หน้าแรก
            </a>
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg text-sm font-heading font-medium cursor-pointer transition-colors {{ request()->routeIs('about.*') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                    <span class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        เกี่ยวกับโรงเรียน
                    </span>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-collapse x-cloak class="ml-7 mt-0.5 space-y-0.5 border-l-2 border-primary-100 pl-3">
                    <a href="{{ route('about.history') }}"    class="block px-3 py-2 rounded-lg text-sm font-heading text-slate-500 hover:text-primary-600 hover:bg-primary-50 cursor-pointer transition-colors">ประวัติความเป็นมา</a>
                    <a href="{{ route('about.structure') }}"  class="block px-3 py-2 rounded-lg text-sm font-heading text-slate-500 hover:text-primary-600 hover:bg-primary-50 cursor-pointer transition-colors">โครงสร้างหน่วย</a>
                    <a href="{{ route('about.symbols') }}"    class="block px-3 py-2 rounded-lg text-sm font-heading text-slate-500 hover:text-primary-600 hover:bg-primary-50 cursor-pointer transition-colors">สัญลักษณ์สถานศึกษา</a>
                    <a href="{{ route('about.philosophy') }}" class="block px-3 py-2 rounded-lg text-sm font-heading text-slate-500 hover:text-primary-600 hover:bg-primary-50 cursor-pointer transition-colors">ปรัชญา/วิสัยทัศน์</a>
                    <a href="{{ route('about.curriculum') }}" class="block px-3 py-2 rounded-lg text-sm font-heading text-slate-500 hover:text-primary-600 hover:bg-primary-50 cursor-pointer transition-colors">หลักสูตร</a>
                </div>
            </div>
            <a href="{{ route('personnel') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-heading font-medium cursor-pointer transition-colors {{ request()->routeIs('personnel*') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                บุคลากร
            </a>
            <a href="{{ route('news') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-heading font-medium cursor-pointer transition-colors {{ request()->routeIs('news*') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                ข่าวสาร
            </a>
            <a href="{{ route('documents') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-heading font-medium cursor-pointer transition-colors {{ request()->routeIs('documents*') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                เอกสาร
            </a>
            <a href="{{ route('knowledge') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-heading font-medium cursor-pointer transition-colors {{ request()->routeIs('knowledge*') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                คลังความรู้
            </a>
            <a href="{{ route('systems') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-heading font-medium cursor-pointer transition-colors {{ request()->routeIs('systems') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                ระบบงาน
            </a>
            <a href="{{ route('contact') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-heading font-medium cursor-pointer transition-colors {{ request()->routeIs('contact') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                ติดต่อเรา
            </a>
        </div>
    </div>
</nav>
