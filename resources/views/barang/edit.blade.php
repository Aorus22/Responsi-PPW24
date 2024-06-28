<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex justify-center items-center min-h-screen p-10">
<div class="w-full max-w-md h-auto bg-gray-800 rounded-lg p-8">
    <div class="flex justify-center items-center mb-4 gap-4">
        <a href="{{ route('barang.index') }}" class="bg-cyan-700 hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded inline-block"><</a>
        <h1 class="text-4xl font-semibold mr-4">Edit Barang</h1>
    </div>
    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-6">
            <label for="nama_barang" class="block text-sm font-medium mb-2">Nama Barang:</label>
            <input type="text" class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}">
        </div>
        <div class="mb-6">
            <label for="deskripsi" class="block text-sm font-medium mb-2">Deskripsi:</label>
            <input type="text" class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="deskripsi" name="deskripsi" value="{{ $barang->deskripsi }}">
        </div>
        <div class="mb-6">
            <label for="stok" class="block text-sm font-medium mb-2">Stok:</label>
            <input type="number" class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="stok" name="stok" value="{{ $barang->stok }}">
        </div>
        <div class="mb-6">
            <label for="harga" class="block text-sm font-medium mb-2">Harga:</label>
            <input type="number" class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="harga" name="harga" value="{{ $barang->harga }}" step="1000">
        </div>
        <div class="mb-6">
            <label for="jenis_barang_id" class="block text-sm font-medium mb-2">Jenis Barang:</label>
            <select class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="jenis_barang_id" name="jenis_barang_id">
                @foreach($jenisBarang as $jenis)
                    <option value="{{ $jenis->id }}" {{ $barang->jenis_barang_id == $jenis->id ? 'selected' : '' }}>{{ $jenis->nama_jenis_barang }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label for="gambar" class="block text-sm font-medium mb-2">Gambar:</label>
            <input type="file" class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="gambar" name="gambar">
            @if($barang->gambar)
                <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang" class="mt-4 w-32 h-32 object-cover">
            @endif
        </div>
        <button type="submit" class="w-full py-2 px-4 bg-cyan-700 hover:bg-cyan-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">Update</button>
    </form>
</div>
</body>
</html>
