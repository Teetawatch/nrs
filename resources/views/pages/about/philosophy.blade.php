@extends('layouts.app')
@section('title', 'ปรัชญา/วิสัยทัศน์/พันธกิจ — ' . config('app.name'))

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
                    <li class="text-white font-medium">ปรัชญา/วิสัยทัศน์/พันธกิจ</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-up">ปรัชญา วิสัยทัศน์ และพันธกิจ</h1>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @php
            $typeLabels = [
                'philosophy' => ['label' => 'ปรัชญา',    'color' => '#0F172A', 'bg' => '#EEF2F7'],
                'vision'     => ['label' => 'วิสัยทัศน์', 'color' => '#0369A1', 'bg' => '#EFF6FF'],
                'mission'    => ['label' => 'พันธกิจ',    'color' => '#059669', 'bg' => '#ECFDF5'],
                'value'      => ['label' => 'ค่านิยม',    'color' => '#7C3AED', 'bg' => '#F5F3FF'],
            ];
        @endphp

        @forelse($items as $type => $group)
        @php $meta = $typeLabels[$type] ?? ['label' => $type, 'color' => '#0F172A', 'bg' => '#EEF2F7']; @endphp
        <section class="mb-14" aria-labelledby="type-{{ $type }}" data-aos="fade-up">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-8 rounded-full" style="background: linear-gradient(to bottom, {{ $meta['color'] }}, {{ $meta['color'] }}80)"></div>
                <h2 id="type-{{ $type }}" class="text-2xl font-bold text-slate-900">{{ $meta['label'] }}</h2>
            </div>
            <div class="space-y-4">
                @foreach($group as $item)
                <div class="bg-white rounded-2xl border border-slate-200/80 p-7 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-start gap-4">
                        @if($item->icon)
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0 shadow-sm"
                             style="background-color: {{ $meta['bg'] }}">
                            {{ $item->icon }}
                        </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="text-lg font-bold mb-3" style="color: {{ $meta['color'] }}">{{ $item->title }}</h3>
                            <div class="prose max-w-none text-slate-700 leading-relaxed [&>p]:mb-3 [&>ul]:list-disc [&>ul]:pl-5 [&>li]:mb-1">
                                {!! $item->content !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @empty
        <div class="text-center py-20 text-slate-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
            <p class="text-lg">ยังไม่มีข้อมูล</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
