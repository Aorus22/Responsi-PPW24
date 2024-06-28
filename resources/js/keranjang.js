window.onload = function() {
    updateTotal();
};

function ubahJumlah(key, operasi) {
    let jumlahElement = document.getElementById('jumlah_' + key);
    let totalElement = document.getElementById('total_' + key);
    let jumlah = parseInt(jumlahElement.innerText);
    let harga = parseInt('{{ $keranjang[$key]["harga"] }}');

    fetch('/update-cart-item', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ key: key, operation: operasi })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal memperbarui jumlah barang');
            }
            return response.json();
        })
        .then(data => {
            if (operasi === 'tambah') {
                jumlah++;
            } else if (operasi === 'kurang' && jumlah > 1) {
                jumlah--;
            }

            jumlahElement.innerText = jumlah;
            totalElement.innerText = formatRupiah(jumlah * harga);

            updateTotal();
        })
        .catch(error => {
            console.error('Terjadi kesalahan: ' + error);
            alert('Terjadi kesalahan: ' + error);
        });
}

function hapusItem(key) {
    let itemElement = document.getElementById('item_' + key);
    itemElement.parentNode.removeChild(itemElement);

    updateTotal();

    fetch('/remove-from-cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ key: key })
    })
        .then(response => {
            if (!response.ok) {
                alert('Gagal menghapus item');
            }
            alert('Item berhasil dihapus dari keranjang');
        })
        .catch(error => {
            console.error('Terjadi kesalahan: ' + error);
        });
}

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
