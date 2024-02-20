@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    {{-- <a href="{{ route('siswa.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a> --}}
                    <div class="d-flex justify-content-between mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModale">
                            TAMBAH BARANG
                        </button>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('siswa.index') }}" class="btn btn-success mx-1">
                                DATA SISWA
                            </a>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-success">
                                DATA PEMINJAMAN
                            </a>
                        </div>
                    </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">NAMA BARANG</th>
                            <th scope="col">GAMBAR</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barang as $barangs)
                            <tr>
                                <td>{{ $barangs->nama_barang }}</td>
                                <td class="text-center">
                                    <img src="{{ Storage::url('public/posts/') . $barangs->gambar }}" class="rounded"
                                        style="max-width: 75px; max-height: 75px;">
                                </td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('barang.destroy', $barangs->id) }}" method="POST">
                                        <a href="{{ route('barang.edit', $barangs->id) }}"
                                            class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Post belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {{ $barang->links() }}

            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="exampleModale" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">TAMBAH BARANG</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="nama_barang">
                        <div class="form-group my-1">
                            <label class="font-weight-bold">Nama</label>
                            <input type="text" class="form-control" name="nama_barang" value=""
                                placeholder="Masukkan Nama Siswa">
                            <!-- error message untuk title -->
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">GAMBAR</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar">

                            <!-- error message untuk title -->
                            @error('gambar')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="d-flex justify-content-end mt-3"> <!-- Added class justify-content-end -->
                            <button type="submit" class="btn btn-md btn-primary mx-1">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning mx-1">RESET</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
