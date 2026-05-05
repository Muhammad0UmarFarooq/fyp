<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvestBridge - Entrepreneur Home</title>
    
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
                            dark: '#0f1523',
                            card: '#1e2738',
                            box: '#111625',
                            green: '#4ade80',
                            yellow: '#facc15',
                            muted: '#64748b'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#111625] text-white font-sans min-h-screen antialiased flex flex-col">

    <!-- Top Navigation extracted to component -->
    <x-navbar />

    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar extracted to component -->
        <x-sidebar />

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-8xl mx-auto">
                
                <!-- Action Buttons: Delete Pitch & Update Pitch -->
                <div class="flex justify-end space-x-4 mb-6">
                    <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded transition-colors text-sm">
                        Delete Pitch
                    </button>
                    <button class="bg-[#4ade80] hover:bg-[#4ade80]/90 text-[#064e3b] font-bold py-2 px-6 rounded transition-colors text-sm">
                        Update Pitche
                    </button>
                </div>

                <!-- Card 1 -->
                <div class="bg-[#1e2738] rounded-lg overflow-hidden shadow-2xl border border-white/5 mb-8">
                    <!-- Video/Image Section -->
                    <div class="relative w-full h-64 md:h-96 bg-gray-900 group">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1000&q=80" alt="Shoes Shop" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                        <!-- Play Button Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-white/10 backdrop-blur-md p-6 rounded-lg cursor-pointer hover:bg-white/20 transition-colors border border-white/10 shadow-lg">
                                <svg class="w-10 h-10 text-[#4ade80] ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 md:p-8">
                        <!-- Title Row -->
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h2 class="text-2xl font-bold">Shoes Shop</h2>
                                <div class="flex items-center text-xs text-gray-400 mt-1">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span>Founder: <span class="text-white font-medium">Naeem Azhar</span></span>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1">Seeking Capital</div>
                                <div class="text-2xl font-bold text-[#4ade80]">$5000000</div>
                            </div>
                        </div>

                        <!-- Vision Statement -->
                        <div class="mb-8 mt-4">
                            <p class="text-sm text-gray-400 leading-relaxed">
                                Bridging Our Shop to next Level in our areas. We need capital for strategic marketing expansion and high-end shop decorations to compete in the luxury segment. Expanding floor space by 200%.
                            </p>
                        </div>

                        <!-- Stats Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="bg-[#111625] rounded px-5 py-4 border border-white/5">
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1.5">CURRENT MRR</div>
                                <div class="text-lg font-bold text-white">$1000000</div>
                            </div>
                            <div class="bg-[#111625] rounded px-5 py-4 border border-white/5">
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1.5">MOM GROWTH</div>
                                <div class="text-lg font-bold text-[#4ade80]">22%</div>
                            </div>
                            <div class="bg-[#111625] rounded px-5 py-4 border border-white/5">
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1.5">RETURN TIME</div>
                                <div class="text-lg font-bold text-[#4ade80]">2 years</div>
                            </div>
                            <div class="bg-[#111625] rounded px-5 py-4 border border-white/5">
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1.5">VALUATION</div>
                                <div class="text-lg font-bold text-white">$10000000</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
