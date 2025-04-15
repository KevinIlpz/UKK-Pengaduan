<x-app-layout>
        <div class="bg-gray-900 py-4 border-b border-gray-800">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight px-6">
                Kelola Staff
            </h2>
        </div>

    <div class="py-6 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">
                @if(session('success'))
                    <div class="p-4 bg-gray-800 border border-emerald-500/30 rounded-xl text-emerald-400 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="border border-gray-800 rounded-xl overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-800">
                        <thead class="bg-gray-850">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-400 uppercase tracking-wider">
                                    Nama Staff
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-400 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-4 text-right text-sm font-medium text-gray-400 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-800">
                            @forelse ($staff as $user)
                                <tr class="hover:bg-gray-850 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-300">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end items-center gap-4">
                                            <a href="{{ route('headstaff.staff.edit', $user->id) }}"
                                               class="text-gray-400 hover:text-blue-400 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('headstaff.staff.destroy', $user->id) }}" method="POST"
                                                  onsubmit="return confirm('Hapus staff ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-400 transition-colors duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center">
                                        <div class="text-gray-500 text-sm">Belum ada data staff</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col-reverse sm:flex-row justify-between gap-6">
                    @if ($staff->hasPages())
                        <div class="flex-1">
                            {{ $staff->links('vendor.pagination.simple-dark') }}
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('headstaff.staff.create') }}"
                           class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 border border-blue-500 rounded-lg text-white transition-all duration-300
                                  flex items-center gap-2 justify-center
                                  shadow-lg hover:shadow-blue-500/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah Staff
                        </a>

                        <a href="{{ route('headstaff.staff.export') }}"
                        class="px-5 py-2.5 bg-transparent hover:bg-emerald-600 border-2 border-emerald-500 rounded-lg text-emerald-400 hover:text-white
                               transition-all duration-300 flex items-center gap-2 justify-center
                               hover:border-emerald-600 shadow hover:shadow-emerald-500/10">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                         </svg>
                         Export Excel
                     </a>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
