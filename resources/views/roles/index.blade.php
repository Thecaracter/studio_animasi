@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-white tracking-tight">Kelola Hak Akses (Roles)</h1>
        <a href="{{ route('roles.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-orange-600 hover:bg-orange-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-orange-500 transition-colors">
            <svg class="mr-2 -ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Tambah Role
        </a>
    </div>

    @if(session('success'))
    <div class="bg-emerald-900/50 border border-emerald-500/50 text-emerald-400 px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-800">
                <thead class="bg-gray-950">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama Role</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Permissions (Hak Akses)</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800 bg-gray-900">
                    @forelse($roles as $role)
                    <tr class="hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="px-3 py-1 bg-gray-800 border border-gray-700 rounded-md text-sm font-medium text-gray-300">
                                    {{ $role->name }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-2">
                                @forelse($role->permissions as $permission)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-500/10 text-orange-400 border border-orange-500/20">
                                        {{ $permission->name }}
                                    </span>
                                @empty
                                    <span class="text-sm text-gray-500 italic">Belum ada hak akses.</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('roles.edit', $role->id) }}" class="text-indigo-400 hover:text-indigo-300 mr-4 transition-colors">Edit</a>
                            
                            @if($role->name !== 'admin')
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus role ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Hapus</button>
                            </form>
                            @else
                            <span class="text-gray-600 inline-block">Baku</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                            Belum ada role yang ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
