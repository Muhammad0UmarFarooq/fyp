<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Your Pitch - InvestBridge</title>
    
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
                        <h2 class="text-[#facc15] font-bold tracking-[0.2em] text-sm uppercase">02. Pitches Identity</h2>
                        
                        <div id="pitch-identity-grid" class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Startup Name</label>
                                <input type="text" value="Shoes shop" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 focus:outline-none focus:border-brand-green/50 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Invested Amount (Owner Investment)</label>
                                <input type="text" value="$ 5000000" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 focus:outline-none focus:border-brand-green/50 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Monthly Net Value(Total Revenue - Total Expenses )</label>
                                <input type="text" value="$ 1000000" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 focus:outline-none focus:border-brand-green/50 text-sm">
                            </div>
                            <div id="monthly-growth-field" class="space-y-2">
                                <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Monthly Growth</label>
                                <div class="flex items-center bg-[#0b1120] border border-white/5 rounded">
                                    <input type="text" value="22%" class="flex-1 bg-transparent px-4 py-4 focus:outline-none text-sm">
                                    <div class="p-2">
                                        <button type="button" onclick="removeFinalField('monthly-growth-field')" class="bg-white w-8 h-8 flex items-center justify-center rounded shadow-sm group">
                                            <div class="bg-[#ff0000] w-6 h-6 rounded-full flex items-center justify-center group-hover:bg-[#b30000] transition-colors">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path></svg>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Add Button Box (Always at the end) -->
                            <div id="add-button-box" class="bg-[#0b1120] border border-white/5 h-[84px] rounded flex items-center justify-center">
                                <button type="button" onclick="showFieldCreator()" class="bg-white w-10 h-10 flex items-center justify-center rounded shadow-sm group">
                                    <div class="bg-[#007bff] w-8 h-8 rounded-full flex items-center justify-center group-hover:bg-[#0056b3] transition-colors">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Vision Statement</label>
                            <textarea rows="4" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-3 focus:outline-none focus:border-brand-green/50 text-sm leading-relaxed">A future where no shoe is mass-produced before it's sold. We are building the infrastructure for footwear that fits every foot perfectly, is manufactured only when ordered, and scales without warehouses of dead stock — making traditional retail inventory obsolete.</textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Additional Detail</label>
                            <textarea rows="4" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-3 focus:outline-none focus:border-brand-green/50 text-sm leading-relaxed">The requested investment will be used to enhance our platform, grow our team, and execute targeted marketing strategies. With this capital, we aim to increase revenue, capture market share, and deliver strong returns for our investors.</textarea>
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
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 block">Total Valuation</label>
                                <div class="flex items-center justify-center space-x-2">
                                    <span class="text-5xl font-bold text-brand-green">$</span>
                                    <input type="text" value="10000000" class="bg-transparent text-5xl font-bold text-brand-green focus:outline-none w-full text-center">
                                </div>
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

    <script>
        let fieldCount = 0;
        
        function showFieldCreator() {
            fieldCount++;
            const grid = document.getElementById('pitch-identity-grid');
            const addButtonBox = document.getElementById('add-button-box');
            const creatorId = `creator-${fieldCount}`;
            
            const creatorHTML = `
                <div id="${creatorId}" class="bg-[#0b1120] border border-white/10 p-4 rounded space-y-3">
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Title</label>
                        <input type="text" id="title-${fieldCount}" class="w-full bg-[#111625] border border-white/5 rounded px-3 py-2 text-xs text-gray-300 focus:outline-none" placeholder="e.g. Target Market">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Field</label>
                        <input type="text" id="value-${fieldCount}" class="w-full bg-[#111625] border border-white/5 rounded px-3 py-2 text-xs text-gray-300 focus:outline-none" placeholder="e.g. Global">
                    </div>
                    <div class="flex items-center space-x-2 pt-1">
                        <button type="button" onclick="removeCreator('${creatorId}')" class="bg-[#ff0000] text-white text-[10px] font-bold px-3 py-1.5 rounded uppercase tracking-wider hover:bg-red-700 transition-colors">Remove</button>
                        <button type="button" onclick="addField(${fieldCount})" class="bg-[#007bff] text-white text-[10px] font-bold px-4 py-1.5 rounded uppercase tracking-wider hover:bg-[#0056b3] transition-colors">ADD</button>
                    </div>
                </div>
            `;
            
            // Insert before the add button box
            addButtonBox.insertAdjacentHTML('beforebegin', creatorHTML);
        }

        function addField(id) {
            const titleInput = document.getElementById(`title-${id}`);
            const valueInput = document.getElementById(`value-${id}`);
            const title = titleInput.value || 'Additional Info';
            const value = valueInput.value || '';
            const creator = document.getElementById(`creator-${id}`);
            const addButtonBox = document.getElementById('add-button-box');
            
            const fieldId = `field-final-${id}`;
            const fieldHTML = `
                <div id="${fieldId}" class="space-y-2">
                    <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">${title}</label>
                    <div class="flex items-center bg-[#0b1120] border border-white/5 rounded">
                        <input type="text" value="${value}" class="flex-1 bg-transparent px-4 py-4 focus:outline-none text-sm">
                        <div class="p-2">
                            <button type="button" onclick="removeFinalField('${fieldId}')" class="bg-white w-8 h-8 flex items-center justify-center rounded shadow-sm group">
                                <div class="bg-[#ff0000] w-6 h-6 rounded-full flex items-center justify-center group-hover:bg-[#b30000] transition-colors">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path></svg>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            // Remove the creator box
            creator.remove();
            
            // Insert the permanent field before the add button box
            addButtonBox.insertAdjacentHTML('beforebegin', fieldHTML);
        }
        
        function removeCreator(id) {
            document.getElementById(id).remove();
        }

        function removeFinalField(id) {
            document.getElementById(id).remove();
        }
    </script>

</body>
</html>
