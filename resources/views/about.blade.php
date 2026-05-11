<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvestBridge - About</title>
    
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
<body class="bg-[#111625] text-white font-sans min-h-screen antialiased">

    <!-- Top Navigation -->
    <nav class="w-full px-8 py-5 flex justify-between items-center border-b border-white/5">
        <div class="flex items-center space-x-2">
            <div class="leading-none">
                <div class="text-xl font-bold tracking-tight">
                    Invest<span class="text-brand-green">Bridge</span>
                </div>
                <div class="text-[8px] font-bold tracking-widest uppercase text-gray-500 mt-1">
                    Entrepreneur/Investor
                </div>
            </div>
        </div>
        
        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ route('pitch.arena') }}" class="text-gray-400 hover:text-gray-300 text-sm font-bold pb-1 transition-colors">
                Home
            </a>
            <a href="{{ route('about') }}" class="text-brand-green text-sm font-bold border-b-2 border-brand-green pb-1">
                About
            </a>
        </div>

        <div>
            <a href="{{ route('home') }}" class="bg-brand-green text-[#064e3b] px-6 py-2 rounded font-bold text-sm hover:bg-brand-green/90 transition-colors">
                Join us
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="w-full max-w-8xl mx-auto px-6 py-16 md:py-24">
        
        <!-- Hero Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20 items-center mb-24">
            <!-- Text Content -->
            <div>
                <div class="text-[10px] font-bold tracking-[0.2em] uppercase text-brand-green mb-4">
                    Institutional Access
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                    The Future of<br>High-Stakes<br>Venture Capital
                </h1>
                <div class="space-y-4 text-gray-400 text-[14px] leading-relaxed">
                    <p>
                        The InvestBridge is the first hybrid platform bridging the gap between social financial intelligence and institutional-grade private equity.
                    </p>
                    <p>
                        We enable elite investors to discover, vet, and execute deals in a secure architectural vault.
                    </p>
                </div>
            </div>
            
            <!-- Graphic / Image -->
            <div class="bg-brand-card rounded-lg p-8 relative overflow-hidden shadow-2xl border border-white/5 h-80 flex items-center justify-center">
                <!-- Fallback to a placeholder representing the image from screenshot -->
                <div class="absolute inset-0 opacity-20">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=1000&q=80" alt="Venture Capital Background" class="w-full h-full object-cover grayscale">
                </div>
                <div class="relative z-10 text-center">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-[#4a5568] tracking-widest uppercase">
                        Venture<br>Capital
                    </h2>
                </div>
            </div>
        </div>

        <!-- Philosophy Section -->
        <div class="mb-24 max-w-3xl">
            <h2 class="text-2xl font-bold mb-6">Our Philosophy</h2>
            <div class="space-y-6 text-[13px] text-gray-400 leading-relaxed">
                <p>
                    We believe that the democratization of high-stakes venture capital shouldn't mean a dilution of quality. For too long, the barrier to elite investment opportunities has been geographic and network-based, rather than merit-based.
                </p>
                <p>
                    Our mission is to bridge the gap between social engagement and elite venture capital. We've built a sanctuary for financial intelligence where signals are separated from noise, and where the collective wisdom of thousands of accredited investors can be focused into precise, institutional-grade execution.
                </p>
                <p>
                    At Sovereign Investor, transparency is our foundation, but privacy is our cornerstone. We are building the architectural vault where the next generation of global unicorns will be discovered, funded, and scaled.
                </p>
            </div>
        </div>

        <!-- Bottom Stats Section -->
        <div class="bg-brand-card rounded-xl border border-white/5 p-8 md:p-12 shadow-2xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <!-- Stat 1 -->
                <div>
                    <div class="text-3xl md:text-4xl font-extrabold text-brand-green mb-2">$100M+</div>
                    <div class="text-[9px] font-bold tracking-[0.15em] text-gray-500 uppercase">Capital Deployed</div>
                </div>
                <!-- Stat 2 -->
                <div>
                    <div class="text-3xl md:text-4xl font-extrabold text-white mb-2">500+</div>
                    <div class="text-[9px] font-bold tracking-[0.15em] text-gray-500 uppercase">Verified Investors</div>
                </div>
                <!-- Stat 3 -->
                <div>
                    <div class="text-3xl md:text-4xl font-extrabold text-brand-yellow mb-2">24/7</div>
                    <div class="text-[9px] font-bold tracking-[0.15em] text-gray-500 uppercase">Regulatory Support</div>
                </div>
            </div>
        </div>

    </main>

</body>
</html>
