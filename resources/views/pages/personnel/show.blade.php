@extends('layouts.app')
@section('title', $person->full_name . ' — ' . config('app.name'))

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
                    <li><a href="{{ route('personnel') }}" class="hover:text-white transition-colors cursor-pointer">บุคลากร</a></li>
                    <li aria-hidden="true"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                    <li class="text-white font-medium truncate max-w-xs">{{ $person->full_name }}</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-up">{{ $person->full_name }}</h1>
            <p class="text-white/70 mt-3 text-lg animate-fade-up" style="animation-delay: 0.1s;">{{ $person->position }}</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg overflow-hidden" data-aos="fade-up">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                <div class="md:col-span-1 bg-gradient-to-b from-slate-50 to-white p-8 flex flex-col items-center text-center border-b md:border-b-0 md:border-r border-slate-100">
                    <div class="w-40 h-40 rounded-full overflow-hidden border-4 border-white shadow-xl mb-5 ring-4 ring-accent/10">
                        <img src="{{ $person->photo_url }}" alt="{{ $person->full_name }}" class="w-full h-full object-cover">
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 mb-1">{{ $person->full_name }}</h2>
                    <p class="text-accent font-medium text-sm mb-2">{{ $person->position }}</p>
                    @if($person->rank)
                    <span class="inline-block px-3 py-1 bg-primary/10 text-primary text-xs font-medium rounded-full mb-3">{{ $person->rank }}</span>
                    @endif
                    @if($person->department)
                    <p class="text-slate-500 text-sm">{{ $person->department->name }}</p>
                    @endif

                    <div class="mt-6 space-y-3 w-full text-left">
                        @if($person->email)
                        <a href="mailto:{{ $person->email }}" class="flex items-center gap-3 text-sm text-slate-600 hover:text-accent transition-colors cursor-pointer group p-2 rounded-lg hover:bg-accent/5">
                            <div class="w-8 h-8 rounded-lg bg-accent/10 flex items-center justify-center flex-shrink-0 group-hover:bg-accent/20 transition-colors">
                                <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="truncate">{{ $person->email }}</span>
                        </a>
                        @endif
                        @if($person->phone)
                        <a href="tel:{{ $person->phone }}" class="flex items-center gap-3 text-sm text-slate-600 hover:text-accent transition-colors cursor-pointer group p-2 rounded-lg hover:bg-accent/5">
                            <div class="w-8 h-8 rounded-lg bg-accent/10 flex items-center justify-center flex-shrink-0 group-hover:bg-accent/20 transition-colors">
                                <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            {{ $person->phone }}
                        </a>
                        @endif
                    </div>
                </div>

                <div class="md:col-span-2 p-8">
                    @if($person->bio)
                    <h3 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
                        <div class="w-1 h-5 rounded-full bg-accent"></div>
                        ประวัติ
                    </h3>
                    <div class="prose max-w-none text-slate-700 leading-relaxed [&>p]:mb-3">
                        {!! nl2br(e($person->bio)) !!}
                    </div>
                    @else
                    <div class="text-center py-12 text-slate-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <p>ไม่มีข้อมูลประวัติ</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('personnel') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-accent transition-colors cursor-pointer group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                กลับไปหน้าบุคลากร
            </a>
        </div>
    </div>
</div>
@endsection
