@extends('layouts.app')

@section('content')
    <!-- Top Navigation -->
    <nav class="w-full px-8 py-8 flex justify-between items-center absolute top-0 left-0">
        <div class="text-xl font-bold tracking-tight">
            Invest<span class="text-brand-green">Bridge</span>
        </div>
        <a href="{{ route('login') }}" class="text-brand-green text-xs font-bold tracking-widest uppercase border-b border-brand-green pb-0.5 hover:text-brand-green/80 hover:border-brand-green/80 transition-colors">
            Back to Login
        </a>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-[#1e2738] rounded-md shadow-2xl overflow-hidden mt-16">
            <div class="px-8 py-10 md:px-12 md:py-12">
                <h2 class="text-2xl font-bold text-center mb-6">
                   Reset Password
                </h2>

                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500/20 text-red-500 text-xs p-4 rounded-sm mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf

                    <input
                        type="hidden"
                        name="token"
                        value="{{ $token }}"
                    >

                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-gray-400 tracking-widest uppercase">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ $email }}"
                            required
                            class="w-full bg-[#111625] border border-transparent rounded-sm px-4 py-4 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-green focus:ring-1 focus:ring-brand-green transition-colors"
                        >
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-gray-400 tracking-widest uppercase">
                            New Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full bg-[#111625] border border-transparent rounded-sm px-4 py-4 text-xl text-gray-200 placeholder-gray-500 tracking-[0.2em] focus:outline-none focus:border-brand-green focus:ring-1 focus:ring-brand-green transition-colors"
                            placeholder="Enter new password"
                        >
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-bold text-gray-400 tracking-widest uppercase">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            class="w-full bg-[#111625] border border-transparent rounded-sm px-4 py-4 text-xl text-gray-200 placeholder-gray-500 tracking-[0.2em] focus:outline-none focus:border-brand-green focus:ring-1 focus:ring-brand-green transition-colors"
                            placeholder="Confirm new password"
                        >
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-brand-green text-[#064e3b] font-bold text-[13px] tracking-wide py-4 rounded-sm hover:bg-brand-green/90 transition-colors flex items-center justify-center space-x-2 mt-4">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection