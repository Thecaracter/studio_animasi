@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    {{-- Back Button --}}
    <div class="flex items-center">
        <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 text-orange-600 hover:text-orange-400 font-semibold transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-gray-900 rounded-xl shadow-lg border border-gray-800 overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 sm:px-8 py-8">
            <h1 class="text-3xl font-bold text-white">Edit User</h1>
            <p class="text-gray-300 text-sm mt-2">{{ $user->email }}</p>
        </div>

        {{-- Form Content --}}
        <div class="px-6 sm:px-8 py-8">
            <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Name Field --}}
                <div>
                    <label for="name" class="block text-sm font-bold text-white mb-3">
                        Nama Lengkap <span class="text-red-600">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name"
                        class="w-full px-4 py-3 border-2 border-gray-700 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-900/30 transition-all @error('name') border-red-500 focus:border-red-500 @enderror"
                        value="{{ old('name', $user->name) }}"
                        required
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email Field --}}
                <div>
                    <label for="email" class="block text-sm font-bold text-white mb-3">
                        Email <span class="text-red-600">*</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        class="w-full px-4 py-3 border-2 border-gray-700 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-900/30 transition-all @error('email') border-red-500 focus:border-red-500 @enderror"
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Role Field --}}
                <div>
                    <label for="role" class="block text-sm font-bold text-white mb-3">
                        Role <span class="text-red-600">*</span>
                    </label>
                    <select 
                        name="role" 
                        id="role"
                        class="w-full px-4 py-3 border-2 border-gray-700 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-900/30 transition-all @error('role') border-red-500 focus:border-red-500 @enderror"
                        required
                    >
                        @foreach($allRoles as $role)
                            <option value="{{ $role->name }}" {{ $userRole === $role->name ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Info Box --}}
                <div class="bg-gradient-to-br from-amber-50 to-amber-100 border-2 border-amber-800/50 rounded-lg p-4">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="text-sm text-amber-900">
                            <p class="font-bold">💡 Catatan:</p>
                            <p class="mt-1">Password tidak dapat diubah di halaman ini. Gunakan fitur reset password jika diperlukan.</p>
                        </div>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-4 pt-4 border-t border-gray-700">
                    <a href="{{ route('users.index') }}" class="flex-1 px-6 py-3 border-2 border-gray-300 rounded-lg hover:bg-gray-800 transition-colors text-center font-semibold text-gray-300">
                        Batal
                    </a>
                    @can('edit-user')
                    <button type="submit" class="flex-1 bg-gradient-to-r from-orange-600 to-orange-400 text-white px-6 py-3 rounded-lg hover:shadow-lg hover:from-orange-400 hover:to-blue-800 transition-all font-semibold shadow-md">
                        Update User
                    </button>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
