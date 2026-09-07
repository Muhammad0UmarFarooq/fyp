<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Investor Profile - {{ $user->name }}</title>
    
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

                <!-- Profile Header -->
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 bg-[#161e2d] border border-white/5 rounded-3xl p-6 sm:p-8 md:p-12 shadow-2xl relative overflow-hidden">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 sm:space-x-6 md:space-x-12 w-full md:w-auto">
                        <form action="{{ route('investor.profile.image') }}" method="POST" enctype="multipart/form-data" class="relative group cursor-pointer flex-shrink-0" id="profileImageForm">
                            @csrf
                            <div class="w-32 h-32 sm:w-40 sm:h-40 bg-[#0b1120] rounded-2xl flex items-center justify-center border-4 border-white/10 overflow-hidden shadow-2xl relative transition-colors duration-300" id="imagePreviewContainer">
                                @if($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="w-full h-full object-cover">
                                @else
                                    <span class="text-4xl sm:text-5xl font-extrabold text-brand-green">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                @endif
                                <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                            </div>
                            <input type="file" name="profile_image" id="profileImageInput" class="hidden" accept="image/*" onchange="document.getElementById('profileImageForm').submit()">
                        </form>

                        <div class="space-y-4 min-w-0">
                            <div class="flex items-center justify-center sm:justify-start space-x-4">
                                <span class="bg-[#1e293b] text-brand-green px-4 py-1.5 rounded text-[10px] font-bold tracking-widest uppercase">Verified Investor</span>
                            </div>
                            <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold text-center sm:text-left break-words">{{ $user->name }}</h1>
                            <div class="flex flex-col md:flex-row items-center md:items-start gap-2 md:space-x-12 text-sm text-gray-400 font-medium">
                                <div class="flex items-center">
                                    <span class="mr-2">📍</span> {{ $user->city ?? 'City Not Provided' }}
                                </div>
                                <div class="flex items-center break-all">
                                    <span class="mr-2">✉️</span> {{ $user->email }}
                                </div>
                                <div class="flex items-center">
                                    <span class="mr-2">📞</span> {{ $user->phone ?? 'Phone Not Provided' }}
                                </div>
                            </div>


                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-white/10">
                        <div class="bg-[#0b1120] px-4 py-3 rounded-xl border border-white/5">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Investment Amount</span>
                            <span class="text-base font-bold text-brand-green break-words">PKR {{ number_format($investorProfile->investment_amount ?? 0) }}</span>
                        </div>
                        <div class="bg-[#0b1120] px-4 py-3 rounded-xl border border-white/5">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Investment Focus</span>
                            <span class="text-sm font-bold text-white break-words">{{ $investorProfile->investment_focus ?? 'Not Specified' }}</span>
                        </div>
                        <div class="bg-[#0b1120] px-4 py-3 rounded-xl border border-white/5">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Portfolio Size</span>
                            <span class="text-sm font-bold text-white break-words">{{ $investorProfile->portfolio_size ?? 'Not Specified' }}</span>
                        </div>
                    </div>                        </div>
                    </div>

                    <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')" class="w-full sm:w-auto bg-brand-green text-[#064e3b] px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-[#3dbd6d] transition-colors flex items-center justify-center space-x-2 shadow-lg shadow-brand-green/20 cursor-pointer">
                        <span>✏️</span>
                        <span>Edit Profile</span>
                    </button>
                </div>

                <!-- Sections -->
                <div class="space-y-16">
                    <!-- Philosophy -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-px w-8 bg-brand-green"></div>
                            <h2 class="text-xl font-bold">Philosophy</h2>
                        </div>
                        <div class="bg-[#161e2d] border-l-4 border-brand-green p-6 sm:p-10 rounded-r-2xl shadow-xl">
                            <p class="text-gray-300 leading-loose text-base sm:text-lg italic font-light">
                                "{{ $user->bio ?? 'No investment philosophy or bio provided yet. Click Edit Profile to add your philosophy.' }}"
                            </p>
                        </div>
                    </div>

                    <!-- Focus Sectors -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-px w-8 bg-brand-green"></div>
                            <h2 class="text-xl font-bold">Focus Sectors</h2>
                        </div>
                        <div class="flex flex-wrap gap-4 items-center">
                            @if(!empty($investorProfile->interested_businesses) && is_array($investorProfile->interested_businesses))
                                @foreach($investorProfile->interested_businesses as $sector)
                                    <span class="bg-[#161e2d] text-brand-green px-8 py-3 rounded-lg font-bold text-xs tracking-widest border border-white/5 shadow-lg">{{ $sector }}</span>
                                @endforeach
                            @else
                                <span class="text-gray-500 text-sm italic">No focus sectors specified. Click Edit Profile to add sectors.</span>
                            @endif
                            <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')" class="bg-[#1e293b] text-gray-400 px-6 py-3 rounded-lg font-bold text-sm border border-white/5 hover:text-white transition-colors cursor-pointer">
                                + Add Sector
                            </button>
                        </div>
                    </div>

                    <!-- Current Portfolio -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-px w-8 bg-brand-green"></div>
                            <h2 class="text-xl font-bold">Current Portfolio</h2>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            @forelse($activeAgreements as $agreement)
                                <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-6 sm:p-8 shadow-xl hover:bg-[#1e293b] transition-all group relative overflow-hidden flex items-center space-x-6">
                                    <div class="bg-[#0b1120] w-14 h-14 sm:w-16 sm:h-16 rounded-2xl flex items-center justify-center text-brand-green font-bold text-xl sm:text-2xl shadow-inner group-hover:scale-110 transition-transform flex-shrink-0">
                                        @if($agreement->entrepreneur->profile_image)
                                            <img src="{{ asset('storage/' . $agreement->entrepreneur->profile_image) }}" class="w-full h-full object-cover rounded-2xl">
                                        @else
                                            {{ strtoupper(substr($agreement->pitch->startup_name ?? $agreement->pitch->company_name ?? $agreement->entrepreneur->name, 0, 2)) }}
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-lg sm:text-2xl font-bold mb-1 text-white break-words">{{ $agreement->pitch->startup_name ?? $agreement->pitch->company_name ?? $agreement->entrepreneur->company_name ?? 'Startup Venture' }}</h3>
                                        <div class="text-[10px] text-brand-green font-bold uppercase tracking-widest">Founder: {{ $agreement->entrepreneur->name }} • Active Venture</div>
                                        <p class="text-xs text-gray-400 mt-2 line-clamp-2">{{ $agreement->pitch->vision_statement ?? $agreement->pitch->additional_detail ?? 'Active investment agreement partner.' }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-1 lg:col-span-2 bg-[#161e2d]/30 border border-white/5 rounded-2xl p-8 text-center text-gray-500 font-medium">
                                    No active portfolio investments finalized yet. Check your agreements portal to complete pending agreements.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Signed Agreements -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-px w-8 bg-brand-green"></div>
                            <h2 class="text-xl font-bold">Signed Agreements Vault</h2>
                        </div>
                        <div class="space-y-4">
                            @forelse($activeAgreements as $agreement)
                                <a href="{{ route('investor.agreements.download', $agreement->id) }}" class="bg-[#161e2d] border border-white/5 rounded-2xl p-4 sm:p-6 flex flex-col sm:flex-row justify-between sm:items-center gap-4 group cursor-pointer hover:bg-[#1e293b] hover:border-brand-green/30 transition-all shadow-xl block">
                                    <div class="flex items-center space-x-4 min-w-0">
                                        <div class="bg-[#0b1120] p-3 rounded-xl text-brand-green group-hover:scale-110 transition-transform flex-shrink-0">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </div>
                                        <div class="min-w-0">
                                            <span class="font-bold text-gray-200 block text-base break-words">{{ $agreement->agreement_filename ?? 'Signed_Investment_Agreement.pdf' }}</span>
                                            <span class="text-xs text-gray-500">{{ $agreement->entrepreneur->name }} • Signed {{ \Carbon\Carbon::parse($agreement->agreement_date)->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4 flex-shrink-0">
                                        <span class="text-xs font-bold text-brand-green tracking-widest uppercase group-hover:underline">Download</span>
                                        <div class="bg-brand-green/20 p-2.5 rounded-lg group-hover:bg-brand-green group-hover:text-[#0b1120] text-brand-green transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="bg-[#161e2d]/30 border border-white/5 rounded-2xl p-8 text-center text-gray-500 font-medium">
                                    No signed agreements available.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity">
        <div class="bg-[#161e2d] border border-white/10 rounded-3xl max-w-3xl w-full p-4 sm:p-8 md:p-10 shadow-2xl space-y-8 relative">
            <div class="flex justify-between items-center border-b border-white/10 pb-6">
                <h3 class="text-xl sm:text-3xl font-bold text-white flex items-center space-x-3">
                    <span>⚙️</span>
                    <span class="break-words">Edit Profile Details</span>
                </h3>
                <button onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="text-gray-400 hover:text-white text-2xl font-bold">&times;</button>
            </div>

            <form action="{{ route('investor.profile.update') }}" method="POST" class="space-y-6">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-4 rounded-xl">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">City / Location</label>
                        <input type="text" name="city" value="{{ old('city', $user->city) }}" placeholder="e.g. Lahore (DHA)" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="e.g. 03123311111" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                    </div>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Focus Sectors (Comma separated)</label>
                    <input type="text" name="interested_businesses" value="{{ old('interested_businesses', is_array($investorProfile->interested_businesses) ? implode(', ', $investorProfile->interested_businesses) : '') }}" placeholder="Energy, Technology, E-Commerce, Fintech" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Investment Amount (PKR)</label>
                        <input type="number" name="investment_amount" value="{{ old('investment_amount', $investorProfile->investment_amount) }}" placeholder="e.g. 1200000" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Investment Focus</label>
                        <input type="text" name="investment_focus" value="{{ old('investment_focus', $investorProfile->investment_focus) }}" placeholder="e.g. Tech Startups" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Portfolio Size</label>
                        <input type="text" name="portfolio_size" value="{{ old('portfolio_size', $investorProfile->portfolio_size) }}" placeholder="e.g. 5 Companies, $500k+" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                    </div>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Investment Philosophy / Bio</label>
                    <textarea name="bio" rows="4" placeholder="Share your investment strategy, vision, and what kind of founders you seek..." class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">{{ old('bio', $user->bio) }}</textarea>
                </div>

                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 border-t border-white/10 pt-6">
                    <button type="button" onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest bg-gray-800 text-gray-300 hover:bg-gray-700 transition-colors">Cancel</button>
                    <button type="submit" class="w-full sm:w-auto bg-brand-green text-[#064e3b] px-10 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-[#3dbd6d] transition-colors shadow-lg shadow-brand-green/20 cursor-pointer">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

</body>
    <script>
        const imageForm = document.getElementById('profileImageForm');
        const imageInput = document.getElementById('profileImageInput');
        const previewContainer = document.getElementById('imagePreviewContainer');

        previewContainer.addEventListener('click', () => imageInput.click());

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            previewContainer.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            previewContainer.addEventListener(eventName, () => {
                previewContainer.classList.add('border-brand-green');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            previewContainer.addEventListener(eventName, () => {
                previewContainer.classList.remove('border-brand-green');
            }, false);
        });

        previewContainer.addEventListener('drop', (e) => {
            let dt = e.dataTransfer;
            let files = dt.files;
            
            if (files.length) {
                imageInput.files = files;
                imageForm.submit();
            }
        });
    </script>
</html>
