@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-4xl font-bold text-white flex items-center gap-3">
                <span class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center text-white text-xl"><i class="fa-solid fa-users"></i></span>
                Kelola User
            </h1>
            <p class="text-gray-400 text-sm mt-2">Kelola pengguna dan izin akses sistem</p>
        </div>
        @can('create-user')
        <a href="{{ route('users.create-form') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-600 to-orange-400 text-white px-6 py-3 rounded-lg hover:shadow-lg hover:from-orange-400 hover:to-blue-800 transition-all font-semibold shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah User
        </a>
        @endcan
    </div>

    {{-- Table Card --}}
    <div class="bg-gray-900 rounded-xl shadow-lg overflow-hidden border border-gray-800">
        {{-- Table Header Info --}}
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-4">
            <p class="text-white text-sm font-medium">Total {{ count($users) }} pengguna</p>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-800 border-b border-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-widest">Pengguna</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-widest">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-widest">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse ($users as $user)
                    <tr class="hover:bg-gray-800/50 transition-colors duration-150 group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md group-hover:shadow-lg transition-shadow">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-white">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-400">ID: {{ $user->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-300 font-medium">{{ $user->email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->getRoleNames()->isNotEmpty())
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($user->getRoleNames() as $role)
                                    <span class="inline-flex items-center px-3 py-1 bg-gradient-to-r from-orange-900/30 to-gray-800/50 text-orange-400 rounded-full text-xs font-bold border border-orange-800">
                                        {{ ucwords(str_replace('_', ' ', $role)) }}
                                    </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="inline-flex px-3 py-1 bg-gray-100 text-gray-400 rounded-full text-xs font-medium">No role</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-gradient-to-r from-green-100 to-green-50 text-green-400 rounded-full text-xs font-bold border border-green-800/50">
                                <span class="w-2 h-2 bg-green-600 rounded-full animate-pulse"></span>
                                Active
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-3">
                                @can('edit-user')
                                <a href="{{ route('users.edit-form', $user) }}" class="inline-flex items-center gap-1 px-4 py-2 bg-gray-800/50 text-orange-600 rounded-lg hover:bg-orange-900/30 transition-colors font-semibold text-sm border border-orange-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                @endcan
                                @if ($user->id !== auth()->id())
                                @can('delete-user')
                                <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-900/30 transition-colors font-semibold text-sm border border-red-800/50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                                @endcan
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2z"></path>
                                </svg>
                                <p class="text-gray-400 font-medium">Tidak ada pengguna</p>
                                <p class="text-gray-400 text-sm">Mulai dengan menambahkan pengguna baru</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
