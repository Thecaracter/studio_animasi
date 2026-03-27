<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Animasi Jobs')</title>    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950">
    <div class="min-h-screen flex flex-col" x-data="{ sidebarOpen: false }">
        <div class="flex flex-1 overflow-hidden">
            {{-- Sidebar --}}
            @include('layouts.sidebar')

            {{-- Main Content Wrapper --}}
            <div class="flex-1 flex flex-col overflow-hidden">
                {{-- Header --}}
                @include('layouts.header')

                {{-- Main Content --}}
                <main class="flex-1 overflow-auto">
                    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
                        {{-- Alerts --}}
                        @if ($message = Session::get('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start space-x-3 shadow-sm" x-data="{ show: true }" x-show="show">
                            <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-green-800">{{ $message }}</h3>
                            </div>
                            <button @click="show = false" class="text-green-400 hover:text-green-600 flex-shrink-0">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        @endif

                        @if ($message = Session::get('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start space-x-3 shadow-sm" x-data="{ show: true }" x-show="show">
                            <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-red-800">{{ $message }}</h3>
                            </div>
                            <button @click="show = false" class="text-red-400 hover:text-red-600 flex-shrink-0">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        @endif

                        {{-- Page Content --}}
                        @yield('content')
                    </div>
                </main>

                {{-- Footer --}}
                @include('layouts.footer')
            </div>
        </div>
    </div>
</body>
</html>
