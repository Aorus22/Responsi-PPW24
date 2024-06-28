<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
@include('components.header')

<div class="container mx-auto mt-16 p-10">
    <div class="flex flex-col justify-center items-center mb-4">
        @if(count($keranjang) > 0)
            <div class="flex justify-center items-center mb-4 gap-4">
                <a href="{{ route('kasir') }}" class="bg-cyan-700 hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded inline-block"><</a>
                <h1 class="text-4xl font-semibold mr-4">Keranjang</h1>
            </div>
            <form id="checkoutForm" action="{{ route('checkout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-cyan-700 hover:bg-cyan-800 text-white mb-8 font-bold py-2 px-4 rounded">Checkout</button>
            </form>
        @else
            <h1 class="text-4xl font-semibold mb-4">Keranjang</h1>
            <p class="text-xl text-gray-400 mb-4">Keranjang kosong. Silakan tambahkan barang terlebih dahulu.</p>
            <a href="{{ route('kasir') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Kembali ke Kasir</a>
        @endif
    </div>

    @if(count($keranjang) > 0)
        <div class="grid grid-cols-2 gap-8">
            @foreach($keranjang as $key => $item)
                <div id="item_{{ $key }}" class="bg-gray-800 border border-gray-700 p-4 rounded-lg">
                    <h2 class="text-xl font-semibold">{{ $item["nama_barang"] }}</h2>
                    <p class="text-gray-400">Jumlah: <span class="jumlah" id="jumlah_{{ $key }}">{{ $item["jumlah"] }}</span></p>
                    <p class="text-gray-400">Harga Satuan: Rp{{ number_format($item["harga"], 0, ',', '.') }}</p>
                    <p class="text-gray-400">Total Harga: Rp<span class="total" id="total_{{ $key }}">{{ number_format($item["jumlah"] * $item["harga"], 0, ',', '.') }}</span></p>
                    <div class="mt-4 flex justify-between">
                        <button onclick="openModal('{{ $key }}')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Ubah Jumlah</button>
                        <form action="{{ route('removeFromCart', ['key' => $key]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?');">
                            @csrf
                            <button type="submit" class="bg-[#bf2929] hover:bg-[#ff4d4d] text-white font-bold py-2 px-4 rounded">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="my-8 flex justify-center item-center text-center">
            <div>
                <h2 class="text-2xl font-semibold mb-2">Total Harga</h2>
                <div class="bg-cyan-900 text-white px-4 py-2 rounded-lg">
                    <p class="text-2xl font-bold">Rp<span id="totalSemua">0</span></p>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-gray-900 p-8 rounded-lg max-w-md">
                <h2 class="text-2xl font-semibold mb-4">Masukkan Jumlah Barang</h2>
                <form id="update-cart-form" action="{{ route('updateCartItem') }}" method="POST">
                    @csrf
                    <input type="hidden" id="barang_id" name="barang_id">
                    <label for="jumlah" class="block mb-2">Jumlah:</label>
                    <input type="number" id="jumlah" name="jumlah" class="w-full px-3 py-2 text-black border rounded-lg focus:outline-none focus:ring focus:border-blue-500" required>
                    <div class="mt-4 flex justify-end">
                        <button type="button" onclick="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">Batal</button>
                        <button type="submit" class="bg-cyan-700 hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded-lg">Ubah</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openModal(key) {
                document.getElementById('barang_id').value = key;
                document.getElementById('modal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('modal').classList.add('hidden');
            }

            window.onload = function() {
                updateTotal();
            };

            function updateTotal() {
                let total = 0;
                document.querySelectorAll('[id^=total_]').forEach(function(element) {
                    total += parseInt(element.innerText.replace(/\./g, ''));
                });
                document.getElementById('totalSemua').innerText = formatRupiah(total);
            }

            function formatRupiah(angka) {
                var reverse = angka.toString().split('').reverse().join('');
                var ribuan = reverse.match(/\d{1,3}/g);
                var formatted = ribuan.join('.').split('').reverse().join('');
                return formatted;
            }
        </script>
    @endif
</div>
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
