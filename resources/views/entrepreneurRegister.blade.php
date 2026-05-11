<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvestBridge - Entrepreneur Registration</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brand-dark text-white font-sans min-h-screen flex flex-col items-center justify-center p-4 md:p-8 antialiased">

    <div class="w-full max-w-4xl flex flex-col items-center mt-8 mb-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-3">INVESTBRIDGE ENTREPRENEUR</h1>
            <p class="text-brand-muted text-xs font-semibold tracking-widest uppercase">Secure Access Registration</p>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white text-gray-900 shadow-2xl">
            <div class="p-8 md:p-14">
                <form action="{{ route('entrepreneur.register.post') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        
                        <!-- Full Legal Name -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Full Legal Name</label>
                            <input type="text" name="name" placeholder="Johnathan Doe" class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-brand-green" required>
                        </div>

                        <!-- Professional Email -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Professional Email</label>
                            <input type="email" name="email" placeholder="name@firm.com" class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-brand-green" autocomplete="off" required>
                        </div>

                        <!-- CNIC -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">CNIC (13-Digit Format)</label>
                            <input type="text" name="cnic" placeholder="XXXXX-XXXXXXX-X" class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-brand-green" required>
                        </div>

                        <!-- Phone No -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Phone No (+92)</label>
                            <input type="text" name="phone" placeholder="+92 - " class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-brand-green" required>
                        </div>

                        <!-- City -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">City</label>
                            <div class="relative">
                                <select name="city" class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-500 appearance-none focus:outline-none focus:ring-1 focus:ring-brand-green" required>
                                    <option value="" disabled selected>Select Territory</option>
                                    <option value="karachi">Karachi</option>
                                    <option value="lahore">Lahore</option>
                                    <option value="islamabad">Islamabad</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Business -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Business</label>
                            <input type="text" name="company_name" placeholder="Shoes Shop" class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-brand-green" required>
                        </div>

                        <!-- Total Valuation -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Total Valuation</label>
                            <input type="number" name="total_valuation" placeholder="e.g. 5000000" class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-brand-green" required>
                        </div>

                        <!-- Future Valuation -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Future Valuation</label>
                            <input type="number" name="future_valuation" placeholder="i.e 100 00000" class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-brand-green" required>
                        </div>

                        <!-- Secure Password -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Secure Password</label>
                            <input type="password" name="password" placeholder="••••••••••••" class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-xl text-gray-800 placeholder-gray-300 tracking-[0.2em] focus:outline-none focus:ring-1 focus:ring-brand-green" autocomplete="new-password" required>
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Confirm Password</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••••••" class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-xl text-gray-800 placeholder-gray-300 tracking-[0.2em] focus:outline-none focus:ring-1 focus:ring-brand-green" autocomplete="new-password" required>
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="pt-10 flex flex-col items-center space-y-8">
                        <button type="submit" class="w-full md:w-[60%] bg-brand-btn text-brand-green font-bold text-[11px] tracking-[0.15em] uppercase py-4 hover:bg-[#1a2336] transition-colors flex items-center justify-center space-x-2">
                            <span>Register Account</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                        
                        <a href="{{ route('pitch.arena') }}" class="text-[#a0aec0] text-[11px] font-bold tracking-[0.15em] uppercase hover:text-brand-dark transition-colors">
                            Skip For Now
                        </a>

                        <p class="text-xs text-gray-400 font-medium pb-2">
                            Already have an account? <a href="{{ route('entrepreneur.login') }}" class="font-bold text-gray-900 underline underline-offset-2 hover:text-brand-dark">Log In</a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>
</html>
