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

        <main class="flex-1 p-4 sm:p-6 md:p-12 relative">
            <div class="max-w-8xl mx-auto space-y-16">
                <!-- Header -->
                <div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-2 break-words">{{ $pitch ? $pitch->startup_name : 'View Pitch Page' }}</h1>
                    <div class="flex items-center text-sm text-gray-400 mt-2">
                        <svg class="w-4 h-4 mr-2 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Founder: <span class="text-white font-medium">{{ $pitch && $pitch->user ? $pitch->user->name : 'Entrepreneur' }}</span></span>
                    </div>
                </div>

                <!-- 01. VIDEO TRANSMISSION -->
                <div class="space-y-6">
                    <div class="flex flex-wrap justify-between items-end gap-2">
                        <h2 class="text-brand-yellow font-bold text-xs sm:text-sm tracking-widest uppercase">01. VIDEO TRANSMISSION</h2>
                        <span class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">EXECUTIVE PITCH PRESENTATION</span>
                    </div>
                    <div class="bg-[#161e2d] rounded-2xl overflow-hidden shadow-2xl border border-white/5">
                        <div class="relative aspect-video bg-gray-900 group">
                            @if($pitch && $pitch->video_path)
                                <video src="{{ asset('storage/' . $pitch->video_path) }}" class="w-full h-full object-cover z-10 relative" controls preload="metadata"></video>
                            @else
                                <img src="{{ asset('images/shoes_shop.jpg') }}" alt="Pitch Video" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                    <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/10">
                                        <svg class="w-10 h-10 text-brand-green ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- 02. PITCHES IDENTITY -->
                <div class="space-y-8">
                    <h2 class="text-brand-yellow font-bold text-sm tracking-widest uppercase">02. PITCHES IDENTITY</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Startup Name</label>
                            <input type="text" value="{{ $pitch ? $pitch->startup_name : 'N/A' }}" readonly class="w-full bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Invested Amount (Owner Investment)</label>
                            <input type="text" value="{{ $pitch && $pitch->invested_amount ? 'PKR ' . number_format($pitch->invested_amount) : 'N/A' }}" readonly class="w-full bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Monthly Net Value (Total Revenue - Total Expenses)</label>
                            <input type="text" value="{{ $pitch && $pitch->monthly_net_value ? 'PKR ' . number_format($pitch->monthly_net_value) : 'N/A' }}" readonly class="w-full bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Monthly Growth</label>
                            <input type="text" value="{{ $pitch && $pitch->monthly_growth ? $pitch->monthly_growth . '%' : 'N/A' }}" readonly class="w-full bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                        </div>
                    </div>

                    @if($pitch && $pitch->pitchFields->isNotEmpty())
                    <!-- Dynamic Custom Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        @foreach($pitch->pitchFields as $field)
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">{{ $field->label }}</label>
                            <input type="text" value="{{ $field->value }}" readonly class="w-full bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="space-y-2">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Vision Statement</label>
                        <div class="w-full bg-[#0b1120] rounded p-6 text-sm text-gray-400 leading-relaxed italic">
                            {{ $pitch && $pitch->vision_statement ? $pitch->vision_statement : 'No vision statement provided.' }}
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Additional Detail</label>
                        <div class="w-full bg-[#0b1120] rounded p-6 text-sm text-gray-400 leading-relaxed italic">
                            {{ $pitch && $pitch->additional_detail ? $pitch->additional_detail : 'No additional details provided.' }}
                        </div>
                    </div>
                </div>

                <!-- 03. THE CAPITAL ARCHITECTURE -->
                <div class="bg-[#161e2d] border border-white/5 rounded-3xl p-4 md:p-10 shadow-2xl">
                    <h2 class="text-brand-yellow font-bold text-sm tracking-widest uppercase mb-10">03. THE CAPITAL ARCHITECTURE</h2>
                    
                    <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                        <div class="space-y-8 flex-1 max-w-md">
                            <div class="space-y-2">
                                <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Funding Amount Required (PKR)</label>
                                <div class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 text-xl font-bold text-white">
                                    <span class="text-gray-600 mr-2">$</span> {{ $pitch && $pitch->funding_required ? number_format($pitch->funding_required) : '0' }}
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Return Time (Period)</label>
                                <div class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 text-xl font-bold text-white uppercase tracking-widest">
                                    {{ $pitch && $pitch->return_time ? $pitch->return_time : 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <div class="md:ml-12 bg-[#1e293b] rounded-2xl p-6 md:p-8 flex-shrink-0 w-full md:w-80 text-center shadow-xl border border-white/5">
                            <div class="text-[9px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-4">Total Valuation</div>
                            <div class="text-2xl sm:text-3xl md:text-4xl font-black text-brand-green break-words">PKR {{ $pitch && $pitch->total_valuation ? number_format($pitch->total_valuation) : '0' }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>



</body>
</html>
