@extends('layouts.app')
@section('title', 'สัญลักษณ์สถานศึกษา — ' . config('app.name'))

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
                    <li class="text-white font-medium" data-translate="aboutSymbols">สัญลักษณ์สถานศึกษา</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-up" data-translate="aboutSymbols">สัญลักษณ์สถานศึกษา</h1>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($symbols->isNotEmpty())
            <div class="space-y-10">
                @foreach($symbols as $idx => $symbol)
                <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300" data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                        @if($symbol->image_url)
                        <div class="md:col-span-1 p-8 bg-gradient-to-b from-slate-50 to-white flex items-center justify-center border-b md:border-b-0 md:border-r border-slate-100">
                            <img src="{{ $symbol->image_url }}" alt="{{ $symbol->name }}" class="max-h-52 object-contain">
                        </div>
                        @endif
                        <div class="{{ $symbol->image_url ? 'md:col-span-2' : 'md:col-span-3' }} p-8">
                            <h2 class="text-2xl font-bold mb-3 flex items-center gap-3" style="color: #27456B;">
                                <div class="w-1.5 h-7 rounded-full bg-gradient-to-b from-accent to-accent-light"></div>
                                {{ $symbol->name }}
                            </h2>
                            @if($symbol->description)
                            <p class="text-slate-600 text-lg mb-4 leading-relaxed">{{ $symbol->description }}</p>
                            @endif
                            @if($symbol->content)
                            <div class="prose max-w-none text-slate-700 leading-relaxed [&>p]:mb-3 [&>ul]:list-disc [&>ul]:pl-5">
                                {!! $symbol->content !!}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 text-slate-400">
                <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                <p class="text-lg">ยังไม่มีข้อมูลสัญลักษณ์สถานศึกษา</p>
            </div>
        @endif
    </div>
</div>
@endsection
