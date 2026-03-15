@php
    $announcements = \App\Models\Announcement::active()->latest()->take(5)->get();
@endphp

@if($announcements->isNotEmpty())
<div x-data="{
        open: true,
        current: 0,
        total: {{ $announcements->count() }},
        timer: null,
        start() {
            if (this.total > 1) {
                this.timer = setInterval(() => { this.current = (this.current + 1) % this.total }, 5000);
            }
        },
        pause() { clearInterval(this.timer); },
        resume() { this.start(); },
        prev() { this.current = (this.current - 1 + this.total) % this.total; },
        next() { this.current = (this.current + 1) % this.total; }
     }"
     x-init="start()"
     x-show="open"
     x-cloak
     @mouseenter="pause()"
     @mouseleave="resume()"
     x-transition:leave="transition ease-in-out duration-400"
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform -translate-y-full"
     class="relative z-40 overflow-hidden min-h-[48px]">

    {{-- Animated background --}}
    <div class="absolute inset-0 bg-gradient-to-r from-[#0f2444] via-[#1E3A5F] to-[#163052]"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/[0.03] to-transparent animate-pulse"></div>

    @foreach($announcements as $i => $ann)
    @php
        $typeConfig = [
            'info'    => ['icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',    'dot' => 'bg-sky-400',     'badge' => 'bg-sky-400/20 text-sky-200 border-sky-400/30',    'label' => 'ข่าวสาร'],
            'warning' => ['icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z', 'dot' => 'bg-amber-400', 'badge' => 'bg-amber-400/20 text-amber-200 border-amber-400/30', 'label' => 'แจ้งเตือน'],
            'danger'  => ['icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',            'dot' => 'bg-red-400',     'badge' => 'bg-red-400/20 text-red-200 border-red-400/30',    'label' => 'ด่วน'],
            'success' => ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',               'dot' => 'bg-emerald-400', 'badge' => 'bg-emerald-400/20 text-emerald-200 border-emerald-400/30', 'label' => 'ประกาศ'],
        ];
        $cfg = $typeConfig[$ann->type] ?? $typeConfig['info'];
    @endphp

    <div x-show="current === {{ $i }}"
         x-transition:enter="transition ease-out duration-400"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="absolute inset-0 text-white py-2.5 px-4">

        <div class="max-w-7xl mx-auto flex items-center gap-3">

            {{-- Left: dot + badge + content --}}
            <div class="flex items-center gap-3 flex-1 min-w-0">
                {{-- Pulse dot --}}
                <span class="relative flex-shrink-0 hidden sm:flex">
                    <span class="animate-ping absolute inline-flex h-2.5 w-2.5 rounded-full {{ $cfg['dot'] }} opacity-60"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 {{ $cfg['dot'] }}"></span>
                </span>

                {{-- Type badge --}}
                <span class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $cfg['badge'] }} flex-shrink-0">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $cfg['icon'] }}"/>
                    </svg>
                    {{ $cfg['label'] }}
                </span>

                {{-- Title --}}
                <span class="font-semibold text-sm text-white flex-shrink-0 truncate max-w-[180px] sm:max-w-none">{{ $ann->title }}</span>

                {{-- Divider --}}
                <span class="hidden sm:block text-white/30 flex-shrink-0 select-none">—</span>

                {{-- Content --}}
                <span class="text-sm text-white/75 truncate hidden sm:block">{{ $ann->content }}</span>
            </div>

            {{-- Right: counter + nav + close --}}
            <div class="flex items-center gap-2 flex-shrink-0">

                @if($announcements->count() > 1)
                {{-- Dot indicators (desktop) --}}
                <div class="hidden md:flex items-center gap-1.5 mr-1">
                    @foreach($announcements as $j => $a)
                    <button @click="current = {{ $j }}"
                            :class="current === {{ $j }} ? 'bg-white w-4' : 'bg-white/30 w-1.5'"
                            class="h-1.5 rounded-full transition-all duration-300 cursor-pointer hover:bg-white/70"
                            aria-label="ประกาศที่ {{ $j + 1 }}"></button>
                    @endforeach
                </div>

                {{-- Counter (mobile) --}}
                <span class="md:hidden text-xs text-white/50 tabular-nums">
                    <span x-text="current + 1"></span>/<span>{{ $announcements->count() }}</span>
                </span>

                {{-- Prev / Next arrows --}}
                <button @click="prev()" class="w-6 h-6 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all duration-200 cursor-pointer" aria-label="ก่อนหน้า">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button @click="next()" class="w-6 h-6 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all duration-200 cursor-pointer" aria-label="ถัดไป">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                @endif

                {{-- Divider --}}
                <span class="text-white/20 select-none">|</span>

                {{-- Close button --}}
                <button @click="open = false"
                        class="w-6 h-6 rounded-full hover:bg-white/15 flex items-center justify-center transition-all duration-200 cursor-pointer group"
                        aria-label="ปิด">
                    <svg class="w-3.5 h-3.5 text-white/60 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>
    @endforeach

    {{-- Bottom shimmer line --}}
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
</div>
@endif
