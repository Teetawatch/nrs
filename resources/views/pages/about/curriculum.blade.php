@extends('layouts.app')
@section('title', 'หลักสูตร — ' . config('app.name'))

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
                    <li class="text-white font-medium">หลักสูตร</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-up">หลักสูตรของโรงเรียน</h1>
            <p class="text-white/70 mt-3 text-lg animate-fade-up" style="animation-delay: 0.1s;">หลักสูตรการเรียนการสอนของโรงเรียน</p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @php
            $levelMeta = [
                'primary'   => ['label' => 'ระดับประถมศึกษา',           'color' => '#0369A1'],
                'secondary' => ['label' => 'ระดับมัธยมศึกษาตอนต้น',     'color' => '#059669'],
                'high'      => ['label' => 'ระดับมัธยมศึกษาตอนปลาย',    'color' => '#7C3AED'],
            ];
        @endphp

        @forelse($curriculums as $level => $group)
        @php $meta = $levelMeta[$level] ?? ['label' => $level, 'color' => '#0F172A']; @endphp
        <section class="mb-14" aria-labelledby="level-{{ $level }}" data-aos="fade-up">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1.5 h-8 rounded-full" style="background: linear-gradient(to bottom, {{ $meta['color'] }}, {{ $meta['color'] }}80)"></div>
                <h2 id="level-{{ $level }}" class="text-2xl font-bold text-slate-900">{{ $meta['label'] }}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                @foreach($group as $idx => $curriculum)
                <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm card-hover group" data-aos="fade-up" data-aos-delay="{{ ($idx % 2) * 100 }}">
                    @if($curriculum->image_url)
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ $curriculum->image_url }}" alt="{{ $curriculum->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    @else
                    <div class="h-1.5 w-full" style="background: linear-gradient(to right, {{ $meta['color'] }}, {{ $meta['color'] }}80)"></div>
                    @endif
                    <div class="p-6">
                        <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-lg text-white mb-3 shadow-sm"
                              style="background-color: {{ $meta['color'] }}">{{ $meta['label'] }}</span>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-accent transition-colors duration-200">{{ $curriculum->name }}</h3>
                        <div class="prose max-w-none text-slate-600 text-sm leading-relaxed [&>p]:mb-2 [&>ul]:list-disc [&>ul]:pl-5">
                            {!! $curriculum->description !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @empty
        <div class="text-center py-20 text-slate-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <p class="text-lg">ยังไม่มีข้อมูลหลักสูตร</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
