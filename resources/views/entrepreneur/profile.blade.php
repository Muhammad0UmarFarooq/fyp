<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - Naeem Azhar</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0b1120] text-white font-sans min-h-screen antialiased">

    <x-navbar />

    <div class="flex">
        <x-sidebar />

        <main class="flex-1 p-12">
            <div class="max-w-8xl mx-auto">

                <!-- Profile Header -->
                <div class="flex items-center space-x-12 mb-16">
                    <div class="relative group">
                        <div class="w-40 h-40 bg-white rounded-2xl flex items-center justify-center border-4 border-white/10 overflow-hidden shadow-2xl">
                            <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <span class="bg-[#1e293b] text-brand-green px-4 py-1.5 rounded text-[10px] font-bold tracking-widest uppercase">Verified Entrepreneur</span>
                        <h1 class="text-6xl font-bold">Naeem Azhar</h1>
                        <div class="flex items-center space-x-12 text-sm text-gray-400 font-medium">
                            <div class="flex items-center">
                                <span class="mr-2">📍</span> Gujrat
                            </div>
                            <div class="flex items-center">
                                naeem@gmail.com
                            </div>
                            <div class="flex items-center">
                                03111111122
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sections -->
                <div class="space-y-16">
                    <!-- Operational Vision -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-px w-8 bg-brand-green"></div>
                            <h2 class="text-xl font-bold">Operational Vision</h2>
                        </div>
                        <div class="bg-[#161e2d] border-l-4 border-brand-green p-8 rounded-r-2xl shadow-xl">
                            <p class="text-gray-400 leading-loose text-lg">
                                Focusing on scaling disruptive solutions in retail and energy sectors with a high-conviction approach to operational excellence. Naeem's journey is defined by a relentless pursuit of efficiency and market transformation through technology-first frameworks.
                            </p>
                        </div>
                    </div>

                    <!-- Active Venture -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-px w-8 bg-brand-green"></div>
                            <h2 class="text-xl font-bold">Active Venture</h2>
                        </div>
                        <div class="max-w-md bg-[#161e2d] border border-white/5 rounded-2xl p-6 shadow-xl">
                            <div class="flex justify-between items-start mb-8">
                                <div class="bg-[#1e293b] p-3 rounded-xl text-brand-green">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                                <span class="bg-brand-green/10 text-brand-green px-3 py-1 rounded text-[10px] font-bold tracking-widest uppercase">Series A</span>
                            </div>
                            <h3 class="text-2xl font-bold mb-2">Shoes Shop</h3>
                            <p class="text-sm text-gray-500 font-medium mb-12">Retail Tech - Next-Gen Footwear Logistics</p>
                        </div>
                    </div>

                    <!-- Signed Agreements -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-px w-8 bg-brand-green"></div>
                            <h2 class="text-xl font-bold">Signed Agreements</h2>
                        </div>
                        <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-6 flex justify-between items-center group cursor-pointer hover:bg-[#1e293b] transition-colors shadow-xl">
                            <div class="flex items-center space-x-4">
                                <div class="bg-[#0b1120] p-3 rounded-xl text-brand-green">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <span class="font-bold text-gray-200">Shoes_Shop_Series_A_Agreement.pdf</span>
                            </div>
                            <div class="bg-brand-green/20 p-2 rounded-lg group-hover:bg-brand-green/30 transition-colors">
                                <svg class="w-5 h-5 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
