@extends('layouts.app')
@section('title', 'เอกสารและข้อมูลสอบ — ' . config('app.name'))

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
                    <li class="text-white font-medium">เอกสาร</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-up">เอกสาร</h1>
            <p class="text-white/70 mt-3 text-lg animate-fade-up" style="animation-delay: 0.1s;">ดาวน์โหลดเอกสารและแบบฟอร์มต่าง ๆ ของโรงเรียน</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @forelse($categories as $cat)
        @if($cat->documents->isNotEmpty())
        <section class="mb-12" aria-labelledby="cat-{{ $cat->id }}" data-aos="fade-up">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white text-lg shadow-sm"
                     style="background-color: {{ $cat->color }}">
                    @if($cat->icon)
                    <span>{{ $cat->icon }}</span>
                    @else
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    @endif
                </div>
                <h2 id="cat-{{ $cat->id }}" class="text-xl font-bold text-slate-900">{{ $cat->name }}</h2>
                <span class="text-xs text-slate-400 bg-slate-100 px-2.5 py-0.5 rounded-full">{{ $cat->documents->count() }} ไฟล์</span>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">
                <table class="w-full text-sm" role="table">
                    <thead>
                        <tr class="border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                            <th class="text-left px-6 py-3.5 font-semibold text-slate-700" scope="col">ชื่อเอกสาร</th>
                            <th class="text-left px-4 py-3.5 font-semibold text-slate-700 hidden md:table-cell" scope="col">ประเภท</th>
                            <th class="text-left px-4 py-3.5 font-semibold text-slate-700 hidden md:table-cell" scope="col">ขนาด</th>
                            <th class="text-left px-4 py-3.5 font-semibold text-slate-700 hidden sm:table-cell" scope="col">ดาวน์โหลด</th>
                            <th class="px-4 py-3.5" scope="col"><span class="sr-only">จัดการ</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($cat->documents as $doc)
                        <tr class="hover:bg-accent/[0.02] transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @php
                                        $iconMap = ['pdf' => 'text-red-500', 'docx' => 'text-blue-500', 'doc' => 'text-blue-500', 'xlsx' => 'text-emerald-500', 'xls' => 'text-emerald-500'];
                                        $iconColor = $iconMap[strtolower($doc->file_type)] ?? 'text-slate-400';
                                    @endphp
                                    <svg class="w-8 h-8 {{ $iconColor }} flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <div>
                                        <p class="font-medium text-slate-900 group-hover:text-accent transition-colors">{{ $doc->title }}</p>
                                        @if($doc->description)
                                        <p class="text-xs text-slate-500 mt-0.5">{{ $doc->description }}</p>
                                        @endif
                                        @if($doc->year)
                                        <span class="inline-block text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full mt-1">ปี {{ $doc->year }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 hidden md:table-cell">
                                <span class="uppercase text-xs font-bold {{ $iconColor }}">{{ $doc->file_type }}</span>
                            </td>
                            <td class="px-4 py-4 text-slate-500 hidden md:table-cell">{{ $doc->file_size_human }}</td>
                            <td class="px-4 py-4 text-slate-500 hidden sm:table-cell">{{ number_format($doc->download_count) }}</td>
                            <td class="px-4 py-4 text-right">
                                <a href="{{ route('documents.download', $doc->id) }}"
                                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-accent text-white text-xs font-semibold rounded-lg hover:bg-accent-dark transition-all duration-200 cursor-pointer hover:shadow-md hover:shadow-accent/20 hover:-translate-y-0.5"
                                   aria-label="ดาวน์โหลด {{ $doc->title }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    ดาวน์โหลด
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        @endif
        @empty
        <div class="text-center py-20 text-slate-400">
            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <p class="text-lg">ยังไม่มีเอกสาร</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
