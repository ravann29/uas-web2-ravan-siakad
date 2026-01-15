<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
        <div class="max-w-md w-full">

            {{-- HEADER SECTION --}}
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-gray-900 mb-1">Selamat Datang</h1>
                <p class="text-gray-600 text-sm">Masuk ke Sistem Akademik</p>
            </div>

            {{-- SESSION STATUS --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- FORM CARD --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                
                {{-- Form Header --}}
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h2 class="text-base font-semibold text-gray-900">LOGIN</h2>
                        </div>
                    </div>
                </div>

                {{-- Form Body --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="p-6 space-y-6">
                        
                        {{-- EMAIL --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 ring-2 ring-red-200 @enderror" 
                                   value="{{ old('email') }}" 
                                   placeholder="email@example.com"
                                   required 
                                   autofocus 
                                   autocomplete="username">
                            @error('email')
                                <div class="mt-2 flex items-start">
                                    <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password') border-red-500 ring-2 ring-red-200 @enderror" 
                                   placeholder="Masukkan password"
                                   required 
                                   autocomplete="current-password">
                            @error('password')
                                <div class="mt-2 flex items-start">
                                    <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        {{-- REMEMBER ME --}}
                        <div class="flex items-center">
                            <input id="remember_me" 
                                   type="checkbox" 
                                   name="remember" 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                {{ __('Remember me') }}
                            </label>
                        </div>

                        {{-- FORM ACTIONS --}}
                        <div class="pt-6 border-t border-gray-200">
                            <div class="flex items-center justify-between">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" 
                                       class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors duration-200">
                                        Lupa password?
                                    </a>
                                @endif
                                
                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400 transition-all duration-200"
                                        style="background-color: #F39C12;">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                    {{ __('LOGIN') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- REGISTER LINK --}}
            @if (Route::has('register'))
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition-colors duration-200">
                            Daftar sekarang
                        </a>
                    </p>
                </div>
            @endif

            {{-- INFO BOX --}}
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Informasi Login</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Gunakan email dan password yang terdaftar</li>
                                <li>Pastikan koneksi internet Anda stabil</li>
                                <li>Hubungi admin jika mengalami kesulitan login</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>