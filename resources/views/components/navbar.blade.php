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
        <div class="text-right">
            <div href="{{ route('entrepreneur.profile') }}" class="text-xs font-bold text-white cursor-pointer hover:text-gray-200 transition-colors">Naeem Azhar</div>
            <a href="#" class="text-[9px] font-bold tracking-widest uppercase text-gray-500 hover:text-white transition-colors">SIGN OUT</a>
        </div>
        <div class="w-8 h-8 rounded overflow-hidden border border-white/10 bg-gray-800 flex items-center justify-center cursor-pointer hover:border-gray-500 transition-colors">
            <svg href="{{ route('entrepreneur.profile') }}" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
        </div>
    </div>
</nav>
