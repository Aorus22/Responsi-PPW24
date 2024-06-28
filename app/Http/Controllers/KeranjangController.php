<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Routing\Controller;

class KeranjangController extends Controller
{
    public function addToCart(Request $request)
    {
        $barangId = $request->input('barang_id');
        $jumlah = $request->input('jumlah');

        $barang = Barang::find($barangId);

        if (!$barang) {
            return back()->with('error', 'Barang tidak ditemukan.');
        }

        $keranjang = session()->get('keranjang', []);

        $itemKeranjang = [
            'barang_id' => $barangId,
            'nama_barang' => $barang->nama_barang,
            'jumlah' => $jumlah,
            'harga' => $barang->harga,
        ];

        $keranjang[] = $itemKeranjang;
        session()->put('keranjang', $keranjang);

        return back()->with('success', 'Barang berhasil ditambahkan ke keranjang.');
    }

    public function showCart()
    {
        $keranjang = session()->get('keranjang', []);
        return view('kasir.keranjang', ['keranjang' => $keranjang]);
    }

    public function removeFromCart(Request $request)
    {
        $key = $request->input('key');

        $keranjang = session()->get('keranjang', []);

        if (array_key_exists($key, $keranjang)) {
            unset($keranjang[$key]);
            session()->put('keranjang', $keranjang);
            return redirect()->route('keranjang')->with('success', 'Item berhasil dihapus dari keranjang.');
        } else {
            return redirect()->route('keranjang')->with('error', 'Item tidak ditemukan dalam keranjang.');
        }
    }

    public function updateCartItem(Request $request)
    {
        $barang_id = $request->input('barang_id');
        $jumlah = $request->input('jumlah');

        $keranjang = session()->get('keranjang');

        if (!isset($keranjang[$barang_id])) {
            return redirect()->route('keranjang')->with('error', 'Item tidak ditemukan dalam keranjang.');
        }

        $item = $keranjang[$barang_id];
        $item['jumlah'] = $jumlah;

        $keranjang[$barang_id] = $item;
        session()->put('keranjang', $keranjang);

        return redirect()->route('keranjang')->with('success', 'Jumlah barang berhasil diperbarui.');
    }

    public function checkout()
    {
        $keranjang = session()->get('keranjang', []);

        if (empty($keranjang)) {
            return back()->with('error', 'Keranjang belanja kosong. Tidak dapat melakukan checkout.');
        }

        foreach ($keranjang as $item) {
            $barang = Barang::find($item['barang_id']);

            if (!$barang) {
                return back()->with('error', 'Barang tidak ditemukan: ' . $item['nama_barang']);
            }

            if ($barang->stok < $item['jumlah']) {
                return back()->with('error', 'Stok barang tidak mencukupi untuk: ' . $item['nama_barang']);
            }

            $barang->stok -= $item['jumlah'];
            $barang->save();
        }

        session()->forget('keranjang');

        return redirect()->route('kasir')->with('success', 'Transaksi Berhasil');
    }
}
