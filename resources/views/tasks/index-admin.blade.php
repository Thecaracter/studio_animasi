@extends('layouts.app')

@section('title', 'Kelola Tugas')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white"><i class="fa-solid fa-list-check mr-2"></i>Kelola Tugas</h1>
            <p class="text-sm text-gray-400 mt-1">Kelola semua tugas yang telah dibuat</p>
        </div>
        @can('create-task')
        <a href="{{ route('tasks.create-form') }}" class="bg-gradient-to-r from-orange-600 to-orange-500 text-white px-4 py-2.5 rounded-lg hover:from-orange-500 hover:to-orange-400 transition-colors font-semibold shadow-lg shadow-orange-500/20">
            <i class="fa-solid fa-plus mr-2"></i>Buat Tugas Baru
        </a>
        @endcan
    </div>

    @if (session('success'))
        <div class="bg-emerald-900/30 border border-emerald-500/30 rounded-lg p-4 text-emerald-300">
            <i class="fa-solid fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-900 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-800 border-b border-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Judul Tugas</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Assigned To</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Due Date</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Kondisi</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse ($tasks as $task)
                        <tr class="hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-3">
                                <div class="text-sm font-medium text-white truncate max-w-xs">{{ $task->title }}</div>
                                <div class="text-xs text-gray-400 mt-1">ID: {{ $task->id }}</div>
                            </td>
                            <td class="px-6 py-3">
                                <div class="text-sm text-gray-300">{{ $task->assignedTo->name ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $task->assignedTo->email ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-3">
                                @php
                                    $statusLabels = [
                                        'pending' => 'Pending',
                                        'submitted' => 'Submitted',
                                        'approved' => 'Approved',
                                        'rejected' => 'Rejected',
                                    ];
                                    $statusColors = [
                                        'pending' => 'bg-blue-900/30 text-blue-300 border-blue-500/30',
                                        'submitted' => 'bg-yellow-900/30 text-yellow-300 border-yellow-500/30',
                                        'approved' => 'bg-emerald-900/30 text-emerald-300 border-emerald-500/30',
                                        'rejected' => 'bg-red-900/30 text-red-300 border-red-500/30',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $statusColors[$task->status] ?? 'bg-gray-700 text-gray-300 border-gray-600' }}">
                                    {{ $statusLabels[$task->status] ?? $task->status }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                <div class="text-sm text-gray-300">{{ $task->due_date->format('d M Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-3">
                                @php
                                    $conditionClass = '';
                                    $conditionIcon = '';
                                    $conditionText = '';
                                    
                                    if ($task->status === 'approved') {
                                        $conditionClass = 'text-emerald-400';
                                        $conditionIcon = 'fa-circle-check';
                                        $conditionText = 'Selesai';
                                    } elseif ($task->status === 'rejected') {
                                        $conditionClass = 'text-red-400';
                                        $conditionIcon = 'fa-circle-xmark';
                                        $conditionText = 'Ditolak';
                                    } elseif (now() > $task->due_date) {
                                        $conditionClass = 'text-red-400';
                                        $conditionIcon = 'fa-clock';
                                        $conditionText = 'Telat';
                                    } elseif ($task->status === 'submitted') {
                                        $conditionClass = 'text-yellow-400';
                                        $conditionIcon = 'fa-hourglass-end';
                                        $conditionText = 'Menunggu Review';
                                    } else {
                                        $conditionClass = 'text-blue-400';
                                        $conditionIcon = 'fa-spinner';
                                        $conditionText = 'Dalam Proses';
                                    }
                                @endphp
                                <span class="inline-flex items-center text-sm {{ $conditionClass }}">
                                    <i class="fa-solid {{ $conditionIcon }} mr-1"></i>{{ $conditionText }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center space-x-2">
                                    @can('edit-task')
                                    <a href="{{ route('tasks.edit-form', $task) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-900/30 text-blue-300 rounded hover:bg-blue-900/50 transition-colors text-xs font-medium border border-blue-500/30">
                                        <i class="fa-solid fa-pen-to-square mr-1"></i>Edit
                                    </a>
                                    @endcan
                                    
                                    @can('delete-task')
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-900/30 text-red-300 rounded hover:bg-red-900/50 transition-colors text-xs font-medium border border-red-500/30">
                                            <i class="fa-solid fa-trash mr-1"></i>Hapus
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fa-solid fa-inbox text-4xl text-gray-600 mb-3"></i>
                                    <p class="text-gray-400">Tidak ada tugas</p>
                                    <a href="{{ route('tasks.create-form') }}" class="mt-3 text-orange-400 hover:text-orange-300 text-sm font-medium">
                                        Buat tugas pertama Anda
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-gray-800 border border-orange-500/30 rounded-lg p-4">
        <p class="text-sm text-gray-300">
            <strong class="text-orange-400"><i class="fa-solid fa-lightbulb text-yellow-500 mr-1.5"></i>Tips:</strong> Klik Edit untuk mengubah detail tugas, atau lihat kondisi tugas untuk status terkini.
        </p>
    </div>
</div>
@endsection
