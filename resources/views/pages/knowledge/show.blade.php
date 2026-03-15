@extends('layouts.app')
@section('title', $item->title . ' — ' . config('app.name'))
@section('description', $item->excerpt)

@section('content')
<div class="bg-slate-50 min-h-screen">
    {{-- Page Header --}}
    <div class="bg-gradient-to-br from-primary-400 via-primary-500 to-primary-600 text-white py-12 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cpath d=&quot;M60 0H0v60&quot; fill=&quot;none&quot; stroke=&quot;%23fff&quot; stroke-width=&quot;0.5&quot;/%3E%3C/svg%3E');"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <nav class="text-sm text-white/60 mb-3" aria-label="Breadcrumb">
                <ol class="flex items-center gap-2 flex-wrap">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors cursor-pointer">หน้าแรก</a></li>
                    <li aria-hidden="true"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                    <li><a href="{{ route('knowledge') }}" class="hover:text-white transition-colors cursor-pointer">แหล่งความรู้</a></li>
                    <li aria-hidden="true"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                    <li class="text-white font-medium truncate max-w-xs">{{ $item->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-10">
            <article class="flex-1 min-w-0" data-aos="fade-up">
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    @if($item->cover_image_url)
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ $item->cover_image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    </div>
                    @endif
                    <div class="p-8">
                        <div class="flex items-center gap-3 flex-wrap mb-4">
                            @if($item->category)
                            <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-lg">{{ $item->category->name }}</span>
                            @endif
                            @php
                                $typeLabel = ['article' => 'บทความ', 'video' => 'วิดีโอ', 'link' => 'ลิงก์', 'file' => 'ไฟล์'];
                                $typeColor = ['article' => '#0F172A', 'video' => '#DC2626', 'link' => '#0369A1', 'file' => '#059669'];
                            @endphp
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-lg text-white shadow-sm"
                                  style="background-color: {{ $typeColor[$item->type] ?? '#0F172A' }}">
                                {{ $typeLabel[$item->type] ?? $item->type }}
                            </span>
                            <span class="text-xs text-slate-400 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                {{ number_format($item->view_count) }} ครั้ง
                            </span>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 leading-tight mb-6">{{ $item->title }}</h1>

                        @if($item->external_url)
                        <a href="{{ $item->external_url }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-dark text-white text-sm font-semibold rounded-xl hover:shadow-lg hover:shadow-accent/25 hover:-translate-y-0.5 transition-all duration-200 mb-6 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            เปิดลิงก์ภายนอก
                        </a>
                        @endif

                        <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed
                            [&>p]:mb-4 [&>h2]:text-2xl [&>h2]:font-bold [&>h2]:mt-8 [&>h2]:mb-4
                            [&>h3]:text-xl [&>h3]:font-bold [&>h3]:mt-6 [&>h3]:mb-3
                            [&>ul]:list-disc [&>ul]:pl-6 [&>ul]:mb-4 [&>ol]:list-decimal [&>ol]:pl-6 [&>ol]:mb-4
                            [&>li]:mb-1 [&>img]:rounded-xl [&>img]:my-6
                            [&>h2]:text-[#27456B] [&>h3]:text-[#27456B]">
                            [&>blockquote]:border-l-4 [&>blockquote]:border-accent [&>blockquote]:pl-4 [&>blockquote]:italic [&>blockquote]:text-slate-600">
                            {!! $item->content !!}
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="{{ route('knowledge') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-accent transition-colors cursor-pointer group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        กลับไปแหล่งความรู้
                    </a>
                </div>
            </article>

            @if($related->isNotEmpty())
            <aside class="lg:w-72 flex-shrink-0" data-aos="fade-left">
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm sticky top-24">
                    <h3 class="font-bold text-slate-900 mb-5 flex items-center gap-2">
                        <div class="w-1 h-5 rounded-full bg-accent"></div>
                        เนื้อหาที่เกี่ยวข้อง
                    </h3>
                    <div class="space-y-4">
                        @foreach($related as $rel)
                        <a href="{{ route('knowledge.show', $rel->slug) }}" class="flex gap-3 group cursor-pointer p-1.5 -mx-1.5 rounded-xl hover:bg-accent/5 transition-colors">
                            <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 bg-slate-100">
                                @if($rel->cover_image_url)
                                <img src="{{ $rel->cover_image_url }}" alt="{{ $rel->title }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full bg-accent/5 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"/></svg>
                                </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-900 line-clamp-2 group-hover:text-accent transition-colors">{{ $rel->title }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </aside>
            @endif
        </div>
    </div>
</div>
@endsection
