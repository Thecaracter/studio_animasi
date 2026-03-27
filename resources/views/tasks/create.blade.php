@extends('layouts.app')

@section('title', 'Buat Tugas Baru')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('dashboard') }}" class="text-primary-600 hover:text-primary-700">← Kembali</a>
    </div>

    <div class="bg-gray-900 rounded-lg shadow p-6 space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white"><i class="fa-solid fa-plus"></i> Buat Tugas Baru</h1>
            <p class="text-sm text-gray-400 mt-1">Berikan tugas baru kepada editor</p>
        </div>

        <form method="POST" action="{{ route('tasks.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-semibold text-gray-300 mb-2">
                    Judul Tugas <span class="text-red-600">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title"
                    class="w-full px-4 py-2.5 bg-gray-950/50 border border-gray-800 rounded-lg text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all @error('title') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Contoh: Animasi Scene A Menit 1-30"
                    value="{{ old('title') }}"
                    required
                >
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-300 mb-2">
                    Deskripsi <span class="text-red-600">*</span>
                </label>
                <textarea 
                    name="description" 
                    id="description"
                    rows="5"
                    class="w-full px-4 py-2.5 bg-gray-950/50 border border-gray-800 rounded-lg text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all @error('description') border-red-500 ring-1 ring-red-500 @enderror"
                    placeholder="Jelaskan detail tugas yang harus dikerjakan..."
                    required
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="assigned_to_id" class="block text-sm font-semibold text-gray-300 mb-2">
                    Assign Ke <span class="text-red-600">*</span>
                </label>
                <select 
                    name="assigned_to_id" 
                    id="assigned_to_id"
                    class="w-full px-4 py-2.5 bg-gray-950/50 border border-gray-800 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all @error('assigned_to_id') border-red-500 ring-1 ring-red-500 @enderror"
                    required
                >
                    <option value="" class="bg-gray-900 text-gray-200">-- Pilih Editor --</option>
                    @foreach ($editors as $editor)
                        <option value="{{ $editor->id }}" {{ old('assigned_to_id') == $editor->id ? 'selected' : '' }} class="bg-gray-900 text-gray-200">
                            {{ $editor->name }} ({{ $editor->email }})
                        </option>
                    @endforeach
                </select>
                @error('assigned_to_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="due_date" class="block text-sm font-semibold text-gray-300 mb-2">
                    Deadline <span class="text-red-600">*</span>
                </label>
                <input
                    type="datetime-local"
                    name="due_date"
                    id="due_date"
                    class="w-full px-4 py-2.5 bg-gray-950/50 border border-gray-800 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all cursor-pointer @error('due_date') border-red-500 ring-1 ring-red-500 @enderror"
                    style="color-scheme: dark;"
                    value="{{ old('due_date') }}"
                    required
                >
                @error('due_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-gray-800 border border-orange-500/30 rounded-lg p-4">
                <p class="text-sm text-gray-300">
                    <strong class="text-orange-400 flex items-center mb-1"><i class="fa-solid fa-lightbulb text-yellow-500 mr-1.5"></i> Tips:</strong> Pastikan deadline cukup untuk editor menyelesaikan tugas. Gunakan deskripsi yang jelas dan detail.
                </p>
            </div>

            <div class="flex space-x-4 pt-4">
                <a href="{{ route('dashboard') }}" class="flex-1 px-4 py-2.5 border border-gray-700 bg-gray-900 rounded-lg hover:bg-gray-800 transition-colors text-center font-medium text-gray-300">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-gradient-to-r from-orange-600 to-orange-500 text-white px-4 py-2.5 rounded-lg hover:from-orange-500 hover:to-orange-400 transition-colors font-semibold shadow-lg shadow-orange-500/20">
                    <i class="fa-solid fa-check mr-2"></i>Buat Tugas
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
