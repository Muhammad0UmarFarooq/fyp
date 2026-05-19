<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entrepreneur Dashboard - InvestBridge</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0b1120] text-white font-sans min-h-screen antialiased">

    <!-- Navbar -->
    <x-navbar />

    <div class="flex">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="max-w-8xl mx-auto bg-[#161e2d] rounded-3xl overflow-hidden shadow-2xl border border-white/5">
                
                <!-- Action Buttons -->
                <div class="p-6 flex justify-end space-x-4">
                    @if($pitch)
                        <form action="{{ route('entrepreneur.pitch.destroy', $pitch) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-[#ff0000] text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-red-700 transition-colors" onclick="return confirm('Are you sure you want to delete this pitch?');">
                                Delete Pitch
                            </button>
                        </form>
                        <a href="{{ route('entrepreneur.pitch.update', $pitch) }}" class="bg-[#4ade80] text-[#064e3b] px-8 py-3 rounded-lg font-bold text-lg hover:bg-[#3dbd6d] transition-colors inline-block text-center">
                            Update Pitch
                        </a>
                    @else
                        
                    @endif
                </div>

                @if($pitch)
                <!-- Pitch Content -->
                <div class="px-8 pb-12">
                    <!-- Video/Image Preview -->
                    <div class="relative w-full h-[70vh] bg-gray-900 rounded-2xl overflow-hidden mb-8 group">
                        @if($pitch->video_path)
                            <video src="{{ asset('storage/' . $pitch->video_path) }}" class="w-full h-full object-cover z-10 relative" controls></video>
                        @else
                            <img src="{{ asset('images/shoes_shop.jpg') }}" alt="{{ $pitch->startup_name }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                            <!-- Play Button Overlay -->
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                <div class="bg-brand-green/20 backdrop-blur-md p-6 rounded-2xl border border-white/10 shadow-xl">
                                    <svg class="w-12 h-12 text-brand-green" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Header Details -->
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-4xl font-bold mb-2">{{ $pitch->startup_name }}</h1>
                            <div class="flex items-center text-sm text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Founder: <span class="text-white font-medium">{{ auth()->user()->name ?? 'Entrepreneur' }}</span></span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Seeking Capital</div>
                            <div class="text-4xl font-bold text-brand-green">PKR {{ number_format($pitch->funding_required ?? 0) }}</div>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-400 text-lg leading-relaxed mb-6">
                        {{ $pitch->vision_statement ?? 'No vision statement provided.' }}
                    </p>

                    <!-- Stats Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                        @if($pitch->monthly_net_value)
                        <div class="bg-[#0b1120] p-6 rounded-xl border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-2">Monthly Net Value</div>
                            <div class="text-2xl font-bold text-white">PKR {{ number_format($pitch->monthly_net_value) }}</div>
                        </div>
                        @endif
                        
                        @if($pitch->monthly_growth)
                        <div class="bg-[#0b1120] p-6 rounded-xl border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-2">MoM Growth</div>
                            <div class="text-2xl font-bold text-brand-green">{{ $pitch->monthly_growth }}%</div>
                        </div>
                        @endif
                        
                        @if($pitch->return_time)
                        <div class="bg-[#0b1120] p-6 rounded-xl border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-2">Return Time</div>
                            <div class="text-2xl font-bold text-brand-green">{{ $pitch->return_time }}</div>
                        </div>
                        @endif
                        
                        @if($pitch->total_valuation)
                        <div class="bg-[#0b1120] p-6 rounded-xl border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-2">Valuation</div>
                            <div class="text-2xl font-bold text-white">PKR {{ number_format($pitch->total_valuation) }}</div>
                        </div>
                        @endif

                        @if($pitch->pitchFields)
                            @foreach($pitch->pitchFields as $field)
                            <div class="bg-[#0b1120] p-6 rounded-xl border border-white/5">
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-2">{{ $field->label }}</div>
                                <div class="text-2xl font-bold text-white">{{ $field->value }}</div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                @else
                <div class="px-8 pb-12 flex flex-col items-center justify-center text-center py-20">
                    <div class="bg-brand-green/10 p-6 rounded-full mb-6">
                        <svg class="w-16 h-16 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-4">No Active Pitch</h2>
                    <p class="text-gray-400 max-w-md mb-8 leading-relaxed">
                        You haven't created your institutional-grade investment opportunity yet. Create your first pitch to attract investors.
                    </p>
                    <a href="{{ route('entrepreneur.pitch.create') }}" class="bg-[#4ade80] text-[#064e3b] px-8 py-4 rounded-lg font-bold tracking-widest uppercase hover:bg-[#3dbd6d] transition-all shadow-xl shadow-brand-green/10">
                        Create Your Pitch Now
                    </a>
                </div>
                @endif
            </div>
        </main>
    </div>

</body>
</html>
