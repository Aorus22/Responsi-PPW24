<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
@include('components.header')
<div class="container mx-auto mt-32 px-4">
    <div class="bg-gray-800 rounded-lg p-8">
        <h1 class="text-4xl font-extrabold mb-8 text-center">Selamat Datang di Toko Barang</h1>
        <div class="flex justify-center">
            <a href="{{ route('kasir') }}" class="inline-block bg-cyan-700 hover:bg-cyan-800 text-white font-semibold py-3 px-6 rounded-md transition duration-300 ease-in-out transform hover:scale-105">Beli Sekarang</a>
        </div>
    </div>
</div>
</body>
</html>
