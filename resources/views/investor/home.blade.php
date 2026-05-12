<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Startup Pitch Arena - InvestBridge</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0b1120] text-white font-sans min-h-screen antialiased">

    <x-investor-navbar />

    <div class="flex">
        <x-investor-sidebar />

        <main class="flex-1 p-12">
            <div class="max-w-8xl mx-auto">
                <!-- Header -->
                <div class="mb-12">
                    <h1 class="text-4xl font-bold mb-2">Startup Pitch <span class="text-brand-green">Arena</span></h1>
                    <p class="text-gray-400 text-sm">Vetted opportunities in emerging markets and high-growth sectors.</p>
                </div>

                <!-- Pitch List -->
                <div class="space-y-12">
                    
                    <!-- Pitch 1: Shoes Shop -->
                    <div class="bg-[#161e2d] rounded-2xl overflow-hidden shadow-2xl border border-white/5">
                        <div class="relative aspect-video bg-gray-900 group">
                            <img src="{{ asset('images/shoes_shop.jpg') }}" alt="Shoes Shop" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/10">
                                    <svg class="w-10 h-10 text-brand-green ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h2 class="text-2xl font-bold"><a href="{{ route('investor.pitch.view') }}" class="hover:text-brand-green hover:underline transition-colors">Shoes Shop</a></h2>
                                    <div class="flex items-center text-xs text-gray-400 mt-1">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        <span>Founder: <span class="text-white font-medium">Naeem Azhar</span></span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1">Seeking Capital</div>
                                    <div class="text-3xl font-bold text-brand-green">$5000000</div>
                                </div>
                            </div>

                            <p class="text-gray-400 text-sm leading-relaxed mb-8">
                                Bridging Our Shop to next Level in our areas. We need capital for strategic marketing expansion and high-end shop decorations to compete in the luxury segment. Expanding floor space by 200%.
                            </p>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-4 gap-4 mb-8">
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">Current MRR</div>
                                    <div class="text-lg font-bold">$1000000</div>
                                </div>
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">MOM Growth</div>
                                    <div class="text-lg font-bold text-brand-green">22%</div>
                                </div>
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">Return Time</div>
                                    <div class="text-lg font-bold text-brand-green">2 years</div>
                                </div>
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">Valuation</div>
                                    <div class="text-lg font-bold">$10000000</div>
                                </div>
                            </div>

                            <!-- Bid Section -->
                            <div class="grid grid-cols-4 gap-4 pt-8 border-t border-white/5">
                                <div class="space-y-1">
                                    <label class="text-[8px] font-bold text-gray-500 uppercase tracking-widest">Offer Amount ($)</label>
                                    <input type="text" value="7000000" class="w-full bg-white text-orange-600 font-bold border border-white/10 rounded px-3 py-3 text-sm focus:outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[8px] font-bold text-gray-500 uppercase tracking-widest">Time Period</label>
                                    <input type="text" value="3 years" class="w-full bg-white text-orange-600 font-bold border border-white/10 rounded px-3 py-3 text-sm focus:outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[8px] font-bold text-gray-500 uppercase tracking-widest">Return Value</label>
                                    <input type="text" value="15000000" class="w-full bg-white text-orange-600 font-bold border border-white/10 rounded px-3 py-3 text-sm focus:outline-none">
                                </div>
                                <div class="flex items-end">
                                    <button class="w-full bg-[#4ade80] text-[#064e3b] font-bold text-xs tracking-widest uppercase py-4 rounded hover:bg-[#3dbd6d] transition-colors">Bid</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pitch 2: Garments Shop -->
                    <div class="bg-[#161e2d] rounded-2xl overflow-hidden shadow-2xl border border-white/5">
                        <div class="relative aspect-video bg-gray-900 group">
                            <img src="https://img.magnific.com/free-photo/empty-boutique-shopping-centre_482257-78792.jpg?semt=ais_hybrid&w=740&q=80" alt="Garments Shop" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/10">
                                    <svg class="w-10 h-10 text-brand-green ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h2 class="text-2xl font-bold"><a href="{{ route('investor.pitch.view') }}" class="hover:text-brand-green hover:underline transition-colors">Garments shop</a></h2>
                                    <div class="flex items-center text-xs text-gray-400 mt-1">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        <span>Founder: <span class="text-white font-medium">Saleem</span></span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1">Seeking Capital</div>
                                    <div class="text-3xl font-bold text-brand-green">$7000000</div>
                                </div>
                            </div>

                            <p class="text-gray-400 text-sm leading-relaxed mb-8">
                                Bridging Our Shop to next Level in our areas. We need capital for strategic marketing expansion and high-end shop decorations to compete in the luxury segment. Expanding floor space by 200%.
                            </p>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-4 gap-4 mb-8">
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">Current MRR</div>
                                    <div class="text-lg font-bold">$1000000</div>
                                </div>
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">MOM Growth</div>
                                    <div class="text-lg font-bold text-brand-green">22%</div>
                                </div>
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">Return Time</div>
                                    <div class="text-lg font-bold text-brand-green">2 years</div>
                                </div>
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">Valuation</div>
                                    <div class="text-lg font-bold">$10000000</div>
                                </div>
                            </div>

                            <!-- Bid Section -->
                            <div class="grid grid-cols-4 gap-4 pt-8 border-t border-white/5">
                                <div class="space-y-1">
                                    <label class="text-[8px] font-bold text-gray-500 uppercase tracking-widest">Offer Amount ($)</label>
                                    <input type="text" value="6000000" class="w-full bg-white text-orange-600 font-bold border border-white/10 rounded px-3 py-3 text-sm focus:outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[8px] font-bold text-gray-500 uppercase tracking-widest">Time Period</label>
                                    <input type="text" value="2 years" class="w-full bg-white text-orange-600 font-bold border border-white/10 rounded px-3 py-3 text-sm focus:outline-none">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[8px] font-bold text-gray-500 uppercase tracking-widest">Return Value</label>
                                    <input type="text" value="13000000" class="w-full bg-white text-orange-600 font-bold border border-white/10 rounded px-3 py-3 text-sm focus:outline-none">
                                </div>
                                <div class="flex items-end">
                                    <button class="w-full bg-[#4ade80] text-[#064e3b] font-bold text-xs tracking-widest uppercase py-4 rounded hover:bg-[#3dbd6d] transition-colors">Bid</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

</body>
</html>
