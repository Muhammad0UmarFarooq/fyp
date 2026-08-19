@extends('layouts.app')

@section('content')
    @include('components.admin-navbar')

    <div class="flex flex-1">
        @include('components.admin-sidebar')

        <main class="flex-1 p-8 overflow-y-auto">
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">Dashboard</h1>
                <p class="text-gray-400 text-sm mt-1">Overview of all platform activity</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
                <!-- Total Users -->
                <div class="bg-[#161e2d] rounded-xl border border-white/5 p-6 hover:border-white/10 transition-colors">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                    </div>
                    <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Total Users</div>
                    <div class="text-3xl font-bold text-white">{{ $stats['total_users'] }}</div>
                </div>

                <!-- Entrepreneurs -->
                <div class="bg-[#161e2d] rounded-xl border border-white/5 p-6 hover:border-white/10 transition-colors">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </div>
                    <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Entrepreneurs</div>
                    <div class="text-3xl font-bold text-emerald-400">{{ $stats['entrepreneurs'] }}</div>
                </div>

                <!-- Investors -->
                <div class="bg-[#161e2d] rounded-xl border border-white/5 p-6 hover:border-white/10 transition-colors">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-lg bg-violet-500/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Investors</div>
                    <div class="text-3xl font-bold text-violet-400">{{ $stats['investors'] }}</div>
                </div>

                <!-- Active Pitches -->
                <div class="bg-[#161e2d] rounded-xl border border-white/5 p-6 hover:border-white/10 transition-colors">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-lg bg-amber-500/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                    <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Active Pitches</div>
                    <div class="text-3xl font-bold text-amber-400">{{ $stats['active_pitches'] }}<span class="text-sm text-gray-500 font-normal">/{{ $stats['total_pitches'] }}</span></div>
                </div>

                <!-- Agreements -->
                <div class="bg-[#161e2d] rounded-xl border border-white/5 p-6 hover:border-white/10 transition-colors">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-lg bg-rose-500/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>
                    <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Agreements</div>
                    <div class="text-3xl font-bold text-rose-400">{{ $stats['active_agreements'] }}<span class="text-sm text-gray-500 font-normal">/{{ $stats['total_agreements'] }}</span></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Users -->
                <div class="bg-[#161e2d] rounded-xl border border-white/5 overflow-hidden">
                    <div class="px-6 py-4 border-b border-white/5 flex justify-between items-center">
                        <h2 class="text-sm font-bold text-white uppercase tracking-wider">Recent Users</h2>
                        <a href="{{ route('admin.users') }}" class="text-xs text-[#4ade80] hover:text-[#3dbd6d] font-medium transition-colors">View All &rarr;</a>
                    </div>
                    <div class="divide-y divide-white/5">
                        @forelse($recentUsers as $user)
                        <div class="px-6 py-4 flex items-center justify-between hover:bg-white/[0.02] transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full {{ $user->role === 'entrepreneur' ? 'bg-emerald-500/10' : 'bg-violet-500/10' }} flex items-center justify-center">
                                    <span class="text-xs font-bold {{ $user->role === 'entrepreneur' ? 'text-emerald-400' : 'text-violet-400' }}">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                                <div>
                                    <a href="{{ route('admin.users.detail', $user) }}" class="text-sm font-medium text-white hover:text-[#4ade80] transition-colors">{{ $user->name }}</a>
                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold tracking-widest uppercase px-2 py-1 rounded {{ $user->role === 'entrepreneur' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-violet-500/10 text-violet-400' }}">{{ $user->role }}</span>
                        </div>
                        @empty
                        <div class="px-6 py-8 text-center text-gray-500 text-sm">No users registered yet</div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Agreements -->
                <div class="bg-[#161e2d] rounded-xl border border-white/5 overflow-hidden">
                    <div class="px-6 py-4 border-b border-white/5 flex justify-between items-center">
                        <h2 class="text-sm font-bold text-white uppercase tracking-wider">Recent Agreements</h2>
                        <a href="{{ route('admin.agreements') }}" class="text-xs text-[#4ade80] hover:text-[#3dbd6d] font-medium transition-colors">View All &rarr;</a>
                    </div>
                    <div class="divide-y divide-white/5">
                        @forelse($recentAgreements as $agreement)
                        <div class="px-6 py-4 hover:bg-white/[0.02] transition-colors">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-medium text-white">{{ $agreement->entrepreneur->name ?? 'N/A' }} &harr; {{ $agreement->investor->name ?? 'N/A' }}</span>
                                <span class="text-[10px] font-bold tracking-widest uppercase px-2 py-1 rounded
                                    @if($agreement->status === 'active') bg-emerald-500/10 text-emerald-400
                                    @elseif($agreement->status === 'completed') bg-blue-500/10 text-blue-400
                                    @else bg-amber-500/10 text-amber-400
                                    @endif">{{ str_replace('_', ' ', $agreement->status) }}</span>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $agreement->pitch->startup_name ?? 'Pitch Deleted' }} &middot; {{ $agreement->estimated_roi ?? 0 }}% ROI
                            </div>
                        </div>
                        @empty
                        <div class="px-6 py-8 text-center text-gray-500 text-sm">No agreements created yet</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
