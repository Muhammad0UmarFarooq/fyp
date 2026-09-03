<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Active Investment Offers - InvestBridge</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>

    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0b1120] text-white font-sans min-h-screen antialiased">

    <x-investor-navbar />

    <div class="flex">
        <x-investor-sidebar />

        <main class="flex-1 p-4 md:p-12">
            <div class="max-w-8xl mx-auto">
                <!-- Header -->
                <div class="mb-12">
                    <h1 class="text-4xl font-bold mb-2">Active Investment Offers</h1>
                    <p class="text-gray-400 text-sm">Manage your current proposals and track the status of negotiations in the deal pipeline.</p>
                </div>

                @if(session('success'))
                <div class="bg-brand-green/20 border border-brand-green text-brand-green p-4 rounded-xl mb-8 flex items-center space-x-3">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                <!-- Offers List -->
                <div class="space-y-6">
                    @forelse($offers as $offer)
                    <div x-data="{ editing: false }" class="bg-[#161e2d] border border-white/5 rounded-2xl p-8 shadow-xl">
                        <div class="flex flex-col sm:flex-row justify-between items-start mb-6 md:mb-10 gap-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-[#1e293b] rounded-lg flex items-center justify-center text-brand-green overflow-hidden font-bold text-xl">
                                    {{ substr($offer->pitch ? $offer->pitch->startup_name : 'S', 0, 1) }}
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold">{{ $offer->pitch ? $offer->pitch->startup_name : 'Unknown Startup' }}</h2>
                                    <div class="flex items-center text-[10px] text-brand-green font-bold uppercase tracking-widest mt-0.5">
                                        <span class="w-1 h-1 bg-brand-green rounded-full mr-2"></span>
                                        {{ $offer->pitch && $offer->pitch->user ? $offer->pitch->user->name : 'Entrepreneur' }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1">Offer Amount</div>
                                <div class="text-3xl font-bold text-brand-green">PKR {{ number_format($offer->offer_amount) }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-8 mb-6 md:mb-10">
                            <div>
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Return Time (years)</div>
                                <div class="text-lg font-bold">{{ $offer->time_period }}</div>
                            </div>
                            <div>
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Return Value</div>
                                <div class="text-lg font-bold">PKR {{ number_format($offer->valuation) }}</div>
                            </div>
                            <div>
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Date Sent</div>
                                <div class="text-lg font-bold">{{ $offer->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3" x-show="!editing">
                            <div class="flex flex-wrap items-center gap-2">
                                <form action="{{ route('investor.offers.destroy', $offer) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this offer?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider hover:bg-red-700 transition-colors cursor-pointer">Cancel</button>
                                </form>

                                @if($offer->pitch)
                                <a href="{{ route('investor.pitch.view', $offer->pitch->id) }}" class="bg-[#0b1120] text-gray-300 px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider inline-block hover:bg-gray-800 transition-colors">View Pitch</a>
                                @endif

                                @if($offer->status === 'accepted')
                                <a href="{{ route('investor.agreements') }}" class="bg-brand-green text-[#064e3b] px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider inline-block hover:bg-[#3dbd6d] transition-colors font-extrabold">Proceed to Agreement</a>
                                @else
                                <button type="button" @click="editing = true" class="border border-brand-green/30 text-brand-green px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider hover:bg-brand-green/10 transition-colors cursor-pointer">
                                    {{ $offer->status === 'rejected' ? 'Edit Terms' : 'Re-Bid' }}
                                </button>
                                @endif
                            </div>
                            <div>
                                @if($offer->status === 'accepted')
                                <span class="text-brand-green font-black text-[10px] tracking-widest uppercase bg-brand-green/10 px-3 py-1.5 rounded-full border border-brand-green/20">Accepted / Finalized</span>
                                @elseif($offer->status === 'rejected')
                                <span class="text-red-500 font-black text-[10px] tracking-widest uppercase bg-red-500/10 px-3 py-1.5 rounded-full border border-red-500/20">Rejected</span>
                                @else
                                <span class="text-amber-500 font-black text-[10px] tracking-widest uppercase bg-amber-500/10 px-3 py-1.5 rounded-full border border-amber-500/20">Pending Offer</span>
                                @endif
                            </div>
                        </div>

                        <!-- Inline Edit Terms Form -->
                        <form x-show="editing" x-transition x-cloak action="{{ route('investor.offers.update', $offer) }}" method="POST" class="mt-8 pt-8 border-t border-white/5 grid grid-cols-1 md:grid-cols-3 gap-4">
                            @csrf
                            @method('PUT')
                            <div class="space-y-1">
                                <label class="text-[8px] font-bold text-gray-500 uppercase tracking-widest">Offer Amount (PKR)</label>
                                <input type="number" name="offer_amount" value="{{ $offer->offer_amount }}" required class="w-full bg-[#0b1120] text-brand-green font-bold border border-white/10 rounded px-3 py-3 text-sm focus:outline-none">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[8px] font-bold text-gray-500 uppercase tracking-widest">Return Time Period</label>
                                <input type="text" name="time_period" value="{{ $offer->time_period }}" required class="w-full bg-[#0b1120] text-brand-green font-bold border border-white/10 rounded px-3 py-3 text-sm focus:outline-none">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[8px] font-bold text-gray-500 uppercase tracking-widest">Return Value (PKR)</label>
                                <input type="number" name="valuation" value="{{ $offer->valuation }}" required class="w-full bg-[#0b1120] text-brand-green font-bold border border-white/10 rounded px-3 py-3 text-sm focus:outline-none">
                            </div>
                            <div class="md:col-span-3 flex justify-end space-x-3 pt-4 items-center">
                                <button type="button" @click="editing = false" class="border border-red-900/30 text-red-400 px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider hover:bg-red-500/10 transition-colors cursor-pointer">Cancel</button>
                                <button type="submit" class="bg-brand-green text-[#064e3b] px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider hover:bg-[#3dbd6d] transition-colors cursor-pointer font-black">Submit Re-Bid</button>
                            </div>
                        </form>
                    </div>
                    @empty
                    <div class="bg-[#161e2d] rounded-2xl p-16 text-center border border-white/5 shadow-2xl">
                        <p class="text-gray-400 text-sm">You have not submitted any investment offers yet.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

</body>

</html>
