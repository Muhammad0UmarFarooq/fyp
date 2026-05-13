<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Pitch - InvestBridge</title>
    
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

        <main class="flex-1 p-12 relative">
            <div class="max-w-8xl mx-auto space-y-16">
                <!-- Header -->
                <div>
                    <h1 class="text-4xl font-bold mb-2">View Pitch Page</h1>
                    <p class="text-gray-400 text-sm max-w-xl">Here You Can View The Details Of The Pitch</p>
                </div>

                <!-- 01. VIDEO TRANSMISSION -->
                <div class="space-y-6">
                    <div class="flex justify-between items-end">
                        <h2 class="text-brand-yellow font-bold text-sm tracking-widest uppercase">01. VIDEO TRANSMISSION</h2>
                        <span class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">EXECUTIVE PITCH PRESENTATION</span>
                    </div>
                    <div class="bg-[#161e2d] rounded-2xl overflow-hidden shadow-2xl border border-white/5">
                        <div class="relative aspect-video bg-gray-900 group">
                            <img src="{{ asset('images/shoes_shop.jpg') }}" alt="Shoes Shop" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/10">
                                    <svg class="w-10 h-10 text-brand-green ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </div>
                </div>

                <!-- 02. PITCHES IDENTITY -->
                <div class="space-y-8">
                    <h2 class="text-brand-yellow font-bold text-sm tracking-widest uppercase">02. PITCHES IDENTITY</h2>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Startup Name</label>
                            <input type="text" value="Shoes shop" readonly class="w-full bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Invested Amount (Owner Investment)</label>
                            <input type="text" value="$ 5000000" readonly class="w-full bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Monthly Net Value (Total Revenue - Total Expenses)</label>
                            <input type="text" value="$ 1000000" readonly class="w-full bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Monthly Growth</label>
                            <input type="text" value="22%" readonly class="w-full bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                        </div>
                    </div>

                    <!-- Dynamic Growth Fields -->
                    <div id="growth-fields-container" class="grid grid-cols-2 gap-6"></div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Vision Statement</label>
                        <div class="w-full bg-[#0b1120] rounded p-6 text-sm text-gray-400 leading-relaxed italic">
                            A future where no shoe is mass-produced before it's sold. We are building the infrastructure for footwear that fits every foot perfectly, is manufactured only when ordered, and scales without warehouses of dead stock — making traditional retail inventory obsolete.
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Additional Detail</label>
                        <div class="w-full bg-[#0b1120] rounded p-6 text-sm text-gray-400 leading-relaxed italic">
                            The requested investment will be used to enhance our platform, grow our team, and execute targeted marketing strategies. With this capital, we aim to increase revenue, capture market share, and deliver strong returns for our investors.
                        </div>
                    </div>

                    <!-- Additional Fields Section -->
                    <div class="space-y-4">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Additional Fields</label>
                        <div id="input-groups-container" class="space-y-4">
                            <!-- Dynamic fields would be injected here if this was a real application with backend data -->
                        </div>
                    </div>
                </div>

                <!-- 03. THE CAPITAL ARCHITECTURE -->
                <div class="bg-[#161e2d] border border-white/5 rounded-3xl p-10 shadow-2xl">
                    <h2 class="text-brand-yellow font-bold text-sm tracking-widest uppercase mb-10">03. THE CAPITAL ARCHITECTURE</h2>
                    
                    <div class="flex justify-between items-start">
                        <div class="space-y-8 flex-1 max-w-md">
                            <div class="space-y-2">
                                <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Funding Amount Required ($)</label>
                                <div class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 text-xl font-bold text-white">
                                    <span class="text-gray-600 mr-2">$</span> 5000000
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Return Time (Period)</label>
                                <div class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 text-xl font-bold text-white uppercase tracking-widest">
                                    2 years
                                </div>
                            </div>
                        </div>

                        <div class="ml-12 bg-[#1e293b] rounded-2xl p-8 flex-shrink-0 w-80 text-center shadow-xl border border-white/5">
                            <div class="text-[9px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-4">Total Valuation</div>
                            <div class="text-4xl font-black text-brand-green">$10000000</div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>



</body>
</html>
