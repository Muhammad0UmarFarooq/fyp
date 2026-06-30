<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>InvestBridge - Investor Registration</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

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
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
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
                            <input type="text" name="name" placeholder="Johnathan Doe" class="input" required
                                maxlength="25" pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"
                                title="Only letters and single spaces allowed. Maximum 25 characters.">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="label">Professional Email</label>
                            <input type="email" name="email" class="input" placeholder="example@gmail.com"
                                maxlength="100" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" required
                                title="Enter a valid email address (e.g., user@example.com).">
                        </div>

                        <!-- CNIC -->
                        <div>
                            <label class="label">CNIC (13-Digit Format)</label>
                            <input type="text" name="cnic" placeholder="XXXXX-XXXXXXX-X" class="input" required
                                maxlength="15" pattern="^\d{5}-\d{7}-\d{1}$"
                                title="CNIC must be in the format XXXXX-XXXXXXX-X">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="label">Phone No(start from 3)</label>
                            <input type="tel" name="phone" placeholder="+923XXXXXXX" class="input" required
                                maxlength="11" pattern="3[0-9]{10}"
                                title="Phone number must start with 3 and contain exactly 11 digits."
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
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
                            <label class="label">Investment Amount (PKR)</label>
                            <input type="number" id="investment_amount" name="investment_amount" placeholder="e.g. 80000"
                                class="input [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                min="80000" max="100000000000" required
                                title="Investment amount must be between 80,000 and 100,000,000,000 (100 Billion).">
                            <p id="inv_amt_error" class="hidden text-red-500 text-[11px] font-semibold mt-1"></p>
                        </div>

                        <!-- Investment Focus -->
                        <div>
                            <label class="label">Investment Interest / Description</label>
                            <input type="text" name="investment_focus" placeholder="Primary investment focus..."
                                class="input" required>
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="label">Secure Password</label>
                            <input type="password" id="password" name="password" placeholder="••••••••••••"
                                class="input tracking-widest" maxlength="16" autocomplete="new-password" required
                                title="Password: max 16 characters, must include at least 1 uppercase letter, 1 number, and 1 special symbol.">
                            <p id="pw_error" class="hidden text-red-500 text-[11px] font-semibold mt-1"></p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="label">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••••••"
                                class="input tracking-widest" maxlength="16" autocomplete="new-password" required>
                            <p id="pw_confirm_error" class="hidden text-red-500 text-[11px] font-semibold mt-1"></p>
                        </div>

                    </div>

                    <!-- Button -->
                    <div class="pt-10 flex flex-col items-center space-y-6">

                        <button type="submit"
                            class="w-full md:w-[60%] bg-brand-btn text-brand-green font-bold text-xs tracking-[0.15em] uppercase py-4 hover:bg-[#1a2336] transition flex justify-center items-center gap-2">

                            Register Account

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>

                        </button>

                        <a href="{{ route('pitch.arena') }}"
                            class="text-gray-400 text-xs font-bold tracking-widest uppercase hover:text-brand-dark">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cnicInput = document.querySelector('input[name="cnic"]');
            if (cnicInput) {
                cnicInput.addEventListener('input', function(e) {
                    let val = e.target.value.replace(/\D/g, ''); // Remove non-digits
                    if (val.length > 13) {
                        val = val.substring(0, 13);
                    }
                    let formatted = '';
                    if (val.length > 0) {
                        formatted += val.substring(0, 5);
                    }
                    if (val.length > 5) {
                        formatted += '-' + val.substring(5, 12);
                    }
                    if (val.length > 12) {
                        formatted += '-' + val.substring(12, 13);
                    }
                    e.target.value = formatted;
                });
            }

            const phoneInput = document.querySelector('input[name="phone"]');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let rawVal = e.target.value;
                    let digits = rawVal.replace(/\D/g, '');

                    // Strip leading zeros
                    while (digits.startsWith('0')) {
                        digits = digits.substring(1);
                    }

                    let phoneDigits = '';
                    if (digits.startsWith('923')) {
                        phoneDigits = digits.substring(2); // Keep starting with 3
                    } else if (digits.startsWith('3')) {
                        phoneDigits = digits;
                    } else {
                        phoneDigits = '';
                    }

                    // Max 11 digits
                    if (phoneDigits.length > 11) {
                        phoneDigits = phoneDigits.substring(0, 11);
                    }

                    if (phoneDigits.length > 0) {
                        e.target.value = '+92-' + phoneDigits;
                    } else {
                        e.target.value = '';
                    }
                });
            }

            // ── Investment Amount: 80,000 – 100,000,000,000 ──
            const invAmtInput = document.getElementById('investment_amount');
            const invAmtError = document.getElementById('inv_amt_error');

            function showInvError(msg) {
                invAmtError.textContent = msg;
                invAmtError.classList.remove('hidden');
                invAmtInput.classList.add('border-red-500');
                invAmtInput.setCustomValidity(msg);
            }
            function clearInvError() {
                invAmtError.textContent = '';
                invAmtError.classList.add('hidden');
                invAmtInput.classList.remove('border-red-500');
                invAmtInput.setCustomValidity('');
            }

            if (invAmtInput) {
                // Block e, E, +, - keys
                invAmtInput.addEventListener('keydown', function(e) {
                    if (['e', 'E', '+', '-'].includes(e.key)) {
                        e.preventDefault();
                    }
                });
                // Block paste of invalid characters
                invAmtInput.addEventListener('paste', function(e) {
                    const pasted = (e.clipboardData || window.clipboardData).getData('text');
                    if (/[eE+\-]/.test(pasted)) e.preventDefault();
                });
                // Real-time range validation
                invAmtInput.addEventListener('input', function() {
                    const val = parseFloat(this.value);
                    if (this.value === '' || isNaN(val)) { clearInvError(); return; }
                    if (val < 80000) {
                        showInvError('Investment amount minimum should be 80,000.');
                    } else if (val > 100000000000) {
                        showInvError('Investment amount must be under 100,000,000,000 (100 Billion).');
                    } else {
                        clearInvError();
                    }
                });
                invAmtInput.addEventListener('blur', function() {
                    const val = parseFloat(this.value);
                    if (!isNaN(val) && val < 80000) {
                        showInvError('Investment amount minimum should be 80,000.');
                    } else if (!isNaN(val) && val > 100000000000) {
                        showInvError('Investment amount must be under 100,000,000,000 (100 Billion).');
                    }
                });
            }

            // ── Password Validation ──
            const pwInput        = document.getElementById('password');
            const pwError        = document.getElementById('pw_error');
            const pwConfirmInput = document.getElementById('password_confirmation');
            const pwConfirmError = document.getElementById('pw_confirm_error');

            function validatePassword(val) {
                if (val.length > 16)           return 'Password must not exceed 16 characters.';
                if (!/[A-Z]/.test(val))         return 'Password must contain at least 1 uppercase letter.';
                if (!/[0-9]/.test(val))         return 'Password must contain at least 1 number.';
                if (!/[^A-Za-z0-9]/.test(val))  return 'Password must contain at least 1 special symbol (e.g. @, #, $).';
                return '';
            }

            function showPwError(msg) {
                pwError.textContent = msg;
                pwError.classList.remove('hidden');
                pwInput.classList.add('border-red-500');
                pwInput.setCustomValidity(msg);
            }
            function clearPwError() {
                pwError.textContent = '';
                pwError.classList.add('hidden');
                pwInput.classList.remove('border-red-500');
                pwInput.setCustomValidity('');
            }

            if (pwInput) {
                pwInput.addEventListener('input', function() {
                    if (this.value === '') { clearPwError(); return; }
                    const msg = validatePassword(this.value);
                    msg ? showPwError(msg) : clearPwError();
                    if (pwConfirmInput && pwConfirmInput.value) {
                        pwConfirmInput.dispatchEvent(new Event('input'));
                    }
                });
            }

            if (pwConfirmInput) {
                pwConfirmInput.addEventListener('input', function() {
                    if (this.value === '') {
                        pwConfirmError.textContent = '';
                        pwConfirmError.classList.add('hidden');
                        this.classList.remove('border-red-500');
                        this.setCustomValidity('');
                        return;
                    }
                    if (pwInput && this.value !== pwInput.value) {
                        pwConfirmError.textContent = 'Passwords do not match.';
                        pwConfirmError.classList.remove('hidden');
                        this.classList.add('border-red-500');
                        this.setCustomValidity('Passwords do not match.');
                    } else {
                        pwConfirmError.textContent = '';
                        pwConfirmError.classList.add('hidden');
                        this.classList.remove('border-red-500');
                        this.setCustomValidity('');
                    }
                });
            }
        });
    </script>
</body>

</html>
