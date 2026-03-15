@extends('layouts.app')
@section('title', 'ประวัติความเป็นมา — ' . config('app.name'))
@section('description', 'ประวัติความเป็นมาของ ' . config('app.name'))

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
                    <li class="text-white font-medium" data-translate="aboutHistory">ประวัติความเป็นมา</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-up" data-translate="aboutHistory">ประวัติความเป็นมา</h1>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($history)
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden" data-aos="fade-up">
                @if($history->cover_image_url)
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $history->cover_image_url }}" alt="{{ $history->title }}" class="w-full h-full object-cover">
                </div>
                @endif
                <div class="p-8">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-3" style="color: #27456B;">
                        <div class="w-1.5 h-7 rounded-full bg-gradient-to-b from-accent to-accent-light"></div>
                        {{ $history->title }}
                    </h2>
                    <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed [&>p]:mb-4 [&>h2]:text-2xl [&>h2]:font-bold [&>h2]:mt-8 [&>h2]:mb-4 [&>h3]:text-xl [&>h3]:font-bold [&>h3]:mt-6 [&>h3]:mb-3 [&>ul]:list-disc [&>ul]:pl-6 [&>ol]:list-decimal [&>ol]:pl-6 [&>img]:rounded-xl [&>img]:my-6 [&>h2]:text-[#27456B] [&>h3]:text-[#27456B]">
                        {!! $history->content !!}
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20 text-slate-400">
                <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <p class="text-lg">ยังไม่มีข้อมูลประวัติโรงเรียน</p>
            </div>
        @endif
    </div>
</div>
@endsection
