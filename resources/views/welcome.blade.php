<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Suara Warga</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-950 text-gray-100">

  <!-- Header -->
  <header class="bg-gray-900 shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-white tracking-wide">📢 Suara Warga</h1>
      <div>
        <a href="{{ route('login') }}" class="text-sm px-4 py-2 border border-gray-600 rounded hover:bg-gray-800 transition">Masuk</a>
        <a href="{{ route('register') }}" class="text-sm ml-3 px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-400 transition">Daftar</a>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="bg-gradient-to-br from-gray-800 to-gray-900 py-24">
    <div class="max-w-5xl mx-auto px-6 text-center">
      <h2 class="text-4xl sm:text-5xl font-extrabold mb-6 leading-tight">
        Bersama Wujudkan Perubahan Nyata
      </h2>
      <p class="text-lg sm:text-xl text-gray-300 mb-8">
        Laporkan kejadian, keluhan, atau permasalahan di sekitar Anda dengan mudah. Kami siap mendengarkan dan bertindak.
      </p>
      <a href="{{ route('register') }}" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-full font-semibold transition shadow-lg">
        Kirim Laporan
      </a>
    </div>
  </section>

  <!-- Laporan Terbaru -->
  <section class="max-w-7xl mx-auto px-6 py-20">
    <div class="text-center mb-12">
      <h3 class="text-3xl font-bold">Laporan Publik Terkini</h3>
      <p class="text-gray-400 mt-2">Ikuti perkembangan laporan yang telah disampaikan oleh warga</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach ($reports as $report)
        <div class="bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 border border-gray-700">
          <div class="h-48 overflow-hidden">
            <img
              src="{{ asset('storage/' . $report->image) }}"
              alt="Foto Laporan"
              class="object-cover w-full h-full"
              onerror="this.src='https://via.placeholder.com/600x400?text=No+Image';"
            >
          </div>
          <div class="p-5 flex flex-col justify-between h-60">
            <div>
              <h4 class="text-xl font-semibold mb-1 truncate">{{ $report->title }}</h4>
              <span class="inline-block text-xs px-2 py-1 rounded bg-gray-700 text-gray-300 mb-2">{{ $report->type }}</span>
              <p class="text-sm text-gray-400 mb-3 line-clamp-3">{{ Str::limit($report->description, 100) }}</p>
            </div>
            <div class="flex justify-between items-center text-sm">
              <span class="@if($report->status == 'SELESAI') text-green-400 @elseif($report->status == 'PROSES') text-yellow-300 @else text-red-400 @endif font-semibold">
                Status: {{ $report->status }}
              </span>
              <span class="text-gray-500 text-xs">{{ $report->created_at->format('d M Y') }}</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-6 bg-gray-900 border-t border-gray-800">
    <div class="container mx-auto px-4 text-center">
      <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Suara Warga. Semua hak dilindungi.</p>
    </div>
  </footer>
</body>
</html>
