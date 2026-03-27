@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Role Baru</h1>
        <a href="{{ route('roles.index') }}" class="text-gray-400 hover:text-white transition-colors">
            &larr; Kembali ke daftar
        </a>
    </div>

    <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden shadow-sm p-6 max-w-3xl">
        <form action="{{ route('roles.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Nama Role</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input type="text" name="name" id="name" required
                        class="block w-full bg-gray-950/50 border border-gray-800 rounded-lg text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all sm:text-sm px-4 py-2.5"
                        placeholder="Contoh: editor animasi">
                </div>
                @error('name')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-3">Pilih Hak Akses (Permissions)</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($permissions as $permission)
                        <div class="relative flex items-start">
                            <div class="flex items-center h-5">
                                <input id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}" type="checkbox" 
                                       class="focus:ring-orange-500 h-4 w-4 text-orange-600 border-gray-700 bg-gray-950 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="permission_{{ $permission->id }}" class="font-medium text-gray-400 select-none cursor-pointer hover:text-gray-300 transition-colors">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pt-5 border-t border-gray-800 flex justify-end">
                <button type="submit" class="inline-flex justify-center py-2.5 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-orange-500 transition-colors w-full sm:w-auto">
                    Simpan Role
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
