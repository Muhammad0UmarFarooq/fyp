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

                @if(session('success'))
                <div class="bg-brand-green/20 border border-brand-green text-brand-green p-4 rounded-xl mb-8 flex items-center space-x-3">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-900/30 border border-red-500 text-red-400 p-4 rounded-xl mb-8 flex items-center space-x-3">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('error') }}</span>
                </div>
                @endif

                <!-- Pitch List -->
                <div class="space-y-12">
                    @forelse($pitches as $pitch)
                    <div class="bg-[#161e2d] rounded-2xl overflow-hidden shadow-2xl border border-white/5">
                        <div class="relative aspect-video bg-gray-900 group">
                            @if($pitch->video_path)
                                <video src="{{ asset('storage/' . $pitch->video_path) }}" class="w-full h-full object-cover z-10 relative" controls preload="metadata"></video>
                            @else
                                <img src="{{ asset('images/shoes_shop.jpg') }}" alt="{{ $pitch->startup_name }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                    <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/10">
                                        <svg class="w-10 h-10 text-brand-green ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h2 class="text-2xl font-bold"><a href="{{ route('investor.pitch.view', $pitch) }}" class="hover:text-brand-green hover:underline transition-colors">{{ $pitch->startup_name }}</a></h2>
                                    <div class="flex items-center text-xs text-gray-400 mt-1">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        <span>Founder: <span class="text-white font-medium">{{ $pitch->user->name ?? 'Entrepreneur' }}</span></span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1">Seeking Capital</div>
                                    <div class="text-3xl font-bold text-brand-green">Rs {{ number_format($pitch->funding_required ?? 0) }}</div>
                                </div>
                            </div>

                            <p class="text-gray-400 text-sm leading-relaxed mb-8">
                                {{ $pitch->vision_statement ?? 'No vision statement provided.' }}
                            </p>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">Monthly Net Value</div>
                                    <div class="text-lg font-bold">Rs {{ number_format($pitch->monthly_net_value ?? 0) }}</div>
                                </div>
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">MOM Growth</div>
                                    <div class="text-lg font-bold text-brand-green">{{ $pitch->monthly_growth ?? 0 }}%</div>
                                </div>
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">Return Time (years)</div>
                                    <div class="text-lg font-bold text-brand-green">{{ $pitch->return_time ?? 'N/A' }}</div>
                                </div>
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">Valuation</div>
                                    <div class="text-lg font-bold">Rs {{ number_format($pitch->total_valuation ?? 0) }}</div>
                                </div>
                            </div>

                            @if($pitch->pitchFields->isNotEmpty())
                            <!-- Dynamic Custom Fields -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 pt-4 border-t border-white/5">
                                @foreach($pitch->pitchFields as $field)
                                <div class="bg-[#0b1120] p-4 rounded-xl border border-white/5">
                                    <div class="text-[8px] font-bold text-gray-500 tracking-widest uppercase mb-1">{{ $field->label }}</div>
                                    <div class="text-lg font-bold text-white">{{ $field->value }}</div>
                                </div>
                                @endforeach
                            </div>
                            @endif

                            <!-- Bid Section -->
                            @php
                                $existingOffer = \App\Models\Offer::where('pitch_id', $pitch->id)->where('investor_id', auth()->id())->first();
                            @endphp

                            @if($existingOffer)
                            <div class="flex items-center justify-between bg-brand-green/10 border border-brand-green/20 p-6 rounded-xl mt-8">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-6 h-6 text-brand-green flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <div>
                                        <div class="text-sm font-bold text-white">Offer Already Placed</div>
                                        <div class="text-xs text-gray-400">You submitted a bid of Rs {{ number_format($existingOffer->offer_amount) }}. Status: <span class="text-brand-green font-bold uppercase tracking-wider">{{ $existingOffer->status }}</span></div>
                                    </div>
                                </div>
                                <a href="{{ route('investor.myOffers') }}" class="bg-brand-green text-[#064e3b] px-6 py-2.5 rounded font-black text-xs uppercase tracking-wider hover:bg-[#3dbd6d] transition-colors cursor-pointer font-extrabold">Manage in My Offers</a>
                            </div>
                            @else
                            <form action="{{ route('investor.offers.store', $pitch) }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 pt-8 border-t border-white/5">
                                @csrf
                                <div class="space-y-1">
                                    <label class="text-[8px] font-bold text-gray-500 uppercase tracking-widest">Offer Amount (Rs)</label>
                                    <input type="number" name="offer_amount" value="{{ old('offer_amount') }}" placeholder="Enter offer amount" required class="w-full bg-white text-orange-600 font-bold border border-white/10 rounded px-3 py-3 text-sm focus:outline-none placeholder:font-normal placeholder:text-gray-400">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[8px] font-bold text-gray-500 uppercase tracking-widest">Time Period (years)</label>
                                    <input type="number" name="time_period" value="{{ old('time_period') }}" placeholder="Enter time period in years 1..10" required class="w-full bg-white text-orange-600 font-bold border border-white/10 rounded px-3 py-3 text-sm focus:outline-none placeholder:font-normal placeholder:text-gray-400">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[8px] font-bold text-gray-500 uppercase tracking-widest">Return Value</label>
                                    <input type="number" name="valuation" value="{{ old('valuation') }}" placeholder="Enter value" required class="w-full bg-white text-orange-600 font-bold border border-white/10 rounded px-3 py-3 text-sm focus:outline-none placeholder:font-normal placeholder:text-gray-400">
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" class="w-full bg-[#4ade80] text-[#064e3b] font-bold text-xs tracking-widest uppercase py-4 rounded hover:bg-[#3dbd6d] transition-colors cursor-pointer shadow-lg shadow-brand-green/20">Bid</button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="bg-[#161e2d] rounded-2xl p-16 text-center border border-white/5 shadow-2xl">
                        <div class="bg-white/5 p-6 rounded-full inline-block mb-6">
                            <svg class="w-16 h-16 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">No Pitches Available Yet</h3>
                        <p class="text-gray-400 max-w-md mx-auto text-sm">Entrepreneurs are currently preparing institutional-grade investment opportunities. Please check back soon.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

</body>
</html>
