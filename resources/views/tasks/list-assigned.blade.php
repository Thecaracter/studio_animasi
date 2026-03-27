@extends('layouts.app')

@section('title', 'Daftar Tugas Saya')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-white">📝 Tugas yang Diberikan</h1>
    </div>

    @if ($tasks->isEmpty())
    <div class="bg-gray-900 rounded-lg shadow p-12 text-center">
        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="text-lg font-medium text-white">Tidak ada tugas</h3>
        <p class="text-gray-400 mt-1">Tidak ada tugas yang diberikan sejauh ini. Admin akan memberikan tugas segera.</p>
    </div>
    @else
    <div class="grid gap-6" x-data="{ expandedId: null }">
        @foreach ($tasks as $task)
        <div class="bg-gray-900 rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden" x-data="{ expanded: false }">
            <div class="p-6 cursor-pointer" @click="expanded = !expanded">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white">{{ $task->title }}</h3>
                        <p class="text-sm text-gray-400 mt-1">Dari: <span class="font-medium">{{ $task->assignedBy->name }}</span></p>
                    </div>
                    <div class="flex items-center space-x-3">
                        @php
                            $statusColor = [
                                'pending' => 'bg-gray-100 text-gray-200',
                                'in_progress' => 'bg-primary-100 text-primary-800',
                                'submitted' => 'bg-warning-100 text-warning-800',
                                'approved' => 'bg-success-100 text-success-800',
                                'rejected' => 'bg-danger-100 text-danger-800',
                            ][$task->status] ?? 'bg-gray-100 text-gray-200';
                            
                            $statusLabel = [
                                'pending' => 'Pending',
                                'in_progress' => 'Dikerjakan',
                                'submitted' => 'Menunggu Review',
                                'approved' => 'Approved',
                                'rejected' => 'Ditolak',
                            ][$task->status] ?? $task->status;
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                            {{ $statusLabel }}
                        </span>
                        <svg :class="{ 'rotate-180': expanded }" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div x-show="expanded" class="border-t border-gray-700 px-6 py-4 bg-gray-800 space-y-4">
                <div>
                    <h4 class="text-sm font-semibold text-gray-300 mb-2">Deskripsi</h4>
                    <p class="text-sm text-gray-400 whitespace-pre-wrap">{{ $task->description }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-300 mb-1">Deadline</h4>
                        <p class="text-sm text-gray-400">{{ $task->due_date->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-300 mb-1">Status</h4>
                        <p class="text-sm text-gray-400">{{ $statusLabel }}</p>
                    </div>
                </div>

                @if ($task->submissions->isNotEmpty())
                <div class="bg-gray-900 rounded p-3 border border-gray-700">
                    <h4 class="text-sm font-semibold text-gray-300 mb-2">Submission Terakhir</h4>
                    @php $lastSubmission = $task->submissions->last(); @endphp
                    <div class="text-sm text-gray-400 space-y-1">
                        <p><strong>Submitted:</strong> {{ $lastSubmission->submitted_at->format('d M Y H:i') }}</p>
                        <p><strong>Link:</strong> <a href="{{ $lastSubmission->drive_link }}" target="_blank" class="text-primary-600 hover:text-primary-700 underline">Lihat File</a></p>
                        @if ($lastSubmission->notes)
                        <p><strong>Notes:</strong> {{ $lastSubmission->notes }}</p>
                        @endif
                        <p><strong>Status Review:</strong> 
                            @if ($lastSubmission->review)
                                <span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $lastSubmission->review->status === 'approved' ? 'bg-success-100 text-success-800' : 'bg-danger-100 text-danger-800' }}">
                                    {{ $lastSubmission->review->status === 'approved' ? 'Approved' : 'Rejected' }}
                                </span>
                                @if ($lastSubmission->review->feedback)
                                <div class="mt-2 p-2 bg-gray-800 rounded text-xs">
                                    {{ $lastSubmission->review->feedback }}
                                </div>
                                @endif
                            @else
                                <span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-warning-100 text-warning-800">Pending Review</span>
                            @endif
                        </p>
                    </div>
                </div>
                @endif

                <div class="flex space-x-3 pt-2">
                    @if (!in_array($task->status, ['approved']))
                        <a href="{{ route('tasks.submit-form', $task) }}" class="flex-1 bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors text-center font-medium">
                            Submit Tugas
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
