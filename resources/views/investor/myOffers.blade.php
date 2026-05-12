<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Active Investment Offers - InvestBridge</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0b1120] text-white font-sans min-h-screen antialiased">

    <x-investor-navbar />

    <div class="flex">
        <x-investor-sidebar />

        <main class="flex-1 p-12">
            <div class="max-w-8xl mx-auto">
                <!-- Header -->
                <div class="mb-12">
                    <h1 class="text-4xl font-bold mb-2">Active Investment Offers</h1>
                    <p class="text-gray-400 text-sm">Manage your current proposals and track the status of negotiations
                        in the deal pipeline.</p>
                </div>

                <!-- Offers List -->
                <div class="space-y-6">

                    <!-- Offer 1: Solaris Grid -->
                    <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-8 shadow-xl">
                        <div class="flex justify-between items-start mb-10">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-[#1e293b] rounded-lg flex items-center justify-center text-brand-green overflow-hidden">
                                    <img src="https://solarbusinesshub.com/wp-content/uploads/2016/12/solaris-expands-its-product-range-from-off-grid-solar-power-manufacturers.jpg"
                                        class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold">Solaris Grid</h2>
                                    <div
                                        class="flex items-center text-[10px] text-brand-green font-bold uppercase tracking-widest mt-0.5">
                                        <span class="w-1 h-1 bg-brand-green rounded-full mr-2"></span>
                                        Junaid Akhtar
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1">Offer
                                    Amount</div>
                                <div class="text-3xl font-bold text-brand-green">$1000000</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-8 mb-10">
                            <div>
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Return
                                    Time Period</div>
                                <div class="text-lg font-bold">4 years</div>
                            </div>
                            <div>
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Valuation
                                </div>
                                <div class="text-lg font-bold">$2500000</div>
                            </div>
                            <div>
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Date Sent
                                </div>
                                <div class="text-lg font-bold">Oct 24, 2025</div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex space-x-3">
                                <button
                                    class="bg-red-600 text-white px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider">Cancel</button>
                                <a href="{{ route('investor.pitch.view') }}"
                                    class="bg-[#0b1120] text-gray-300 px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider inline-block">View
                                    Pitch</a>
                                <button
                                    class="bg-[#1e293b] text-brand-green px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider">Edit
                                    Terms</button>
                            </div>
                            <div class="text-red-600 font-black text-[10px] tracking-widest uppercase">Rejected</div>
                        </div>
                    </div>

                    <!-- Offer 2: Nimbus AI -->
                    <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-8 shadow-xl">
                        <div class="flex justify-between items-start mb-10">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-[#1e293b] rounded-lg flex items-center justify-center text-brand-green overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&w=100&q=80"
                                        class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold">Nimbus AI</h2>
                                    <div
                                        class="flex items-center text-[10px] text-brand-green font-bold uppercase tracking-widest mt-0.5">
                                        <span class="w-1 h-1 bg-brand-green rounded-full mr-2"></span>
                                        Muhammad Usama
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1">Offer
                                    Amount</div>
                                <div class="text-3xl font-bold text-brand-green">$1200000</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-8 mb-10">
                            <div>
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Return
                                    Time Period</div>
                                <div class="text-lg font-bold text-gray-600">----</div>
                            </div>
                            <div>
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Valuation
                                    (POST)</div>
                                <div class="text-lg font-bold text-gray-600">$-----</div>
                            </div>
                            <div>
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Date Sent
                                </div>
                                <div class="text-lg font-bold">New Date</div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex space-x-3">
                                <button
                                    class="bg-red-600 text-white px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider">Cancel</button>
                                <a href="{{ route('investor.pitch.view') }}"
                                    class="bg-[#0b1120] text-gray-300 px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider inline-block">View
                                    Pitch</a>
                                <button
                                    class="bg-[#1e293b] text-brand-green px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider">Re-Bid</button>
                                <button
                                    class="border border-red-900/30 text-red-900 px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider">Cancel</button>
                            </div>
                            <div class="text-gray-500 font-black text-[10px] tracking-widest uppercase">Pending Offer
                            </div>
                        </div>
                    </div>

                    <!-- Offer 3: Shoes Shop -->
                    <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-8 shadow-xl">
                        <div class="flex justify-between items-start mb-10">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-[#1e293b] rounded-lg flex items-center justify-center text-brand-green overflow-hidden">
                                    <img src="{{ asset('images/shoes_shop.jpg') }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold">Shoes Shop</h2>
                                    <div
                                        class="flex items-center text-[10px] text-brand-green font-bold uppercase tracking-widest mt-0.5">
                                        <span class="w-1 h-1 bg-brand-green rounded-full mr-2"></span>
                                        Naeem Azhar
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-1">Offer
                                    Amount</div>
                                <div class="text-3xl font-bold text-brand-green">$500000</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-8 mb-10">
                            <div>
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Return
                                    Time Period</div>
                                <div class="text-lg font-bold">2 years</div>
                            </div>
                            <div>
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Valuation
                                </div>
                                <div class="text-lg font-bold">$1200000</div>
                            </div>
                            <div>
                                <div class="text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Date Sent
                                </div>
                                <div class="text-lg font-bold">Oct 15, 2025</div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex space-x-3">
                                <button
                                    class="bg-red-600 text-white px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider">Cancel</button>
                                <a href="{{ route('investor.pitch.view') }}" class="bg-[#0b1120] text-gray-300 px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider inline-block">View Pitch</a>
                                <button
                                    class="bg-brand-green text-[#064e3b] px-8 py-2.5 rounded font-bold text-[11px] uppercase tracking-wider">Proceed
                                    to Agreement</button>
                            </div>
                            <div class="text-gray-500 font-black text-[10px] tracking-widest uppercase">Offer Finalized
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

</body>

</html>
