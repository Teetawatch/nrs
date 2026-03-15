<footer class="bg-primary text-white relative overflow-hidden" role="contentinfo">
    {{-- Decorative elements --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-accent/5 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-accent/5 rounded-full blur-3xl -translate-x-1/3 translate-y-1/3"></div>
    <div class="absolute inset-0 opacity-[0.02]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cpath d=&quot;M60 0H0v60&quot; fill=&quot;none&quot; stroke=&quot;%23fff&quot; stroke-width=&quot;0.5&quot;/%3E%3C/svg%3E');"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- School Info --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-heading font-bold text-lg leading-none block">{{ config('app.name') }}</span>
                        <span class="text-white/40 text-[10px] font-medium tracking-wider uppercase">School Website</span>
                    </div>
                </div>
                <p class="text-white/50 text-sm leading-relaxed mb-6" data-translate="footerDesc">
                    มุ่งมั่นพัฒนาผู้เรียนให้มีความรู้ ทักษะ และคุณธรรม พร้อมก้าวสู่สังคมอย่างมีคุณภาพ
                </p>
                @php $contactInfo = \App\Models\ContactInfo::all()->keyBy('key'); @endphp
                <div class="space-y-3">
                    @if(isset($contactInfo['phone']))
                    <a href="tel:{{ $contactInfo['phone']->value }}" class="flex items-center gap-3 text-sm text-white/50 hover:text-accent-light transition-colors cursor-pointer group">
                        <div class="w-8 h-8 rounded-lg bg-white/5 group-hover:bg-accent/10 flex items-center justify-center flex-shrink-0 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        {{ $contactInfo['phone']->value }}
                    </a>
                    @endif
                    @if(isset($contactInfo['email']))
                    <a href="mailto:{{ $contactInfo['email']->value }}" class="flex items-center gap-3 text-sm text-white/50 hover:text-accent-light transition-colors cursor-pointer group">
                        <div class="w-8 h-8 rounded-lg bg-white/5 group-hover:bg-accent/10 flex items-center justify-center flex-shrink-0 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        {{ $contactInfo['email']->value }}
                    </a>
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="font-heading font-bold mb-5 text-sm uppercase tracking-wider text-white/80" data-translate="footerQuickLinks">ลิงก์ด่วน</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="text-white/50 hover:text-accent-light transition-colors cursor-pointer inline-flex items-center gap-2 group"><svg class="w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg><span data-translate="home">หน้าแรก</span></a></li>
                    <li><a href="{{ route('news') }}" class="text-white/50 hover:text-accent-light transition-colors cursor-pointer inline-flex items-center gap-2 group"><svg class="w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg><span data-translate="news">ข่าวสาร</span></a></li>
                    <li><a href="{{ route('personnel') }}" class="text-white/50 hover:text-accent-light transition-colors cursor-pointer inline-flex items-center gap-2 group"><svg class="w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg><span data-translate="personnel">บุคลากร</span></a></li>
                    <li><a href="{{ route('documents') }}" class="text-white/50 hover:text-accent-light transition-colors cursor-pointer inline-flex items-center gap-2 group"><svg class="w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg><span data-translate="documents">เอกสาร</span></a></li>
                    <li><a href="{{ route('knowledge') }}" class="text-white/50 hover:text-accent-light transition-colors cursor-pointer inline-flex items-center gap-2 group"><svg class="w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg><span data-translate="footerKnowledge">แหล่งความรู้</span></a></li>
                    <li><a href="{{ route('systems') }}" class="text-white/50 hover:text-accent-light transition-colors cursor-pointer inline-flex items-center gap-2 group"><svg class="w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg><span data-translate="systems">ระบบงาน</span></a></li>
                    <li><a href="{{ route('contact') }}" class="text-white/50 hover:text-accent-light transition-colors cursor-pointer inline-flex items-center gap-2 group"><svg class="w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg><span data-translate="contact">ติดต่อเรา</span></a></li>
                </ul>
            </div>

            {{-- About School --}}
            <div>
                <h3 class="font-heading font-bold mb-5 text-sm uppercase tracking-wider text-white/80" data-translate="footerAbout">เกี่ยวกับโรงเรียน</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('about.history') }}" class="text-white/50 hover:text-accent-light transition-colors cursor-pointer inline-flex items-center gap-2 group"><svg class="w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg><span data-translate="aboutHistory">ประวัติความเป็นมา</span></a></li>
                    <li><a href="{{ route('about.structure') }}" class="text-white/50 hover:text-accent-light transition-colors cursor-pointer inline-flex items-center gap-2 group"><svg class="w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg><span data-translate="aboutStructure">โครงสร้างหน่วย</span></a></li>
                    <li><a href="{{ route('about.symbols') }}" class="text-white/50 hover:text-accent-light transition-colors cursor-pointer inline-flex items-center gap-2 group"><svg class="w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg><span data-translate="aboutSymbols">สัญลักษณ์สถานศึกษา</span></a></li>
                    <li><a href="{{ route('about.philosophy') }}" class="text-white/50 hover:text-accent-light transition-colors cursor-pointer inline-flex items-center gap-2 group"><svg class="w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg><span data-translate="aboutPhilosophy">ปรัชญา/วิสัยทัศน์</span></a></li>
                    <li><a href="{{ route('about.curriculum') }}" class="text-white/50 hover:text-accent-light transition-colors cursor-pointer inline-flex items-center gap-2 group"><svg class="w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg><span data-translate="aboutCurriculum">หลักสูตร</span></a></li>
                </ul>
            </div>

            {{-- Contact CTA --}}
            <div>
                <h3 class="font-heading font-bold mb-5 text-sm uppercase tracking-wider text-white/80" data-translate="footerContact">ติดต่อเรา</h3>
                <p class="text-white/50 text-sm mb-5 leading-relaxed" data-translate="footerContactDesc">
                    มีคำถามหรือข้อเสนอแนะ? ส่งข้อความถึงเราได้ตลอดเวลา
                </p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-accent text-white text-sm font-semibold rounded-xl hover:bg-accent-dark transition-all duration-200 cursor-pointer shadow-lg shadow-accent/20 hover:shadow-accent/30 hover:-translate-y-0.5 group">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span data-translate="footerSendMsg">ส่งข้อความ</span>
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="border-t border-white/[0.06]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/30">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }} — All rights reserved.</p>
            <a href="{{ url('/admin') }}" class="hover:text-accent-light transition-colors cursor-pointer flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <span data-translate="footerAdmin">เข้าสู่ระบบผู้ดูแล</span>
            </a>
        </div>
    </div>
</footer>
