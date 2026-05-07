<aside class="w-64 bg-[#0f1523] border-r border-white/5 min-h-[calc(100vh-73px)] flex flex-col py-6">
    <nav class="flex-1 space-y-2 px-4">
        <!-- Home -->
        <a href="{{ route('investor.home') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors {{ request()->routeIs('investor.dashboard') ? 'bg-white/5 text-[#4ade80] border-r-2 border-[#4ade80]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="uppercase font-bold text-xs tracking-widest">Home</span>
        </a>
        
        <!-- My Offers -->
        <a href="{{ route('investor.myOffers') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors {{ request()->routeIs('investor.myOffers') ? 'bg-white/5 text-[#4ade80] border-r-2 border-[#4ade80]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <span class="uppercase font-bold text-xs tracking-widest">MY OFFERS</span>
        </a>
        
        <!-- Agreements -->
        <a href="{{ route('investor.agreements') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium text-sm transition-colors {{ request()->routeIs('investor.agreements') ? 'bg-white/5 text-[#4ade80] border-r-2 border-[#4ade80]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-２V5a２　２　０　０１　２　－２ｈ５．５８６ａ１　１　０　０１．７０７．２９３ｌ５．４１４　５．４１４ａ１　１　０　０１．２９３．７０７Ｖ１９ａ２　２　０　０１－２　２z"></path></svg>
            <span class="uppercase font-bold text-xs tracking-widest">AGREEMENTS</span>
        </a>
    </nav>
</aside>
