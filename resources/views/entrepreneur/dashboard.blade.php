<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entrepreneur Dashboard - InvestBridge</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            dark: '#0b1120',
                            card: '#161e2d',
                            green: '#4ade80',
                            red: '#ff0000',
                            muted: '#94a3b8'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#0b1120] text-white font-sans min-h-screen antialiased">

    <!-- Navbar -->
    <x-navbar />

    <div class="flex">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="max-w-5xl mx-auto bg-[#161e2d] rounded-3xl overflow-hidden shadow-2xl border border-white/5">
                
                <!-- Action Buttons -->
                <div class="p-6 flex justify-end space-x-4">
                    <button class="bg-[#ff0000] text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-red-700 transition-colors">
                        Delete Pitch
                    </button>
                    <a href="{{ route('entrepreneur.pitch.update') }}" class="bg-[#4ade80] text-[#064e3b] px-8 py-3 rounded-lg font-bold text-lg hover:bg-[#3dbd6d] transition-colors inline-block text-center">
                        Update Pitch
                    </a>
                </div>

                <!-- Pitch Content -->
                <div class="px-8 pb-12">
                    <!-- Video/Image Preview -->
                    <div class="relative w-full aspect-video bg-gray-900 rounded-2xl overflow-hidden mb-8 group">
                        <img src="{{ asset('images/shoes_shop.jpg') }}" alt="Shoes Shop" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                        <!-- Play Button Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-brand-green/20 backdrop-blur-md p-6 rounded-2xl cursor-pointer hover:bg-brand-green/30 transition-colors border border-white/10 shadow-xl">
                                <svg class="w-12 h-12 text-brand-green" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Header Details -->
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-4xl font-bold mb-2">Shoes Shop</h1>
                            <div class="flex items-center text-sm text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Founder: <span class="text-white font-medium">Naeem Azhar</span></span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-1">Seeking Capital</div>
                            <div class="text-4xl font-bold text-brand-green">$5000000</div>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-400 text-lg leading-relaxed mb-12">
                        Bridging Our Shop to next Level in our areas. We need capital for strategic marketing expansion and high-end shop decorations to compete in the luxury segment. Expanding floor space by 200%.
                    </p>

                    <!-- Stats Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-[#0b1120] p-6 rounded-xl border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-2">Current MRR</div>
                            <div class="text-2xl font-bold text-white">$1000000</div>
                        </div>
                        <div class="bg-[#0b1120] p-6 rounded-xl border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-2">MoM Growth</div>
                            <div class="text-2xl font-bold text-brand-green">22%</div>
                        </div>
                        <div class="bg-[#0b1120] p-6 rounded-xl border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-2">Return Time</div>
                            <div class="text-2xl font-bold text-brand-green">2 years</div>
                        </div>
                        <div class="bg-[#0b1120] p-6 rounded-xl border border-white/5">
                            <div class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-2">Valuation</div>
                            <div class="text-2xl font-bold text-white">$10000000</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
