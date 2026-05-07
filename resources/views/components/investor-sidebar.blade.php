<aside class="w-64 bg-[#0f1523] border-r border-white/5 min-h-[calc(100vh-73px)] flex flex-col py-6">
    <nav class="flex-1 space-y-2 px-4">
        <!-- Home -->
        <a href="{{ route('investor.home') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors {{ request()->routeIs('investor.home') ? 'bg-white/5 text-[#4ade80] border-r-2 border-[#4ade80]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="uppercase font-bold text-xs tracking-widest">Home</span>
        </a>
        
        <!-- My Offers -->
        <a href="{{ route('investor.offers') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors {{ request()->routeIs('investor.offers') ? 'bg-white/5 text-[#4ade80] border-r-2 border-[#4ade80]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="uppercase font-bold text-xs tracking-widest">MY OFFERS</span>
        </a>
        
        <!-- Agreements -->
        <a href="{{ route('investor.agreements') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors {{ request()->routeIs('investor.agreements') ? 'bg-white/5 text-[#4ade80] border-r-2 border-[#4ade80]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="uppercase font-bold text-xs tracking-widest">AGREEMENTS</span>
        </a>
    </nav>
</aside>
