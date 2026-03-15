@extends('layouts.app')
@section('title', 'โครงสร้างหน่วย — ' . config('app.name'))

@section('content')
<div class="bg-slate-50 min-h-screen">
    {{-- Page Header --}}
    <div class="bg-gradient-to-br from-primary-400 via-primary-500 to-primary-600 text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cpath d=&quot;M60 0H0v60&quot; fill=&quot;none&quot; stroke=&quot;%23fff&quot; stroke-width=&quot;0.5&quot;/%3E%3C/svg%3E');"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent/15 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <nav class="text-sm text-white/60 mb-4" aria-label="Breadcrumb">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors cursor-pointer" data-translate="breadcrumbHome">หน้าแรก</a></li>
                    <li aria-hidden="true"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                    <li class="text-white font-medium" data-translate="aboutStructure">โครงสร้างหน่วย</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-up" data-translate="aboutStructure">โครงสร้างหน่วย</h1>
            <p class="text-white/70 mt-3 text-lg animate-fade-up" style="animation-delay: 0.1s;">โครงสร้างการจัดหน่วยงานของโรงเรียน</p>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($units->isNotEmpty())
            <div class="space-y-8">
                @foreach($units as $idx => $unit)
                <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm" data-aos="fade-up" data-aos-delay="{{ $idx * 80 }}">
                    <div class="flex items-center gap-4 p-6 bg-gradient-to-r from-primary/5 to-transparent border-b border-slate-100">
                        @if($unit->image_url)
                        <img src="{{ $unit->image_url }}" alt="{{ $unit->name }}" class="w-14 h-14 rounded-xl object-cover shadow-sm">
                        @else
                        <div class="w-14 h-14 rounded-xl bg-accent/10 flex items-center justify-center">
                            <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        @endif
                        <div>
                            <h2 class="text-xl font-bold text-primary">{{ $unit->name }}</h2>
                            @if($unit->short_name)
                            <span class="text-sm text-slate-500">({{ $unit->short_name }})</span>
                            @endif
                            @if($unit->description)
                            <p class="text-sm text-slate-600 mt-1">{{ $unit->description }}</p>
                            @endif
                        </div>
                    </div>
                    @if($unit->children->isNotEmpty())
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($unit->children as $child)
                            <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl border border-slate-100 hover:border-accent/20 hover:bg-accent/[0.02] transition-all duration-200">
                                <div class="w-2 h-2 rounded-full bg-accent mt-2 flex-shrink-0"></div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 text-sm">{{ $child->name }}</h3>
                                    @if($child->description)
                                    <p class="text-xs text-slate-500 mt-1">{{ $child->description }}</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 text-slate-400">
                <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <p class="text-lg">ยังไม่มีข้อมูลโครงสร้างหน่วย</p>
            </div>
        @endif
    </div>
</div>
@endsection
