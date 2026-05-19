<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Active Offers - InvestBridge</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0b1120] text-white font-sans min-h-screen antialiased">

    <x-navbar />

    <div class="flex">
        <x-sidebar />

        <main class="flex-1 p-12">
            <div class="max-w-8xl mx-auto">
                <!-- Header -->
                <div class="flex justify-between items-end mb-12">
                    <h1 class="text-4xl font-bold">Active <span class="text-brand-green">Offers</span></h1>
                    <span class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">{{ $offers->where('status', 'pending')->count() }} PENDING DECISIONS</span>
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

                <!-- Offers List -->
                <div class="space-y-6">
                    @forelse($offers as $offer)
                    <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-8 shadow-xl">
                        <div class="flex justify-between items-start mb-10">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 rounded-xl overflow-hidden border border-white/10 bg-gray-800 flex items-center justify-center font-bold text-xl text-brand-green">
                                    {{ substr($offer->investor ? $offer->investor->name : 'I', 0, 1) }}
                                </div>
                                <h2 class="text-2xl font-bold text-gray-200">{{ $offer->investor ? $offer->investor->name : 'Investor' }}</h2>
                            </div>
                            <div class="text-right">
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.15em] uppercase mb-1">Offer Amount</div>
                                <div class="text-4xl font-bold text-brand-green">PKR {{ number_format($offer->offer_amount) }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-8 mb-10">
                            <div>
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.15em] uppercase mb-2">Time Period</div>
                                <div class="text-xl font-bold text-gray-200">{{ $offer->time_period }}</div>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.15em] uppercase mb-2">Valuation</div>
                                <div class="text-xl font-bold text-gray-200">PKR {{ number_format($offer->valuation) }}</div>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.15em] uppercase mb-2">Date</div>
                                <div class="text-xl font-bold text-gray-200">{{ $offer->created_at->format('d M Y') }}</div>
                            </div>
                        </div>

                        @if($offer->status === 'pending')
                        <div class="flex space-x-4">
                            <form action="{{ route('entrepreneur.offers.status', $offer) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="bg-[#991b1b] text-white px-8 py-2.5 rounded text-xs font-bold tracking-widest uppercase hover:bg-red-900 transition-colors cursor-pointer">Reject</button>
                            </form>

                            <form action="{{ route('entrepreneur.offers.status', $offer) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" class="bg-brand-green text-[#064e3b] px-8 py-2.5 rounded text-xs font-bold tracking-widest uppercase hover:bg-[#3dbd6d] transition-colors cursor-pointer font-extrabold">Accept</button>
                            </form>
                        </div>
                        @else
                        <div class="flex items-center">
                            <span class="text-xs font-bold tracking-widest uppercase px-4 py-2 rounded {{ $offer->status === 'accepted' ? 'bg-brand-green/20 text-brand-green border border-brand-green/30' : 'bg-red-500/20 text-red-400 border border-red-500/30' }}">
                                Status: {{ ucfirst($offer->status) }}
                            </span>
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="bg-[#161e2d] rounded-2xl p-16 text-center border border-white/5 shadow-2xl">
                        <p class="text-gray-400 text-sm">No investment offers have been received yet.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

</body>
</html>
