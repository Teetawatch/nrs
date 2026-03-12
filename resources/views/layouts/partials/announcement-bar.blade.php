@php
    $announcements = \App\Models\Announcement::active()->latest()->take(3)->get();
@endphp

@if($announcements->isNotEmpty())
<div x-data="{ open: true, current: 0, total: {{ $announcements->count() }} }"
     x-init="if(total > 1) setInterval(() => current = (current + 1) % total, 5000)"
     x-show="open" x-cloak
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 max-h-16"
     x-transition:leave-end="opacity-0 max-h-0"
     class="relative overflow-hidden bg-gradient-to-r from-primary via-primary-600 to-primary z-40">
    @foreach($announcements as $i => $ann)
    @php
        $iconMap = [
            'info'    => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            'warning' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
            'danger'  => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            'success' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        ];
        $dotColor = [
            'info'    => 'bg-accent-light',
            'warning' => 'bg-amber-400',
            'danger'  => 'bg-red-400',
            'success' => 'bg-emerald-400',
        ];
    @endphp
    <div x-show="current === {{ $i }}"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="text-white text-sm py-2.5 px-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <span class="flex-shrink-0 w-2 h-2 rounded-full {{ $dotColor[$ann->type] ?? 'bg-accent-light' }} animate-pulse-soft"></span>
                <svg class="w-4 h-4 flex-shrink-0 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconMap[$ann->type] ?? $iconMap['info'] }}"/>
                </svg>
                <span class="font-semibold mr-1 flex-shrink-0">{{ $ann->title }}</span>
                <span class="truncate text-white/80">{{ $ann->content }}</span>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
                @if($announcements->count() > 1)
                <div class="hidden sm:flex items-center gap-1">
                    @foreach($announcements as $j => $a)
                    <button @click="current = {{ $j }}" :class="current === {{ $j }} ? 'bg-white' : 'bg-white/30'" class="w-1.5 h-1.5 rounded-full transition-colors cursor-pointer" aria-label="ประกาศที่ {{ $j + 1 }}"></button>
                    @endforeach
                </div>
                @endif
                <button @click="open = false" class="flex-shrink-0 w-6 h-6 rounded-full hover:bg-white/10 flex items-center justify-center transition-colors cursor-pointer" aria-label="ปิด">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
