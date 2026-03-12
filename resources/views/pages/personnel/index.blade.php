@extends('layouts.app')
@section('title', 'บุคลากร — ' . config('app.name'))

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
                    <li class="text-white font-medium">บุคลากร</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-up">บุคลากร</h1>
            <p class="text-white/70 mt-3 text-lg animate-fade-up" style="animation-delay: 0.1s;">คณะครูและบุคลากรของโรงเรียน</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-16">

        {{-- Commanders --}}
        @if($commanders->isNotEmpty())
        <section aria-labelledby="commanders-heading" data-aos="fade-up">
            <div class="text-center mb-12">
                <div class="inline-block px-4 py-1.5 bg-accent/10 text-accent text-sm font-semibold rounded-full mb-3">ผู้บังคับบัญชา</div>
                <h2 id="commanders-heading" class="text-2xl md:text-3xl font-bold text-slate-900">ผู้บริหารโรงเรียน</h2>
            </div>
            <div class="flex flex-wrap justify-center gap-10">
                @foreach($commanders as $idx => $person)
                <a href="{{ route('personnel.show', $person->slug) }}" class="group text-center cursor-pointer" data-aos="zoom-in" data-aos-delay="{{ $idx * 100 }}">
                    <div class="relative mb-5">
                        <div class="w-36 h-36 mx-auto rounded-full overflow-hidden border-4 border-white shadow-xl group-hover:shadow-2xl group-hover:shadow-accent/20 transition-all duration-300">
                            <img src="{{ $person->photo_url }}" alt="{{ $person->full_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-10 h-1 rounded-full bg-gradient-to-r from-accent to-accent-light opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <p class="font-bold text-slate-900 text-sm group-hover:text-primary transition-colors leading-tight">{{ $person->full_name }}</p>
                    <p class="text-xs text-slate-500 mt-1">{{ $person->position }}</p>
                    @if($person->rank)<p class="text-xs text-accent mt-1 font-medium">{{ $person->rank }}</p>@endif
                </a>
                @endforeach
            </div>
        </section>
        @endif

        {{-- Unit Heads --}}
        @if($unitHeads->isNotEmpty())
        <section aria-labelledby="unitheads-heading" data-aos="fade-up">
            <div class="text-center mb-12">
                <div class="inline-block px-4 py-1.5 bg-primary/10 text-primary text-sm font-semibold rounded-full mb-3">หัวหน้าหน่วย</div>
                <h2 id="unitheads-heading" class="text-2xl md:text-3xl font-bold text-slate-900">หัวหน้าหน่วยงาน</h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($unitHeads as $idx => $person)
                <a href="{{ route('personnel.show', $person->slug) }}" class="group text-center cursor-pointer" data-aos="fade-up" data-aos-delay="{{ ($idx % 5) * 60 }}">
                    <div class="w-24 h-24 mx-auto rounded-full overflow-hidden border-3 border-white shadow-lg mb-3 group-hover:shadow-xl group-hover:shadow-accent/10 transition-all duration-300">
                        <img src="{{ $person->photo_url }}" alt="{{ $person->full_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <p class="font-semibold text-slate-900 text-xs group-hover:text-accent transition-colors leading-tight">{{ $person->full_name }}</p>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $person->position }}</p>
                </a>
                @endforeach
            </div>
        </section>
        @endif

        {{-- By Department --}}
        @forelse($departments as $dept)
        @if($dept->personnel->isNotEmpty())
        <section aria-labelledby="dept-{{ $dept->id }}" data-aos="fade-up">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1.5 h-8 rounded-full bg-gradient-to-b from-accent to-accent-light"></div>
                <h2 id="dept-{{ $dept->id }}" class="text-xl font-bold text-slate-900">{{ $dept->name }}</h2>
                <span class="text-xs text-slate-400 bg-slate-100 px-2.5 py-0.5 rounded-full">{{ $dept->personnel->count() }} คน</span>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
                @foreach($dept->personnel as $person)
                <a href="{{ route('personnel.show', $person->slug) }}" class="group bg-white rounded-2xl border border-slate-200/80 p-5 text-center card-hover cursor-pointer">
                    <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-3 ring-2 ring-slate-100 group-hover:ring-accent/30 transition-all">
                        <img src="{{ $person->photo_url }}" alt="{{ $person->full_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <p class="font-semibold text-slate-900 text-xs leading-tight group-hover:text-accent transition-colors">{{ $person->full_name }}</p>
                    <p class="text-xs text-slate-500 mt-1 leading-tight">{{ $person->position }}</p>
                </a>
                @endforeach
            </div>
        </section>
        @endif
        @empty
        <div class="text-center py-16 text-slate-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <p class="text-lg">ยังไม่มีข้อมูลบุคลากร</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
