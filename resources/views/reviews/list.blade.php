@extends('layouts.app')

@section('title', 'Daftar Review Tugas')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-white"><i class="fa-solid fa-circle-check"></i> Review Submission</h1>
    </div>

    @if ($submissions->isEmpty())
    <div class="bg-gray-900 rounded-lg shadow p-12 text-center">
        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h3 class="text-lg font-medium text-white">Tidak ada submission</h3>
        <p class="text-gray-400 mt-1">Semua submission sudah direview atau belum ada submission.</p>
    </div>
    @else
    <div class="grid gap-6">
        @foreach ($submissions as $submission)
        <div class="bg-gray-900 rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden" x-data="{ expanded: false }">
            <div class="p-6 cursor-pointer" @click="expanded = !expanded">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white">{{ $submission->task->title }}</h3>
                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-400">
                            <span><i class="fa-solid fa-pen-to-square text-gray-500"></i> Dari: <strong class="ml-1">{{ $submission->submittedBy->name }}</strong></span>
                            <span><i class="fa-solid fa-clock text-gray-500"></i> Submitted: {{ $submission->submitted_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-block px-3 py-1 bg-warning-100 text-warning-800 rounded-full text-xs font-semibold">
                            Pending Review
                        </span>
                        <svg :class="{ 'rotate-180': expanded }" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div x-show="expanded" class="border-t border-gray-700 px-6 py-4 bg-gray-800 space-y-4">
                <div>
                    <h4 class="text-sm font-semibold text-gray-300 mb-2">Deskripsi Tugas</h4>
                    <p class="text-sm text-gray-400 whitespace-pre-wrap">{{ $submission->task->description }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-300 mb-1">Deadline</h4>
                        <p class="text-sm text-gray-400">{{ $submission->task->due_date->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-300 mb-1">Submitted At</h4>
                        <p class="text-sm text-gray-400">{{ $submission->submitted_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <div class="bg-gray-900 rounded p-4 border border-gray-700">
                    <h4 class="text-sm font-semibold text-gray-300 mb-3">Submission Details</h4>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Drive Link</p>
                            <a href="{{ $submission->drive_link }}" target="_blank" rel="noopener noreferrer" class="text-primary-600 hover:text-primary-700 underline text-sm break-all">
                                {{ $submission->drive_link }}
                            </a>
                        </div>
                        @if ($submission->notes)
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Notes dari Editor</p>
                            <p class="text-sm text-gray-400">{{ $submission->notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flex space-x-3 pt-2">
                    @can('approve-task')
                    <a href="{{ route('reviews.approve-form', $submission) }}" class="flex-1 bg-success-600 text-white px-4 py-2 rounded-lg hover:bg-success-700 transition-colors text-center font-medium">
                        <i class="fa-solid fa-check"></i> Terima
                    </a>
                    @endcan
                    @can('reject-task')
                    <a href="{{ route('reviews.reject-form', $submission) }}" class="flex-1 bg-danger-600 text-white px-4 py-2 rounded-lg hover:bg-danger-700 transition-colors text-center font-medium">
                        <i class="fa-solid fa-xmark"></i> Tolak
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
