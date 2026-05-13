<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>InvestBridge - Investor Registration</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet"/>

    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-brand-dark text-white font-sans min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-5xl">

<!-- Header -->
<div class="text-center mb-12">
    <h1 class="text-4xl font-extrabold tracking-tight">
        INVESTBRIDGE INVESTOR
    </h1>
    <p class="text-brand-muted text-xs font-semibold tracking-widest uppercase mt-2">
        Secure Access Registration
    </p>
</div>

<!-- Form Card -->
<div class="bg-white text-gray-900 shadow-2xl rounded-lg">

<div class="p-8 md:p-14">

<form action="{{ route('investor.register.post') }}" method="POST" class="space-y-10">
    @csrf

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700 font-bold uppercase tracking-wider">
                        Please correct the following errors:
                    </p>
                    <ul class="mt-2 list-disc list-inside text-xs text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

<!-- Full Name -->
<div>
<label class="label">Full Legal Name</label>
<input type="text" name="name" placeholder="Johnathan Doe" class="input" required>
</div>

<!-- Email -->
<div>
<label class="label">Professional Email</label>
<input type="email" name="email" placeholder="name@firm.com" class="input" autocomplete="off" required>
</div>

<!-- CNIC -->
<div>
<label class="label">CNIC (13-Digit Format)</label>
<input type="text" name="cnic" placeholder="XXXXX-XXXXXXX-X" class="input" required>
</div>

<!-- Phone -->
<div>
<label class="label">Phone No (+92)</label>
<input type="text" name="phone" placeholder="+92 -" class="input" required>
</div>

<!-- City -->
<div>
<label class="label">City</label>
<select name="city" class="input text-gray-500" required>
<option disabled selected>Select Territory</option>
<option>Karachi</option>
<option>Lahore</option>
<option>Islamabad</option>
</select>
</div>

<!-- Business Interest -->
<div>
<label class="label">Interested Business</label>

<div class="grid grid-cols-2 gap-3 mt-2">

<label class="flex items-center gap-2">
<input type="checkbox" name="businesses[]" value="technology"
class="accent-green-500">
Technology
</label>

<label class="flex items-center gap-2">
<input type="checkbox" name="businesses[]" value="realestate"
class="accent-green-500">
Real Estate
</label>

<label class="flex items-center gap-2">
<input type="checkbox" name="businesses[]" value="ecommerce"
class="accent-green-500">
E-Commerce
</label>

</div>
</div>

<!-- Investment Amount -->
<div>
<label class="label">Investment Amount (USD)</label>
<input type="number" name="investment_amount" placeholder="e.g. 5000000" class="input" required>
</div>

<!-- Investment Focus -->
<div>
<label class="label">Investment Interest / Description</label>
<input type="text" name="investment_focus" placeholder="Primary investment focus..." class="input" required>
</div>

<!-- Password -->
<div>
<label class="label">Secure Password</label>
<input type="password" name="password" placeholder="••••••••••••" class="input tracking-widest" autocomplete="new-password" required>
</div>

<!-- Confirm Password -->
<div>
<label class="label">Confirm Password</label>
<input type="password" name="password_confirmation" placeholder="••••••••••••" class="input tracking-widest" autocomplete="new-password" required>
</div>

</div>

<!-- Button -->
<div class="pt-10 flex flex-col items-center space-y-6">

<button type="submit"
class="w-full md:w-[60%] bg-brand-btn text-brand-green font-bold text-xs tracking-[0.15em] uppercase py-4 hover:bg-[#1a2336] transition flex justify-center items-center gap-2">

Register Account

<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M14 5l7 7m0 0l-7 7m7-7H3"/>
</svg>

</button>

<a href="{{ route('pitch.arena') }}" class="text-gray-400 text-xs font-bold tracking-widest uppercase hover:text-brand-dark">
Skip For Now
</a>

<p class="text-xs text-gray-400">
Already have an account?
<a href="{{ route('login') }}" class="font-bold text-gray-900 underline">Log In</a>
</p>

</div>

</form>

</div>
</div>
</div>



</body>
</html>