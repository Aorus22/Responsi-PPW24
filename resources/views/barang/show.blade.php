<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
@include('components.header')
<div class="container mx-auto mt-24 p-10">
    <div class="flex justify-center items-center mb-32 gap-4">
        <a href="{{ route('barang.index') }}" class="bg-cyan-700 hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded inline-block"><</a>
        <h1 class="text-4xl font-semibold mr-4">Detail Barang</h1>
    </div>
    <div class="flex items-center">
        <div class="w-1/2 flex justify-end">
            @if($barang->gambar)
            <div class="max-w-xs">
                <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang" class="w-full h-auto rounded-lg">
            </div>
            @else
            <div class="max-w-xs">
                <img src="https://oneshaf.com/wp-content/uploads/2021/08/placeholder.png" alt="Placeholder" class="w-full h-auto rounded-lg">
            </div>
            @endif
        </div>
        <div class="w-1/2 ml-8">
            <div class="mb-4">
                <h2 class="text-3xl font-semibold">{{ $barang->nama_barang }}</h2>
                <p class="text-lg text-gray-400">{{ $barang->deskripsi }}</p>
            </div>
            <div class="mb-4">
                <p><span class="font-semibold">Stok:</span> {{ $barang->stok }}</p>
                <p><span class="font-semibold">Harga: Rp</span> {{ number_format($barang->harga, 0, ',', '.') }}</p>
                <p><span class="font-semibold">Jenis Barang:</span> {{ $barang->jenisBarang ? $barang->jenisBarang->nama_jenis_barang : 'Tidak ada jenis barang' }}</p>
            </div>
            <div>
                <a href="{{ route('barang.edit', $barang->id) }}" class="bg-[#05a096] hover:bg-[#84d9d9] text-white font-bold py-2 px-4 rounded inline-block">Edit</a>
                <form id="delete-form-{{ $barang->id }}" action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete({{ $barang->id }})" class="bg-[#bf2929] hover:bg-[#ff4d4d] text-white font-bold py-2 px-4 rounded inline-block">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete(id) {
        if (confirm("Apakah yakin ingin menghapus barang ini?")) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
</body>
</html>
