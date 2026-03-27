@extends('layouts.app')

@section('title', 'Reject Submission')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('reviews.list') }}" class="text-primary-600 hover:text-primary-700">← Kembali</a>
    </div>

    <div class="bg-gray-900 rounded-lg shadow p-6 space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Reject Submission</h1>
            <p class="text-sm text-gray-400 mt-1">Tugas: {{ $submission->task->title }}</p>
            <p class="text-sm text-gray-400">Editor: {{ $submission->submittedBy->name }}</p>
        </div>

        <div class="bg-warning-50 border border-warning-200 rounded-lg p-4 space-y-3">
            <div>
                <p class="text-xs font-semibold text-warning-600 uppercase tracking-wider">Deskripsi Tugas</p>
                <p class="text-sm text-warning-900 mt-1 whitespace-pre-wrap">{{ $submission->task->description }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-warning-600 uppercase tracking-wider">Submitted File</p>
                <a href="{{ $submission->drive_link }}" target="_blank" rel="noopener noreferrer" class="text-warning-600 hover:text-warning-700 underline text-sm mt-1 block">
                    Lihat Submission →
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('reviews.reject', $submission) }}" class="space-y-6">
            @csrf

            <div>
                <label for="feedback" class="block text-sm font-semibold text-gray-300 mb-2">
                    Alasan Penolakan <span class="text-red-600">*</span>
                </label>
                <textarea 
                    name="feedback" 
                    id="feedback"
                    rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-danger-500 @error('feedback') border-red-500 @enderror"
                    placeholder="Jelaskan mengapa submission ini ditolak dan apa yang perlu diperbaiki..."
                    required
                >{{ old('feedback') }}</textarea>
                @error('feedback')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-danger-50 border border-danger-200 rounded-lg p-4">
                <p class="text-sm text-danger-900">
                    <strong><i class="fa-solid fa-triangle-exclamation"></i> Penolakan</strong><br>
                    Submission ini akan dikembalikan ke editor. Editor akan menerima notifikasi untuk memperbaiki dan mengulang pengerjaan.
                </p>
            </div>

            <div class="flex space-x-4 pt-4">
                <a href="{{ route('reviews.list') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-800 transition-colors text-center font-medium text-gray-300">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-danger-600 text-white px-4 py-2 rounded-lg hover:bg-danger-700 transition-colors font-medium">
                    <i class="fa-solid fa-xmark"></i> Reject Submission
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
