<nav class="bg-[#0f1523] border-b border-white/5 px-8 py-4 flex justify-between items-center z-50 relative">
    <div class="flex items-center space-x-2 w-64">
        <div class="leading-none">
            <div class="text-xl font-bold tracking-tight text-white">
                Invest<span class="text-[#4ade80]">Bridge</span>
            </div>
            <div class="text-[8px] font-bold tracking-widest uppercase text-gray-500 mt-1">
                Entrepreneur/Investor
            </div>
        </div>
    </div>

    <div class="flex items-center space-x-4">
        <a href="{{ route('investor.profile') }}" class="text-xs font-bold text-[#4ade80] cursor-pointer hover:text-[#4ade80]/80 transition-colors">{{ auth()->user()->name }}</a>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="border border-white/10 px-4 py-1.5 rounded text-[9px] font-bold tracking-widest uppercase text-gray-500 hover:text-white hover:border-white/30 transition-colors">SIGN OUT</button>
        </form>
    </div>
</nav>
