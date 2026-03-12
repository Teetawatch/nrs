<!DOCTYPE html>
<html lang="th" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'โรงเรียน'))</title>
    <meta name="description" content="@yield('description', 'เว็บไซต์โรงเรียน')">

    {{-- Google Fonts: Kanit (Headings) + Sarabun (Content) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700;800&family=Sarabun:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary:   { DEFAULT: '#3B82F6', 50: '#EFF6FF', 100: '#DBEAFE', 200: '#BFDBFE', 300: '#93C5FD', 400: '#60A5FA', 500: '#3B82F6', 600: '#2563EB', 700: '#1D4ED8', 800: '#1E40AF', 900: '#1E3A8A' },
                        secondary: { DEFAULT: '#64748B', light: '#94A3B8', dark: '#475569' },
                        accent:    { DEFAULT: '#10B981', light: '#34D399', dark: '#059669' },
                        gold:      { DEFAULT: '#F59E0B', light: '#FCD34D', dark: '#D97706' },
                    },
                    fontFamily: {
                        sans: ['Sarabun', 'sans-serif'],
                        heading: ['Kanit', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out forwards',
                        'fade-up': 'fadeUp 0.6s ease-out forwards',
                        'fade-down': 'fadeDown 0.5s ease-out forwards',
                        'slide-left': 'slideLeft 0.6s ease-out forwards',
                        'slide-right': 'slideRight 0.6s ease-out forwards',
                        'scale-in': 'scaleIn 0.5s ease-out forwards',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-soft': 'pulseSoft 3s ease-in-out infinite',
                        'shimmer': 'shimmer 2s linear infinite',
                        'marquee': 'marquee 30s linear infinite',
                    },
                    keyframes: {
                        fadeIn:     { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        fadeUp:     { '0%': { opacity: '0', transform: 'translateY(30px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        fadeDown:   { '0%': { opacity: '0', transform: 'translateY(-20px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        slideLeft:  { '0%': { opacity: '0', transform: 'translateX(40px)' }, '100%': { opacity: '1', transform: 'translateX(0)' } },
                        slideRight: { '0%': { opacity: '0', transform: 'translateX(-40px)' }, '100%': { opacity: '1', transform: 'translateX(0)' } },
                        scaleIn:    { '0%': { opacity: '0', transform: 'scale(0.9)' }, '100%': { opacity: '1', transform: 'scale(1)' } },
                        float:      { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-10px)' } },
                        pulseSoft:  { '0%, 100%': { opacity: '0.5' }, '50%': { opacity: '1' } },
                        shimmer:    { '0%': { backgroundPosition: '-200% 0' }, '100%': { backgroundPosition: '200% 0' } },
                        marquee:    { '0%': { transform: 'translateX(0)' }, '100%': { transform: 'translateX(-50%)' } },
                    },
                },
            },
        }
    </script>

    {{-- AOS (Animate on Scroll) --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    <style>
        body { font-family: 'Sarabun', sans-serif; }
        .prose { font-family: 'Sarabun', sans-serif; }
        .font-heading { font-family: 'Kanit', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Kanit', sans-serif; }
        [x-cloak] { display: none !important; }

        /* Gradient text utility */
        .text-gradient {
            background: linear-gradient(135deg, #0369A1, #38BDF8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .text-gradient-gold {
            background: linear-gradient(135deg, #D4A843, #F5D98A, #D4A843);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glass morphism */
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .glass-dark {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Card hover lift */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
        }

        /* Decorative gradient blobs */
        .blob-gradient {
            background: radial-gradient(circle at 30% 30%, rgba(3, 105, 161, 0.15), transparent 60%),
                        radial-gradient(circle at 70% 70%, rgba(56, 189, 248, 0.1), transparent 60%);
        }

        /* Subtle pattern overlay */
        .pattern-dots {
            background-image: radial-gradient(circle, rgba(15, 23, 42, 0.05) 1px, transparent 1px);
            background-size: 24px 24px;
        }

        /* Section label line */
        .section-label::after {
            content: '';
            display: block;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, #0369A1, #38BDF8);
            border-radius: 2px;
            margin-top: 8px;
        }
        .section-label-center::after {
            margin-left: auto;
            margin-right: auto;
        }

        /* Smooth scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #F1F5F9; }
        ::-webkit-scrollbar-thumb { background: #94A3B8; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #64748B; }

        /* Respect reduced motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
            [data-aos] { opacity: 1 !important; transform: none !important; }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-900 antialiased" x-data="{ showScrollTop: false }" @scroll.window="showScrollTop = window.scrollY > 400">

    {{-- Skip to main content (accessibility) --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[100] focus:px-4 focus:py-2 focus:bg-accent focus:text-white focus:rounded-lg focus:shadow-lg">
        ข้ามไปยังเนื้อหาหลัก
    </a>

    @include('layouts.partials.announcement-bar')
    @include('layouts.partials.navbar')

    <main id="main-content">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    {{-- Scroll to Top Button --}}
    <button x-show="showScrollTop" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="fixed bottom-6 right-6 z-50 w-12 h-12 bg-accent text-white rounded-full shadow-lg hover:bg-accent-dark hover:shadow-xl flex items-center justify-center transition-all duration-200 cursor-pointer group"
            aria-label="เลื่อนขึ้นด้านบน">
        <svg class="w-5 h-5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
        </svg>
    </button>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- AOS Init --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 700,
                easing: 'ease-out-cubic',
                once: true,
                offset: 60,
                disable: window.matchMedia('(prefers-reduced-motion: reduce)').matches
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
