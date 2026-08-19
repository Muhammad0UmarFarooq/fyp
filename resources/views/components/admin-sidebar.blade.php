<aside class="w-64 bg-[#0f1523] border-r border-white/5 h-[calc(100vh-73px)] sticky top-[73px] flex flex-col py-6 overflow-y-auto">
    <nav class="flex-1 space-y-2 px-4">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-white/5 text-[#f87171] border-r-2 border-[#f87171]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span>Dashboard</span>
        </a>

        <!-- Users -->
        <a href="{{ route('admin.users') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors {{ request()->routeIs('admin.users') || request()->routeIs('admin.users.detail') ? 'bg-white/5 text-[#f87171] border-r-2 border-[#f87171]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <span>Users</span>
        </a>

        <!-- Pitches -->
        <a href="{{ route('admin.pitches') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors {{ request()->routeIs('admin.pitches') ? 'bg-white/5 text-[#f87171] border-r-2 border-[#f87171]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <span>Pitches</span>
        </a>

        <!-- Offers -->
        <a href="{{ route('admin.offers') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors {{ request()->routeIs('admin.offers') ? 'bg-white/5 text-[#f87171] border-r-2 border-[#f87171]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <span>Offers</span>
        </a>

        <!-- Agreements -->
        <a href="{{ route('admin.agreements') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors {{ request()->routeIs('admin.agreements') ? 'bg-white/5 text-[#f87171] border-r-2 border-[#f87171]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span>Agreements</span>
        </a>
    </nav>

    <div class="px-4 mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm text-red-400 hover:text-red-300 hover:bg-red-400/5 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
