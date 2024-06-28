<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
@include('components.header')

<div class="container mx-auto mt-16 p-10">
    <div class="flex flex-col justify-center items-center mb-4">
        <h1 class="text-5xl font-semibold mr-4 mb-5">List Barang</h1>
        <a href="{{ route('barang.create') }}" class="bg-cyan-700 hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded inline-block">Tambah Barang</a>
    </div>
    <table class="table-auto w-full bg-gray-800 border border-gray-700 rounded-lg">
        <thead>
        <tr class="bg-gray-700">
            <th class="px-4 py-2 border-b border-gray-600">No</th>
            <th class="px-4 py-2 border-b border-gray-600">Id</th>
            <th class="px-4 py-2 border-b border-gray-600">Nama Barang</th>
            <th class="px-4 py-2 border-b border-gray-600">Deskripsi</th>
            <th class="px-4 py-2 border-b border-gray-600">Stok</th>
            <th class="px-4 py-2 border-b border-gray-600">Harga</th>
            <th class="px-4 py-2 border-b border-gray-600">Jenis Barang</th>
            <th class="px-4 py-2 border-b border-gray-600">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($barang as $index => $item)
            <tr>
                <td class="border-b px-4 py-2 border-gray-600">{{ $index + 1 }}</td>
                <td class="border-b px-4 py-2 border-gray-600">{{ $item->id }}</td>
                <td class="border-b px-4 py-2 border-gray-600">{{ $item->nama_barang }}</td>
                <td class="border-b px-4 py-2 border-gray-600">{{ $item->deskripsi }}</td>
                <td class="border-b px-4 py-2 border-gray-600">{{ $item->stok }}</td>
                <td class="border-b px-4 py-2 border-gray-600">{{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="border-b px-4 py-2 border-gray-600">
                    @if($item->jenisBarang)
                        {{ $item->jenisBarang->nama_jenis_barang }}
                    @else
                        Tidak ada jenis barang
                    @endif
                </td>
                <td class="border-b border-gray-600 px-4 py-2 h-full">
                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('barang.show', $item->id) }}" class="bg-[#084443] hover:bg-[#05a096] text-white font-bold py-2 px-4 rounded inline-block">Detail</a>
                        <a href="{{ route('barang.edit', $item->id) }}" class="bg-[#05a096] hover:bg-[#84d9d9] text-white font-bold py-2 px-4 rounded inline-block">Edit</a>
                        <form id="delete-form-{{ $item->id }}" action="{{ route('barang.destroy', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $item->id }})" class="bg-[#bf2929] hover:bg-[#ff4d4d] text-white font-bold py-2 px-4 rounded inline-block">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
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
