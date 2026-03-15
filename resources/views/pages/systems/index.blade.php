@extends('layouts.app')
@section('title', 'รวมระบบงาน — ' . config('app.name'))

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
                    <li class="text-white font-medium" data-translate="systems">รวมระบบงาน</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-up" data-translate="homeSystemsTitle">รวมระบบงานออนไลน์</h1>
            <p class="text-white/70 mt-3 text-lg animate-fade-up" style="animation-delay: 0.1s;">เข้าถึงระบบงานและบริการออนไลน์ต่าง ๆ ของโรงเรียน</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-14">

        @forelse($categories as $cat)
        @if($cat->systems->isNotEmpty())
        <section aria-labelledby="cat-{{ $cat->id }}" data-aos="fade-up">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-7 rounded-full bg-gradient-to-b from-accent to-accent-light"></div>
                <h2 id="cat-{{ $cat->id }}" class="text-xl font-bold text-slate-900">{{ $cat->name }}</h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @foreach($cat->systems as $system)
                @include('pages.systems._card', ['system' => $system])
                @endforeach
            </div>
        </section>
        @endif
        @empty
        @endforelse

        @if($uncategorized->isNotEmpty())
        <section aria-labelledby="other-systems">
            @if($categories->isNotEmpty())
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1 h-7 rounded-full bg-slate-400"></div>
                <h2 id="other-systems" class="text-xl font-bold text-slate-900" data-translate="homeSystemsTitle">ระบบงานอื่น ๆ</h2>
            </div>
            @endif
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @foreach($uncategorized as $system)
                @include('pages.systems._card', ['system' => $system])
                @endforeach
            </div>
        </section>
        @endif

        @if($categories->isEmpty() && $uncategorized->isEmpty())
        <div class="text-center py-20 text-slate-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
            <p class="text-lg" data-translate="systemsNoResult">ยังไม่มีระบบงาน</p>
        </div>
        @endif
    </div>
</div>
@endsection
