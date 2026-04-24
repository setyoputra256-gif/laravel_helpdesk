<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tiket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white border-b px-6 py-4">
        <h1 class="text-xl font-semibold text-gray-800">Sistem Tiket</h1>
    </nav>
    <main class="max-w-5xl mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>