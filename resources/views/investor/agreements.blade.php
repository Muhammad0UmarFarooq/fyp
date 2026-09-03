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

        <main class="flex-1 p-4 md:p-12">
            <div class="max-w-8xl mx-auto space-y-16">
                
                @if(session('success'))
                    <div class="bg-brand-green/20 border border-brand-green/30 text-brand-green px-6 py-4 rounded-xl flex items-center space-x-4 shadow-lg">
                        <span>✅</span>
                        <p class="font-semibold text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-500/20 border border-red-500/30 text-red-400 px-6 py-4 rounded-xl flex items-center space-x-4 shadow-lg">
                        <span>❌</span>
                        <p class="font-semibold text-sm">{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Section 1: Agreement Signature Page -->
                <div class="space-y-8">
                    <div>
                        <h1 class="text-4xl font-bold mb-8">Agreement Signature Page</h1>
                        <h2 class="text-xl font-bold text-gray-200 mb-6">Pending For Sign</h2>
                    </div>

                    <div class="space-y-4">
                        @forelse($pendingSign as $agreement)
                            <div class="bg-[#161e2d] border border-white/5 rounded-xl p-6 flex justify-between items-center shadow-lg">
                                <div class="flex flex-wrap items-center gap-2 md:gap-4">
                                    <div class="w-12 h-12 rounded-lg overflow-hidden border border-white/10 bg-gray-800 flex items-center justify-center text-lg font-bold text-brand-green">
                                        @if($agreement->entrepreneur->profile_image)
                                            <img src="{{ asset('storage/' . $agreement->entrepreneur->profile_image) }}" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($agreement->entrepreneur->name, 0, 2)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <span class="font-bold text-gray-200 block">{{ $agreement->entrepreneur->name }}</span>
                                        <span class="text-xs text-gray-400">{{ $agreement->pitch->startup_name ?? $agreement->pitch->company_name ?? 'Startup' }}</span>
                                    </div>
                                </div>
                                
                                <form action="{{ route('investor.agreements.upload', $agreement->id) }}" method="POST" enctype="multipart/form-data" id="upload-form-{{ $agreement->id }}">
                                    @csrf
                                    <input type="file" name="agreement_file" id="file-{{ $agreement->id }}" class="hidden" accept=".pdf,.docx,.doc" onchange="document.getElementById('upload-form-{{ $agreement->id }}').submit()">
                                    <button type="button" onclick="document.getElementById('file-{{ $agreement->id }}').click()" class="bg-brand-green text-[#064e3b] px-10 py-3 rounded-lg font-bold text-xs tracking-widest uppercase hover:bg-[#3dbd6d] transition-colors cursor-pointer shadow-lg shadow-brand-green/10">
                                        Upload Agreement
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="bg-[#161e2d]/50 border border-white/5 rounded-xl p-8 text-center text-gray-500 font-medium">
                                No agreements pending your signature or upload.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Section 2: Rejected Agreements -->
                @if($rejected->isNotEmpty())
                    <div class="space-y-6">
                        <h2 class="text-xl font-bold text-gray-200">Rejected Agreements</h2>
                        <div class="space-y-4">
                            @foreach($rejected as $agreement)
                                <div class="bg-[#161e2d] border border-red-500/20 rounded-xl p-6 flex justify-between items-center shadow-lg">
                                    <div class="flex flex-wrap items-center gap-2 md:gap-4">
                                        <div class="w-12 h-12 rounded-lg overflow-hidden border border-red-500/30 bg-red-500/10 flex items-center justify-center text-lg font-bold text-red-500">
                                            @if($agreement->entrepreneur->profile_image)
                                                <img src="{{ asset('storage/' . $agreement->entrepreneur->profile_image) }}" class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($agreement->entrepreneur->name, 0, 2)) }}
                                            @endif
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-200 block">{{ $agreement->entrepreneur->name }}</span>
                                            <span class="text-xs text-red-400">Rejected: {{ $agreement->rejection_reason ?? 'No reason provided' }}</span>
                                        </div>
                                    </div>
                                    
                                    <form action="{{ route('investor.agreements.upload', $agreement->id) }}" method="POST" enctype="multipart/form-data" id="upload-form-{{ $agreement->id }}">
                                        @csrf
                                        <input type="file" name="agreement_file" id="file-{{ $agreement->id }}" class="hidden" accept=".pdf,.docx,.doc" onchange="document.getElementById('upload-form-{{ $agreement->id }}').submit()">
                                        <button type="button" onclick="document.getElementById('file-{{ $agreement->id }}').click()" class="bg-brand-green text-[#064e3b] px-10 py-3 rounded-lg font-bold text-xs tracking-widest uppercase hover:bg-[#3dbd6d] transition-colors cursor-pointer shadow-lg shadow-brand-green/10">
                                            Re-Sign & Upload
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <hr class="border-white/5">

                <!-- Section 3: Staged For Execution & Vault -->
                <div class="space-y-12">
                    <div>
                        <h2 class="text-4xl font-bold mb-4">Agreements Vault</h2>
                        <p class="text-gray-400 text-sm">Finalize and secure legal documentation for venture disbursement.</p>
                    </div>

                    @if($staged->isNotEmpty())
                        <div class="space-y-8">
                            <h3 class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Staged For Execution (Ready to Send)</h3>
                            
                            @foreach($staged as $agreement)
                                <div class="space-y-4">
                                    <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-4 md:p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 shadow-xl">
                                        <div class="flex flex-wrap items-center gap-2 md:gap-4">
                                            <div class="w-12 h-12 rounded-xl overflow-hidden border border-white/10 bg-gray-800 flex items-center justify-center font-bold text-brand-green">
                                                @if($agreement->entrepreneur->profile_image)
                                                    <img src="{{ asset('storage/' . $agreement->entrepreneur->profile_image) }}" class="w-full h-full object-cover">
                                                @else
                                                    {{ strtoupper(substr($agreement->entrepreneur->name, 0, 2)) }}
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-[10px] text-brand-green font-bold uppercase tracking-widest mb-1">Founder / CEO</div>
                                                <div class="text-lg font-bold">{{ $agreement->entrepreneur->name }}</div>
                                                <div class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">{{ $agreement->pitch->startup_name ?? $agreement->pitch->company_name ?? 'Startup' }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-8 space-y-8 shadow-2xl">
                                        <div class="flex justify-between items-center">
                                            <div class="flex flex-wrap items-center gap-2 md:gap-4">
                                                <div class="bg-red-500/10 p-3 rounded-lg text-red-500">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-gray-200">{{ $agreement->agreement_filename ?? 'Signed_Agreement.pdf' }}</div>
                                                    <div class="text-[10px] text-gray-500 font-bold mt-1">{{ $agreement->agreement_filesize ?? '1.4 MB' }} • Uploaded {{ $agreement->updated_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                            <form action="{{ route('investor.agreements.remove', $agreement->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-red-500 text-[10px] font-bold tracking-widest uppercase hover:underline cursor-pointer">Remove</button>
                                            </form>
                                        </div>

                                        <div class="flex space-x-4">
                                            <form action="{{ route('investor.agreements.remove', $agreement->id) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" class="w-full bg-red-600/20 border border-red-500/30 text-red-400 font-bold text-xs tracking-widest uppercase py-4 rounded-xl shadow-lg hover:bg-red-600 hover:text-white transition-colors cursor-pointer">Cancel</button>
                                            </form>
                                            <form action="{{ route('investor.agreements.send', $agreement->id) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" class="w-full bg-brand-green text-[#064e3b] font-bold text-xs tracking-widest uppercase py-4 rounded-xl shadow-lg shadow-brand-green/10 hover:bg-[#3dbd6d] transition-all flex items-center justify-center space-x-2 group cursor-pointer">
                                                    <span>Send to Entrepreneur</span>
                                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Active/Completed Agreements in Vault -->
                    <div class="space-y-6 pt-6">
                        <h3 class="text-[10px] font-bold text-gray-500 tracking-[0.2em] uppercase">Active & Finalized Agreements</h3>
                        
                        <div class="space-y-4">
                            @forelse($vault as $agreement)
                                <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-4 md:p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 shadow-xl hover:border-brand-green/30 transition-colors">
                                    <div class="flex flex-wrap items-center gap-2 md:gap-4">
                                        <div class="w-12 h-12 rounded-xl overflow-hidden border border-white/10 bg-gray-800 flex items-center justify-center font-bold text-brand-green">
                                            @if($agreement->entrepreneur->profile_image)
                                                <img src="{{ asset('storage/' . $agreement->entrepreneur->profile_image) }}" class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($agreement->entrepreneur->name, 0, 2)) }}
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-lg font-bold">{{ $agreement->entrepreneur->name }}</div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase">{{ $agreement->pitch->startup_name ?? $agreement->pitch->company_name ?? 'Startup' }} • Signed {{ \Carbon\Carbon::parse($agreement->agreement_date)->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-2 md:gap-4">
                                        <span class="bg-brand-green/10 text-brand-green px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider">Active</span>
                                        <a href="{{ route('investor.agreements.download', $agreement->id) }}" class="bg-[#1e293b] text-brand-green hover:bg-brand-green hover:text-[#064e3b] px-6 py-2.5 rounded-lg font-bold text-xs tracking-widest uppercase transition-all flex items-center space-x-2 shadow-lg">
                                            <span>📥</span>
                                            <span>My Contract</span>
                                        </a>
                                        @if($agreement->entrepreneur_file)
                                            <a href="{{ route('investor.agreements.download.entrepreneur', $agreement->id) }}" class="bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-[#0b1120] px-6 py-2.5 rounded-lg font-bold text-xs tracking-widest uppercase transition-all flex items-center space-x-2 shadow-lg">
                                                <span>📥</span>
                                                <span>Signed / Invoice</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="bg-[#161e2d]/30 border border-white/5 rounded-2xl p-8 text-center text-gray-500 font-medium">
                                    No active or finalized agreements in your vault yet.
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

</body>
</html>
