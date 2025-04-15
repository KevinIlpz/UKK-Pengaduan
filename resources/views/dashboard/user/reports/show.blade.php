<x-app-layout>
    <x-slot name="header">
        <div class="px-4 py-4 bg-gray-900 shadow-sm">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-white">Detail Laporan</h2>
                <a href="{{ route('dashboard.user') }}" class="text-sm text-indigo-400 hover:text-white transition">
                    &larr; Kembali ke Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-gray-800 py-8">
        <div class="max-w-4xl mx-auto px-4 space-y-8">
            <!-- Gambar -->
            <div class="rounded-xl overflow-hidden shadow-lg border border-gray-800 bg-gray-900">
                @if ($report->image)
                    <img src="{{ asset('storage/' . $report->image) }}" class="w-full object-cover max-h-96" alt="Gambar Laporan">
                @else
                    <div class="flex justify-center items-center h-64 bg-gray-800 text-gray-500">
                        <span>Tidak ada gambar</span>
                    </div>
                @endif
            </div>

            <!-- Informasi Utama -->
            <div class="bg-gray-900 rounded-xl p-6 border border-gray-800 shadow">
                <h3 class="text-xl font-bold text-white mb-4">{{ $report->type }}</h3>
                <p class="text-gray-300 mb-6">{{ $report->description }}</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-400">
                    <div>
                        <span class="block text-indigo-400 font-semibold">Lokasi</span>
                        {{ $report->village }}, {{ $report->subdistrict }}, {{ $report->regency }}, {{ $report->province }}
                    </div>
                    <div>
                        <span class="block text-indigo-400 font-semibold">Pelapor</span>
                        {{ $report->user->name }}
                    </div>
                    <div>
                        <span class="block text-indigo-400 font-semibold">Jumlah View</span>
                        {{ $report->views ?? 0 }}
                    </div>
                    <div>
                        <span class="block text-indigo-400 font-semibold">Status</span>
                        <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-medium
                            {{ $report->status === 'PROSES' ? 'bg-white text-black' :
                               ($report->status === 'DITOLAK' ? 'bg-red-600 text-white' :
                               ($report->status === 'SELESAI' ? 'bg-green-600 text-white' : 'bg-gray-600 text-white')) }}">
                            {{ ucfirst(strtolower($report->status)) }}
                        </span>
                    </div>
                </div>

                <!-- Tombol Like -->
                <div class="mt-6">
                    <form action="{{ route('user.reports.like', $report->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center text-indigo-400 hover:text-indigo-300">
                            @if ($report->isLikedBy(auth()->user()))
                                ❤️
                            @else
                                🤍
                            @endif
                            <span class="ml-2">({{ $report->likes->count() }})</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Progress Penanganan -->
            @if ($report->progress->isNotEmpty())
                <div class="bg-gray-900 rounded-xl p-6 border border-gray-800 shadow">
                    <h3 class="text-lg font-semibold text-white mb-4">Progress Penanganan</h3>
                    <div class="space-y-4">
                        @foreach ($report->progress as $progress)
                            <div class="p-4 border-l-4 border-indigo-500 bg-gray-800 rounded">
                                <p class="text-gray-200 text-sm"><strong>Ditindaklanjuti oleh:</strong> {{ $progress->staff->name ?? 'N/A' }}</p>
                                <p class="text-gray-400 text-sm mt-1">{{ $progress->description }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $progress->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Komentar -->
            <div class="bg-gray-900 rounded-xl p-6 border border-gray-800 shadow">
                <h3 class="text-lg font-semibold text-white mb-4">Komentar</h3>

                <!-- Form Komentar -->
                <form method="POST" action="{{ route('user.comments.store', $report->id) }}">
                    @csrf
                    <textarea name="content" rows="3" class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Tulis komentar...">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <div class="mt-3 text-right">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 px-4 py-2 rounded text-white">Kirim</button>
                    </div>
                </form>

                <!-- List Komentar -->
                <div class="mt-6 space-y-6">
                    @forelse ($comments as $comment)
                        <div class="border-b border-gray-700 pb-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-white font-semibold">{{ $comment->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                                @if (auth()->id() === $comment->user_id)
                                    <div class="flex space-x-2">
                                        <button onclick="document.getElementById('edit-{{ $comment->id }}').classList.toggle('hidden')" class="text-xs text-indigo-400 hover:text-indigo-300">Edit</button>
                                        <form method="POST" action="{{ route('user.comments.destroy', $comment) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-xs text-red-500 hover:text-red-400">Hapus</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            <p class="text-sm text-gray-300 mt-2">{{ $comment->content }}</p>

                            <!-- Form Edit -->
                            <div id="edit-{{ $comment->id }}" class="mt-3 hidden">
                                <form method="POST" action="{{ route('user.comments.update', $comment) }}" class="space-y-2">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="content" rows="2" class="w-full p-2 bg-gray-800 border border-gray-600 rounded-lg text-gray-200">{{ $comment->content }}</textarea>
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" onclick="document.getElementById('edit-{{ $comment->id }}').classList.add('hidden')" class="text-sm text-gray-400 hover:text-white">Batal</button>
                                        <button type="submit" class="text-sm text-white bg-indigo-600 hover:bg-indigo-500 px-3 py-1 rounded">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Belum ada komentar. Jadilah yang pertama!</p>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
