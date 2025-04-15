<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white min-h-screen flex">

    <!-- Left: Illustration or Image -->
    <div class="hidden md:flex w-1/2 bg-gradient-to-tr from-indigo-400 to-blue-500 items-center justify-center p-10">
        <div class="text-white text-center max-w-md">
            <h2 class="text-3xl font-bold mb-4">Selamat Datang Kembali!</h2>
            <p class="text-lg">Akses dashboard dan kelola semuanya dengan mudah dan cepat.</p>
        </div>
    </div>

    <!-- Right: Login Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md space-y-6">
            <div class="text-center">
                <h1 class="text-2xl font-semibold text-gray-800">Login ke Akun Anda</h1>
                <p class="text-sm text-gray-500">Silakan masuk untuk melanjutkan</p>
            </div>

            @if (session('status'))
                <div class="bg-green-100 border border-green-300 text-green-700 text-sm p-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" required autofocus
                        class="w-full px-4 py-3 rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm placeholder-gray-400"
                        placeholder="you@example.com">
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-4 py-3 rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm placeholder-gray-400"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Options -->
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md font-medium shadow-sm transition">
                    Masuk
                </button>
            </form>

            <p class="text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Daftar sekarang</a>
            </p>
        </div>
    </div>

</body>
</html>
