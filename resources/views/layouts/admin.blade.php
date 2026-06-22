<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Nyalse</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 flex min-h-screen">

    <aside class="w-64 bg-gray-900 text-white flex flex-col hidden md:flex">
        <div class="h-16 flex items-center justify-center border-b border-gray-800">
            <h2 class="text-xl font-bold text-amber-500">NYALSE ADMIN</h2>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="#" class="block px-4 py-2 rounded bg-gray-800 text-white font-medium">Dashboard</a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-800 text-gray-300 transition">Inventory</a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-800 text-gray-300 transition">Rentals</a>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col">
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6">
            <div class="font-semibold text-gray-800">Administrator</div>
            <div>
                <button class="text-sm text-gray-500 hover:text-red-600">Log Out</button>
            </div>
        </header>

        <main class="p-6 flex-1 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

</body>
</html>