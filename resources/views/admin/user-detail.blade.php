@extends('layouts.app')

@section('content')
    @include('components.admin-navbar')

    <div class="flex flex-1">
        @include('components.admin-sidebar')

        <main class="flex-1 p-8 overflow-y-auto">
            <!-- Back Button -->
            <a href="{{ route('admin.users') }}" class="inline-flex items-center text-gray-400 hover:text-white text-sm mb-6 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Users
            </a>

            <!-- User Profile Card -->
            <div class="bg-[#161e2d] rounded-xl border border-white/5 p-8 mb-6">
                <div class="flex items-start space-x-6">
                    <div class="w-20 h-20 rounded-xl {{ $user->role === 'entrepreneur' ? 'bg-emerald-500/10' : 'bg-violet-500/10' }} flex items-center justify-center flex-shrink-0 overflow-hidden">
                        @if($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-2xl font-bold {{ $user->role === 'entrepreneur' ? 'text-emerald-400' : 'text-violet-400' }}">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-1">
                            <h1 class="text-2xl font-bold text-white">{{ $user->name }}</h1>
                            <span class="text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded {{ $user->role === 'entrepreneur' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-violet-500/10 text-violet-400' }}">{{ $user->role }}</span>
                        </div>
                        <p class="text-gray-400 text-sm">{{ $user->email }}</p>
                        @if($user->bio)
                            <p class="text-gray-400 text-sm mt-2">{{ $user->bio }}</p>
                        @endif
                    </div>
                </div>

                <!-- Personal Info Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                    <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                        <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">CNIC</div>
                        <div class="text-sm font-medium text-white font-mono">{{ $user->cnic ?? '—' }}</div>
                    </div>
                    <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                        <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Phone</div>
                        <div class="text-sm font-medium text-white">{{ $user->phone ?? '—' }}</div>
                    </div>
                    <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                        <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">City</div>
                        <div class="text-sm font-medium text-white">{{ $user->city ?? '—' }}</div>
                    </div>
                    <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                        <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Joined</div>
                        <div class="text-sm font-medium text-white">{{ $user->created_at->format('d M Y') }}</div>
                    </div>
                </div>
            </div>

            @if($user->role === 'entrepreneur')
                <!-- Entrepreneur Profile -->
                @if($user->entrepreneurProfile)
                <div class="bg-[#161e2d] rounded-xl border border-white/5 p-6 mb-6">
                    <h2 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Entrepreneur Profile</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Company</div>
                            <div class="text-sm font-medium text-white">{{ $user->entrepreneurProfile->company_name ?? '—' }}</div>
                        </div>
                        <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Industry</div>
                            <div class="text-sm font-medium text-white">{{ $user->entrepreneurProfile->industry ?? '—' }}</div>
                        </div>
                        <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Total Valuation</div>
                            <div class="text-sm font-medium text-emerald-400">Rs {{ number_format($user->entrepreneurProfile->total_valuation ?? 0) }}</div>
                        </div>
                        <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Future Valuation</div>
                            <div class="text-sm font-medium text-emerald-400">Rs {{ number_format($user->entrepreneurProfile->future_valuation ?? 0) }}</div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Entrepreneur's Pitch -->
                @if($user->pitch)
                <div class="bg-[#161e2d] rounded-xl border border-white/5 overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-white/5">
                        <h2 class="text-sm font-bold text-white uppercase tracking-wider">Live Pitch</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-white">{{ $user->pitch->startup_name }}</h3>
                                <p class="text-gray-400 text-sm mt-1">{{ Str::limit($user->pitch->vision_statement, 150) }}</p>
                            </div>
                            <span class="text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded
                                @if($user->pitch->status === 'active') bg-emerald-500/10 text-emerald-400
                                @elseif($user->pitch->status === 'funded') bg-blue-500/10 text-blue-400
                                @else bg-gray-500/10 text-gray-400
                                @endif">{{ $user->pitch->status }}</span>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Funding Required</div>
                                <div class="text-sm font-bold text-[#4ade80]">Rs {{ number_format($user->pitch->funding_required ?? 0) }}</div>
                            </div>
                            <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Invested Amount</div>
                                <div class="text-sm font-bold text-white">Rs {{ number_format($user->pitch->invested_amount ?? 0) }}</div>
                            </div>
                            <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Monthly Growth</div>
                                <div class="text-sm font-bold text-amber-400">{{ $user->pitch->monthly_growth ?? 0 }}%</div>
                            </div>
                            <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Valuation</div>
                                <div class="text-sm font-bold text-white">Rs {{ number_format($user->pitch->total_valuation ?? 0) }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Offers on this pitch -->
                    @if($user->pitch->offers && $user->pitch->offers->count() > 0)
                    <div class="px-6 pb-6">
                        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Offers Received</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-white/5">
                                        <th class="text-left px-4 py-2 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Investor</th>
                                        <th class="text-left px-4 py-2 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Amount</th>
                                        <th class="text-left px-4 py-2 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Time Period</th>
                                        <th class="text-left px-4 py-2 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @foreach($user->pitch->offers as $offer)
                                    <tr class="hover:bg-white/[0.02] transition-colors">
                                        <td class="px-4 py-3 text-sm text-white">{{ $offer->investor->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm text-[#4ade80] font-medium">Rs {{ number_format($offer->offer_amount) }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-400">{{ $offer->time_period }}</td>
                                        <td class="px-4 py-3">
                                            <span class="text-[10px] font-bold tracking-widest uppercase px-2 py-1 rounded
                                                @if($offer->status === 'accepted') bg-emerald-500/10 text-emerald-400
                                                @elseif($offer->status === 'rejected') bg-red-500/10 text-red-400
                                                @else bg-amber-500/10 text-amber-400
                                                @endif">{{ $offer->status }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

            @elseif($user->role === 'investor')
                <!-- Investor Profile -->
                @if($user->investorProfile)
                <div class="bg-[#161e2d] rounded-xl border border-white/5 p-6 mb-6">
                    <h2 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Investor Profile</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Investment Amount</div>
                            <div class="text-sm font-medium text-violet-400">Rs {{ number_format($user->investorProfile->investment_amount ?? 0) }}</div>
                        </div>
                        <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Focus</div>
                            <div class="text-sm font-medium text-white">{{ $user->investorProfile->investment_focus ?? '—' }}</div>
                        </div>
                        <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Portfolio Size</div>
                            <div class="text-sm font-medium text-white">{{ $user->investorProfile->portfolio_size ?? '—' }}</div>
                        </div>
                        <div class="bg-[#0b1120] p-4 rounded-lg border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Interested In</div>
                            <div class="text-sm font-medium text-white">
                                @if($user->investorProfile->interested_businesses)
                                    {{ is_array($user->investorProfile->interested_businesses) ? implode(', ', $user->investorProfile->interested_businesses) : $user->investorProfile->interested_businesses }}
                                @else
                                    —
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Investor's Sent Offers -->
                @if($user->sentOffers && $user->sentOffers->count() > 0)
                <div class="bg-[#161e2d] rounded-xl border border-white/5 overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-white/5">
                        <h2 class="text-sm font-bold text-white uppercase tracking-wider">Bids / Offers Sent</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/5">
                                    <th class="text-left px-6 py-3 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Startup</th>
                                    <th class="text-left px-6 py-3 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Amount</th>
                                    <th class="text-left px-6 py-3 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Time Period</th>
                                    <th class="text-left px-6 py-3 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Valuation</th>
                                    <th class="text-left px-6 py-3 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($user->sentOffers as $offer)
                                <tr class="hover:bg-white/[0.02] transition-colors">
                                    <td class="px-6 py-4 text-sm text-white">{{ $offer->pitch->startup_name ?? 'Pitch Deleted' }}</td>
                                    <td class="px-6 py-4 text-sm text-[#4ade80] font-medium">Rs {{ number_format($offer->offer_amount) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-400">{{ $offer->time_period }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-400">Rs {{ number_format($offer->valuation ?? 0) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="text-[10px] font-bold tracking-widest uppercase px-2 py-1 rounded
                                            @if($offer->status === 'accepted') bg-emerald-500/10 text-emerald-400
                                            @elseif($offer->status === 'rejected') bg-red-500/10 text-red-400
                                            @else bg-amber-500/10 text-amber-400
                                            @endif">{{ $offer->status }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            @endif

            <!-- Agreements for this User -->
            @if($agreements->count() > 0)
            <div class="bg-[#161e2d] rounded-xl border border-white/5 overflow-hidden">
                <div class="px-6 py-4 border-b border-white/5">
                    <h2 class="text-sm font-bold text-white uppercase tracking-wider">Agreements</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-white/5">
                                <th class="text-left px-6 py-3 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Entrepreneur</th>
                                <th class="text-left px-6 py-3 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Investor</th>
                                <th class="text-left px-6 py-3 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Pitch</th>
                                <th class="text-left px-6 py-3 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">ROI</th>
                                <th class="text-left px-6 py-3 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Status</th>
                                <th class="text-left px-6 py-3 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($agreements as $agreement)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-4 text-sm text-white">{{ $agreement->entrepreneur->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-white">{{ $agreement->investor->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-400">{{ $agreement->pitch->startup_name ?? 'Pitch Deleted' }}</td>
                                <td class="px-6 py-4 text-sm text-amber-400 font-medium">{{ $agreement->estimated_roi ?? 0 }}%</td>
                                <td class="px-6 py-4">
                                    <span class="text-[10px] font-bold tracking-widest uppercase px-2 py-1 rounded
                                        @if($agreement->status === 'active') bg-emerald-500/10 text-emerald-400
                                        @elseif($agreement->status === 'completed') bg-blue-500/10 text-blue-400
                                        @else bg-amber-500/10 text-amber-400
                                        @endif">{{ str_replace('_', ' ', $agreement->status) }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $agreement->agreement_date ? \Carbon\Carbon::parse($agreement->agreement_date)->format('d M Y') : '—' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </main>
    </div>
@endsection
