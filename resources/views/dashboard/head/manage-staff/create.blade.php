<x-app-layout>
    <div class="py-8 bg-gray-900 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-8 rounded-xl border border-gray-700 shadow-xl">
                <form action="{{ route('headstaff.staff.store') }}" method="POST" class="space-y-8">
                    @csrf


                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Nama Lengkap</label>
                        <input
                            type="text"
                            name="name"
                            class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Masukkan nama lengkap"
                            required
                        >
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Alamat Email</label>
                        <input
                            type="email"
                            name="email"
                            class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="contoh@email.com"
                            required
                        >
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Provinsi Staff</label>
                        <select
                            name="staff_province"
                            id="staff_province"
                            class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            required
                        >
                            <option value="">Memuat daftar provinsi...</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-300">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="Minimal 8 karakter"
                                required
                            >
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-300">Konfirmasi Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="Ulangi password"
                                required
                            >
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-medium
                               transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <div class="flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293z"/>
                            </svg>
                            <span>Simpan Data Staff</span>
                        </div>
                    </button>

                    <div class="mb-8">
                        <a href="{{ route('headstaff.staff.index') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Kembali ke Daftar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectProvinsi = document.getElementById('staff_province');

            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(response => response.json())
                .then(data => {
                    selectProvinsi.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
                    data.forEach(provinsi => {
                        const option = document.createElement('option');
                        option.value = provinsi.name;
                        option.textContent = provinsi.name;
                        selectProvinsi.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Gagal memuat provinsi:', error);
                    selectProvinsi.innerHTML = '<option value="">Gagal memuat provinsi</option>';
                });
        });
    </script>

</x-app-layout>
