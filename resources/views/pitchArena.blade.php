<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvestBridge - Startup Pitch Arena</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#111625] text-white font-sans min-h-screen antialiased">

    <!-- Top Navigation -->
    <nav class="w-full px-8 py-5 flex justify-between items-center border-b border-white/5">
        <div class="flex items-center space-x-2">
            <div class="leading-none">
                <div class="text-xl font-bold tracking-tight">
                    Invest<span class="text-brand-green">Bridge</span>
                </div>
                <div class="text-[8px] font-bold tracking-widest uppercase text-gray-500 mt-1">
                    Entrepreneur/Investor
                </div>
            </div>
        </div>
        
        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ route('pitch.arena') }}" class="text-brand-green text-sm font-bold border-b-2 border-brand-green pb-1">
                Home
            </a>
            <a href="{{ route('about') }}" class="text-gray-400 hover:text-gray-300 text-sm font-bold pb-1 transition-colors">
                About
            </a>
        </div>

        <div>
            <a href="{{ route('home') }} " class="bg-brand-green text-[#064e3b] px-6 py-2 rounded font-bold text-sm hover:bg-brand-green/90 transition-colors">
                Join us
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-12">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-3xl font-bold mb-2">Startup Pitch Arena</h1>
            <p class="text-gray-400 text-sm">The latest high-conviction deal flow from the network.</p>
        </div>

        <!-- Cards List -->
        <div class="space-y-12">
            
            <!-- Card 1 -->
            <div class="bg-brand-card rounded-lg overflow-hidden shadow-2xl border border-white/5">
                <!-- Video/Image Section -->
                <div class="relative w-full h-64 md:h-96 bg-gray-900 group">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1000&q=80" alt="Shoes Shop" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                    <!-- Play Button Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="bg-white/10 backdrop-blur-md p-6 rounded-lg cursor-pointer hover:bg-white/20 transition-colors border border-white/10 shadow-lg">
                            <svg class="w-10 h-10 text-brand-green ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 md:p-8">
                    <!-- Title Row -->
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h2 class="text-2xl font-bold">Shoes Shop</h2>
                            <div class="flex items-center text-xs text-gray-400 mt-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span>Founder: <span class="text-white font-medium">Naeem Azhar</span></span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1">Seeking Capital</div>
                            <div class="text-2xl font-bold text-brand-green">$5000000</div>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-8">
                        <div class="bg-brand-box rounded px-5 py-4 border border-white/5">
                            <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1.5">MRR</div>
                            <div class="text-lg font-bold text-white">$100000</div>
                        </div>
                        <div class="bg-brand-box rounded px-5 py-4 border border-white/5">
                            <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1.5">Time Period</div>
                            <div class="text-lg font-bold text-brand-green">2 year</div>
                        </div>
                        <div class="bg-brand-box rounded px-5 py-4 border border-white/5">
                            <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1.5">Valuation</div>
                            <div class="text-lg font-bold text-brand-yellow">$10000000</div>
                        </div>
                    </div>

                    <!-- Vision Statement -->
                    <div class="mb-8">
                        <h3 class="text-sm font-bold mb-3">Vision Statement</h3>
                        <p class="text-sm text-gray-400 leading-relaxed">
                            Bridging Our Shop to next Level in our areas. We need capital for strategic marketing expansion and high-end shop decorations to compete in the luxury segment. Expanding floor space by 200%.
                        </p>
                    </div>

                    <!-- Invest Button -->
                    <button onclick="window.location='{{ route('investor.register') }}'" class="w-full bg-[#252f40] hover:bg-[#344155] text-gray-300 font-bold text-xs tracking-widest uppercase py-4 rounded transition-colors flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span>Invest</span>
                    </button>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-brand-card rounded-lg overflow-hidden shadow-2xl border border-white/5">
                <!-- Video/Image Section -->
                <div class="relative w-full h-64 md:h-96 bg-gray-900 group">
                    <img src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?auto=format&fit=crop&w=1000&q=80" alt="Garments Shop" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                </div>

                <!-- Card Body -->
                <div class="p-6 md:p-8">
                    <!-- Title Row -->
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h2 class="text-2xl font-bold">Garments shop</h2>
                            <div class="flex items-center text-xs text-gray-400 mt-1">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span>Founder: <span class="text-white font-medium">Saleem</span></span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1">Seeking Capital</div>
                            <div class="text-2xl font-bold text-brand-green">$7000000</div>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-8">
                        <div class="bg-brand-box rounded px-5 py-4 border border-white/5">
                            <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1.5">MRR</div>
                            <div class="text-lg font-bold text-white">$120000</div>
                        </div>
                        <div class="bg-brand-box rounded px-5 py-4 border border-white/5">
                            <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1.5">Time Period</div>
                            <div class="text-lg font-bold text-brand-green">3 year</div>
                        </div>
                        <div class="bg-brand-box rounded px-5 py-4 border border-white/5">
                            <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1.5">Valuation</div>
                            <div class="text-lg font-bold text-brand-yellow">$13000000</div>
                        </div>
                    </div>

                    <!-- Vision Statement -->
                    <div class="mb-8">
                        <h3 class="text-sm font-bold mb-3">Vision Statement</h3>
                        <p class="text-sm text-gray-400 leading-relaxed">
                            Bridging Our Shop to next Level in our areas. We need capital for strategic marketing expansion and high-end shop decorations to compete in the luxury segment. Expanding floor space by 200%.
                        </p>
                    </div>

                    <!-- Invest Button -->
                    <button onclick="window.location='{{ route('investor.register') }}'" class="w-full bg-[#252f40] hover:bg-[#344155] text-gray-300 font-bold text-xs tracking-widest uppercase py-4 rounded transition-colors flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span>Invest</span>
                    </button>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
