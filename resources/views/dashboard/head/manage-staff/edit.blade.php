<x-app-layout>
    <div class="py-8 bg-gray-900 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Form Container -->
            <div class="bg-gray-800 p-8 rounded-xl border border-gray-700 shadow-xl">
                <form action="{{ route('headstaff.staff.update', $user) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Name Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Nama Lengkap</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Masukkan nama lengkap"
                            required
                        >
                    </div>

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Alamat Email</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="contoh@email.com"
                            required
                        >
                    </div>

                    <!-- Staff Province Field -->
                    <div class="space-y-2">
                        <label for="province" class="block text-sm font-medium text-gray-300">Provinsi Staff</label>
                        <select
                            id="province"
                            name="staff_province"
                            class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        >
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>

                    <!-- Password Group -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Password Field -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-300">
                                Password Baru <span class="text-gray-500">(opsional)</span>
                            </label>
                            <input
                                type="password"
                                name="password"
                                class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="Biarkan kosong"
                            >
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-300">Konfirmasi Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="Ulangi password baru"
                            >
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-medium
                               transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <div class="flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293z"/>
                            </svg>
                            <span>Simpan Perubahan</span>
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
        async function fetchWilayah(endpoint, targetSelect) {
            const url = `https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`;
            const response = await fetch(url);
            const data = await response.json();
            const select = document.getElementById(targetSelect);
            select.innerHTML = '<option value="">Pilih Provinsi</option>';
            data.forEach(item => {
                select.innerHTML += `<option value="${item.name}">${item.name}</option>`;
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Memanggil API untuk mengambil data provinsi,
            // kemudian set nilai yang sudah tersimpan pada user (jika ada)
            fetchWilayah('provinces', 'province').then(() => {
                const selectedProvince = "{{ old('staff_province', $user->staff_province) }}";
                if(selectedProvince) {
                    document.getElementById('province').value = selectedProvince;
                }
            });
        });
    </script>
</x-app-layout>
