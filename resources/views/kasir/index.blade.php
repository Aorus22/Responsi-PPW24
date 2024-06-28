<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir - Daftar Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
@include('components.header')

<div class="container mx-auto mt-24 p-10">
    <div class="grid grid-cols-3 gap-8">
        @foreach($barang as $item)
            <div class="bg-gray-800 border border-gray-700 p-4 rounded-lg">
                <div class="w-full flex justify-center">
                    @if($item->gambar)
                    <div class="max-w-full">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Barang" class="h-48 w-auto rounded-lg">
                    </div>
                    @else
                    <div class="max-w-full">
                        <img src="https://oneshaf.com/wp-content/uploads/2021/08/placeholder.png" alt="Placeholder" class="h-48 w-auto rounded-lg">
                    </div>
                    @endif
                </div>
                <div class="w-full text-center my-4">
                    <h2 class="text-xl font-semibold">{{ $item->nama_barang }}</h2>
                </div>
                <p class="text-gray-400">{{ $item->deskripsi }}</p>
                <p class="text-white mt-2">Stok: {{ $item->stok }}</p>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-lg font-bold text-[#0891b2]">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                    <button onclick="addToCart({{ $item->id }})" class="bg-cyan-700 hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded">Masukkan Keranjang</button>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-80 flex justify-center items-center">
    <div class="bg-gray-900 p-8 rounded-lg max-w-md">
        <h2 class="text-2xl font-semibold mb-4">Masukkan Jumlah Barang</h2>
        <form id="add-to-cart-form" action="{{ route('addToCart') }}" method="POST">
            @csrf
            <input type="hidden" id="barang_id" name="barang_id">
            <label for="jumlah" class="block mb-2">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" class="w-full px-3 py-2 text-black border rounded-lg focus:outline-none focus:ring focus:border-cyan-500" required>
            <div class="mt-4 flex justify-end">
                <button type="button" onclick="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">Batal</button>
                <button type="submit" class="bg-cyan-700 hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded-lg">Tambah</button>
            </div>
        </form>
    </div>
</div>

<!-- Tombol Keranjang -->
<div class="fixed bottom-10 right-10">
    <a href="{{ route('keranjang') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">Keranjang</a>
</div>

<script>
    function addToCart(barangId) {
        document.getElementById('barang_id').value = barangId;
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
</script>

</body>
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

</html>
