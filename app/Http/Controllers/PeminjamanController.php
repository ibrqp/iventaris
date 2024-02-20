<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
 
class PeminjamanController extends Controller
{
    public function index(){
        $peminjaman = Peminjaman::paginate(10);
        $data = Siswa::all();     
        $datagambar = Barang::all();
        return view("peminjaman.index", compact('peminjaman', 'data', 'datagambar'));
    }

    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'id_siswa'=> 'required',
            'id_barang'=> 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' =>'required'
        ]);

        //create post
        Peminjaman::create([
            'id_siswa' => $request->id_siswa,
            'id_barang' => $request->id_barang,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali

        ]);

        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function edit(Peminjaman $peminjaman){
         $data = Siswa::all();
        return view('peminjaman.edit', compact('peminjaman', 'data'));
    }
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //validate form
        $this->validate($request, [
            'gambar'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required|min:5',
            'content'   => 'required|min:10'
        ]);

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //upload new image
            $image = $request->file('gambar');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/'.$peminjaman->image);

            //update post with new image
            $peminjaman->update([
                'gambar'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);

        } else {

            //update post without image
            $peminjaman->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        }

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy(Peminjaman $peminjaman)
    {
        //delete siswa
        $peminjaman->delete();

        //redirect to index
        return redirect()->route('peminjaman.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
