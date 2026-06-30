<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - Naeem Azhar</title>
    
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

                @if(session('success'))
                    <div class="bg-brand-green/20 border border-brand-green/30 text-brand-green px-6 py-4 rounded-xl flex items-center space-x-4 shadow-lg mb-8">
                        <span>✅</span>
                        <p class="font-semibold text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-500/20 border border-red-500/30 text-red-400 px-6 py-4 rounded-xl flex items-center space-x-4 shadow-lg mb-8">
                        <span>❌</span>
                        <p class="font-semibold text-sm">{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Profile Header -->
                <div class="flex items-center justify-between bg-[#161e2d] border border-white/5 rounded-3xl p-12 shadow-2xl relative overflow-hidden mb-16">
                    <div class="flex items-center space-x-12">
                        <form action="{{ route('entrepreneur.profile.image') }}" method="POST" enctype="multipart/form-data" class="relative group cursor-pointer" id="profileImageForm">
                            @csrf
                            <div class="w-40 h-40 bg-[#0b1120] rounded-2xl flex items-center justify-center border-4 border-white/10 overflow-hidden shadow-2xl relative transition-colors duration-300" id="imagePreviewContainer">
                                @if(auth()->user()->profile_image)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile Image" class="w-full h-full object-cover">
                                @else
                                    <span class="text-5xl font-extrabold text-brand-green">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                                @endif
                                <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                            </div>
                            <input type="file" name="profile_image" id="profileImageInput" class="hidden" accept="image/*" onchange="document.getElementById('profileImageForm').submit()">
                        </form>

                        <div class="space-y-4">
                            <span class="bg-[#1e293b] text-brand-green px-4 py-1.5 rounded text-[10px] font-bold tracking-widest uppercase">Verified Entrepreneur</span>
                            <h1 class="text-6xl font-bold">{{ auth()->user()->name }}</h1>
                            <div class="flex items-center space-x-12 text-sm text-gray-400 font-medium">
                                <div class="flex items-center">
                                    <span class="mr-2">📍</span> {{ auth()->user()->city ?? 'City Not Provided' }}
                                </div>
                                <div class="flex items-center">
                                    <span class="mr-2">✉️</span> {{ auth()->user()->email }}
                                </div>
                                <div class="flex items-center">
                                    <span class="mr-2">📞</span> {{ auth()->user()->phone ?? 'Phone Not Provided' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')" class="bg-brand-green text-[#064e3b] px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-[#3dbd6d] transition-colors flex items-center space-x-2 shadow-lg shadow-brand-green/20 cursor-pointer">
                        <span>✏️</span>
                        <span>Edit Profile</span>
                    </button>
                </div>

                <!-- Sections -->
                <div class="space-y-16">
                    <!-- Operational Vision -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-px w-8 bg-brand-green"></div>
                            <h2 class="text-xl font-bold">Operational Vision</h2>
                        </div>
                        <div class="bg-[#161e2d] border-l-4 border-brand-green p-8 rounded-r-2xl shadow-xl">
                            <p class="text-gray-300 leading-loose text-lg italic font-light">
                                "{{ auth()->user()->bio ?? 'No operational vision or bio provided yet. Click Edit Profile to add one.' }}"
                            </p>
                        </div>
                    </div>

                    <!-- Active Venture -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-px w-8 bg-brand-green"></div>
                            <h2 class="text-xl font-bold">Active Venture</h2>
                        </div>
                        
                        @if(auth()->user()->entrepreneurProfile && auth()->user()->entrepreneurProfile->company_name)
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Startup Profile Card -->
                                <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
                                    <div>
                                        <div class="flex justify-between items-start mb-6">
                                            <div class="bg-[#1e293b] p-3 rounded-xl text-brand-green">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                            </div>
                                            @if(auth()->user()->entrepreneurProfile->website)
                                                <a href="{{ auth()->user()->entrepreneurProfile->website }}" target="_blank" class="text-xs text-brand-green hover:underline flex items-center space-x-1">
                                                    <span>🌐</span>
                                                    <span>Visit Site</span>
                                                </a>
                                            @endif
                                        </div>
                                        <h3 class="text-2xl font-bold mb-2">{{ auth()->user()->entrepreneurProfile->company_name }}</h3>
                                        <p class="text-sm text-brand-green font-medium mb-4">{{ auth()->user()->entrepreneurProfile->industry ?? 'Industry Not Specified' }}</p>
                                    </div>
                                    <div class="border-t border-white/5 pt-4 mt-4 flex justify-between items-center text-xs text-gray-500">
                                        <span>Experience</span>
                                        <span class="font-bold text-gray-300">{{ auth()->user()->entrepreneurProfile->experience_years ?? 0 }} Years</span>
                                    </div>
                                </div>

                                <!-- Financial Matrix Cards -->
                                <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-6 shadow-xl flex flex-col justify-center space-y-4">
                                    <div class="text-xs text-gray-500 uppercase tracking-widest font-bold">Current Valuation</div>
                                    <div class="text-4xl font-extrabold text-white">
                                        {{ auth()->user()->entrepreneurProfile->total_valuation ? 'PKR ' . number_format(auth()->user()->entrepreneurProfile->total_valuation) : 'Not Disclosed' }}
                                    </div>
                                </div>

                                <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-6 shadow-xl flex flex-col justify-center space-y-4">
                                    <div class="text-xs text-gray-500 uppercase tracking-widest font-bold">Targeted / Future Valuation</div>
                                    <div class="text-4xl font-extrabold text-brand-green">
                                        {{ auth()->user()->entrepreneurProfile->future_valuation ? 'PKR ' . number_format(auth()->user()->entrepreneurProfile->future_valuation) : 'Not Disclosed' }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-[#161e2d]/30 border border-white/5 rounded-2xl p-8 text-center text-gray-500 font-medium">
                                No active venture details registered yet. Click Edit Profile to set up your startup details.
                            </div>
                        @endif
                    </div>

                    <!-- Signed Agreements Vault -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-px w-8 bg-brand-green"></div>
                            <h2 class="text-xl font-bold">Signed Agreements Vault</h2>
                        </div>
                        <div class="space-y-4">
                            @forelse($activeAgreements as $agreement)
                                <div class="bg-[#161e2d] border border-white/5 rounded-2xl p-6 flex justify-between items-center shadow-xl">
                                    <div class="flex items-center space-x-4">
                                        <div class="bg-[#0b1120] p-3 rounded-xl text-brand-green">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-200 block text-base">{{ $agreement->agreement_filename ?? 'Signed_Agreement.pdf' }}</span>
                                            <span class="text-xs text-gray-500">Investor: {{ $agreement->investor->name }} • Signed on {{ \Carbon\Carbon::parse($agreement->agreement_date)->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('entrepreneur.agreements.download', $agreement->id) }}" class="bg-[#1e293b] text-brand-green hover:bg-brand-green hover:text-[#064e3b] px-4 py-2 rounded-lg font-bold text-xs uppercase transition-colors flex items-center space-x-2">
                                            <span>📥</span>
                                            <span>Contract</span>
                                        </a>
                                        @if($agreement->entrepreneur_file)
                                            <a href="{{ route('entrepreneur.agreements.download.entrepreneur', $agreement->id) }}" class="bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-[#0b1120] px-4 py-2 rounded-lg font-bold text-xs uppercase transition-colors flex items-center space-x-2">
                                                <span>📥</span>
                                                <span>Signed/Invoice</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="bg-[#161e2d]/30 border border-white/5 rounded-2xl p-8 text-center text-gray-500 font-medium">
                                    No signed agreements yet. Once an agreement is finalized, it will appear here.
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
        <div class="bg-[#161e2d] border border-white/10 rounded-3xl max-w-4xl w-full p-10 shadow-2xl space-y-8 relative">
            <div class="flex justify-between items-center border-b border-white/10 pb-6">
                <h3 class="text-3xl font-bold text-white flex items-center space-x-3">
                    <span>⚙️</span>
                    <span>Edit Profile Details</span>
                </h3>
                <button onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="text-gray-400 hover:text-white text-2xl font-bold cursor-pointer">&times;</button>
            </div>

            <form action="{{ route('entrepreneur.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Personal Info -->
                <div>
                    <h4 class="text-sm font-bold text-brand-green uppercase tracking-widest mb-4">Personal Details</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" required class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">City / Location</label>
                            <input type="text" name="city" value="{{ auth()->user()->city }}" placeholder="e.g. Islamabad" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Phone Number</label>
                            <input type="text" name="phone" value="{{ auth()->user()->phone }}" placeholder="e.g. +923001234567" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                        </div>
                    </div>
                </div>

                <!-- Venture Info -->
                <div class="border-t border-white/5 pt-6">
                    <h4 class="text-sm font-bold text-brand-green uppercase tracking-widest mb-4">Venture & Company Details</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Company Name</label>
                            <input type="text" name="company_name" value="{{ auth()->user()->entrepreneurProfile->company_name ?? '' }}" placeholder="e.g. Acme Corp" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Industry / Sector</label>
                            <input type="text" name="industry" value="{{ auth()->user()->entrepreneurProfile->industry ?? '' }}" placeholder="e.g. Fintech" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Website URL</label>
                            <input type="text" name="website" value="{{ auth()->user()->entrepreneurProfile->website ?? '' }}" placeholder="e.g. https://example.com" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Experience (Years)</label>
                        <input type="number" name="experience_years" value="{{ auth()->user()->entrepreneurProfile->experience_years ?? '' }}" placeholder="e.g. 5" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Current Valuation (PKR)</label>
                        <input type="number" name="total_valuation" value="{{ auth()->user()->entrepreneurProfile->total_valuation ?? '' }}" placeholder="e.g. 500000" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Future Valuation Target (PKR)</label>
                        <input type="number" name="future_valuation" value="{{ auth()->user()->entrepreneurProfile->future_valuation ?? '' }}" placeholder="e.g. 2000000" class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">
                    </div>
                </div>

                <!-- Bio / Vision -->
                <div class="border-t border-white/5 pt-6">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Operational Vision / Bio</label>
                    <textarea name="bio" rows="4" placeholder="Describe your operational philosophy, milestones, and venture roadmap..." class="w-full bg-[#0b1120] border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-brand-green">{{ auth()->user()->bio }}</textarea>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 border-t border-white/10 pt-6">
                    <button type="button" onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest bg-gray-800 text-gray-300 hover:bg-gray-700 transition-colors cursor-pointer">Cancel</button>
                    <button type="submit" class="bg-brand-green text-[#064e3b] px-10 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-[#3dbd6d] transition-colors shadow-lg shadow-brand-green/20 cursor-pointer">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

</body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Prevent entering 'e', 'E', '+', '-' in number fields
            const numberInputs = document.querySelectorAll('input[type="number"]');
            numberInputs.forEach(input => {
                input.addEventListener('keydown', function(e) {
                    if (['e', 'E', '+', '-'].includes(e.key)) {
                        e.preventDefault();
                    }
                });
                input.addEventListener('paste', function(e) {
                    const clipboardData = e.clipboardData || window.clipboardData;
                    const pastedData = clipboardData.getData('text');
                    if (/[eE\+\-]/.test(pastedData)) {
                        e.preventDefault();
                    }
                });
            });
        });

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
