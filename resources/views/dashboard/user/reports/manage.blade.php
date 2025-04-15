<x-app-layout>
    <x-slot name="header">
        <div class="px-4 py-6 bg-gray-800 border-b border-gray-800">
            <h2 class="text-2xl font-bold text-white">Laporan Saya</h2>
            <p class="text-sm text-gray-400 mt-1">Kelola dan pantau semua laporan yang telah kamu buat.</p>
        </div>
    </x-slot>

    <div class="bg-gray-800 py-10">
        <div class="max-w-6xl mx-auto px-4 space-y-10">

            <div class="bg-gray-900 p-6 rounded-xl shadow border border-gray-800">
                <form action="{{ route('user.reports.manage') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="type" class="text-sm text-gray-300 block mb-1">Tipe Laporan</label>
                        <select id="type" name="type" class="w-full bg-gray-800 border border-gray-700 text-gray-100 rounded-md px-3 py-2">
                            <option value="">Semua</option>
                            <option value="KEJAHATAN" {{ request('type') == 'KEJAHATAN' ? 'selected' : '' }}>Kejahatan</option>
                            <option value="PEMBANGUNAN" {{ request('type') == 'PEMBANGUNAN' ? 'selected' : '' }}>Pembangunan</option>
                            <option value="SOSIAL" {{ request('type') == 'SOSIAL' ? 'selected' : '' }}>Sosial</option>
                        </select>
                    </div>

                    <div>
                        <label for="status" class="text-sm text-gray-300 block mb-1">Status</label>
                        <select id="status" name="status" class="w-full bg-gray-800 border border-gray-700 text-gray-100 rounded-md px-3 py-2">
                            <option value="">Semua</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Sedang Diproses</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white py-2 rounded-md transition">
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>

            @forelse ($reports as $date => $groupedReports)
                <div class="bg-gray-900 rounded-xl shadow border border-gray-800">
                    <div class="px-6 py-4 border-b border-gray-800">
                        <h3 class="text-white font-semibold text-lg">Pengaduan Tanggal: <span class="text-indigo-400">{{ $date }}</span></h3>
                    </div>

                    @foreach ($groupedReports as $report)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 py-6 border-b border-gray-800">
                            <div class="space-y-2 text-sm text-gray-300">
                                <p><span class="font-semibold text-white">Tipe:</span> {{ $report->type }}</p>
                                <p><span class="font-semibold text-white">Lokasi:</span> {{ strtoupper("{$report->province}, {$report->regency}, {$report->subdistrict}, {$report->village}") }}</p>
                                <p><span class="font-semibold text-white">Deskripsi:</span> {{ $report->description }}</p>
                            </div>

                            <div class="flex justify-center items-center">
                                @if ($report->image)
                                    <img src="{{ asset('storage/' . $report->image) }}" class="rounded-lg object-cover max-h-40 w-full border border-gray-700">
                                @else
                                    <div class="text-gray-500 italic text-center w-full bg-gray-800 rounded-lg py-10 border border-gray-700">Tidak ada gambar</div>
                                @endif
                            </div>

                            <div class="flex flex-col justify-between items-end">
                                <div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        {{ $report->status === 'pending' ? 'bg-yellow-500 text-black' :
                                           ($report->status === 'in_progress' ? 'bg-blue-500 text-white' :
                                           ($report->status === 'completed' ? 'bg-green-600 text-white' : 'bg-gray-500 text-white')) }}">
                                        {{ strtoupper($report->status) }}
                                    </span>
                                </div>
                                <div class="flex space-x-2 mt-6">
                                    <a href="{{ route('user.reports.edit', $report->id) }}"
                                       class="flex items-center gap-2 px-4 py-1.5 bg-yellow-500 hover:bg-yellow-400 text-black text-xs font-semibold rounded-full transition">
                                            Edit
                                    </a>
                                    <form action="{{ route('user.reports.destroy', $report->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex items-center gap-2 px-4 py-1.5 bg-red-600 hover:bg-red-500 text-white text-xs font-semibold rounded-full transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="text-center text-gray-400 bg-gray-900 py-12 rounded-xl border border-gray-800 shadow">
                    Belum ada laporan milikmu nih 😅
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
