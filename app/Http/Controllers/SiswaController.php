<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::paginate(10);

        return view("siswa.index", compact("siswa"));
    }
    public function create()
    {
        return view("siswa.create");
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kelas' => 'required'
        ]);
        //create post
        Siswa::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas
        ]);
        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }
    public function update(Request $request, Siswa $siswa)
    {
        //validate form
        $this->validate($request, [
            'nama' => 'required',
            'kelas' => 'required'
        ]);

        $siswa->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas
        ]);

        //redirect to index
        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy(Siswa $siswa)
    {
        //delete siswa
        $siswa->delete();

        //redirect to index
        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
