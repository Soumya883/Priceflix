<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-white tracking-tight">Welcome Back</h2>
        <p class="text-slate-500 text-sm mt-1">Access your PriceFlex terminal</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Access Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="trader@priceflex.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Secure Pin')" />
            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded bg-slate-950/50 border-white/5 text-cyan-500 focus:ring-cyan-500/20 w-4 h-4 transition-all" name="remember">
                <span class="ms-2 text-xs font-bold text-slate-500 group-hover:text-slate-400 transition-colors uppercase tracking-widest">{{ __('Stay Connected') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-[10px] font-bold text-slate-500 hover:text-cyan-400 transition-colors uppercase tracking-widest" href="{{ route('password.request') }}">
                    {{ __('Recovery?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button>
                {{ __('Open Terminal') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6">
            <p class="text-xs text-slate-500">
                New to the platform? 
                <a href="{{ route('register') }}" class="text-cyan-400 font-bold hover:underline">Register Account</a>
            </p>
        </div>
    </form>
</x-guest-layout>
