<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-3xl text-gray-100">Dashboard Pengguna</h2>
            <a href="{{ route('user.reports.manage') }}" class="text-sm text-gray-400 hover:text-gray-100 transition">
                Kelola Laporanmu
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-900 py-10 px-4 md:px-8">
        <div class="max-w-7xl mx-auto space-y-12">
            <div class="flex flex-col md:flex-row items-center justify-between bg-gray-800 rounded-xl p-8 border border-gray-700 shadow-lg">
                <div class="flex flex-col space-y-2">
                    <span class="text-lg text-gray-300">Halo,</span>
                    <h1 class="text-4xl font-bold text-white">{{ auth()->user()->name }}</h1>
                    <p class="text-base text-gray-400">Semoga hari Anda menyenangkan. Lihat aktivitas terbaru Anda di bawah ini!</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('user.reports.create') }}"
                       class="inline-flex items-center px-8 py-4 bg-indigo-600 hover:bg-indigo-500 rounded-full text-white font-semibold transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 transform group-hover:rotate-90 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Laporan Baru
                    </a>
                </div>
            </div>

            <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-md">
                <form method="GET" action="{{ route('dashboard.user') }}">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Cari Laporan</label>
                            <input type="text" name="search" placeholder="Masukkan kata kunci"
                                   class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Jenis Laporan</label>
                            <select name="type" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Jenis</option>
                                <option value="KEJAHATAN">Kejahatan</option>
                                <option value="PEMBANGUNAN">Pembangunan</option>
                                <option value="SOSIAL">Sosial</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Urutkan</label>
                            <select name="sort" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="desc">Terbaru</option>
                                <option value="asc">Terlama</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit"
                                    class="w-full bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-3 rounded-lg transition-all flex items-center justify-center">
                                Terapkan
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="space-y-8">
                <div class="flex items-center mb-4">
                    <div class="w-1 h-10 bg-indigo-500 mr-3 rounded-full"></div>
                    <h3 class="text-2xl font-bold text-gray-100">Laporan Terkini</h3>
                </div>

                @if($reports->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($reports as $report)
                    <div class="bg-gray-800 rounded-xl border border-gray-700 hover:border-indigo-500 transition-all duration-300 shadow-md overflow-hidden">
                        @if ($report->image)
                        <div class="h-48 bg-gray-900">
                            <img src="{{ asset('storage/' . $report->image) }}" class="w-full h-full object-cover transform hover:scale-105 transition duration-300" alt="Gambar Laporan">
                        </div>
                        @endif
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-medium px-3 py-1 rounded-full bg-indigo-900 text-indigo-400 border border-indigo-800">
                                    {{ $report->type }}
                                </span>
                                <span class="text-xs font-medium px-3 py-1 rounded-full
                                    {{ $report->status === 'PROSES' ? 'bg-amber-900 text-amber-400 border border-amber-800' :
                                    ($report->status === 'DITOLAK' ? 'bg-rose-900 text-rose-400 border border-rose-800' :
                                    'bg-emerald-900 text-emerald-400 border border-emerald-800') }}">
                                    {{ $report->status }}
                                </span>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-100">{{ Str::limit($report->title, 50) }}</h4>
                            <p class="text-sm text-gray-400">{{ Str::limit($report->description, 100) }}</p>
                            <div class="border-t border-gray-700 pt-4 flex justify-between items-center">
                                <div class="flex items-center space-x-2 text-xs text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $report->created_at->translatedFormat('d M Y') }}</span>
                                </div>
                                <div class="flex items-center space-x-4 text-xs text-gray-500">
                                    <span class="flex items-center space-x-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span>{{ $report->views }}</span>
                                    </span>
                                    <span class="flex items-center space-x-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        <span>{{ $report->likes_count }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('user.reports.show', $report->id) }}" class="text-indigo-400 hover:text-indigo-300 text-sm flex items-center transition-colors">
                                    Lihat Detail
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                @if (auth()->id() === $report->user_id)
                                <div class="flex space-x-4">
                                    <a href="{{ route('user.reports.edit', $report->id) }}" class="text-amber-400 hover:text-amber-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('user.reports.destroy', $report->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-rose-400 hover:text-rose-300" onclick="return confirm('Hapus laporan ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $reports->links('') }}
                </div>
                @else
                <div class="bg-gray-800 p-8 rounded-xl border border-gray-700 text-center shadow-md">
                    <h4 class="text-xl font-semibold text-gray-300 mb-3">Belum ada Laporan</h4>
                    <p class="text-gray-500 mb-4">Mulai catat aktivitas Anda dengan membuat laporan pertama.</p>
                    <a href="{{ route('user.reports.create') }}"
                       class="inline-flex items-center text-indigo-400 hover:text-indigo-300 transition-colors text-base font-medium">
                        Buat Laporan Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
