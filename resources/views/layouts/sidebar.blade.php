{{-- Sidebar Navigation --}}
<aside class="hidden lg:flex lg:w-64 bg-gray-900 border-r border-gray-800 text-white flex-col h-screen sticky top-0 shadow-2xl">
    <div class="h-16 flex items-center px-6 border-b border-gray-800 shadow-sm">
        <div class="flex items-center space-x-3 w-full">
            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg transform rotate-3">
                <i class="fa-solid fa-film text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-lg font-bold text-white tracking-wide">Animasi Jobs</h1>
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold">Production System</p>
            </div>
        </div>
    </div>
    
    <div class="p-6 space-y-1 flex-1 overflow-y-auto custom-scrollbar">
        {{-- Dashboard Link --}}
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-orange-600 shadow-lg' : 'hover:bg-gray-800' }}">
            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        {{-- Admin Menu --}}
        @can('create-user')
        <div class="space-y-2 mt-6">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest px-4 py-2">Admin Panel</h3>
            <div class="space-y-1">
                <a href="{{ route('users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('users.*') ? 'bg-orange-600 shadow-lg' : 'hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 6a3 3 0 11-6 0 3 3 0 016 0zM3 10a7 7 0 1014 0 7 7 0 01-14 0z"></path>
                    </svg>
                    <span class="font-medium">Kelola User</span>
                </a>
                <a href="{{ route('roles.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('roles.*') ? 'bg-orange-600 shadow-lg' : 'hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <span class="font-medium">Kelola Hak Akses</span>
                </a>
                <a href="{{ route('tasks.index-admin') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('tasks.index-admin', 'tasks.edit*') ? 'bg-orange-600 shadow-lg' : 'hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000-2H3a1 1 0 00-1 1v12a1 1 0 001 1h10a1 1 0 001-1V6a1 1 0 100-2 2 2 0 00-2 2v1H4V5zm2 2a1 1 0 100 2h6a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">Kelola Tugas</span>
                </a>
            </div>
        </div>
        @endcan

        {{-- Editor Menu --}}
        @can('view-assigned-tasks')
        <div class="space-y-2 mt-6">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest px-4 py-2">Editor</h3>
            <div class="space-y-1">
                <a href="{{ route('tasks.list') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('tasks.list') ? 'bg-orange-600 shadow-lg' : 'hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm12 12H4a2 2 0 00-2 2v1a1 1 0 001 1h14a1 1 0 001-1v-1a2 2 0 00-2-2z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">Tugas Saya</span>
                </a>
            </div>
        </div>
        @endcan

        {{-- Reviewer Menu --}}
        @can('review-task')
        <div class="space-y-2 mt-6">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest px-4 py-2">Reviewer</h3>
            <div class="space-y-1">
                <a href="{{ route('reviews.list') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('reviews.*') ? 'bg-orange-600 shadow-lg' : 'hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">Review Tugas</span>
                </a>
            </div>
        </div>
        @endcan

        {{-- Spacer --}}
        <div class="flex-1"></div>

        {{-- Footer Info --}}
        <div class="border-t border-gray-700 pt-4 text-xs text-gray-400 text-center">
            <p>© 2026 Animasi Jobs</p>
            <p class="text-gray-600 mt-1">v1.0.0</p>
        </div>
    </div>
</aside>

{{-- Mobile Sidebar --}}
<div :class="sidebarOpen ? 'fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-30 lg:hidden' : '': 'hidden'" @click="sidebarOpen = false" x-transition.opacity duration.300ms></div>
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed left-0 top-0 w-64 bg-gray-900 border-r border-gray-800 text-white transition-transform duration-300 overflow-hidden shadow-2xl z-40 h-screen lg:hidden flex flex-col">
    <div class="h-16 flex items-center justify-between px-6 border-b border-gray-800 shadow-sm relative z-10 bg-gray-900">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-lg transform rotate-3">
                <span class="text-white font-bold text-sm">🎬</span>
            </div>
            <div>
                <h1 class="text-md font-bold text-white tracking-wide leading-tight">Animasi Jobs</h1>
            </div>
        </div>
        <button @click="sidebarOpen = false" class="p-1.5 hover:bg-gray-800 rounded-lg transition-colors text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    
    <div class="p-6 space-y-1 flex-1 overflow-y-auto custom-scrollbar">
        
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-orange-600 shadow-lg' : 'hover:bg-gray-800' }}">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        @can('create-user')
        <div class="space-y-2 mt-6">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest px-4 py-2">Admin</h3>
            <a href="{{ route('users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('users.*') ? 'bg-orange-600 shadow-lg' : 'hover:bg-gray-800' }}">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 6a3 3 0 11-6 0 3 3 0 016 0zM3 10a7 7 0 1014 0 7 7 0 01-14 0z"></path>
                </svg>
                <span class="font-medium">Kelola User</span>
            </a>
            <a href="{{ route('roles.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('roles.*') ? 'bg-orange-600 shadow-lg' : 'hover:bg-gray-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <span class="font-medium">Kelola Hak Akses</span>
            </a>
            <a href="{{ route('tasks.index-admin') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('tasks.index-admin', 'tasks.edit*') ? 'bg-orange-600 shadow-lg' : 'hover:bg-gray-800' }}">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000-2H3a1 1 0 00-1 1v12a1 1 0 001 1h10a1 1 0 001-1V6a1 1 0 100-2 2 2 0 00-2 2v1H4V5zm2 2a1 1 0 100 2h6a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">Kelola Tugas</span>
            </a>
        </div>
        @endcan

        @can('view-assigned-tasks')
        <div class="space-y-2 mt-6">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest px-4 py-2">Editor</h3>
            <a href="{{ route('tasks.list') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('tasks.list') ? 'bg-orange-600 shadow-lg' : 'hover:bg-gray-800' }}">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm12 12H4a2 2 0 00-2 2v1a1 1 0 001 1h14a1 1 0 001-1v-1a2 2 0 00-2-2z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">Tugas Saya</span>
            </a>
        </div>
        @endcan

        @can('review-task')
        <div class="space-y-2 mt-6">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest px-4 py-2">Reviewer</h3>
            <a href="{{ route('reviews.list') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('reviews.*') ? 'bg-orange-600 shadow-lg' : 'hover:bg-gray-800' }}">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">Review Tugas</span>
            </a>
        </div>
        @endcan

        <div class="flex-1"></div>
        <div class="border-t border-gray-700 pt-4 text-xs text-gray-400 text-center">
            <p>© 2026 Animasi Jobs</p>
        </div>
    </div>
</aside>
