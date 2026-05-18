<nav class="bg-[#0f1523] border-b border-white/5 px-8 py-4 flex justify-between items-center z-50 sticky top-0 w-full">
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
            <a href="{{ route('investor.profile') }}" class="text-xs font-bold text-[#4ade80] cursor-pointer hover:text-[#4ade80]/80 transition-colors block">{{ auth()->user()->name }}</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-[9px] font-bold tracking-widest uppercase text-gray-500 hover:text-white transition-colors cursor-pointer">SIGN OUT</button>
            </form>
        </div>
        <a href="{{ route('investor.profile') }}" class="w-8 h-8 rounded overflow-hidden border border-white/10 bg-gray-800 flex items-center justify-center cursor-pointer hover:border-brand-green transition-colors font-bold text-xs text-brand-green">
            @if(auth()->user()->profile_image)
                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile Image" class="w-full h-full object-cover">
            @else
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            @endif
        </a>
    </div>
</nav>
