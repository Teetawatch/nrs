@php $contactInfo = \App\Models\ContactInfo::all()->keyBy('key'); @endphp
@php
    $internalSystems = \App\Models\SchoolSystem::active()->whereHas('category', fn($q) => $q->where('name', 'ระบบบริหารการศึกษา'))->orderBy('order')->get();
    $externalSystems = \App\Models\SchoolSystem::active()->whereHas('category', fn($q) => $q->where('name', 'ระบบภายนอก')->orWhere('name', 'ระบบสนับสนุน'))->orderBy('order')->get();
    if ($internalSystems->isEmpty() && $externalSystems->isEmpty()) {
        $allSystems = \App\Models\SchoolSystem::active()->orderBy('order')->get();
        $internalSystems = $allSystems->take(5);
        $externalSystems = $allSystems->skip(5);
    }
@endphp

<footer class="w-full text-white text-sm" role="contentinfo">

    {{-- Top Bar --}}
    <div class="bg-primary py-4 px-4 sm:px-8 flex flex-wrap justify-between items-center border-b border-white/10">
        <div class="flex items-center space-x-2">
            <span class="font-light opacity-90 text-sm">Call center</span>
            <div class="flex items-center space-x-1 font-bold text-lg">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                @if(isset($contactInfo['phone']))
                <a href="tel:{{ $contactInfo['phone']->value }}" class="hover:text-white/70 transition-colors">{{ $contactInfo['phone']->value }}</a>
                @else
                <span>-</span>
                @endif
            </div>
        </div>
        <div class="flex items-center divide-x divide-white/30 mt-2 sm:mt-0">
            <a href="{{ route('documents') }}" class="px-4 flex items-center gap-2 hover:opacity-80 transition-opacity text-xs sm:text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                จัดซื้อจัดจ้าง
            </a>
            <a href="{{ route('contact') }}" class="px-4 flex items-center gap-2 hover:opacity-80 transition-opacity text-xs sm:text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                ถามตอบ
            </a>
            <a href="{{ route('personnel') }}" class="px-4 flex items-center gap-2 hover:opacity-80 transition-opacity text-xs sm:text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                สมุดโทรศัพท์
            </a>
            <a href="{{ route('about.structure') }}" class="px-4 flex items-center gap-2 hover:opacity-80 transition-opacity text-xs sm:text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 012 2h2a2 2 0 012-2V7a2 2 0 01-2-2h-2a2 2 0 01-2 2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                แผนผังเว็บไซต์
            </a>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="bg-[#001b3a] pt-12 pb-16 px-4 sm:px-8 lg:px-12 border-t border-white/5">
        <div class="grid grid-cols-12 gap-8">

            {{-- Left: Branding & Contact --}}
            <div class="col-span-12 lg:col-span-4 flex gap-6">
                <div class="flex-shrink-0">
                    <img src="{{ asset('images/logo/NSRS.webp') }}" alt="{{ config('app.name') }} Logo" class="w-20 h-20 object-contain">
                </div>
                <div class="flex flex-col space-y-4">
                    <div>
                        <h2 class="text-lg font-bold leading-tight" data-translate="schoolName">โรงเรียนพลาธิการ</h2>
                        <h3 class="text-base font-light opacity-90" data-translate="schoolType">กรมพลาธิการทหารเรือ</h3>
                    </div>
                    <div class="text-sm space-y-2 opacity-80 leading-relaxed max-w-xs">
                        @if(isset($contactInfo['address']))
                        <p>{{ $contactInfo['address']->value }}</p>
                        @endif
                        @if(isset($contactInfo['phone']))
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                            <a href="tel:{{ $contactInfo['phone']->value }}" class="hover:underline">{{ $contactInfo['phone']->value }}</a>
                        </div>
                        @endif
                        @if(isset($contactInfo['email']))
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                            <a href="mailto:{{ $contactInfo['email']->value }}" class="hover:underline">{{ $contactInfo['email']->value }}</a>
                        </div>
                        @endif
                        @if(isset($contactInfo['website']))
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                            <a href="{{ $contactInfo['website']->value }}" target="_blank" rel="noopener" class="hover:underline">{{ $contactInfo['website']->value }}</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Middle: Systems --}}
            <div class="col-span-12 lg:col-span-5 grid grid-cols-1 md:grid-cols-2 gap-8 border-l border-white/20 pl-8">
                {{-- Internal Systems --}}
                <div>
                    <h4 class="text-base font-bold mb-5 border-b border-white/10 pb-2">ระบบภายใน</h4>
                    @if($internalSystems->isNotEmpty())
                    <ul class="space-y-2 text-xs opacity-75 leading-relaxed">
                        @foreach($internalSystems as $system)
                        <li>
                            <a href="{{ $system->url }}" @if($system->open_new_tab) target="_blank" rel="noopener noreferrer" @endif class="hover:underline hover:opacity-100 transition-opacity">
                                {{ $system->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <ul class="space-y-2 text-xs opacity-75 leading-relaxed">
                        <li><a href="{{ route('systems') }}" class="hover:underline">ดูระบบงานทั้งหมด</a></li>
                    </ul>
                    @endif
                </div>
                {{-- External Systems / Quick Links --}}
                <div>
                    <h4 class="text-base font-bold mb-5 border-b border-white/10 pb-2">ลิงก์ด่วน</h4>
                    <div class="grid grid-cols-2 gap-x-4 text-xs opacity-75 leading-relaxed">
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="hover:underline hover:opacity-100 transition-opacity" data-translate="home">หน้าแรก</a></li>
                            <li><a href="{{ route('news') }}" class="hover:underline hover:opacity-100 transition-opacity" data-translate="news">ข่าวสาร</a></li>
                            <li><a href="{{ route('personnel') }}" class="hover:underline hover:opacity-100 transition-opacity" data-translate="personnel">บุคลากร</a></li>
                            <li><a href="{{ route('documents') }}" class="hover:underline hover:opacity-100 transition-opacity" data-translate="documents">เอกสาร</a></li>
                            <li><a href="{{ route('knowledge') }}" class="hover:underline hover:opacity-100 transition-opacity" data-translate="footerKnowledge">คลังความรู้</a></li>
                        </ul>
                        <ul class="space-y-2">
                            <li><a href="{{ route('about.history') }}" class="hover:underline hover:opacity-100 transition-opacity" data-translate="aboutHistory">ประวัติความเป็นมา</a></li>
                            <li><a href="{{ route('about.philosophy') }}" class="hover:underline hover:opacity-100 transition-opacity" data-translate="aboutPhilosophy">ปรัชญา/วิสัยทัศน์</a></li>
                            <li><a href="{{ route('about.curriculum') }}" class="hover:underline hover:opacity-100 transition-opacity" data-translate="aboutCurriculum">หลักสูตร</a></li>
                            <li><a href="{{ route('systems') }}" class="hover:underline hover:opacity-100 transition-opacity" data-translate="systems">ระบบงาน</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:underline hover:opacity-100 transition-opacity" data-translate="contact">ติดต่อเรา</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Right: Social & Map --}}
            <div class="col-span-12 lg:col-span-3 space-y-8 pl-0 lg:pl-4">
                <div>
                    <h4 class="text-base font-bold mb-4">ติดตามเราได้ที่</h4>
                    <div class="flex gap-2 flex-wrap">
                        @if(isset($contactInfo['facebook']))
                        <a href="{{ $contactInfo['facebook']->value }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center hover:opacity-80 transition-opacity" aria-label="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3l-.5 3h-2.5v6.8c4.56-.93 8-4.96 8-9.8z"/></svg>
                        </a>
                        @else
                        <a href="#" class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center hover:opacity-80 transition-opacity" aria-label="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3l-.5 3h-2.5v6.8c4.56-.93 8-4.96 8-9.8z"/></svg>
                        </a>
                        @endif
                        @if(isset($contactInfo['youtube']))
                        <a href="{{ $contactInfo['youtube']->value }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center hover:opacity-80 transition-opacity" aria-label="YouTube">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        @endif
                        @if(isset($contactInfo['line']))
                        <a href="{{ $contactInfo['line']->value }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center hover:opacity-80 transition-opacity" aria-label="LINE">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
                @if(isset($contactInfo['map_url']) || isset($contactInfo['address']))
                <div>
                    <h4 class="text-base font-bold mb-4">ที่อยู่</h4>
                    @if(isset($contactInfo['map_url']))
                    <a href="{{ $contactInfo['map_url']->value }}" target="_blank" rel="noopener noreferrer" class="w-14 h-14 bg-gray-600 rounded flex items-center justify-center hover:bg-gray-500 transition-colors overflow-hidden relative" aria-label="ดูแผนที่">
                        <svg class="w-7 h-7 text-red-400 z-10" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/></svg>
                    </a>
                    @else
                    <div class="w-14 h-14 bg-gray-600 rounded flex items-center justify-center">
                        <svg class="w-7 h-7 text-red-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/></svg>
                    </div>
                    @endif
                </div>
                @endif
            </div>

        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="bg-amber-600 py-5 px-4 sm:px-8 lg:px-12 flex flex-col md:flex-row justify-between items-center text-[13px] font-medium text-black/90 gap-3">
        <div class="text-center md:text-left">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. ALL RIGHTS RESERVED.</p>
            <p class="opacity-70 text-xs mt-0.5">Naval Supply School — กรมพลาธิการทหารเรือ</p>
        </div>
        <div class="text-center">
            <a href="{{ route('about.history') }}" class="hover:underline text-xs">นโยบายความเป็นส่วนตัว (Privacy Policy)</a>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ url('/admin') }}" class="flex items-center gap-1.5 hover:underline transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <span data-translate="footerAdmin">เข้าสู่ระบบผู้ดูแล</span>
            </a>
        </div>
    </div>

</footer>
