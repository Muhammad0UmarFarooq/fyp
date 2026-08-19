@extends('layouts.app')

@section('content')
    @include('components.admin-navbar')

    <div class="flex flex-1">
        @include('components.admin-sidebar')

        <main class="flex-1 p-8 overflow-y-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">Agreements</h1>
                <p class="text-gray-400 text-sm mt-1">All deals finalized between entrepreneurs and investors</p>
            </div>

            <!-- Search & Filter -->
            <div class="bg-[#161e2d] rounded-xl border border-white/5 p-4 mb-6">
                <form action="{{ route('admin.agreements') }}" method="GET" class="flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-[250px]">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by entrepreneur or investor name..." class="w-full bg-[#0b1120] border border-white/10 rounded-lg px-4 py-3 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-[#4ade80]/50 transition-colors">
                    </div>
                    <select name="status" class="bg-[#0b1120] border border-white/10 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-[#4ade80]/50 transition-colors">
                        <option value="">All Status</option>
                        <option value="pending_signature" {{ request('status') === 'pending_signature' ? 'selected' : '' }}>Pending Signature</option>
                        <option value="investor_uploaded" {{ request('status') === 'investor_uploaded' ? 'selected' : '' }}>Investor Uploaded</option>
                        <option value="sent_to_entrepreneur" {{ request('status') === 'sent_to_entrepreneur' ? 'selected' : '' }}>Sent to Entrepreneur</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit" class="bg-[#4ade80] text-[#064e3b] px-6 py-3 rounded-lg font-bold text-sm hover:bg-[#3dbd6d] transition-colors">Search</button>
                    @if(request('search') || request('status'))
                        <a href="{{ route('admin.agreements') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Clear</a>
                    @endif
                </form>
            </div>

            <!-- Agreements Table -->
            <div class="bg-[#161e2d] rounded-xl border border-white/5 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-white/5">
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Entrepreneur</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Investor</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Pitch</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Offer Amount</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Est. ROI</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Status</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Agreement Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($agreements as $agreement)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.users.detail', $agreement->entrepreneur_id) }}" class="text-sm text-[#4ade80] hover:text-[#3dbd6d] font-medium transition-colors">{{ $agreement->entrepreneur->name ?? 'N/A' }}</a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.users.detail', $agreement->investor_id) }}" class="text-sm text-violet-400 hover:text-violet-300 font-medium transition-colors">{{ $agreement->investor->name ?? 'N/A' }}</a>
                                </td>
                                <td class="px-6 py-4 text-sm text-white">{{ $agreement->pitch->startup_name ?? 'Pitch Deleted' }}</td>
                                <td class="px-6 py-4 text-sm text-[#4ade80] font-medium">Rs {{ number_format($agreement->offer->offer_amount ?? 0) }}</td>
                                <td class="px-6 py-4 text-sm text-emerald-400 font-medium">{{ $agreement->estimated_roi ?? 0 }}%</td>
                                <td class="px-6 py-4">
                                    <span class="text-[10px] font-bold tracking-widest uppercase px-2 py-1 rounded
                                        @if($agreement->status === 'active') bg-emerald-500/10 text-emerald-400
                                        @elseif($agreement->status === 'completed') bg-blue-500/10 text-blue-400
                                        @elseif($agreement->status === 'rejected') bg-red-500/10 text-red-400
                                        @else bg-amber-500/10 text-amber-400
                                        @endif">{{ str_replace('_', ' ', $agreement->status) }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $agreement->agreement_date ? \Carbon\Carbon::parse($agreement->agreement_date)->format('d M Y') : '—' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500 text-sm">No agreements found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($agreements->hasPages())
                <div class="px-6 py-4 border-t border-white/5">
                    {{ $agreements->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </main>
    </div>
@endsection
