@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-8">
    {{-- Page Header --}}
    <div>
        <h1 class="text-4xl font-bold text-white flex items-center gap-3">
             <span class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center text-white text-xl"><i class="fa-solid fa-chart-pie"></i></span>
            Dashboard Admin
        </h1>
        <p class="text-gray-400 text-sm mt-2">Kelola sistem dan monitor kinerja tim secara keseluruhan</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Total Users --}}
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl shadow-lg border border-gray-800 p-6 hover:shadow-xl transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest">Total User</p>
                    <p class="text-4xl font-bold text-white mt-3">{{ $totalUsers }}</p>
                    <p class="text-xs text-gray-400 mt-2">Pengguna terdaftar</p>
                </div>
                <div class="bg-gradient-to-br from-orange-900/30 to-gray-800/50 p-4 rounded-lg">
                    <svg class="w-8 h-8 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Tasks --}}
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl shadow-lg border border-gray-800 p-6 hover:shadow-xl transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest">Total Tugas</p>
                    <p class="text-4xl font-bold text-white mt-3">{{ $totalTasks }}</p>
                    <p class="text-xs text-gray-400 mt-2">Tugas yang dibuat</p>
                </div>
                <div class="bg-gradient-to-br from-amber-100 to-amber-50 p-4 rounded-lg">
                    <svg class="w-8 h-8 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3a2 2 0 00-2 2v6h6V5a2 2 0 00-2-2H5zM15 3a2 2 0 00-2 2v6h6V5a2 2 0 00-2-2h-2zM5 13a2 2 0 00-2 2v2h6v-2a2 2 0 00-2-2H5zM15 13a2 2 0 00-2 2v2h6v-2a2 2 0 00-2-2h-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Completed Tasks --}}
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl shadow-lg border border-gray-800 p-6 hover:shadow-xl transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest">Tugas Selesai</p>
                    <p class="text-4xl font-bold text-white mt-3">{{ $completedTasks }}</p>
                    <p class="text-xs text-gray-400 mt-2">Selesai dengan sukses</p>
                </div>
                <div class="bg-gradient-to-br from-green-100 to-green-50 p-4 rounded-lg">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Performance Table --}}
    <div class="bg-gray-900 rounded-xl shadow-lg border border-gray-800 overflow-hidden">
        {{-- Table Header --}}
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-5 border-b border-gray-700">
            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                
                Performa Editor - Bulan Ini
            </h2>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-800 border-b border-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-widest">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-widest">Email</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-widest">Diberikan</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-widest">Tepat Waktu</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-widest">Terlambat</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-widest">Selesai</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse ($performanceData as $perf)
                    <tr class="hover:bg-gray-800/50 transition-colors duration-150 group">
                        <td class="px-6 py-4 text-sm font-semibold text-white">{{ $perf['name'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-400">{{ $perf['email'] }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold bg-orange-900/30 text-orange-400 border border-orange-800">
                                {{ $perf['assigned_tasks'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold bg-green-900/30 text-green-400 border border-green-800/50">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                {{ $perf['on_time'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold bg-red-900/30 text-red-400 border border-red-800/50">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                {{ $perf['late'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center text-sm font-bold text-white bg-gradient-to-r from-gray-50 to-transparent">
                            {{ $perf['completed_tasks'] }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <p class="text-gray-400 font-medium">Tidak ada data performa</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
