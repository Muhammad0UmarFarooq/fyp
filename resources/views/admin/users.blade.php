@extends('layouts.app')

@section('content')
    @include('components.admin-navbar')

    <div class="flex flex-1">
        @include('components.admin-sidebar')

        <main class="flex-1 p-8 overflow-y-auto">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white">Users</h1>
                    <p class="text-gray-400 text-sm mt-1">All registered entrepreneurs and investors</p>
                </div>
            </div>

            <!-- Search & Filter -->
            <div class="bg-[#161e2d] rounded-xl border border-white/5 p-4 mb-6">
                <form action="{{ route('admin.users') }}" method="GET" class="flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-[250px]">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, CNIC, phone, or city..." class="w-full bg-[#0b1120] border border-white/10 rounded-lg px-4 py-3 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-[#4ade80]/50 transition-colors">
                    </div>
                    <select name="role" class="bg-[#0b1120] border border-white/10 rounded-lg px-4 py-3 text-sm text-white focus:outline-none focus:border-[#4ade80]/50 transition-colors">
                        <option value="">All Roles</option>
                        <option value="entrepreneur" {{ request('role') === 'entrepreneur' ? 'selected' : '' }}>Entrepreneurs</option>
                        <option value="investor" {{ request('role') === 'investor' ? 'selected' : '' }}>Investors</option>
                    </select>
                    <button type="submit" class="bg-[#4ade80] text-[#064e3b] px-6 py-3 rounded-lg font-bold text-sm hover:bg-[#3dbd6d] transition-colors">Search</button>
                    @if(request('search') || request('role'))
                        <a href="{{ route('admin.users') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Clear</a>
                    @endif
                </form>
            </div>

            <!-- Users Table -->
            <div class="bg-[#161e2d] rounded-xl border border-white/5 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-white/5">
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Name</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Email</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">CNIC</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Phone</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">City</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Role</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Joined</th>
                                <th class="text-left px-6 py-4 text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($users as $user)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full {{ $user->role === 'entrepreneur' ? 'bg-emerald-500/10' : 'bg-violet-500/10' }} flex items-center justify-center flex-shrink-0">
                                            <span class="text-xs font-bold {{ $user->role === 'entrepreneur' ? 'text-emerald-400' : 'text-violet-400' }}">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                        <span class="text-sm font-medium text-white">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-400">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-400 font-mono">{{ $user->cnic ?? '\u2014' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-400">{{ $user->phone ?? '\u2014' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-400">{{ $user->city ?? '\u2014' }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-[10px] font-bold tracking-widest uppercase px-2 py-1 rounded {{ $user->role === 'entrepreneur' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-violet-500/10 text-violet-400' }}">{{ $user->role }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.users.detail', $user) }}" class="text-[#4ade80] hover:text-[#3dbd6d] text-sm font-medium transition-colors">View &rarr;</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-500 text-sm">No users found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($users->hasPages())
                <div class="px-6 py-4 border-t border-white/5">
                    {{ $users->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </main>
    </div>
@endsection
