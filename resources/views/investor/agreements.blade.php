<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agreements Portal - InvestBridge</title>
    
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
            <div class="max-w-8xl mx-auto space-y-16">
                
                <!-- Section 1: Agreement Signature Page -->
                <div class="space-y-8">
                    <div>
                        <h1 class="text-4xl font-bold mb-8">Agreement Signature page</h1>
                        <h2 class="text-xl font-bold text-gray-200 mb-6">Pending For Sign</h2>
                    </div>

                    <div class="space-y-4">
                        <!-- Sign Item 1 -->
                        <div class="bg-[#161e2d] border border-white/5 rounded-xl p-6 flex justify-between items-center shadow-lg">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-lg overflow-hidden border border-white/10 bg-gray-800 flex items-center justify-center">
                                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover">
                                </div>
                                <span class="font-bold text-gray-200">Azeem Aslam</span>
                            </div>
                            <button class="bg-brand-green text-[#064e3b] px-10 py-3 rounded-lg font-bold text-xs tracking-widest uppercase hover:bg-[#3dbd6d] transition-colors">Sign Agreement</button>
                        </div>

                        <!-- Sign Item 2 -->
                        <div class="bg-[#161e2d] border border-white/5 rounded-xl p-6 flex justify-between items-center shadow-lg">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-lg overflow-hidden border border-white/10 bg-gray-800 flex items-center justify-center">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover">
                                </div>
                                <span class="font-bold text-gray-200">Hamza Ayub</span>
                            </div>
                            <button class="bg-brand-green text-[#064e3b] px-10 py-3 rounded-lg font-bold text-xs tracking-widest uppercase hover:bg-[#3dbd6d] transition-colors">Sign Agreement</button>
                        </div>

                        <!-- Sign Item 3 -->
                        <div class="bg-[#161e2d] border border-white/5 rounded-xl p-6 flex justify-between items-center shadow-lg">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-lg overflow-hidden border border-white/10 bg-gray-800 flex items-center justify-center text-xs font-bold text-gray-500">
                                    AS
                                </div>
                                <span class="font-bold text-gray-200">Abdus Salam</span>
                            </div>
                            <button class="bg-brand-green text-[#064e3b] px-10 py-3 rounded-lg font-bold text-xs tracking-widest uppercase hover:bg-[#3dbd6d] transition-colors">Sign Agreement</button>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Rejected Agreements -->
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-gray-200">Rejected Agreements</h2>
                    <div class="bg-[#161e2d] border border-white/5 rounded-xl p-6 flex justify-between items-center shadow-lg opacity-80">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-lg overflow-hidden border border-white/10 bg-gray-800 flex items-center justify-center text-xs font-bold text-gray-500">
                                AS
                            </div>
                            <span class="font-bold text-gray-200">Azhar Saleem</span>
                        </div>
                        <button class="bg-brand-green text-[#064e3b] px-10 py-3 rounded-lg font-bold text-xs tracking-widest uppercase hover:bg-[#3dbd6d] transition-colors">Re-Sign Agreements</button>
                    </div>
                </div>

                <hr class="border-white/5">

                <!-- Section 3: Agreements Vault -->
                <div class="space-y-12">
                    <div>
                        <h2 class="text-4xl font-bold mb-4">Agreements Vault</h2>
                        <p class="text-gray-400 text-sm">Finalize and secure legal documentation for venture disbursement.</p>
                    </div>

                    <!-- Upload Area -->
                    <div class="border-2 border-dashed border-white/5 bg-[#161e2d]/30 rounded-3xl p-16 flex flex-col items-center text-center space-y-6 group hover:bg-[#161e2d]/50 transition-colors cursor-pointer">
                        <div class="bg-white/5 p-4 rounded-xl text-brand-green group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-xl font-bold text-white">Upload Signed Agreement</h3>
                            <p class="text-gray-500 text-sm max-w-xs mx-auto">Drop PDF or DOCX files here to encrypt and stage for partner signature.</p>
                        </div>
                        <div class="flex space-x-4">
                            <span class="bg-[#0b1120] px-4 py-1.5 rounded text-[10px] font-bold text-gray-500 tracking-widest uppercase">Max Size 25MB</span>
                            <span class="bg-[#0b1120] px-4 py-1.5 rounded text-[10px] font-bold text-gray-500 tracking-widest uppercase">AES-256 Encrypted</span>
                        </div>
                    </div>

                    <!-- Staged for Execution -->
                    <div class="space-y-8">
                        <h3 class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Staged For Execution</h3>
                        
                        <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-6 flex justify-between items-center shadow-xl">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-xl overflow-hidden border border-white/10">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <div class="text-[10px] text-brand-green font-bold uppercase tracking-widest mb-1">Founder / CEO</div>
                                    <div class="text-lg font-bold">Naeem Azhar</div>
                                    <div class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">Shoes Shop</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-8 space-y-8 shadow-2xl">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-red-500/10 p-3 rounded-lg text-red-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray-200">Shoes_Shop_Series_A_Agreement.pdf</div>
                                        <div class="text-[10px] text-gray-500 font-bold mt-1">1.4 MB • Uploaded 2 mins ago</div>
                                    </div>
                                </div>
                                <button class="text-red-500 text-[10px] font-bold tracking-widest uppercase hover:underline">Remove</button>
                            </div>

                            <div class="flex space-x-4">
                                <button class="flex-1 bg-red-600 text-white font-bold text-xs tracking-widest uppercase py-4 rounded-xl shadow-lg shadow-red-600/10 hover:bg-red-700 transition-colors">Cancel</button>
                                <button class="flex-1 bg-brand-green text-[#064e3b] font-bold text-xs tracking-widest uppercase py-4 rounded-xl shadow-lg shadow-brand-green/10 hover:bg-[#3dbd6d] transition-all flex items-center justify-center space-x-2 group">
                                    <span>Send to Entrepreneur</span>
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
