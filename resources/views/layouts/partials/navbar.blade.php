@php $contactInfo = \App\Models\ContactInfo::all()->keyBy('key'); @endphp

{{-- ===== TOP UTILITY BAR (dark navy) ===== --}}
<div class="bg-primary-800 text-white hidden lg:block">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-9 text-xs">
            <div class="flex items-center gap-5">
                @if(isset($contactInfo['phone']))
                <a href="tel:{{ $contactInfo['phone']->value }}" class="flex items-center gap-1.5 text-white/70 hover:text-white transition-colors cursor-pointer">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    {{ $contactInfo['phone']->value }}
                </a>
                @endif
                @if(isset($contactInfo['email']))
                <a href="mailto:{{ $contactInfo['email']->value }}" class="flex items-center gap-1.5 text-white/70 hover:text-white transition-colors cursor-pointer">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    {{ $contactInfo['email']->value }}
                </a>
                @endif
            </div>
            <div class="flex items-center gap-4">
                <span class="text-white/50">{{ config('app.name') }}</span>
            </div>
        </div>
    </div>
</div>

{{-- ===== MAIN NAVBAR (white, with blue bottom border) ===== --}}
<nav x-data="{ mobileOpen: false }"
     class="bg-white border-b-[3px] border-primary-600 shadow-sm sticky top-0 z-50"
     role="navigation" aria-label="เมนูหลัก">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0 group" aria-label="หน้าแรก - {{ config('app.name') }}">
                <div class="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center group-hover:bg-primary-100 transition-all duration-200">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <div class="hidden sm:block">
                    <span class="text-slate-800 font-heading font-bold text-base leading-tight block">{{ config('app.name') }}</span>
                    <span class="text-slate-400 text-[10px] font-medium tracking-wider uppercase">School Website</span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center gap-0.5">
                <a href="{{ route('home') }}"
                   class="relative px-4 py-2 text-sm font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('home') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}">
                    หน้าแรก
                    @if(request()->routeIs('home'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>

                {{-- About Dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button @click="open = !open"
                            class="relative flex items-center gap-1 px-4 py-2 text-sm font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('about.*') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}"
                            aria-expanded="open" aria-haspopup="true">
                        เกี่ยวกับ
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
                        <a href="{{ route('about.history') }}"    class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-primary-50 hover:text-primary-600 transition-colors cursor-pointer">ประวัติความเป็นมา</a>
                        <a href="{{ route('about.structure') }}"  class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-primary-50 hover:text-primary-600 transition-colors cursor-pointer">โครงสร้างหน่วย</a>
                        <a href="{{ route('about.symbols') }}"    class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-primary-50 hover:text-primary-600 transition-colors cursor-pointer">สัญลักษณ์สถานศึกษา</a>
                        <a href="{{ route('about.philosophy') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-primary-50 hover:text-primary-600 transition-colors cursor-pointer">ปรัชญา/วิสัยทัศน์</a>
                        <a href="{{ route('about.curriculum') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-primary-50 hover:text-primary-600 transition-colors cursor-pointer">หลักสูตร</a>
                    </div>
                </div>

                <a href="{{ route('personnel') }}"
                   class="relative px-4 py-2 text-sm font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('personnel*') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}">
                    บุคลากร
                    @if(request()->routeIs('personnel*'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>
                <a href="{{ route('news') }}"
                   class="relative px-4 py-2 text-sm font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('news*') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}">
                    ข่าวสาร
                    @if(request()->routeIs('news*'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>
                <a href="{{ route('documents') }}"
                   class="relative px-4 py-2 text-sm font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('documents*') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}">
                    เอกสาร
                    @if(request()->routeIs('documents*'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>
                <a href="{{ route('knowledge') }}"
                   class="relative px-4 py-2 text-sm font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('knowledge*') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}">
                    คลังความรู้
                    @if(request()->routeIs('knowledge*'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>
                <a href="{{ route('systems') }}"
                   class="relative px-4 py-2 text-sm font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('systems') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}">
                    ระบบงาน
                    @if(request()->routeIs('systems'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[3px] bg-primary-600 -mb-[calc(0.5rem+1.5px)]"></span>
                    @endif
                </a>
                <a href="{{ route('contact') }}"
                   class="relative px-4 py-2 text-sm font-medium transition-colors duration-200 cursor-pointer {{ request()->routeIs('contact') ? 'text-primary-600' : 'text-slate-600 hover:text-primary-600' }}">
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
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium cursor-pointer transition-colors {{ request()->routeIs('home') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                หน้าแรก
            </a>
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg text-sm font-medium cursor-pointer transition-colors {{ request()->routeIs('about.*') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                    <span class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        เกี่ยวกับโรงเรียน
                    </span>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-collapse x-cloak class="ml-7 mt-0.5 space-y-0.5 border-l-2 border-primary-100 pl-3">
                    <a href="{{ route('about.history') }}"    class="block px-3 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 hover:bg-primary-50 cursor-pointer transition-colors">ประวัติความเป็นมา</a>
                    <a href="{{ route('about.structure') }}"  class="block px-3 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 hover:bg-primary-50 cursor-pointer transition-colors">โครงสร้างหน่วย</a>
                    <a href="{{ route('about.symbols') }}"    class="block px-3 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 hover:bg-primary-50 cursor-pointer transition-colors">สัญลักษณ์สถานศึกษา</a>
                    <a href="{{ route('about.philosophy') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 hover:bg-primary-50 cursor-pointer transition-colors">ปรัชญา/วิสัยทัศน์</a>
                    <a href="{{ route('about.curriculum') }}" class="block px-3 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 hover:bg-primary-50 cursor-pointer transition-colors">หลักสูตร</a>
                </div>
            </div>
            <a href="{{ route('personnel') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium cursor-pointer transition-colors {{ request()->routeIs('personnel*') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                บุคลากร
            </a>
            <a href="{{ route('news') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium cursor-pointer transition-colors {{ request()->routeIs('news*') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                ข่าวสาร
            </a>
            <a href="{{ route('documents') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium cursor-pointer transition-colors {{ request()->routeIs('documents*') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                เอกสาร
            </a>
            <a href="{{ route('knowledge') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium cursor-pointer transition-colors {{ request()->routeIs('knowledge*') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                คลังความรู้
            </a>
            <a href="{{ route('systems') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium cursor-pointer transition-colors {{ request()->routeIs('systems') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                ระบบงาน
            </a>
            <a href="{{ route('contact') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium cursor-pointer transition-colors {{ request()->routeIs('contact') ? 'text-primary-600 bg-primary-50' : 'text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                ติดต่อเรา
            </a>
        </div>
    </div>
</nav>
