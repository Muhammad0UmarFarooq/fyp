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

    <x-navbar />

    <div class="flex">
        <x-sidebar />

        <main class="flex-1 p-12">
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
                        <h1 class="text-4xl font-bold mb-2">Agreement Signature Page</h1>
                        <h2 class="text-xl font-semibold text-gray-300">Ready To Sign</h2>
                    </div>

                    <div class="space-y-6">
                        @forelse($readyToSign as $agreement)
                            <div class="bg-[#161e2d] border border-white/5 rounded-xl p-6 shadow-xl space-y-6">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 rounded-lg overflow-hidden border border-white/10 bg-gray-800 flex items-center justify-center font-bold text-lg text-brand-green">
                                            @if($agreement->investor->profile_image)
                                                <img src="{{ asset('storage/' . $agreement->investor->profile_image) }}" class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($agreement->investor->name, 0, 2)) }}
                                            @endif
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-200 text-lg block">{{ $agreement->investor->name }}</span>
                                            <span class="text-xs text-gray-400">{{ $agreement->agreement_filename ?? 'Agreement Document' }} • {{ $agreement->agreement_filesize ?? '' }}</span>
                                        </div>
                                    </div>
                                    <div class="flex space-x-4 items-center">
                                        <button onclick="document.getElementById('reject-box-{{ $agreement->id }}').classList.toggle('hidden')" class="bg-red-600/20 border border-red-500/30 text-red-400 px-6 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-red-600 hover:text-white transition-colors cursor-pointer shadow-lg">Reject</button>
                                        <a href="{{ route('entrepreneur.agreements.download', $agreement->id) }}" class="bg-[#1e293b] text-brand-green px-6 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-brand-green hover:text-[#064e3b] transition-colors flex items-center space-x-2 shadow-lg">
                                            <span>📥</span>
                                            <span>Download Contract</span>
                                        </a>
                                        <form action="{{ route('entrepreneur.agreements.sign', $agreement->id) }}" method="POST" enctype="multipart/form-data" id="sign-form-{{ $agreement->id }}">
                                            @csrf
                                            <input type="file" name="signed_file" id="signed-file-{{ $agreement->id }}" class="hidden" accept=".pdf,.docx,.doc" onchange="document.getElementById('sign-form-{{ $agreement->id }}').submit()">
                                            <button type="button" onclick="document.getElementById('signed-file-{{ $agreement->id }}').click()" class="bg-brand-green text-[#064e3b] px-6 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-[#3dbd6d] transition-all cursor-pointer shadow-lg shadow-brand-green/10">
                                                Upload Signed PDF / Invoice
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Collapsible Reject Form -->
                                <div id="reject-box-{{ $agreement->id }}" class="hidden bg-[#0b1120] border border-red-500/30 rounded-xl p-6 mt-4 transition-all">
                                    <form action="{{ route('entrepreneur.agreements.reject', $agreement->id) }}" method="POST" class="space-y-4">
                                        @csrf
                                        <label class="text-xs font-bold text-red-400 uppercase tracking-widest block">Reason for Rejection</label>
                                        <textarea name="rejection_reason" required rows="3" placeholder="Explain why you are rejecting this agreement (e.g. valuation terms, time period)..." class="w-full bg-[#161e2d] border border-white/10 rounded-lg p-4 text-sm text-gray-200 focus:outline-none focus:border-red-500 transition-colors"></textarea>
                                        <div class="flex justify-end space-x-4">
                                            <button type="button" onclick="document.getElementById('reject-box-{{ $agreement->id }}').classList.add('hidden')" class="px-6 py-2 rounded-lg text-xs font-bold text-gray-400 hover:text-white transition-colors">Cancel</button>
                                            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg text-xs font-bold uppercase tracking-wider hover:bg-red-700 transition-colors cursor-pointer shadow-lg">Submit Rejection</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="bg-[#161e2d]/50 border border-white/5 rounded-xl p-8 text-center text-gray-500 font-medium">
                                No new agreement documents received from investors.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Section 2: Active Agreements Portal -->
                <div class="space-y-8">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">Agreements Portal</h1>
                        <p class="text-gray-400 text-sm leading-relaxed">Active and finalized legal agreements.</p>
                    </div>

                    <div class="space-y-4">
                        @forelse($active as $agreement)
                            <div class="bg-[#161e2d] border border-brand-green/30 rounded-xl p-6 flex justify-between items-center shadow-xl">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-[#0b1120] p-3 rounded-lg text-brand-green">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray-200">{{ $agreement->agreement_filename ?? 'Signed_Agreement.pdf' }}</div>
                                        <div class="text-[10px] text-gray-500 font-bold uppercase">Investor: {{ $agreement->investor->name }} • Signed on {{ \Carbon\Carbon::parse($agreement->agreement_date)->format('M d, Y') }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="bg-brand-green/10 text-brand-green px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider">Active</span>
                                    <a href="{{ route('entrepreneur.agreements.download', $agreement->id) }}" class="bg-[#1e293b] text-brand-green hover:bg-brand-green hover:text-[#064e3b] px-6 py-2.5 rounded-lg font-bold text-xs tracking-widest uppercase transition-all flex items-center space-x-2 shadow-lg">
                                        <span>📥</span>
                                        <span>Investor Contract</span>
                                    </a>
                                    @if($agreement->entrepreneur_file)
                                        <a href="{{ route('entrepreneur.agreements.download.entrepreneur', $agreement->id) }}" class="bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-[#0b1120] px-6 py-2.5 rounded-lg font-bold text-xs tracking-widest uppercase transition-all flex items-center space-x-2 shadow-lg">
                                            <span>📥</span>
                                            <span>Signed / Invoice</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="bg-[#161e2d]/30 border border-white/5 rounded-xl p-8 text-center text-gray-500 font-medium">
                                No finalized agreements yet.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Section 3: Rejected Agreements History -->
                @if($rejected->isNotEmpty())
                    <div class="space-y-6 pt-6">
                        <h2 class="text-xl font-bold text-gray-400">Rejected Agreements History</h2>
                        <div class="space-y-4">
                            @foreach($rejected as $agreement)
                                <div class="bg-[#161e2d]/50 border border-red-500/20 rounded-xl p-6 flex justify-between items-center opacity-80">
                                    <div class="flex items-center space-x-4">
                                        <div class="bg-red-500/10 p-3 rounded-lg text-red-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-300">Investor: {{ $agreement->investor->name }}</div>
                                            <div class="text-[10px] text-red-400 font-semibold mt-1">Reason: {{ $agreement->rejection_reason }}</div>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-gray-500 uppercase">Rejected {{ $agreement->updated_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </main>
    </div>

</body>
</html>
