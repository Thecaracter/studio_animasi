@extends('layouts.app')

@section('title', 'Dashboard Editor')

@section('content')
<div class="space-y-8">
    {{-- Page Header --}}
    <div>
        <h1 class="text-4xl font-bold text-white flex items-center gap-3">
            <span class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center text-white text-xl"><i class="fa-solid fa-hand"></i></span>
            Selamat datang, {{ auth()->user()->name }}!
        </h1>
        <p class="text-gray-400 text-sm mt-2">Monitor progres tugas Anda dan kelola deadline dengan efisien</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Assigned Tasks --}}
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl shadow-lg border border-gray-800 p-6 hover:shadow-xl transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest">Diberikan</p>
                    <p class="text-4xl font-bold text-white mt-3">{{ $assignedTasks }}</p>
                    <p class="text-xs text-gray-400 mt-2">Total tugas</p>
                </div>
                <div class="bg-gradient-to-br from-orange-900/30 to-gray-800/50 p-4 rounded-lg">
                    <svg class="w-8 h-8 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3a2 2 0 00-2 2v6h6V5a2 2 0 00-2-2H5zM15 3a2 2 0 00-2 2v6h6V5a2 2 0 00-2-2h-2zM5 13a2 2 0 00-2 2v2h6v-2a2 2 0 00-2-2H5zM15 13a2 2 0 00-2 2v2h6v-2a2 2 0 00-2-2h-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Pending Tasks --}}
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl shadow-lg border border-gray-800 p-6 hover:shadow-xl transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest">Pending</p>
                    <p class="text-4xl font-bold text-white mt-3">{{ $pendingTasks }}</p>
                    <p class="text-xs text-gray-400 mt-2">Menunggu dikerjakan</p>
                </div>
                <div class="bg-gradient-to-br from-amber-100 to-amber-50 p-4 rounded-lg">
                    <svg class="w-8 h-8 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Completed Tasks --}}
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl shadow-lg border border-gray-800 p-6 hover:shadow-xl transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest">Selesai</p>
                    <p class="text-4xl font-bold text-white mt-3">{{ $completedTasks }}</p>
                    <p class="text-xs text-gray-400 mt-2">Tugas sukses</p>
                </div>
                <div class="bg-gradient-to-br from-green-100 to-green-50 p-4 rounded-lg">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- On Time Rate --}}
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl shadow-lg border border-gray-800 p-6 hover:shadow-xl transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest">Tepat Waktu</p>
                    <p class="text-4xl font-bold text-white mt-3">{{ $onTime }}</p>
                    <p class="text-xs text-red-500 mt-2">Terlambat: {{ $late }}</p>
                </div>
                <div class="bg-gradient-to-br from-purple-900/30 to-purple-900/10 p-4 rounded-lg">
                    <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert CTA --}}
    @if($pendingTasks > 0)
    <div class="bg-gradient-to-r from-gray-800 to-gray-800 border-2 border-amber-800/50 rounded-xl p-6 shadow-lg">
        <div class="flex items-start gap-4">
            <svg class="w-6 h-6 text-amber-600 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-amber-900">Tugas Menunggu!</h3>
                <p class="text-sm text-amber-800 mt-1">Anda memiliki <strong>{{ $pendingTasks }} tugas</strong> yang belum dikerjakan. Segera mulai bekerja untuk memenuhi deadline!</p>
            </div>
            <a href="{{ route('tasks.list') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-orange-600 text-white px-6 py-3 rounded-lg hover:shadow-lg hover:from-amber-700 hover:to-orange-700 transition-all font-semibold whitespace-nowrap shadow-md flex-shrink-0">
                Lihat Tugas
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
    @else
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-800/50 rounded-xl p-6 shadow-lg">
        <div class="flex items-start gap-4">
            <svg class="w-6 h-6 text-green-600 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-green-900">Hebat! Semua Tuntas! 🎉</h3>
                <p class="text-sm text-green-800 mt-1">Anda telah menyelesaikan semua tugas yang diberikan. Tunggu tugas-tugas baru atau hubungi admin.</p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
