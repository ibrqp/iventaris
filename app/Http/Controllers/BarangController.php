<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::paginate(5);
        return view("barang.index", compact("barang"));
    }
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_barang' => 'required'
        ]);

        //upload gambar
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/posts', $gambar->hashName());

        //create post
        Barang::create([
            'gambar' => $gambar->hashName(),
            'nama_barang' => $request->nama_barang
        ]);

        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }
    public function update(Request $request, Barang $barang)
    {
        //validate form
        $this->validate($request, [
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_barang' => 'required|min:5',
        ]);

        //check if gambar is uploaded
        if ($request->hasFile('gambar')) {

            //upload new gambar
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/posts', $gambar->hashName());

            //delete old gambar
            Storage::delete('public/posts/' . $barang->gambar);

            //update post with new gambar
            $barang->update([
                'gambar' => $gambar->hashName(),
                'nama_barang' => $request->nama_barang,
            ]);

        } else {

            //update post without gambar
            $barang->update([
                'nama_barang' => $request->nama_barang,
            ]);
        }

        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(Barang $barang)
    {
        //delete siswa
        $barang->delete();

        //redirect to index
        return redirect()->route('barang .index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
