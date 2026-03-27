<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Animasi Jobs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 min-h-screen text-gray-200 font-sans flex items-center justify-center relative overflow-hidden">
    <!-- Background Accents -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-orange-600/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-orange-800/10 blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md bg-gray-900/80 backdrop-blur-xl border border-gray-800 rounded-2xl shadow-2xl p-8 space-y-8 relative z-10 m-4">
        <div class="text-center space-y-2">
            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center transform rotate-3 shadow-lg shadow-orange-500/30 mb-4">
                <svg class="w-8 h-8 text-white transform -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Animasi Jobs</h1>
            <p class="text-sm text-gray-400">Login untuk mengakses Dashboard</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div class="space-y-1">
                <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        class="block w-full pl-10 pr-4 py-2.5 bg-gray-950/50 border border-gray-800 rounded-xl text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 ring-1 ring-red-500 @enderror"
                        placeholder="admin@example.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1" x-data="{ show: false }">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input 
                        :type="show ? 'text' : 'password'" 
                        name="password" 
                        id="password"
                        class="block w-full pl-10 pr-12 py-2.5 bg-gray-950/50 border border-gray-800 rounded-xl text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 @error('password') border-red-500 ring-1 ring-red-500 @enderror"
                        placeholder="••••••••"
                        required
                    >
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" @click="show = !show" class="text-gray-500 hover:text-gray-300 focus:outline-none transition-colors">
                            <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button 
                type="submit" 
                class="w-full flex justify-center py-2.5 px-4 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-400 hover:to-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-orange-500 transition-all duration-200 shadow-lg shadow-orange-500/20"
            >
                Masuk
            </button>
        </form>

        <div class="pt-6 border-t border-gray-800/60">
            <h3 class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-4 text-center">Akun Demo Tersedia</h3>
            <div class="grid grid-cols-2 gap-3 mt-4">
                <div class="bg-gray-950/50 border border-gray-800/80 rounded-lg p-3 hover:border-orange-500/30 transition-colors cursor-pointer group">
                    <p class="text-xs font-medium text-gray-300 group-hover:text-orange-400">Admin</p>
                    <p class="text-[10px] text-gray-500 mt-0.5">admin@example.com</p>
                </div>
                <div class="bg-gray-950/50 border border-gray-800/80 rounded-lg p-3 hover:border-orange-500/30 transition-colors cursor-pointer group">
                    <p class="text-xs font-medium text-gray-300 group-hover:text-orange-400">Editor</p>
                    <p class="text-[10px] text-gray-500 mt-0.5">daus@example.com</p>
                </div>
                <div class="bg-gray-950/50 border border-gray-800/80 rounded-lg p-3 hover:border-orange-500/30 transition-colors cursor-pointer group">
                    <p class="text-xs font-medium text-gray-300 group-hover:text-orange-400">Animator</p>
                    <p class="text-[10px] text-gray-500 mt-0.5">animasi@example.com</p>
                </div>
                <div class="bg-gray-950/50 border border-gray-800/80 rounded-lg p-3 hover:border-orange-500/30 transition-colors cursor-pointer group">
                    <p class="text-xs font-medium text-gray-300 group-hover:text-orange-400">Reviewer</p>
                    <p class="text-[10px] text-gray-500 mt-0.5">reviewer@example.com</p>
                </div>
            </div>
            <div class="mt-4 text-center">
                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-800 text-gray-400 border border-gray-700">
                    <svg class="mr-1.5 h-3 w-3 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd" />
                    </svg>
                    Password: password
                </span>
            </div>
        </div>
    </div>
</body>
</html>
