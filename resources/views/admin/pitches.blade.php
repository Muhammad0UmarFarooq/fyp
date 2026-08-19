@extends('layouts.app')

@section('content')
    @include('components.admin-navbar')

    <div class="flex flex-1">
        @include('components.admin-sidebar')

        <main class="flex-1 p-8 overflow-y-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">Pitches</h1>
                <p class="text-gray-400 text-sm mt-1">All entrepreneur startup pitches</p>
            </div>

            <!-- Search & Filter -->
            <div class="bg-[#161e2d] rounded-xl border border-white/5 p-4 mb-6">
                <form action="{{ route('admin.pitches') }}" method="GET" class="flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-[250px]">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by startup name or entrepreneur..." class="w-full bg-[#0b1120] border border-white/10 rounded-lg px-4 py-3 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-[#4ade80]/50 transition-colors">
                    </div>
                    <select name="status" class="bg-[#0b1120] border border-white/10 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-[#4ade80]/50 transition-colors">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="funded" {{ request('status') === 'funded' ? 'selected' : '' }}>Funded</option>
                        <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    <button type="submit" class="bg-[#4ade80] text-[#064e3b] px-6 py-3 rounded-lg font-bold text-sm hover:bg-[#3dbd6d] transition-colors">Search</button>
                    @if(request('search') || request('status'))
                        <a href="{{ route('admin.pitches') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Clear</a>
                    @endif
                </form>
            </div>

            <!-- Pitches Table -->
            <div class="bg-[#161e2d] rounded-xl border border-white/5 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-white/5">
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Startup Name</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Entrepreneur</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Funding Required</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Invested</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Growth</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Valuation</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Status</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Created</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($pitches as $pitch)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-white">{{ $pitch->startup_name }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.users.detail', $pitch->user) }}" class="text-sm text-[#4ade80] hover:text-[#3dbd6d] font-medium transition-colors">{{ $pitch->user->name }}</a>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4ade80] font-medium">Rs {{ number_format($pitch->funding_required ?? 0) }}</td>
                                <td class="px-6 py-4 text-sm text-white">Rs {{ number_format($pitch->invested_amount ?? 0) }}</td>
                                <td class="px-6 py-4 text-sm text-amber-400 font-medium">{{ $pitch->monthly_growth ?? 0 }}%</td>
                                <td class="px-6 py-4 text-sm text-gray-400">Rs {{ number_format($pitch->total_valuation ?? 0) }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-[10px] font-bold tracking-widest uppercase px-2 py-1 rounded
                                        @if($pitch->status === 'active') bg-emerald-500/10 text-emerald-400
                                        @elseif($pitch->status === 'funded') bg-blue-500/10 text-blue-400
                                        @else bg-gray-500/10 text-gray-400
                                        @endif">{{ $pitch->status }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $pitch->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-500 text-sm">No pitches found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($pitches->hasPages())
                <div class="px-6 py-4 border-t border-white/5">
                    {{ $pitches->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </main>
    </div>
@endsection
