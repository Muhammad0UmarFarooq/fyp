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

<body
    class="bg-brand-dark text-white font-sans min-h-screen flex flex-col items-center justify-center p-4 md:p-8 antialiased">

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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                        <!-- Full Legal Name -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Full
                                Legal Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Johnathan Doe" class="input" required
                                maxlength="25" pattern="^[A-Za-z]+(?: [A-Za-z]+)*$"
                                title="Only letters and single spaces allowed. Maximum 25 characters.">
                        </div>

                        <!-- Professional Email -->
                        <div class="space-y-2.5">
                            <label
                                class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Professional
                                Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="input" placeholder="example@gmail.com"
                                maxlength="100" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" required
                                title="Enter a valid email address (e.g., user@example.com).">
                        </div>

                        <!-- CNIC -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">CNIC
                                (13-Digit Format)</label>
                            <input type="text" name="cnic" value="{{ old('cnic') }}" placeholder="XXXXX-XXXXXXX-X"
                                class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-brand-green"
                                required maxlength="15" title="CNIC must be in the format XXXXX-XXXXXXX-X">
                        </div>

                        <!-- Phone No -->
                        <div>
                            <label class="label">Phone No</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+92-3XXXXXXXXX" class="input" required
                                maxlength="15" pattern="^\+92-3\d{9}$"
                                title="Phone number must start with 3 and have exactly 10 digits (excluding +92-)">
                        </div>

                        <!-- City -->
                        <div class="space-y-2.5">
                            <label
                                class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">City</label>
                            <div class="relative">
                                <select name="city"
                                    class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-500 appearance-none focus:outline-none focus:ring-1 focus:ring-brand-green"
                                    required>
                                    <option value="" disabled {{ old('city') ? '' : 'selected' }}>Select Territory</option>
                                    <option value="karachi" {{ old('city') === 'karachi' ? 'selected' : '' }}>Karachi</option>
                                    <option value="lahore" {{ old('city') === 'lahore' ? 'selected' : '' }}>Lahore</option>
                                    <option value="islamabad" {{ old('city') === 'islamabad' ? 'selected' : '' }}>Islamabad</option>
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        {{-- Industry --}}
                        <div class="space-y-2.5">
                            <label
                                class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Industry</label>
                            <div class="relative">
                                <select name="industry"
                                    class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-500 appearance-none focus:outline-none focus:ring-1 focus:ring-brand-green"
                                    required>
                                    <option value="" disabled {{ old('industry') ? '' : 'selected' }}>Select Industry</option>
                                    <option value="technology" {{ old('industry') === 'technology' ? 'selected' : '' }}>technology</option>
                                    <option value="ecommerce" {{ old('industry') === 'ecommerce' ? 'selected' : '' }}>E-Commerece</option>
                                    <option value="realestate" {{ old('industry') === 'realestate' ? 'selected' : '' }}>Real State</option>
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- Business -->
                        <div class="space-y-2.5">
                            <label
                                class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Business</label>
                            <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Shoes Shop Store"
                                class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-brand-green"
                                pattern="^[A-Za-z]+(?:\s[A-Za-z]+)*$" maxlength="50" required
                                title="Business name: letters only with single spaces between words. No numbers, symbols or double spaces.">
                        </div>

                        <!-- Experience -->
                        <div class="space-y-2.5">
                            <label
                                class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Experience
                                (Years)</label>
                            <input type="text" inputmode="numeric" name="experience" value="{{ old('experience') }}" placeholder="e.g. 3"
                                class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-brand-green"
                                pattern="^([0-5]?[0-9]|60)$" maxlength="2" required
                                title="Experience must be between 0 and 60 years (max 2 digits).">
                        </div>
                        <!-- Total Return Amount -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Total Amount</label>
                            <input type="number" id="total_valuation" name="total_valuation" value="{{ old('total_valuation') }}" placeholder="e.g. 50000"
                                class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-brand-green [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                min="50000" max="1000000000" required
                                title="Total Return Amount must be between 50,000 and 1,000,000,000 (1 Billion).">
                            <p id="total_val_error" class="hidden text-red-500 text-[11px] font-semibold mt-1"></p>
                        </div>

                        <!-- Future Return Amount -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Future Valuation</label>
                            <input type="number" id="future_valuation" name="future_valuation" value="{{ old('future_valuation') }}" placeholder="e.g. 80000"
                                class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-brand-green [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                min="80000" max="100000000000" required
                                title="Future Return Amount must be between 80,000 and 100,000,000,000 (100 Billion).">
                            <p id="future_val_error" class="hidden text-red-500 text-[11px] font-semibold mt-1"></p>
                        </div>

                        <!-- Secure Password -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Secure
                                Password</label>
                            <input type="password" id="password" name="password" placeholder="••••••••••••"
                                class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-xl text-gray-800 placeholder-gray-300 tracking-[0.2em] focus:outline-none focus:ring-1 focus:ring-brand-green"
                                maxlength="16" autocomplete="new-password" required
                                title="Password: max 16 characters, must include at least 1 uppercase letter, 1 number, and 1 special symbol.">
                            <p id="pw_error" class="hidden text-red-500 text-[11px] font-semibold mt-1"></p>
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-2.5">
                            <label class="block text-[11px] font-bold text-gray-600 tracking-widest uppercase">Confirm
                                Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••••••"
                                class="w-full bg-brand-input border border-gray-100 px-4 py-4 text-xl text-gray-800 placeholder-gray-300 tracking-[0.2em] focus:outline-none focus:ring-1 focus:ring-brand-green"
                                maxlength="16" autocomplete="new-password" required>
                            <p id="pw_confirm_error" class="hidden text-red-500 text-[11px] font-semibold mt-1"></p>
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="pt-10 flex flex-col items-center space-y-8">
                        <button type="submit"
                            class="w-full md:w-[60%] bg-brand-btn text-brand-green font-bold text-[11px] tracking-[0.15em] uppercase py-4 hover:bg-[#1a2336] transition-colors flex items-center justify-center space-x-2">
                            <span>Register Account</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>

                        <a href="{{ route('pitch.arena') }}"
                            class="text-[#a0aec0] text-[11px] font-bold tracking-[0.15em] uppercase hover:text-brand-dark transition-colors">
                            Skip For Now
                        </a>

                        <p class="text-xs text-gray-400 font-medium pb-2">
                            Already have an account? <a href="{{ route('login') }}"
                                class="font-bold text-gray-900 underline underline-offset-2 hover:text-brand-dark">Log
                                In</a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>

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

            // Business field – letters + single spaces between words only (no double spaces)
            const businessInput = document.querySelector('input[name="company_name"]');
            if (businessInput) {
                businessInput.addEventListener('keydown', function(e) {
                    const allowedKeys = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Home', 'End'];
                    if (allowedKeys.includes(e.key)) return;
                    if (e.ctrlKey || e.metaKey) return;

                    if (e.key === ' ') {
                        // Block space if field is empty or the last typed character is already a space
                        if (this.value.length === 0 || this.value.endsWith(' ')) {
                            e.preventDefault();
                        }
                        return;
                    }

                    // Only letters allowed
                    if (!/^[A-Za-z]$/.test(e.key)) {
                        e.preventDefault();
                    }
                });

                businessInput.addEventListener('input', function() {
                    // Strip anything that isn't a letter or space
                    let val = this.value.replace(/[^A-Za-z ]/g, '');
                    // Remove leading space
                    val = val.replace(/^ +/, '');
                    // Collapse any double (or more) spaces into a single space
                    val = val.replace(/ {2,}/g, ' ');
                    this.value = val;
                });

                businessInput.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pasted = (e.clipboardData || window.clipboardData).getData('text');
                    // Keep only letters and spaces, collapse multiple spaces, trim leading space
                    let clean = pasted
                        .replace(/[^A-Za-z ]/g, '')
                        .replace(/^ +/, '')
                        .replace(/ {2,}/g, ' ');
                    // Insert at cursor position and re-sanitize
                    const start = this.selectionStart;
                    const end = this.selectionEnd;
                    let current = this.value;
                    let combined = current.substring(0, start) + clean + current.substring(end);
                    combined = combined.replace(/^ +/, '').replace(/ {2,}/g, ' ');
                    this.value = combined.substring(0, 50);
                });
            }

            // Experience field – strict 2-digit, max 60 enforcement
            const experienceInput = document.querySelector('input[name="experience"]');
            if (experienceInput) {
                // Block invalid key presses in real-time
                experienceInput.addEventListener('keydown', function(e) {
                    const allowedKeys = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'];
                    if (allowedKeys.includes(e.key)) return;

                    // Only digits allowed
                    if (!/^\d$/.test(e.key)) {
                        e.preventDefault();
                        return;
                    }

                    const current = this.value;

                    // Block if already 2 digits
                    if (current.length >= 2) {
                        e.preventDefault();
                        return;
                    }

                    // If first digit is 6, only '0' is allowed as second digit
                    if (current === '6' && e.key !== '0') {
                        e.preventDefault();
                        return;
                    }

                    // Block any first digit > 6 (7,8,9 would exceed 60 even as tens digit)
                    // Allow 0-6 as first digit only
                    if (current.length === 0 && parseInt(e.key) > 6) {
                        e.preventDefault();
                        return;
                    }
                });

                // Sanitize on paste or autofill
                experienceInput.addEventListener('input', function() {
                    // Strip non-digits
                    let val = this.value.replace(/\D/g, '');
                    // Take only first 2 digits
                    if (val.length > 2) val = val.substring(0, 2);
                    // Clamp: if value > 60, set to 60
                    if (val !== '' && parseInt(val, 10) > 60) val = '60';
                    this.value = val;
                });
            }

            // ── Total Return Amount: 50,000 – 1,000,000,000 ──
            const totalValInput = document.getElementById('total_valuation');
            const totalValError = document.getElementById('total_val_error');

            function showTotalValError(msg) {
                totalValError.textContent = msg;
                totalValError.classList.remove('hidden');
                totalValInput.classList.add('border-red-500', 'focus:ring-red-500');
                totalValInput.classList.remove('focus:ring-brand-green');
                totalValInput.setCustomValidity(msg);
            }
            function clearTotalValError() {
                totalValError.textContent = '';
                totalValError.classList.add('hidden');
                totalValInput.classList.remove('border-red-500', 'focus:ring-red-500');
                totalValInput.classList.add('focus:ring-brand-green');
                totalValInput.setCustomValidity('');
            }

            if (totalValInput) {
                totalValInput.addEventListener('input', function() {
                    const val = parseFloat(this.value);
                    if (isNaN(val) || this.value === '') { clearTotalValError(); return; }
                    if (val < 50000) {
                        showTotalValError('Current return amount minimum should be 50,000.');
                    } else if (val > 1000000000) {
                        showTotalValError('Total Return Amount must be under 1,000,000,000 (1 Billion).');
                    } else {
                        clearTotalValError();
                    }
                });
                totalValInput.addEventListener('blur', function() {
                    const val = parseFloat(this.value);
                    if (!isNaN(val) && val < 50000) {
                        showTotalValError('Current return amount minimum should be 50,000.');
                    } else if (!isNaN(val) && val > 1000000000) {
                        showTotalValError('Total Return Amount must be under 1,000,000,000 (1 Billion).');
                    }
                });
            }

            // ── Future Return Amount: 80,000 – 100,000,000,000 ──
            const futureValInput = document.getElementById('future_valuation');
            const futureValError = document.getElementById('future_val_error');

            function showFutureValError(msg) {
                futureValError.textContent = msg;
                futureValError.classList.remove('hidden');
                futureValInput.classList.add('border-red-500', 'focus:ring-red-500');
                futureValInput.classList.remove('focus:ring-brand-green');
                futureValInput.setCustomValidity(msg);
            }
            function clearFutureValError() {
                futureValError.textContent = '';
                futureValError.classList.add('hidden');
                futureValInput.classList.remove('border-red-500', 'focus:ring-red-500');
                futureValInput.classList.add('focus:ring-brand-green');
                futureValInput.setCustomValidity('');
            }

            if (futureValInput) {
                futureValInput.addEventListener('input', function() {
                    const val = parseFloat(this.value);
                    if (isNaN(val) || this.value === '') { clearFutureValError(); return; }
                    if (val < 80000) {
                        showFutureValError('Future return amount minimum should be 80,000.');
                    } else if (val > 100000000000) {
                        showFutureValError('Future Return Amount must be under 100,000,000,000 (100 Billion).');
                    } else {
                        clearFutureValError();
                    }
                });
                futureValInput.addEventListener('blur', function() {
                    const val = parseFloat(this.value);
                    if (!isNaN(val) && val < 80000) {
                        showFutureValError('Future return amount minimum should be 80,000.');
                    } else if (!isNaN(val) && val > 100000000000) {
                        showFutureValError('Future Return Amount must be under 100,000,000,000 (100 Billion).');
                    }
                });
            }

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

                    // Max 10 digits
                    if (phoneDigits.length > 10) {
                        phoneDigits = phoneDigits.substring(0, 10);
                    }

                    if (phoneDigits.length > 0) {
                        e.target.value = '+92-' + phoneDigits;
                    } else {
                        e.target.value = '';
                    }
                });
            }

            // ── Password Validation ──
            const pwInput        = document.getElementById('password');
            const pwError        = document.getElementById('pw_error');
            const pwConfirmInput = document.getElementById('password_confirmation');
            const pwConfirmError = document.getElementById('pw_confirm_error');

            function validatePassword(val) {
                if (val.length > 16)          return 'Password must not exceed 16 characters.';
                if (!/[A-Z]/.test(val))        return 'Password must contain at least 1 uppercase letter.';
                if (!/[0-9]/.test(val))        return 'Password must contain at least 1 number.';
                if (!/[^A-Za-z0-9]/.test(val)) return 'Password must contain at least 1 special symbol (e.g. @, #, $).';
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
                    // Re-check confirm field if already filled
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
