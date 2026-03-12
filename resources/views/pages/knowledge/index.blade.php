@extends('layouts.app')
@section('title', 'แหล่งรวมความรู้ — ' . config('app.name'))

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
                    <li class="text-white font-medium">แหล่งความรู้</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-up">แหล่งรวมความรู้</h1>
            <p class="text-white/70 mt-3 text-lg animate-fade-up" style="animation-delay: 0.1s;">บทความ วิดีโอ และสื่อการเรียนรู้ต่าง ๆ</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Main --}}
            <div class="flex-1">
                @if($items->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                    @foreach($items as $idx => $item)
                    @php
                        $typeIcon = ['article' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'video' => 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'link' => 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1', 'file' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'];
                        $typeLabel = ['article' => 'บทความ', 'video' => 'วิดีโอ', 'link' => 'ลิงก์', 'file' => 'ไฟล์'];
                        $typeColor = ['article' => '#0F172A', 'video' => '#DC2626', 'link' => '#0369A1', 'file' => '#059669'];
                    @endphp
                    <article class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden card-hover group" data-aos="fade-up" data-aos-delay="{{ ($idx % 4) * 80 }}">
                        <a href="{{ $item->type === 'link' && $item->external_url ? $item->external_url : route('knowledge.show', $item->slug) }}"
                           @if($item->type === 'link' && $item->external_url) target="_blank" rel="noopener noreferrer" @endif
                           class="block cursor-pointer">
                            <div class="aspect-video overflow-hidden bg-slate-100 relative">
                                @if($item->cover_image_url)
                                <img src="{{ $item->cover_image_url }}" alt="{{ $item->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                <div class="w-full h-full flex items-center justify-center" style="background-color: {{ $typeColor[$item->type] ?? '#0F172A' }}08">
                                    <svg class="w-12 h-12" style="color: {{ $typeColor[$item->type] ?? '#0F172A' }}25" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $typeIcon[$item->type] ?? $typeIcon['article'] }}"/>
                                    </svg>
                                </div>
                                @endif
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold text-white shadow-sm"
                                          style="background-color: {{ $typeColor[$item->type] ?? '#0F172A' }}">
                                        {{ $typeLabel[$item->type] ?? $item->type }}
                                    </span>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="p-6">
                                @if($item->category)
                                <p class="text-xs font-medium text-slate-500 mb-2">{{ $item->category->name }}</p>
                                @endif
                                <h2 class="font-bold text-slate-900 leading-snug mb-2.5 line-clamp-2 group-hover:text-accent transition-colors duration-200">
                                    {{ $item->title }}
                                </h2>
                                @if($item->excerpt)
                                <p class="text-sm text-slate-500 line-clamp-2 mb-3">{{ $item->excerpt }}</p>
                                @endif
                                <div class="flex items-center gap-3 text-xs text-slate-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        {{ number_format($item->view_count) }} ครั้ง
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                    @endforeach
                </div>
                <div class="mt-10">{{ $items->links() }}</div>
                @else
                <div class="text-center py-20 text-slate-400">
                    <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <p class="text-lg">ยังไม่มีเนื้อหา</p>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="lg:w-72 flex-shrink-0" aria-label="หมวดหมู่" data-aos="fade-left">
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm sticky top-24">
                    <h3 class="font-bold text-slate-900 mb-5 flex items-center gap-2">
                        <div class="w-1 h-5 rounded-full bg-accent"></div>
                        หมวดหมู่
                    </h3>
                    <ul class="space-y-1">
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('knowledge') }}?cat={{ $cat->slug }}"
                               class="flex items-center justify-between text-sm text-slate-600 hover:text-accent hover:bg-accent/5 transition-all cursor-pointer py-2.5 px-3 rounded-xl group">
                                <span class="group-hover:translate-x-1 transition-transform">{{ $cat->name }}</span>
                                <span class="text-xs text-slate-400 bg-slate-100 group-hover:bg-accent/10 group-hover:text-accent px-2.5 py-0.5 rounded-full transition-colors">{{ $cat->knowledge_bases_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
