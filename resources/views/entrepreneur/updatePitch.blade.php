<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Your Pitch - InvestBridge</title>
    
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
                            yellow: '#facc15',
                            muted: '#94a3b8'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#0b1120] text-white font-sans min-h-screen antialiased">

    <x-navbar />

    <div class="flex">
        <x-sidebar />

        <main class="flex-1 p-12">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-12">
                    <h1 class="text-4xl font-bold mb-4">Update Your Pitch</h1>
                    <p class="text-gray-400 text-sm max-w-2xl leading-relaxed">
                        Transform your vision into an institutional-grade investment opportunity. Complete the following dimensions of your venture.
                    </p>
                </div>

                <form class="space-y-16">
                    <!-- 01. Video Transmission -->
                    <div class="space-y-6">
                        <div class="flex justify-between items-end">
                            <h2 class="text-brand-yellow font-bold tracking-[0.2em] text-sm">01. VIDEO TRANSMISSION</h2>
                            <span class="text-[10px] text-gray-500 font-bold uppercase">MAX 250MB - MP4/MOV</span>
                        </div>
                        
                        <div class="relative w-full aspect-video bg-[#111625] rounded-xl overflow-hidden border border-white/5 group cursor-pointer">
                            <img src="{{ asset('images/shoes_shop.jpg') }}" class="w-full h-full object-cover opacity-40 group-hover:opacity-50 transition-opacity">
                            <div class="absolute inset-0 flex flex-col items-center justify-center space-y-4">
                                <div class="bg-brand-green/20 p-4 rounded-xl border border-brand-green/30">
                                    <svg class="w-6 h-6 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="text-sm font-medium text-gray-300">Drop your executive pitch here</span>
                            </div>
                        </div>
                    </div>

                    <!-- 02. Pitches Identity -->
                    <div class="space-y-8">
                        <h2 class="text-brand-yellow font-bold tracking-[0.2em] text-sm">02. PITCHES IDENTITY</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Startup Name</label>
                                <input type="text" value="Shoes shop" class="w-full bg-[#111625] border border-white/5 rounded px-4 py-3 focus:outline-none focus:border-brand-green/50 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Invested Amount (Owner Investment)</label>
                                <input type="text" value="$ 5000000" class="w-full bg-[#111625] border border-white/5 rounded px-4 py-3 focus:outline-none focus:border-brand-green/50 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Monthly Net Value (Total Revenue - Total Expenses)</label>
                                <input type="text" value="$ 1000000" class="w-full bg-[#111625] border border-white/5 rounded px-4 py-3 focus:outline-none focus:border-brand-green/50 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Monthly Growth</label>
                                <div class="flex space-x-2">
                                    <input type="text" value="22%" class="flex-1 bg-[#111625] border border-white/5 rounded px-4 py-3 focus:outline-none focus:border-brand-green/50 text-sm">
                                    <button type="button" class="bg-[#111625] border border-white/5 p-3 rounded hover:bg-white/5 transition-colors">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Fields Example -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                            <div class="bg-[#111625] border border-white/5 p-4 rounded flex justify-center">
                                <button type="button" class="bg-[#1e293b] p-2 rounded-full hover:bg-[#334155] transition-colors border border-white/10">
                                    <svg class="w-6 h-6 text-[#4ade80]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                            <div class="bg-[#111625] border border-white/5 p-6 rounded-lg space-y-4">
                                <div class="space-y-1">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Title</label>
                                    <input type="text" class="w-full bg-[#0b1120] border border-white/5 rounded px-3 py-2 text-xs">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Field</label>
                                    <input type="text" class="w-full bg-[#0b1120] border border-white/5 rounded px-3 py-2 text-xs">
                                </div>
                                <div class="flex justify-end space-x-2">
                                    <button type="button" class="bg-red-600 text-white text-[10px] font-bold px-3 py-1 rounded">Remove</button>
                                    <button type="button" class="bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded">Add</button>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Vision Statement</label>
                            <textarea rows="4" class="w-full bg-[#111625] border border-white/5 rounded px-4 py-3 focus:outline-none focus:border-brand-green/50 text-sm leading-relaxed">A future where no shoe is mass-produced before it's sold. We are building the infrastructure for footwear that fits every foot perfectly, is manufactured only when ordered, and scales without warehouses of dead stock — making traditional retail inventory obsolete.</textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Additional Detail</label>
                            <textarea rows="4" class="w-full bg-[#111625] border border-white/5 rounded px-4 py-3 focus:outline-none focus:border-brand-green/50 text-sm leading-relaxed">The requested investment will be used to enhance our platform, grow our team, and execute targeted marketing strategies. With this capital, we aim to increase revenue, capture market share, and deliver strong returns for our investors.</textarea>
                        </div>
                    </div>

                    <!-- 03. The Capital Architecture -->
                    <div class="bg-[#111625] border border-white/5 p-8 rounded-2xl space-y-8">
                        <h2 class="text-brand-yellow font-bold tracking-[0.2em] text-sm">03. THE CAPITAL ARCHITECTURE</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Funding Amount Required ($)</label>
                                    <input type="text" value="$ 5000000" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 focus:outline-none focus:border-brand-green/50 text-lg font-bold">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Return Time (Period)</label>
                                    <input type="text" value="2 years" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 focus:outline-none focus:border-brand-green/50 text-lg font-bold">
                                </div>
                            </div>

                            <div class="bg-[#0b1120] p-10 rounded-xl border border-white/5 text-center">
                                <div class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Total Valuation</div>
                                <div class="text-5xl font-bold text-brand-green">$10000000</div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <div class="flex justify-center pb-12">
                        <button type="submit" class="bg-[#4ade80] text-[#064e3b] px-16 py-4 rounded font-bold text-sm tracking-widest uppercase hover:bg-[#3dbd6d] transition-all shadow-xl shadow-brand-green/10">
                            Edit Pitch
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

</body>
</html>
