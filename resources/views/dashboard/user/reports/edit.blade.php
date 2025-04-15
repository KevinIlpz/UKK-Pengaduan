<x-app-layout>
    <x-slot name="header">
      <header class="bg-gray-900 border-b border-gray-800 py-6 px-6 flex justify-between items-center">
        <h1 class="text-3xl text-white font-semibold">Update Report</h1>
        <a href="{{ route('dashboard.user') }}" class="flex items-center text-sm text-gray-400 hover:text-white transition">
          <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 00-1.414-1.414L6.586 8.586a1 1 0 000 1.414l4.707 4.707a1 1 0 001.414-1.414L9.414 10l3.293-3.293z" clip-rule="evenodd" />
          </svg>
          Kembali Dashboard
        </a>
      </header>
    </x-slot>

    <main class="min-h-screen bg-gray-800 text-white py-10">
      <div class="max-w-3xl mx-auto px-6 space-y-8">
        <!-- Form Card -->
        <section class="bg-gray-800 border border-gray-700 rounded-lg shadow p-6">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Edit Laporanmu</h2>
            <button type="submit" form="reportForm" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg font-medium transition">
              Save Changes
            </button>
          </div>
          <p class="text-gray-400 text-sm mb-4">Lihat dan Edit Laporanmu.</p>

          <form id="reportForm" action="{{ route('user.reports.update', $report->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Report Description -->
            <div>
              <label for="description" class="block text-sm font-medium text-gray-300">Deskripsi Laporanmu</label>
              <textarea id="description" name="description" rows="4" class="mt-1 w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $report->description) }}</textarea>
            </div>

            <!-- Report Category -->
            <div>
              <label for="type" class="block text-sm font-medium text-gray-300">Kategori</label>
              <select id="type" name="type" class="mt-1 w-full bg-gray-700 border border-gray-600 rounded-md px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="KEJAHATAN" {{ $report->type == 'KEJAHATAN' ? 'selected' : '' }}>Kejahatan</option>
                <option value="PEMBANGUNAN" {{ $report->type == 'PEMBANGUNAN' ? 'selected' : '' }}>Pembangunan</option>
                <option value="SOSIAL" {{ $report->type == 'SOSIAL' ? 'selected' : '' }}>Sosial</option>
              </select>
            </div>

            <!-- Location Dropdowns -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="province" class="block text-sm font-medium text-gray-300">Province</label>
                <select id="province" name="province" class="mt-1 w-full bg-gray-700 border border-gray-600 rounded-md px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"></select>
              </div>
              <div>
                <label for="regency" class="block text-sm font-medium text-gray-300">City/Regency</label>
                <select id="regency" name="regency" class="mt-1 w-full bg-gray-700 border border-gray-600 rounded-md px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"></select>
              </div>
              <div>
                <label for="subdistrict" class="block text-sm font-medium text-gray-300">Subdistrict</label>
                <select id="subdistrict" name="subdistrict" class="mt-1 w-full bg-gray-700 border border-gray-600 rounded-md px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"></select>
              </div>
              <div>
                <label for="village" class="block text-sm font-medium text-gray-300">Village</label>
                <select id="village" name="village" class="mt-1 w-full bg-gray-700 border border-gray-600 rounded-md px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"></select>
              </div>
            </div>

            <!-- Current Image -->
            <div>
              <label class="block text-sm font-medium text-gray-300">Current Image</label>
              @if($report->image)
                <div class="mt-2">
                  <img src="{{ asset('storage/' . $report->image) }}" alt="Current Report Image" class="h-32 w-auto object-cover rounded-md border border-gray-600">
                </div>
              @else
                <p class="mt-2 text-sm text-gray-500">No image available</p>
              @endif
            </div>

            <!-- Upload New Image -->
            <div>
              <label for="image" class="block text-sm font-medium text-gray-300">Upload New Image (optional)</label>
              <div class="mt-2 flex justify-center px-4 py-6 border-2 border-dashed border-gray-600 rounded-md bg-gray-700">
                <div class="space-y-2 text-center">
                  <svg class="mx-auto h-10 w-10 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"></path>
                  </svg>
                  <div class="flex items-center justify-center gap-2 text-sm text-gray-300">
                    <label for="image" class="cursor-pointer bg-indigo-600 hover:bg-indigo-500 rounded-md px-3 py-1 font-medium">
                      Browse File
                      <input id="image" name="image" type="file" class="hidden">
                    </label>
                    <span>or drag &amp; drop</span>
                  </div>
                  <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                </div>
              </div>
            </div>
          </form>
        </section>
      </div>
    </main>

    <!-- JavaScript for Regional API -->
    <script>
      const selectedProvince = @json($report->province);
      const selectedRegency = @json($report->regency);
      const selectedSubdistrict = @json($report->subdistrict);
      const selectedVillage = @json($report->village);

      async function fetchWilayah(endpoint, targetSelect, parentId = null, selectedValue = null) {
        const url = parentId
          ? `https://www.emsifa.com/api-wilayah-indonesia/api/${endpoint}/${parentId}.json`
          : `https://www.emsifa.com/api-wilayah-indonesia/api/${endpoint}.json`;

        try {
          const response = await fetch(url);
          const data = await response.json();
          const select = document.getElementById(targetSelect);
          select.innerHTML = '<option value="">Select</option>';

          data.forEach(item => {
            const selected = item.name === selectedValue ? 'selected' : '';
            select.innerHTML += `<option value="${item.name}" data-id="${item.id}" ${selected}>${item.name}</option>`;
          });
        } catch (error) {
          console.error('Error fetching wilayah:', error);
        }
      }

      document.addEventListener('DOMContentLoaded', async () => {
        await fetchWilayah('provinces', 'province', null, selectedProvince);

        const provinceSelect = document.getElementById('province');
        const provinceId = provinceSelect.querySelector('option:checked')?.dataset?.id;
        if (provinceId) {
          await fetchWilayah('regencies', 'regency', provinceId, selectedRegency);
          const regencySelect = document.getElementById('regency');
          const regencyId = regencySelect.querySelector('option:checked')?.dataset?.id;
          if (regencyId) {
            await fetchWilayah('districts', 'subdistrict', regencyId, selectedSubdistrict);
            const subdistrictSelect = document.getElementById('subdistrict');
            const subdistrictId = subdistrictSelect.querySelector('option:checked')?.dataset?.id;
            if (subdistrictId) {
              await fetchWilayah('villages', 'village', subdistrictId, selectedVillage);
            }
          }
        }

        provinceSelect.addEventListener('change', async function () {
          const selected = this.options[this.selectedIndex];
          if (selected.dataset.id) {
            await fetchWilayah('regencies', 'regency', selected.dataset.id);
            document.getElementById('subdistrict').innerHTML = '<option value="">Select</option>';
            document.getElementById('village').innerHTML = '<option value="">Select</option>';
          }
        });

        document.getElementById('regency').addEventListener('change', async function () {
          const selected = this.options[this.selectedIndex];
          if (selected.dataset.id) {
            await fetchWilayah('districts', 'subdistrict', selected.dataset.id);
            document.getElementById('village').innerHTML = '<option value="">Select</option>';
          }
        });

        document.getElementById('subdistrict').addEventListener('change', async function () {
          const selected = this.options[this.selectedIndex];
          if (selected.dataset.id) {
            await fetchWilayah('villages', 'village', selected.dataset.id);
          }
        });
      });
    </script>
  </x-app-layout>
