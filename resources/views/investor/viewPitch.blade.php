<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Pitch - InvestBridge</title>
    
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

        <main class="flex-1 p-12 relative">
            <a href="{{ route('investor.home') }}" class="absolute top-4 left-4 inline-flex items-center text-brand-green text-xs font-bold tracking-widest uppercase hover:underline">
                <span class="mr-2">🔙</span> Back to Home
            </a>
            <div class="max-w-8xl mx-auto space-y-16">
                <!-- Header -->
                <div>
                    <h1 class="text-4xl font-bold mb-2">View Pitch Page</h1>
                    <p class="text-gray-400 text-sm max-w-xl">Transform your vision into an institutional-grade investment opportunity. Complete the following dimensions of your venture.</p>
                </div>

                <!-- 01. VIDEO TRANSMISSION -->
                <div class="space-y-6">
                    <div class="flex justify-between items-end">
                        <h2 class="text-brand-yellow font-bold text-sm tracking-widest uppercase">01. VIDEO TRANSMISSION</h2>
                        <span class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">MAX 250MB • MP4/MOV</span>
                    </div>
                    <div class="relative aspect-video bg-[#161e2d] rounded-2xl border-2 border-dashed border-white/5 flex items-center justify-center group overflow-hidden shadow-2xl">
                        <img src="{{ asset('images/shoes_shop.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-30">
                        <div class="relative flex items-center space-x-4">
                            <div class="bg-brand-green/10 p-4 rounded-xl text-brand-green">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-sm font-bold text-gray-400 tracking-widest uppercase">Drop your executive pitch here</span>
                        </div>
                    </div>
                </div>

                <!-- 02. PITCHES IDENTITY -->
                <div class="space-y-8">
                    <h2 class="text-brand-yellow font-bold text-sm tracking-widest uppercase">02. PITCHES IDENTITY</h2>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Startup Name</label>
                            <input type="text" value="Shoes shop" readonly class="w-full bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Invested Amount (Owner Investment)</label>
                            <input type="text" value="$ 5000000" readonly class="w-full bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Monthly Net Value (Total Revenue - Total Expenses)</label>
                            <input type="text" value="$ 1000000" readonly class="w-full bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Monthly Growth</label>
                            <div class="flex gap-2">
                                <input type="text" value="22%" readonly class="flex-1 bg-[#0b1120] border border-transparent rounded px-4 py-4 text-sm text-gray-200 focus:outline-none">
                                <button type="button" onclick="addGrowthField()" class="bg-[#0b1120] border border-white/5 p-3 rounded hover:bg-white/5 transition-colors">
                                    <svg class="w-5 h-5 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Growth Fields -->
                    <div id="growth-fields-container" class="grid grid-cols-2 gap-6"></div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Vision Statement</label>
                        <div class="w-full bg-[#0b1120] rounded p-6 text-sm text-gray-400 leading-relaxed italic">
                            A future where no shoe is mass-produced before it's sold. We are building the infrastructure for footwear that fits every foot perfectly, is manufactured only when ordered, and scales without warehouses of dead stock — making traditional retail inventory obsolete.
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Additional Detail</label>
                        <div class="w-full bg-[#0b1120] rounded p-6 text-sm text-gray-400 leading-relaxed italic">
                            The requested investment will be used to enhance our platform, grow our team, and execute targeted marketing strategies. With this capital, we aim to increase revenue, capture market share, and deliver strong returns for our investors.
                        </div>
                    </div>

                    <!-- Dynamic Input Groups Section -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center mb-4">
                            <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Additional Fields</label>
                            <button type="button" onclick="addInputGroup()" class="bg-[#1e293b] hover:bg-[#334155] transition-colors border border-white/10 p-2 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                        <div id="input-groups-container" class="space-y-4"></div>
                    </div>
                </div>

                <!-- 03. THE CAPITAL ARCHITECTURE -->
                <div class="bg-[#161e2d] border border-white/5 rounded-3xl p-10 shadow-2xl">
                    <h2 class="text-brand-yellow font-bold text-sm tracking-widest uppercase mb-10">03. THE CAPITAL ARCHITECTURE</h2>
                    
                    <div class="flex justify-between items-start">
                        <div class="space-y-8 flex-1 max-w-md">
                            <div class="space-y-2">
                                <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Funding Amount Required ($)</label>
                                <div class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 text-xl font-bold text-white">
                                    <span class="text-gray-600 mr-2">$</span> 5000000
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Return Time (Period)</label>
                                <div class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 text-xl font-bold text-white uppercase tracking-widest">
                                    2 years
                                </div>
                            </div>
                        </div>

                        <div class="ml-12 bg-[#1e293b] rounded-2xl p-8 flex-shrink-0 w-64 text-center shadow-xl border border-white/5">
                            <div class="text-[9px] font-bold text-gray-500 tracking-[0.2em] uppercase mb-4">Total Valuation</div>
                            <div class="text-4xl font-black text-brand-green">$10000000</div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        let growthFieldCount = 0;
        let inputGroupCount = 0;
        
        function addGrowthField() {
            growthFieldCount++;
            const container = document.getElementById('growth-fields-container');
            const fieldId = `growth-field-${growthFieldCount}`;
            
            const fieldHTML = `
                <div id="${fieldId}" class="space-y-2">
                    <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Monthly Growth</label>
                    <div class="flex gap-2">
                        <input type="text" value="" class="flex-1 bg-[#0b1120] border border-white/5 rounded px-4 py-4 text-sm text-gray-200 focus:outline-none focus:border-brand-green/50 placeholder-gray-600" placeholder="Enter growth %">
                        <button type="button" onclick="removeGrowthField('${fieldId}')" class="bg-[#0b1120] border border-white/5 p-3 rounded hover:bg-white/5 transition-colors">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                        </button>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', fieldHTML);
        }
        
        function removeGrowthField(fieldId) {
            const field = document.getElementById(fieldId);
            if (field) {
                field.remove();
            }
        }

        function addInputGroup() {
            inputGroupCount++;
            const container = document.getElementById('input-groups-container');
            const groupId = `input-group-${inputGroupCount}`;
            
            const groupHTML = `
                <div id="${groupId}" class="bg-[#161e2d] border border-white/5 rounded-lg p-6 space-y-4">
                    <div class="space-y-2">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Title</label>
                        <input type="text" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-3 text-sm text-gray-200 focus:outline-none focus:border-brand-green/50 placeholder-gray-600" placeholder="Enter title">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Description</label>
                        <textarea class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-3 text-sm text-gray-200 focus:outline-none focus:border-brand-green/50 placeholder-gray-600 resize-none" rows="4" placeholder="Enter description"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="removeInputGroup('${groupId}')" class="bg-red-600 hover:bg-red-700 transition-colors text-white text-[10px] font-bold px-4 py-2 rounded">
                            Remove
                        </button>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', groupHTML);
        }
        
        function removeInputGroup(groupId) {
            const group = document.getElementById(groupId);
            if (group) {
                group.remove();
            }
        }
    </script>

</body>
</html>
