<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-100 leading-tight">
            Laporan Detail
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Navigation Header -->
        <div class="flex justify-between items-start mb-8">
            <a href="{{ route('dashboard.staff') }}" class="group flex items-center text-gray-400 hover:text-gray-200 transition-colors">
                <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
            <span class="text-sm text-gray-400">ID Laporan: #{{ $report->id }}</span>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Report Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Report Card -->
                <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6 shadow-xl">
                    <div class="pb-4 border-b border-gray-700">
                        <h1 class="text-3xl font-bold text-gray-100">{{ $report->title }}</h1>
                        <div class="mt-2 flex items-center space-x-4">
                            <span class="text-sm text-gray-400">
                                Dibuat: {{ $report->created_at->format('d M Y, H:i') }}
                            </span>
                            <span class="px-3 py-1 text-sm rounded-full
                                {{ $report->status === 'SELESAI' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' :
                                ($report->status === 'DITOLAK' ? 'bg-rose-500/20 text-rose-400 border border-rose-500/30' :
                                'bg-amber-500/20 text-amber-400 border border-amber-500/30') }}">
                                {{ $report->status }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-400 mb-2">Deskripsi Laporan</h3>
                            <p class="text-gray-300 leading-relaxed">{{ $report->description }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-400 mb-2">Pelapor</h3>
                            <div class="flex items-center space-x-3">
                                <div class="h-8 w-8 rounded-full bg-gray-700 flex items-center justify-center">
                                    <span class="text-gray-400">{{ strtoupper(substr($report->user->name, 0, 1)) }}</span>
                                </div>
                                <span class="text-gray-300">{{ $report->user->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress Timeline -->
                <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-100">Histori Progress</h3>
                        <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>

                    <div class="space-y-6">
                        @forelse ($report->progress as $progress)
                        <div class="relative pl-8 border-l-2 border-gray-700">
                            <div class="absolute w-3 h-3 bg-gray-600 rounded-full -left-[7px] top-2"></div>
                            <p class="text-gray-300">{{ $progress->description }}</p>
                            <div class="mt-2 text-sm text-gray-500 flex items-center space-x-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>{{ $progress->staff->name }} · {{ $progress->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <div class="mx-auto h-24 w-24 text-gray-600 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <h3 class="text-lg text-gray-400">Belum ada catatan progress</h3>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Action Sidebar -->
            <div class="space-y-8">
                @if ($report->status !== 'SELESAI')
                <!-- Progress Form -->
                <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-100 mb-6">Tambah Progress</h3>
                    <form action="{{ route('staff.reports.progress.store', $report) }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-3">Deskripsi</label>
                            <textarea name="description" rows="4" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-gray-300 placeholder-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
                        </div>
                        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-all flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Simpan Progress
                        </button>
                    </form>
                </div>

                <!-- Complete Report -->
                <form action="{{ route('staff.reports.complete', $report) }}" method="POST"
                      onsubmit="return confirm('Konfirmasi penyelesaian laporan?')"
                      class="bg-gray-800 rounded-2xl border border-gray-700 p-6">
                    @csrf
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-100 mb-4">Finalisasi Laporan</h3>
                        <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl transition-all flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Tandai Selesai
                        </button>
                    </div>
                </form>
                @else
                <div class="bg-gray-800 rounded-2xl border border-emerald-500/30 p-6 text-center">
                    <div class="text-emerald-400 mx-auto mb-4">
                        <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-100">Laporan Telah Selesai</h3>
                    <p class="text-gray-400 mt-2 text-sm">Ditandai selesai pada {{ $report->updated_at->format('d M Y, H:i') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
