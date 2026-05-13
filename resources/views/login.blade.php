<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvestBridge - Login</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#111625] text-white font-sans min-h-screen flex flex-col antialiased">

    <!-- Top Navigation -->
    <nav class="w-full px-8 py-8 flex justify-between items-center absolute top-0 left-0">
        <div class="text-xl font-bold tracking-tight">
            Invest<span class="text-brand-green">Bridge</span>
        </div>
        <a href="{{ route('home') }}" class="text-brand-green text-xs font-bold tracking-widest uppercase border-b border-brand-green pb-0.5 hover:text-brand-green/80 hover:border-brand-green/80 transition-colors">
            Back to Home
        </a>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-[#1e2738] rounded-md shadow-2xl overflow-hidden mt-16">
            <div class="px-8 py-10 md:px-12 md:py-12">
                <!-- Header -->
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-bold mb-2">Welcome To<br>InvestBridge</h1>
                    <p class="text-brand-muted text-[10px] font-bold tracking-[0.15em] uppercase">Access the Sovereign Vault</p>
                </div>

                <!-- Form -->
                <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="bg-red-500/10 border border-red-500/20 text-red-500 text-xs p-4 rounded-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-gray-400 tracking-widest uppercase">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@investbridge.com" class="w-full bg-[#111625] border border-transparent rounded-sm px-4 py-4 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-green focus:ring-1 focus:ring-brand-green transition-colors" autocomplete="off">
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-gray-400 tracking-widest uppercase">Password</label>
                        <input type="password" name="password" required placeholder="••••••••••••" class="w-full bg-[#111625] border border-transparent rounded-sm px-4 py-4 text-xl text-gray-200 placeholder-gray-500 tracking-[0.2em] focus:outline-none focus:border-brand-green focus:ring-1 focus:ring-brand-green transition-colors" autocomplete="off">
                    </div>

                    <!-- Options -->
                    <div class="flex items-center justify-between text-xs pt-1 pb-1">
                        <label class="flex items-center text-gray-400 cursor-pointer hover:text-gray-300">
                            <input type="checkbox" name="remember" class="form-checkbox h-3.5 w-3.5 bg-[#111625] border-transparent rounded-sm text-brand-green focus:ring-0 focus:ring-offset-0">
                            <span class="ml-2 font-medium">Remember Me</span>
                        </label>
                        <a href="#" class="text-brand-yellow font-medium hover:underline">Forgot Password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-brand-green text-[#064e3b] font-bold text-[13px] tracking-wide py-4 rounded-sm hover:bg-brand-green/90 transition-colors flex items-center justify-center space-x-2 mt-4">
                        <span>Login to Account</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    
                    <div class="text-center pt-6 space-y-2">
                        <p class="text-[13px] text-gray-400">
                            New Investor? <a href="{{ route('investor.register') }}" class="text-brand-yellow font-bold hover:underline">Register Here</a>
                        </p>
                        <p class="text-[13px] text-gray-400">
                            New Entrepreneur? <a href="{{ route('entrepreneur.register') }}" class="text-brand-yellow font-bold hover:underline">Register Here</a>
                        </p>
                    </div>
                </form>
            </div>
            
            <!-- Trust Badges -->
            <div class="bg-[#182030] px-10 py-6 border-t border-white/5 flex justify-between items-center text-[9px] text-gray-500 font-bold tracking-wider uppercase">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <span class="leading-tight">SSL<br>Secure</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <span>Encrypted</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="leading-tight">ISO<br>27001</span>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full pb-8 pt-4 px-4 text-center flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-8 text-[11px] text-gray-500 font-bold tracking-widest uppercase">
        <a href="#" class="hover:text-gray-300 transition-colors">Privacy Policy</a>
        <a href="#" class="hover:text-gray-300 transition-colors">Terms of Service</a>
        <a href="#" class="hover:text-gray-300 transition-colors">Security Protocol</a>
        <span class="md:ml-4">&copy; 2026 THE INVESTBRIDGE. SECURE VAULT ACCESS.</span>
    </footer>

</body>
</html>
