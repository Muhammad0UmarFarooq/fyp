<nav class="bg-[#0f1523] border-b border-white/5 px-4 md:px-8 py-4 flex justify-between items-center z-50 sticky top-0 w-full">
    <div class="flex items-center space-x-3">
        <!-- Mobile Hamburger -->
        <button onclick="document.getElementById('mobile-sidebar').classList.toggle('hidden')" class="md:hidden text-gray-400 hover:text-white transition-colors cursor-pointer" aria-label="Toggle menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
        <div class="leading-none">
            <div class="text-xl font-bold tracking-tight text-white">
                Invest<span class="text-[#4ade80]">Bridge</span>
            </div>
            <div class="text-[8px] font-bold tracking-widest uppercase text-red-400 mt-1">
                Admin Panel
            </div>
        </div>
    </div>

    <div class="flex items-center space-x-4">
        <div class="text-right hidden sm:block">
            <span class="text-xs font-bold text-white block">{{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-[9px] font-bold tracking-widest uppercase text-gray-500 hover:text-white transition-colors">SIGN OUT</button>
            </form>
        </div>
        <div class="w-8 h-8 rounded overflow-hidden border border-red-400/30 bg-red-400/10 flex items-center justify-center">
            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
        </div>
    </div>
</nav>
