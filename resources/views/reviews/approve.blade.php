@extends('layouts.app')

@section('title', 'Approve Submission')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('reviews.list') }}" class="text-primary-600 hover:text-primary-700">← Kembali</a>
    </div>

    <div class="bg-gray-900 rounded-lg shadow p-6 space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Approve Submission</h1>
            <p class="text-sm text-gray-400 mt-1">Tugas: {{ $submission->task->title }}</p>
            <p class="text-sm text-gray-400">Editor: {{ $submission->submittedBy->name }}</p>
        </div>

        <div class="bg-primary-50 border border-primary-200 rounded-lg p-4 space-y-3">
            <div>
                <p class="text-xs font-semibold text-primary-600 uppercase tracking-wider">Deskripsi Tugas</p>
                <p class="text-sm text-primary-900 mt-1 whitespace-pre-wrap">{{ $submission->task->description }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-primary-600 uppercase tracking-wider">Submitted File</p>
                <a href="{{ $submission->drive_link }}" target="_blank" rel="noopener noreferrer" class="text-primary-600 hover:text-primary-700 underline text-sm mt-1 block">
                    Lihat Submission →
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('reviews.approve', $submission) }}" class="space-y-6">
            @csrf

            <div>
                <label for="feedback" class="block text-sm font-semibold text-gray-300 mb-2">Feedback (Opsional)</label>
                <textarea 
                    name="feedback" 
                    id="feedback"
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                    placeholder="Tambahkan feedback atau komentar tentang submission..."
                    value="{{ old('feedback') }}"
                ></textarea>
            </div>

            <div class="bg-success-50 border border-success-200 rounded-lg p-4">
                <p class="text-sm text-success-900">
                    <strong><i class="fa-solid fa-check"></i> Persetujuan</strong><br>
                    Dengan mengklik tombol di bawah, Anda menyetujui bahwa submission ini sudah sesuai dengan requirement dan siap diproduksi.
                </p>
            </div>

            <div class="flex space-x-4 pt-4">
                <a href="{{ route('reviews.list') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-800 transition-colors text-center font-medium text-gray-300">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-success-600 text-white px-4 py-2 rounded-lg hover:bg-success-700 transition-colors font-medium">
                    <i class="fa-solid fa-check"></i> Approve Submission
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
