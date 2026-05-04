<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>InvestBridge - Investor Registration</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet"/>

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
                'brand-dark': '#111625',
                'brand-input': '#f8fafc',
                'brand-green': '#4ade80',
                'brand-muted': '#718096',
                'brand-btn': '#111827',
            }
        }
    }
}
</script>   

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

<form action="#" method="POST" class="space-y-10">

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

<!-- Full Name -->
<div>
<label class="label">Full Legal Name</label>
<input type="text" placeholder="Johnathan Doe" class="input">
</div>

<!-- Email -->
<div>
<label class="label">Professional Email</label>
<input type="email" placeholder="name@firm.com" class="input" autocomplete="off">
</div>

<!-- CNIC -->
<div>
<label class="label">CNIC (13-Digit Format)</label>
<input type="text" placeholder="XXXXX-XXXXXXX-X" class="input">
</div>

<!-- Phone -->
<div>
<label class="label">Phone No (+92)</label>
<input type="text" placeholder="+92 -" class="input">
</div>

<!-- City -->
<div>
<label class="label">City</label>
<select class="input text-gray-500">
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
<input type="text" placeholder="e.g. 5000000" class="input">
</div>

<!-- Investment Focus -->
<div>
<label class="label">Investment Interest / Description</label>
<input type="text" placeholder="Primary investment focus..." class="input">
</div>

<!-- Password -->
<div>
<label class="label">Secure Password</label>
<input type="password" placeholder="••••••••••••" class="input tracking-widest" autocomplete="new-password">
</div>

<!-- Confirm Password -->
<div>
<label class="label">Confirm Password</label>
<input type="password" placeholder="••••••••••••" class="input tracking-widest" autocomplete="new-password">
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

<a href="#" class="text-gray-400 text-xs font-bold tracking-widest uppercase hover:text-brand-dark">
Skip For Now
</a>

<p class="text-xs text-gray-400">
Already have an account?
<a href="{route('login')}" class="font-bold text-gray-900 underline">Log In</a>
</p>

</div>

</form>

</div>
</div>
</div>

<!-- Reusable Input Styles -->
<style type="text/tailwindcss">
.label{
    @apply block text-[11px] font-bold text-gray-600 tracking-widest uppercase mb-2;
}

.input{
    @apply w-full bg-brand-input border border-gray-200 px-4 py-4 text-sm text-gray-800 placeholder-gray-300
    focus:outline-none focus:ring-2 focus:ring-brand-green rounded-md transition;
}
</style>

</body>
</html>