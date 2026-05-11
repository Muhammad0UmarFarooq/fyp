<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Active Offers - InvestBridge</title>
    
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
                <!-- Header -->
                <div class="flex justify-between items-end mb-12">
                    <h1 class="text-4xl font-bold">Active <span class="text-brand-green">Offers</span></h1>
                    <span class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">2 PENDING DECISIONS</span>
                </div>

                <!-- Offers List -->
                <div class="space-y-6">
                    <!-- Offer Card 1 -->
                    <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-8 shadow-xl">
                        <div class="flex justify-between items-start mb-10">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 rounded-xl overflow-hidden border border-white/10">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80" alt="Malik Riaz" class="w-full h-full object-cover">
                                </div>
                                <h2 class="text-2xl font-bold text-gray-200">Malik Riaz</h2>
                            </div>
                            <div class="text-right">
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.15em] uppercase mb-1">Offer Amount</div>
                                <div class="text-4xl font-bold text-brand-green">$9000000</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-8 mb-10">
                            <div>
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.15em] uppercase mb-2">Time Period</div>
                                <div class="text-xl font-bold text-gray-200">2 years</div>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.15em] uppercase mb-2">Valuation</div>
                                <div class="text-xl font-bold text-gray-200">$16000000</div>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.15em] uppercase mb-2">Date</div>
                                <div class="text-xl font-bold text-gray-200">3 Dec 2025</div>
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <button onclick="handleOffer(this)" class="bg-[#991b1b] text-white px-8 py-2.5 rounded text-xs font-bold tracking-widest uppercase hover:bg-red-900 transition-colors">Reject</button>
                            <button onclick="handleOffer(this)" class="border border-brand-green/30 text-brand-green px-8 py-2.5 rounded text-xs font-bold tracking-widest uppercase hover:bg-brand-green/10 transition-colors">Accept</button>
                        </div>
                    </div>

                    <!-- Offer Card 2 -->
                    <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-8 shadow-xl">
                        <div class="flex justify-between items-start mb-10">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 rounded-xl overflow-hidden border border-white/10">
                                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80" alt="Arshad" class="w-full h-full object-cover">
                                </div>
                                <h2 class="text-2xl font-bold text-gray-200">Arshad</h2>
                            </div>
                            <div class="text-right">
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.15em] uppercase mb-1">Offer Amount</div>
                                <div class="text-4xl font-bold text-brand-green">$7000000</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-8 mb-10">
                            <div>
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.15em] uppercase mb-2">Time Period</div>
                                <div class="text-xl font-bold text-gray-200">2 years</div>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.15em] uppercase mb-2">Valuation</div>
                                <div class="text-xl font-bold text-gray-200">$14000000</div>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-gray-500 tracking-[0.15em] uppercase mb-2">Date</div>
                                <div class="text-xl font-bold text-gray-200">23 Jan 2025</div>
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <button onclick="handleOffer(this)" class="bg-[#991b1b] text-white px-8 py-2.5 rounded text-xs font-bold tracking-widest uppercase hover:bg-red-900 transition-colors">Reject</button>
                            <button onclick="handleOffer(this)" class="border border-brand-green/30 text-brand-green px-8 py-2.5 rounded text-xs font-bold tracking-widest uppercase hover:bg-brand-green/10 transition-colors">Accept</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function handleOffer(button) {
            const offerCard = button.closest('.bg-[#161e2d]');
            if (offerCard) {
                offerCard.style.transition = 'all 0.3s ease';
                offerCard.style.opacity = '0';
                offerCard.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    offerCard.remove();
                }, 300);
            }
        }
    </script>

</body>
</html>
