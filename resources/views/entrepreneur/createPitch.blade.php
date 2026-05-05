<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvestBridge - Create Your Pitch</title>
    
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

    <x-navbar />

    <div class="flex flex-1 overflow-hidden">
        <x-sidebar />

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-8xl mx-auto pb-20">
                <div class="mb-10 mt-4">
                    <h1 class="text-3xl font-bold text-white mb-2">Create Your Pitch</h1>
                    <p class="text-gray-400 text-sm">Transform your vision into an institutional-grade investment opportunity. Complete the following dimensions of your venture.</p>
                </div>

                <form action="#" method="POST">
                    <!-- Section 1 -->
                    <div class="mb-12">
                        <div class="flex justify-between items-end mb-4">
                            <h2 class="text-sm font-bold text-[#facc15] tracking-widest uppercase">01. Video Transmission</h2>
                            <span class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">Max 250MB • MP4/MOV</span>
                        </div>
                        
                        <div class="relative border-2 border-dashed border-white/10 bg-[#0f1523] rounded-lg p-16 flex flex-col items-center justify-center hover:border-[#4ade80]/50 transition-colors">
                            <input type="file" accept="video/mp4,video/quicktime" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" aria-label="Upload video pitch">
                            <div class="bg-white/5 p-4 rounded-lg mb-4 pointer-events-none">
                                <svg class="w-6 h-6 text-[#4ade80]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="text-white font-bold text-sm mb-1 pointer-events-none">Drop your executive pitch here</div>
                            <div class="text-gray-500 text-xs pointer-events-none">or click to browse secure local files</div>
                        </div>
                    </div>

                    <!-- Section 2 -->
                    <div class="mb-12">
                        <h2 class="text-sm font-bold text-[#facc15] tracking-widest uppercase mb-6">02. Pitches Identity</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6" id="dynamic-fields-container">
                            <div>
                                <label class="block text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Startup Name</label>
                                <input type="text" placeholder="e.g. NextGrid Systems" class="w-full bg-[#0f1523] border border-transparent focus:border-[#4ade80] rounded px-4 py-3 text-white text-sm outline-none transition-colors">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Invested Amount (Owner Investment)</label>
                                <input type="text" placeholder="$ 5000000" class="w-full bg-[#0f1523] border border-transparent focus:border-[#4ade80] rounded px-4 py-3 text-white text-sm outline-none transition-colors">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Monthly Net Profit <span class="lowercase normal-case text-gray-500">(Total Revenue - Total Expenses)</span></label>
                                <input type="text" placeholder="$ 1000000" class="w-full bg-[#0f1523] border border-transparent focus:border-[#4ade80] rounded px-4 py-3 text-white text-sm outline-none transition-colors">
                            </div>
                            <div class="relative group">
                                <label class="block text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Monthly Growth</label>
                                <input type="text" placeholder="22%" class="w-full bg-[#0f1523] border border-transparent focus:border-[#4ade80] rounded px-4 py-3 text-white text-sm outline-none transition-colors pr-10">
                                <button type="button" onclick="this.parentElement.remove()" class="absolute right-3 top-[34px] bg-white rounded-sm">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Add custom field UI -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 items-start" id="add-field-section">
                            <!-- Add Button -->
                            <div id="add-field-btn" class="bg-[#0f1523] rounded flex items-center justify-center cursor-pointer hover:bg-white/5 transition-colors h-[72px]" onclick="document.getElementById('add-field-form').classList.remove('hidden')">
                                <div class="bg-white rounded-sm p-0.5 inline-flex">
                                    <svg class="w-6 h-6 text-[#1d4ed8]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                            
                            <!-- Add Form (hidden by default) -->
                            <div id="add-field-form" class="bg-[#1e2738] p-4 rounded-lg hidden border border-transparent">
                                <div class="flex items-center space-x-3 mb-3">
                                    <label class="text-[10px] text-white font-bold w-8">Title</label>
                                    <input type="text" id="new-field-title" class="flex-1 bg-[#0f1523] border border-transparent focus:border-[#4ade80] rounded px-3 py-1.5 text-white text-xs outline-none transition-colors">
                                </div>
                                <div class="flex items-center space-x-3 mb-4">
                                    <label class="text-[10px] text-white font-bold w-8">Field</label>
                                    <input type="text" id="new-field-value" class="flex-1 bg-[#0f1523] border border-transparent focus:border-[#4ade80] rounded px-3 py-1.5 text-white text-xs outline-none transition-colors">
                                </div>
                                <div class="flex justify-end space-x-2">
                                    <button type="button" onclick="document.getElementById('add-field-form').classList.add('hidden')" class="bg-red-600 hover:bg-red-700 text-white text-[10px] font-bold px-3 py-1.5 rounded transition-colors">Remove</button>
                                    <button type="button" onclick="addNewField()" class="bg-[#1d4ed8] hover:bg-blue-700 text-white text-[10px] font-bold px-4 py-1.5 rounded transition-colors">ADD</button>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Vision Statement</label>
                            <textarea rows="4" placeholder="Describe your long-term vision for the company and how it will impact the market." class="w-full bg-[#0f1523] border border-transparent focus:border-[#4ade80] rounded px-4 py-3 text-gray-400 text-sm outline-none transition-colors"></textarea>
                        </div>
                        <div>
                            <label class="block text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Additional details</label>
                            <textarea rows="4" placeholder="Provide any additional information about your pitch that you think investors should know." class="w-full bg-[#0f1523] border border-transparent focus:border-[#4ade80] rounded px-4 py-3 text-gray-400 text-sm outline-none transition-colors"></textarea>
                        </div>
                    </div>

                    <!-- Section 3 -->
                    <div class="mb-12">
                        <h2 class="text-sm font-bold text-[#facc15] tracking-widest uppercase mb-6">03. The Capital Architecture</h2>
                        
                        <div class="bg-[#1e2738] rounded-lg p-8 border border-white/5 shadow-xl">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Seeking Amount Requested</label>
                                        <input type="text" value="$ 5000000" class="w-full bg-[#0f1523] border border-transparent focus:border-[#4ade80] rounded px-4 py-3 text-white text-sm outline-none transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Return Time Period</label>
                                        <input type="text" value="2 years" class="w-full bg-[#0f1523] border border-transparent focus:border-[#4ade80] rounded px-4 py-3 text-white text-sm outline-none transition-colors">
                                    </div>
                                </div>
                                
                                <div class="bg-[#0f1523] rounded-lg p-6 border border-white/5 h-full flex flex-col justify-center">
                                    <label class="block text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">Total Valuation</label>
                                    <input type="text" value="$10000000" class="w-full bg-transparent border-none text-3xl font-bold text-[#4ade80] outline-none p-0 focus:ring-0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center mt-12">
                        <button type="button" class="bg-[#4ade80] hover:bg-[#4ade80]/90 text-[#064e3b] font-bold py-3 px-10 rounded transition-colors text-sm flex items-center space-x-2">
                            <span>Publish Pitch</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

</body>
<script>
    function addNewField() {
        const titleInput = document.getElementById('new-field-title');
        const valueInput = document.getElementById('new-field-value');
        const title = titleInput.value.trim();
        const value = valueInput.value.trim();
        
        if (!title) return;
        
        const container = document.getElementById('dynamic-fields-container');
        
        const fieldDiv = document.createElement('div');
        fieldDiv.className = 'relative group';
        
        fieldDiv.innerHTML = `
            <label class="block text-[9px] font-bold text-gray-500 tracking-widest uppercase mb-2">${title}</label>
            <input type="text" value="${value}" class="w-full bg-[#0f1523] border border-transparent focus:border-[#4ade80] rounded px-4 py-3 text-white text-sm outline-none transition-colors pr-10">
            <button type="button" onclick="this.parentElement.remove()" class="absolute right-3 top-[34px] bg-white rounded-sm">
                <svg class="w-5 h-5 text-[#1d4ed8]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
            </button>
        `;
        
        container.appendChild(fieldDiv);
        
        // Reset form
        titleInput.value = '';
        valueInput.value = '';
        document.getElementById('add-field-form').classList.add('hidden');
    }
</script>
</html>
