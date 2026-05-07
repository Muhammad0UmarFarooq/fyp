<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agreements Portal - InvestBridge</title>
    
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

    <x-navbar />

    <div class="flex">
        <x-sidebar />

        <main class="flex-1 p-12">
            <div class="max-w-4xl mx-auto space-y-16">
                
                <!-- Section 1: Agreement Signature Page -->
                <div class="space-y-8">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Agreement Signature Page</h1>
                        <h2 class="text-lg font-semibold text-gray-300">Ready To sign</h2>
                    </div>

                    <div class="space-y-4">
                        <!-- Sign Item 1 -->
                        <div class="bg-[#161e2d] border border-white/5 rounded-xl p-6 flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-full overflow-hidden border border-white/10">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover">
                                </div>
                                <span class="font-bold text-gray-200">Marcus Thorne</span>
                            </div>
                            <div class="flex space-x-4">
                                <button class="bg-red-600 text-white px-8 py-2 rounded font-bold text-xs">Reject</button>
                                <button class="bg-brand-green text-[#064e3b] px-8 py-2 rounded font-bold text-xs">Sign Agreement</button>
                            </div>
                        </div>

                        <!-- Sign Item 2 -->
                        <div class="bg-[#161e2d] border border-white/5 rounded-xl p-6 flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-full overflow-hidden border border-white/10">
                                    <img src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover">
                                </div>
                                <span class="font-bold text-gray-200">Saleem Gohr</span>
                            </div>
                            <div class="flex space-x-4">
                                <button class="bg-red-600 text-white px-8 py-2 rounded font-bold text-xs">Reject</button>
                                <button class="bg-brand-green text-[#064e3b] px-8 py-2 rounded font-bold text-xs">Sign Agreement</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Agreements Portal -->
                <div class="space-y-8">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Agreements Portal</h1>
                        <p class="text-gray-400 text-sm leading-relaxed">Finalize your deal by uploading and sending legal documents.</p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest block mb-4">UPLOAD SIGNED AGREEMENT</label>
                            <div class="border-2 border-dashed border-white/5 bg-[#111625] rounded-xl p-12 text-center cursor-pointer hover:border-brand-green/30 transition-colors group">
                                <div class="mb-4 flex justify-center">
                                    <div class="bg-white/5 p-4 rounded-xl group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                </div>
                                <p class="text-sm font-medium mb-1">Drag and drop your signed agreement here or <span class="text-brand-green underline">Browse files</span></p>
                                <p class="text-[10px] text-gray-500 uppercase font-bold">Supports PDF, DOCX (Max 25MB)</p>
                            </div>
                        </div>

                        <!-- Uploaded File -->
                        <div class="bg-[#161e2d] border-l-2 border-brand-green rounded-r-xl p-4 flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <div class="bg-[#0b1120] p-3 rounded-lg text-brand-green">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-200">Shoes_Shop_Series_A_Agreement.pdf</div>
                                    <div class="text-[10px] text-gray-500 font-bold uppercase">2.4 MB • Uploaded 2 mins ago</div>
                                </div>
                            </div>
                            <button class="text-[10px] font-bold text-gray-500 uppercase tracking-widest hover:text-red-500 transition-colors">
                                <span class="mr-1">🗑</span> REMOVE
                            </button>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest block mb-4">RECIPIENT INVESTOR</label>
                            <div class="bg-[#111625] rounded-xl p-4 flex items-center space-x-4 border border-white/5">
                                <div class="w-8 h-8 rounded-full overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover">
                                </div>
                                <span class="font-bold text-sm text-gray-300">Malik Riaz</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-8">
                            <button class="bg-red-600 text-white px-8 py-2.5 rounded font-bold text-xs tracking-widest uppercase">Cancel</button>
                            <button class="bg-brand-green text-[#064e3b] px-8 py-2.5 rounded font-bold text-xs tracking-widest uppercase flex items-center">
                                Send to Investor <span class="ml-2">▶</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
