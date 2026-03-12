@extends('layouts.app')
@section('title', 'ติดต่อเรา — ' . config('app.name'))

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
                    <li class="text-white font-medium">ติดต่อเรา</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-up">ติดต่อเรา</h1>
            <p class="text-white/70 mt-3 text-lg animate-fade-up" style="animation-delay: 0.1s;">ติดต่อสอบถามข้อมูลหรือส่งข้อความถึงเรา</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3" role="alert" data-aos="fade-down">
            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- Contact Info --}}
            <div class="space-y-6" data-aos="fade-right">
                <div>
                    <h2 class="text-2xl font-bold text-primary mb-2 flex items-center gap-3">
                        <div class="w-1.5 h-7 rounded-full bg-gradient-to-b from-accent to-accent-light"></div>
                        ข้อมูลติดต่อ
                    </h2>
                    <p class="text-slate-600">ติดต่อเราได้ทางช่องทางต่าง ๆ ดังนี้</p>
                </div>

                @if(isset($contactInfo['address']))
                <div class="flex items-start gap-4 p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-all duration-200">
                    <div class="w-11 h-11 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-1">{{ $contactInfo['address']->label }}</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $contactInfo['address']->value }}</p>
                    </div>
                </div>
                @endif

                @if(isset($contactInfo['phone']))
                <a href="tel:{{ $contactInfo['phone']->value }}" class="flex items-start gap-4 p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:border-accent/30 hover:shadow-md transition-all duration-200 cursor-pointer group">
                    <div class="w-11 h-11 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0 group-hover:bg-accent/20 transition-colors">
                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-1 group-hover:text-accent transition-colors">{{ $contactInfo['phone']->label }}</h3>
                        <p class="text-slate-600 text-sm">{{ $contactInfo['phone']->value }}</p>
                    </div>
                </a>
                @endif

                @if(isset($contactInfo['fax']))
                <div class="flex items-start gap-4 p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm">
                    <div class="w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-1">{{ $contactInfo['fax']->label }}</h3>
                        <p class="text-slate-600 text-sm">{{ $contactInfo['fax']->value }}</p>
                    </div>
                </div>
                @endif

                @if(isset($contactInfo['email']))
                <a href="mailto:{{ $contactInfo['email']->value }}" class="flex items-start gap-4 p-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:border-accent/30 hover:shadow-md transition-all duration-200 cursor-pointer group">
                    <div class="w-11 h-11 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0 group-hover:bg-accent/20 transition-colors">
                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-1 group-hover:text-accent transition-colors">{{ $contactInfo['email']->label }}</h3>
                        <p class="text-slate-600 text-sm">{{ $contactInfo['email']->value }}</p>
                    </div>
                </a>
                @endif

                {{-- Map --}}
                @if(isset($contactInfo['map_url']))
                <div class="rounded-2xl overflow-hidden border border-slate-200/80 h-64 shadow-sm">
                    <iframe src="{{ $contactInfo['map_url']->value }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="แผนที่โรงเรียน"></iframe>
                </div>
                @endif
            </div>

            {{-- Contact Form --}}
            <div data-aos="fade-left">
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-primary mb-6 flex items-center gap-3">
                        <div class="w-1.5 h-7 rounded-full bg-gradient-to-b from-accent to-accent-light"></div>
                        ส่งข้อความถึงเรา
                    </h2>

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-5" novalidate>
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
                                    ชื่อ-นามสกุล <span class="text-red-500" aria-hidden="true">*</span>
                                </label>
                                <input type="text" id="name" name="name" required
                                       value="{{ old('name') }}"
                                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-300' }} text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition-colors"
                                       placeholder="ชื่อของคุณ"
                                       aria-required="true"
                                       aria-describedby="{{ $errors->has('name') ? 'name-error' : '' }}">
                                @error('name')<p id="name-error" class="text-red-500 text-xs mt-1" role="alert">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">เบอร์โทรศัพท์</label>
                                <input type="tel" id="phone" name="phone"
                                       value="{{ old('phone') }}"
                                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('phone') ? 'border-red-400 bg-red-50' : 'border-slate-300' }} text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition-colors"
                                       placeholder="08x-xxx-xxxx">
                                @error('phone')<p class="text-red-500 text-xs mt-1" role="alert">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">
                                อีเมล <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <input type="email" id="email" name="email" required
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-300' }} text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition-colors"
                                   placeholder="email@example.com"
                                   aria-required="true">
                            @error('email')<p class="text-red-500 text-xs mt-1" role="alert">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-slate-700 mb-1.5">
                                เรื่อง <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <input type="text" id="subject" name="subject" required
                                   value="{{ old('subject') }}"
                                   class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('subject') ? 'border-red-400 bg-red-50' : 'border-slate-300' }} text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition-colors"
                                   placeholder="หัวข้อที่ต้องการติดต่อ"
                                   aria-required="true">
                            @error('subject')<p class="text-red-500 text-xs mt-1" role="alert">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-slate-700 mb-1.5">
                                ข้อความ <span class="text-red-500" aria-hidden="true">*</span>
                            </label>
                            <textarea id="message" name="message" required rows="5"
                                      class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('message') ? 'border-red-400 bg-red-50' : 'border-slate-300' }} text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition-colors resize-none"
                                      placeholder="รายละเอียดข้อความของคุณ..."
                                      aria-required="true">{{ old('message') }}</textarea>
                            @error('message')<p class="text-red-500 text-xs mt-1" role="alert">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit"
                                class="w-full px-6 py-3.5 bg-gradient-to-r from-accent to-accent-dark text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-accent/25 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                ส่งข้อความ
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
