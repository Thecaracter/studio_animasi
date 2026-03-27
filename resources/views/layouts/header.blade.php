{{-- Navigation Header --}}
@auth
<nav class="bg-gray-900 border-b border-gray-800 shadow-lg sticky top-0 z-40">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-3">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2.5 rounded-lg hover:bg-gray-800 transition-colors text-gray-400 lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="lg:hidden flex items-center space-x-2 ml-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fa-solid fa-film text-white text-sm"></i>
                    </div>
                    <span class="font-bold text-white text-lg">Animasi Jobs</span>
                </div>
            </div>
            
            <div class="flex items-center space-x-4 lg:space-x-6">
                <div class="flex items-center space-x-3 pl-4 border-l border-gray-800">
                    <div class="hidden sm:flex items-center space-x-3">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 capitalize">{{ implode(', ', auth()->user()->getRoleNames()->toArray()) }}</p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center shadow-md">
                            <span class="text-white text-sm font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="sm:hidden">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center shadow-md">
                            <span class="text-white text-sm font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors font-medium text-sm shadow-sm hover:shadow-md">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
@endauth
