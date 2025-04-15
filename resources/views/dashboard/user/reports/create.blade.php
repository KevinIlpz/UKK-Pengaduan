<x-app-layout>
    <!-- Header Area with Minimalist Navigation -->
    <header class="bg-gray-800 py-4 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-white">Laporan Baru</h1>
            <a href="{{ route('dashboard.user') }}" class="flex items-center text-gray-300 hover:text-white transition">
                <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="text-lg">Dashboard</span>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="bg-gray-900 min-h-screen py-10">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="px-6 py-8 border-b border-gray-700">
                    <h2 class="text-2xl font-semibold text-white flex items-center">
                        Formulir Pengaduan
                    </h2>
                    <p class="mt-2 text-sm text-gray-400">Lengkapi data di bawah ini untuk mengirimkan laporan Anda.</p>
                </div>

                <!-- Form Section -->
                <form action="{{ route('user.reports.store') }}" method="POST" enctype="multipart/form-data" class="px-6 py-8 space-y-6">
                    @csrf

                    <!-- Deskripsi Laporan -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300">Deskripsi Laporan</label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="4" class="shadow focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-700 bg-gray-700 text-white rounded-md"></textarea>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Jelaskan detail pengaduan Anda.</p>
                    </div>

                    <!-- Jenis Laporan -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-300">Jenis Laporan</label>
                        <select id="type" name="type" class="mt-1 block w-full py-2 pl-3 pr-10 text-base bg-gray-700 border border-gray-700 text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="KEJAHATAN">Kejahatan</option>
                            <option value="PEMBANGUNAN">Pembangunan</option>
                            <option value="SOSIAL">Sosial</option>
                        </select>
                    </div>

                    <!-- Wilayah Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-300">Provinsi</label>
                            <select id="province" name="province" class="mt-1 block w-full py-2 pl-3 pr-10 bg-gray-700 text-white border border-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <!-- Options fetched from API -->
                            </select>
                        </div>
                        <div>
                            <label for="regency" class="block text-sm font-medium text-gray-300">Kabupaten/Kota</label>
                            <select id="regency" name="regency" class="mt-1 block w-full py-2 pl-3 pr-10 bg-gray-700 text-white border border-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <!-- Options fetched from API -->
                            </select>
                        </div>
                        <div>
                            <label for="subdistrict" class="block text-sm font-medium text-gray-300">Kecamatan</label>
                            <select id="subdistrict" name="subdistrict" class="mt-1 block w-full py-2 pl-3 pr-10 bg-gray-700 text-white border border-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <!-- Options fetched from API -->
                            </select>
                        </div>
                        <div>
                            <label for="village" class="block text-sm font-medium text-gray-300">Kelurahan/Desa</label>
                            <select id="village" name="village" class="mt-1 block w-full py-2 pl-3 pr-10 bg-gray-700 text-white border border-gray-700 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <!-- Options fetched from API -->
                            </select>
                        </div>
                    </div>

                    <!-- Upload Gambar with Preview -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300">Upload Gambar</label>
                        <div class="mt-3 flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-700 rounded-md bg-gray-800">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" />
                                </svg>
                                <div class="flex text-sm text-gray-400">
                                    <label for="image" class="relative cursor-pointer bg-gray-700 rounded-md font-medium text-indigo-400 hover:text-indigo-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-400">
                                        <span>Upload file</span>
                                        <input id="image" name="image" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">atau drag & drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF maksimal 2MB</p>
                            </div>
                            <!-- Image Preview Container -->
                            <div id="image-preview-container" class="mt-4 hidden">
                                <p class="text-sm text-gray-300 mb-2">Preview:</p>
                                <img id="image-preview" class="max-h-64 rounded-md shadow-md" alt="Preview Image">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button Positioned at Center -->
                    <div class="flex justify-center pt-4">
                        <button type="submit" class="flex items-center justify-center px-6 py-3 border border-transparent text-lg font-medium rounded-md text-gray-900 bg-indigo-400 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 transition">
                            <svg class="-ml-1 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                            </svg>
                            Kirim Pengaduan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- JavaScript to Fetch Wilayah Data and Handle Image Preview -->
    <script>
        // Fetch wilayah menggunakan API EMSIFA
        async function fetchWilayah(endpoint, targetSelect, parentId = null) {
            const url = parentId
                ? `https://www.emsifa.com/api-wilayah-indonesia/api/${endpoint}/${parentId}.json`
                : `https://www.emsifa.com/api-wilayah-indonesia/api/${endpoint}.json`;
            const response = await fetch(url);
            const data = await response.json();
            const select = document.getElementById(targetSelect);
            select.innerHTML = '<option value="">Pilih</option>';
            data.forEach(item => {
                select.innerHTML += `<option value="${item.name}" data-id="${item.id}">${item.name}</option>`;
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchWilayah('provinces', 'province');

            document.getElementById('province').addEventListener('change', function () {
                const selected = this.options[this.selectedIndex];
                if (selected.dataset.id) {
                    fetchWilayah('regencies', 'regency', selected.dataset.id);
                } else {
                    document.getElementById('regency').innerHTML = '<option value="">Pilih</option>';
                }
                document.getElementById('subdistrict').innerHTML = '<option value="">Pilih</option>';
                document.getElementById('village').innerHTML = '<option value="">Pilih</option>';
            });

            document.getElementById('regency').addEventListener('change', function () {
                const selected = this.options[this.selectedIndex];
                if (selected.dataset.id) {
                    fetchWilayah('districts', 'subdistrict', selected.dataset.id);
                } else {
                    document.getElementById('subdistrict').innerHTML = '<option value="">Pilih</option>';
                }
                document.getElementById('village').innerHTML = '<option value="">Pilih</option>';
            });

            document.getElementById('subdistrict').addEventListener('change', function () {
                const selected = this.options[this.selectedIndex];
                if (selected.dataset.id) {
                    fetchWilayah('villages', 'village', selected.dataset.id);
                } else {
                    document.getElementById('village').innerHTML = '<option value="">Pilih</option>';
                }
            });

            // Image preview functionality
            const imageInput = document.getElementById('image');
            const previewContainer = document.getElementById('image-preview-container');
            const previewImage = document.getElementById('image-preview');

            imageInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.addEventListener('load', function () {
                        previewImage.src = reader.result;
                        previewContainer.classList.remove('hidden');
                    }, false);

                    reader.readAsDataURL(file);
                } else {
                    previewContainer.classList.add('hidden');
                    previewImage.src = '';
                }
            });
        });
    </script>
</x-app-layout>
