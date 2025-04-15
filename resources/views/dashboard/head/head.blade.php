<x-app-layout>

    <div class="flex flex-col lg:flex-row gap-8 bg-gray-950 min-h-screen p-6">
        {{-- Left Sidebar --}}
        <div class="w-full lg:w-80 space-y-6">
            {{-- User Card --}}
            <div class="bg-gray-900 p-6 rounded-xl border border-gray-800">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-500/20 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Logged in as</p>
                        <p class="font-medium text-white">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <div class="mt-6 bg-gray-800 p-4 rounded-lg">
                    <p class="text-sm text-gray-400 flex justify-between">
                        <span>Pending Reports</span>
                        <span class="text-blue-400">{{ $onprogressReports }}</span>
                    </p>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="bg-gray-900 p-6 rounded-xl border border-gray-800 space-y-6">
                <div class="border-t border-gray-800 pt-6">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Total Staff</span>
                        <span class="text-white font-medium">{{ $totalStaff }}</span>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-6">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Total Users</span>
                        <span class="text-white font-medium">{{ $totalUsers }}</span>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-6">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Total Reports</span>
                        <span class="text-white font-medium">{{ $totalReports }}</span>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-6">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Completed Reports</span>
                        <span class="text-white font-medium">{{ $totalReports - $onprogressReports }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="flex-1 space-y-6">
            {{-- Chart Section --}}
            <div class="bg-gray-900 p-6 rounded-xl border border-gray-800">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-white">Regional Report Distribution</h3>
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                    </svg>
                </div>
                <div class="h-[27rem]">
                    <canvas id="provinceChart" class="w-full h-full"></canvas>
                </div>
            </div>
            
            {{-- Completed vs Uncompleted Chart --}}
            <div class="bg-gray-900 p-6 rounded-xl border border-gray-800">
                <h3 class="text-lg font-semibold text-white mb-6">Laporan Selesai vs Belum per Tipe</h3>
                <div class="h-[25rem] w-full">
                    <canvas id="completedChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        const labels = {!! json_encode($complaintsPerProvince->keys()) !!};
    const data = {!! json_encode($complaintsPerProvince->values()) !!};

    function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

const backgroundColors = labels.map(() => getRandomColor());

const ctx = document.getElementById('provinceChart').getContext('2d');
new Chart(ctx, {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            label: 'Reports',
            data: data,
            backgroundColor: backgroundColors,
            borderColor: '#1D4ED8',
            borderWidth: 1,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: true },
            tooltip: {
                backgroundColor: '#111827',
                titleColor: '#9CA3AF',
                bodyColor: '#E5E7EB',
                borderColor: '#374151',
                borderWidth: 1
            }
        }
    }
});
        

    const ctxCompleted = document.getElementById('completedChart').getContext('2d');

    new Chart(ctxCompleted, {
        type: 'bar',
        data: {
            labels: {!! json_encode($reportTypes) !!},
            datasets: [
                {
                    label: 'Laporan Selesai',
                    data: {!! json_encode(array_values($completedReportsByType->toArray())) !!},
                    backgroundColor: '#10B981'
                },
                {
                    label: 'Laporan Belum Selesai',
                    data: {!! json_encode(array_values($uncompletedReportsByType->toArray())) !!},
                    backgroundColor: '#EF4444'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#E5E7EB'
                    }
                },
                tooltip: {
                    backgroundColor: '#111827',
                    titleColor: '#9CA3AF',
                    bodyColor: '#E5E7EB',
                    borderColor: '#374151',
                    borderWidth: 1
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#9CA3AF'
                    },
                    grid: {
                        color: '#374151'
                    }
                },
                x: {
                    ticks: {
                        color: '#9CA3AF'
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });


    </script>
</x-app-layout>