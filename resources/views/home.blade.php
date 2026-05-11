<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvestBridge - High Stakes Venture Capital</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#131B2E] text-white font-sans min-h-screen relative overflow-x-hidden selection:bg-brand-green selection:text-brand-dark">

<!-- Background Effects -->
<div class="absolute inset-0 bg-grid-pattern pointer-events-none opacity-50"></div>
<div class="absolute inset-0 bg-gradient-to-b from-transparent via-brand-dark/50 to-brand-dark pointer-events-none"></div>
<div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[600px] bg-brand-green/5 rounded-full blur-[100px] pointer-events-none"></div>

<!-- Navbar -->
<header class="bg-[#0B1326] relative z-10 container mx-auto px-6 py-8 flex items-center justify-between">

    <!-- Logo -->
    <div class="flex items-center gap-2">
        <span class="text-xl font-bold tracking-tight">
            Invest<span class="text-brand-green">Bridge</span>
        </span>
    </div>

    <!-- Navigation -->
    <nav class="hidden md:flex items-center gap-6">
        @guest
            <a href="{{ route('pitch.arena') }}" class="text-brand-muted hover:text-white transition-colors text-sm font-medium">
                Continue as Guest
            </a>

            <!-- Investor -->
            <a href="{{ route('investor.register') }}"
               class="bg-brand-green/10 text-brand-green border border-brand-green/30 px-5 py-2.5 rounded-md text-sm font-semibold hover:bg-brand-green/20 transition-colors">
                Investor Entry
            </a>

            <!-- Entrepreneur -->
            <a href="{{ route('entrepreneur.register') }}"
               class="bg-brand-green/10 text-brand-green border border-brand-green/30 px-5 py-2.5 rounded-md text-sm font-semibold hover:bg-brand-green/20 transition-colors">
                Entrepreneur Entry
            </a>
        @else
            @if(auth()->user()->role === 'entrepreneur')
                <a href="{{ route('entrepreneur.dashboard') }}"
                   class="bg-brand-green/10 text-brand-green border border-brand-green/30 px-5 py-2.5 rounded-md text-sm font-semibold hover:bg-brand-green/20 transition-colors">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('investor.home') }}"
                   class="bg-brand-green/10 text-brand-green border border-brand-green/30 px-5 py-2.5 rounded-md text-sm font-semibold hover:bg-brand-green/20 transition-colors">
                    Go to Dashboard
                </a>
            @endif
            
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-brand-muted hover:text-white transition-colors text-sm font-medium">
                    Sign Out
                </button>
            </form>
        @endguest
    </nav>
</header>

<!-- Main Content -->
<main class="relative z-10 container mx-auto px-6 pt-16 pb-20 flex flex-col items-center text-center">

    <!-- Subtitle -->
    <div class="text-brand-green text-[11px] font-bold tracking-[0.25em] uppercase mb-8">
        Institutional Grade Access
    </div>

    <!-- Heading -->
    <h1 class="text-5xl md:text-7xl font-bold tracking-tight leading-[1.1] mb-8 max-w-4xl text-[#e2e8f0]">
        The Gateway to
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#b4ea70] to-[#5be59b]">
            High-Stakes
        </span>
        Venture Capital
    </h1>

    <!-- Description -->
    <p class="text-brand-muted text-lg md:text-xl max-w-3xl mb-16 leading-relaxed font-medium">
        Connecting sophisticated capital with the world's most ambitious founders.
        Secure, vetted, and architected for exponential growth.
    </p>

    <!-- Cards -->
    <div class="grid md:grid-cols-2 gap-8 w-full max-w-5xl mb-24 text-left">

        <!-- Investor Card -->
        <div class="bg-[#1e293b]/60 backdrop-blur-md border border-brand-green/20 rounded-xl p-8 hover:border-brand-green/40 transition-colors group">

            <h3 class="text-2xl font-bold mb-3 text-white">
                Investor Entry
            </h3>

            <p class="text-brand-muted mb-8 font-medium">
                Deploy capital into exclusive, vetted high-growth startups and venture funds.
            </p>

            <a href="{{ route('investor.register') }}"
               class="inline-flex items-center justify-center w-full bg-brand-green text-[#064e3b] px-6 py-3.5 rounded-md font-bold hover:bg-brand-green/90 transition-colors">
                Begin Allocation →
            </a>

        </div>

        <!-- Entrepreneur Card -->
        <div class="bg-[#1e293b]/60 backdrop-blur-md border border-brand-yellow/20 rounded-xl p-8 hover:border-brand-yellow/40 transition-colors group">

            <h3 class="text-2xl font-bold mb-3 text-white">
                Entrepreneur Entry
            </h3>

            <p class="text-brand-muted mb-8 font-medium">
                Submit your vision for institutional review and access global capital partners.
            </p>

            <a href="{{ route('entrepreneur.register') }}"
               class="inline-flex items-center justify-center w-full bg-brand-yellow text-[#422006] px-6 py-3.5 rounded-md font-bold hover:bg-brand-yellow/90 transition-colors">
                Submit Pitch →
            </a>

        </div>

    </div>

    <!-- Stats -->
    <div class="bg-[#1e293b]/40 backdrop-blur-lg border border-white/5 rounded-2xl w-full max-w-5xl px-12 py-10 flex flex-col md:flex-row items-center justify-between gap-10">

        <div class="text-center">
            <div class="text-3xl md:text-4xl font-bold text-brand-green mb-2">$100M+</div>
            <div class="text-[11px] text-brand-muted font-bold tracking-[0.15em] uppercase">
                Capital Deployed
            </div>
        </div>

        <div class="hidden md:block w-px h-16 bg-white/10"></div>

        <div class="text-center">
            <div class="text-3xl md:text-4xl font-bold text-white mb-2">500+</div>
            <div class="text-[11px] text-brand-muted font-bold tracking-[0.15em] uppercase">
                Verified Investors
            </div>
        </div>

        <div class="hidden md:block w-px h-16 bg-white/10"></div>

        <div class="text-center">
            <div class="text-3xl md:text-4xl font-bold text-brand-yellow mb-2">24/7</div>
            <div class="text-[11px] text-brand-muted font-bold tracking-[0.15em] uppercase">
                Regulatory Support
            </div>
        </div>

    </div>

</main>

</body>
</html>