<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', ["barang" => $barang]);
    }

    public function create()
    {
        $jenisBarang = JenisBarang::all();
        return view('barang.create', ['jenisBarang' => $jenisBarang]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'jenis_barang_id' => 'required|exists:jenis_barang,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('barang_gambar', 'public');
        }

        Barang::create([
            'nama_barang' => $request->input('nama_barang'),
            'deskripsi' => $request->input('deskripsi'),
            'stok' => $request->input('stok'),
            'harga' => $request->input('harga'),
            'jenis_barang_id' => $request->input('jenis_barang_id'),
            'gambar' => $gambarPath,
        ]);

        return redirect('/barang');
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.show', ['barang' => $barang]);
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $jenisBarang = JenisBarang::all();
        return view('barang.edit', ['barang' => $barang, 'jenisBarang' => $jenisBarang]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
            'jenis_barang_id' => 'required|exists:jenis_barang,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $barang = Barang::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }

            $gambarPath = $request->file('gambar')->store('barang_gambar', 'public');
            $barang->gambar = $gambarPath;
        }

        $barang->update([
            'nama_barang' => $request->input('nama_barang'),
            'deskripsi' => $request->input('deskripsi'),
            'stok' => $request->input('stok'),
            'harga' => $request->input('harga'),
            'jenis_barang_id' => $request->input('jenis_barang_id')
        ]);

        return redirect('/barang');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }
        $barang->delete();

        return redirect('/barang');
    }

    public function kasirIndex()
    {
        $barang = Barang::all();

        return view('kasir.index', compact('barang'));
    }
}
