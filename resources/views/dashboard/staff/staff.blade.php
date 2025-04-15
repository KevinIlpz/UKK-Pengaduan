<x-app-layout class="bg-gradient-to-r from-gray-800 to-gray-700">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Dashboard Staff
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row justify-between gap-6 mb-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-gray-800 to-gray-700 rounded-xl p-6 flex-1 border border-gray-700">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-lg text-gray-300">Welcome back,</p>
                        <p class="text-2xl font-bold text-white mt-1">{{ auth()->user()->name }}</p>
                        <div class="mt-3 flex items-center">
                            <span class="bg-gray-700 text-blue-400 px-3 py-1 rounded-full text-sm">
                                {{ $reports->count() }} Laporan Belum Diselesaikan
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Export Button -->
            <!-- Export Buttons Vertical Small Layout -->
<div class="flex flex-col items-start space-y-3">
    <a href="{{ route('staff.reports.export.all') }}" class="flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-lg text-gray-300 hover:text-white transition-all duration-300 text-sm">
        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Export All Data
    </a>
    <a href="{{ route('staff.reports.export.month') }}" class="flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-lg text-gray-300 hover:text-white transition-all duration-300 text-sm">
        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Export 1 Bulan
    </a>
    <a href="{{ route('staff.reports.export.week') }}" class="flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-lg text-gray-300 hover:text-white transition-all duration-300 text-sm">
        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Export 1 Minggu
    </a>
</div>

        </div>

        <!-- Reports Section -->
        <div class="space-y-6">
            <!-- Status Messages -->
            @if (session('success'))
            <div class="p-4 bg-gray-800 border border-emerald-500/30 rounded-xl text-emerald-400 text-sm">
                {{ session('success') }}
            </div>
            @endif

            <!-- Reports Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($reports as $report)
                <div class="bg-gray-800 rounded-xl border border-gray-700 hover:border-gray-600 transition-colors duration-200">
                    <!-- Report Image -->
                    <div class="h-48 bg-gray-900 rounded-t-xl flex items-center justify-center overflow-hidden">
                        @if ($report->image)
                        <img src="{{ asset('storage/' . $report->image) }}" class="w-full h-full object-cover">
                        @else
                        <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        @endif
                    </div>

                    <!-- Report Content -->
                    <div class="p-5 space-y-4">
                        <!-- Status Badges -->
                        <div class="flex justify-between items-center">
                            <span class="px-3 py-1 text-sm rounded-full bg-gray-700 text-blue-400">
                                {{ $report->type }}
                            </span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                            {{ $report->status === 'PROSES' ? 'bg-yellow-100 text-yellow-800' :
                            ($report->status === 'DITOLAK' ? 'bg-red-100 text-red-800' :
                            ($report->status === 'SELESAI' ? 'bg-green-100 text-green-800' :
                            'bg-gray-100 text-gray-800')) }}">
                            {{ ucfirst(strtolower($report->status)) }}
                        </span>
                        </div>

                        <!-- Report Details -->
                        <div class="space-y-2">
                            <h4 class="text-lg font-semibold text-gray-100">{{ Str::limit($report->title, 50) }}</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">{{ Str::limit($report->description, 100) }}</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-between items-center pt-4">
                            @if ($report->status == 'PROSES')
                            <button onclick="showModal({{ $report->id }})"
                                class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-gray-300 hover:text-white transition-colors duration-200">
                                Take Action
                            </button>
                            @else
                            <span class="text-sm text-gray-500">Completed</span>
                            @endif

                            <a href="{{ route('staff.reports.export.single', $report->id) }}"
                               class="flex items-center text-gray-400 hover:text-emerald-400 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                <span class="text-sm">Export</span>
                            </a>

                        
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Action Modal -->
    <div id="modal" class="hidden fixed inset-0 bg-gray-900/80 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-gray-800 rounded-xl border border-gray-700 w-full max-w-md mx-4">
            <div class="p-6 border-b border-gray-700">
                <h3 class="text-lg font-semibold text-gray-100 flex items-center">
                    <svg class="w-5 h-5 text-blue-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Report Action
                </h3>
            </div>

            <form id="modalForm" method="POST" class="p-6 space-y-6">
                @csrf
                <input type="hidden" name="redirect_to_detail" value="1">

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300">Select Action</label>
                    <select name="status" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-gray-100
                              focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="PROSES">In Progress</option>
                        <option value="DITOLAK">Reject</option>
                        <option value="SELESAI">Mark Complete</option>
                    </select>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="hideModal()"
                            class="px-4 py-2 text-gray-300 hover:text-white transition-colors duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white transition-colors duration-200">
                        Confirm
                    </button>
                </div>
            </form>
            
        </div>
        
    </div>

    <script>
        function showModal(reportId) {
            const form = document.getElementById('modalForm');
            form.action = `/staff/reports/${reportId}/status`;
            document.getElementById('modal').classList.remove('hidden');
        }

        function hideModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
</x-app-layout>
