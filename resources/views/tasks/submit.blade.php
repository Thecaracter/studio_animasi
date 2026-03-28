@extends('layouts.app')

@section('title', 'Submit Tugas - ' . $task->title)

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('tasks.list') }}" class="text-primary-600 hover:text-primary-700">← Kembali</a>
    </div>

    <div class="bg-gray-900 rounded-lg shadow p-6 space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">{{ $task->title }}</h1>
            <p class="text-sm text-gray-400 mt-1">Dari: {{ $task->assignedBy->name }}</p>
        </div>

        <div class="bg-primary-50 border border-primary-200 rounded-lg p-4">
            <p class="text-sm text-primary-900"><strong>Deadline:</strong> {{ $task->due_date->format('d M Y H:i') }}</p>
            <p class="text-sm text-primary-900 mt-2"><strong>Deskripsi:</strong></p>
            <p class="text-sm text-primary-800 mt-1 whitespace-pre-wrap">{{ $task->description }}</p>
        </div>

        <form method="POST" action="{{ route('tasks.submit', $task) }}" class="space-y-6">
            @csrf

            <div>
                <label for="drive_link" class="block text-sm font-semibold text-gray-300 mb-2">
                    Link Google Drive <span class="text-red-600">*</span>
                </label>
                <input 
                    type="url" 
                    name="drive_link" 
                    id="drive_link"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 @error('drive_link') border-red-500 @enderror"
                    placeholder="https://drive.google.com/file/d/..."
                    value="{{ old('drive_link') }}"
                    required
                >
                @error('drive_link')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-400 mt-2">Pastikan link dapat diakses (set sharing ke "Anyone with the link")</p>
            </div>

            <div>
                <label for="notes" class="block text-sm font-semibold text-gray-300 mb-2">Catatan (Opsional)</label>
                <textarea 
                    name="notes" 
                    id="notes"
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 @error('notes') border-red-500 @enderror"
                    placeholder="Tambahkan catatan tentang submission Anda..."
                >{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4 pt-4">
                <a href="{{ route('tasks.list') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-800 transition-colors text-center font-medium text-gray-300">
                    Batal
                </a>
                @can('submit-task')
                <button type="submit" class="flex-1 bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors font-medium">
                    Submit Tugas
                </button>
                @endcan
            </div>
        </form>
    </div>
</div>
@endsection
