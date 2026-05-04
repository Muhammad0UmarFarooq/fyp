<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvestBridge - High Stakes Venture Capital</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        colors: {
                            brand: {
                                dark: '#1e3a8a', // Background
                                card: '#161e2d', // Card background
                                green: '#4ade80', // Primary Green
                                yellow: '#facc15', // Primary Yellow
                                muted: '#94a3b8'
                            }
                        }
                    }
                }
            }
        </script>
        <style type="text/tailwindcss">
            @layer utilities {
                .bg-grid-pattern {
                    background-image: 
                        linear-gradient(to right, rgba(255,255,255,0.02) 1px, transparent 1px),
                        linear-gradient(to bottom, rgba(255,255,255,0.02) 1px, transparent 1px);
                    background-size: 40px 40px;
                }
            }
        </style>
    @endif
</head>
<body class="font-sans min-h-screen relative overflow-x-hidden selection:bg-brand-green selection:text-brand-light bg-blue-900">
    
    <!-- Background visual effects -->
    <div class="absolute inset-0 bg-grid-pattern pointer-events-none opacity-50"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-blue-900/50 to-blue-900 pointer-events-none"></div>
    <!-- A faint glow in the center to mimic the image's lighting -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[600px] bg-brand-green/5 rounded-full blur-[100px] pointer-events-none"></div>

    <!-- Navbar -->
    <header class="bg[#0B1326] relative z-10 container mx-auto px-6 py-8 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center gap-2">
            <span class="text-xl font-bold tracking-tight">Invest<span class="text-brand-green">Bridge</span></span>
        </div>

        <!-- Nav Links -->
        <nav class="hidden md:flex items-center gap-6">
            <a href="#" class="text-brand-muted hover:text-white transition-colors text-sm font-medium">Continue as Guest</a>
            <a href="#" class="bg-brand-green text-brand-dark px-5 py-2.5 rounded-md text-sm font-semibold hover:bg-brand-green/90 transition-colors">Investor Entry</a>
            <a href="#" class="bg-brand-green/10 text-brand-green border border-brand-green/30 px-5 py-2.5 rounded-md text-sm font-semibold hover:bg-brand-green/20 transition-colors">Entrepreneur Entry</a>
        </nav>
    </header>

    @yield('content')

</body>
</html>