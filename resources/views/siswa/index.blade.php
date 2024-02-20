@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                TAMBAH SISWA
                            </button>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('barang.index')}}" class="btn btn-success mx-1">
                                    DATA BARANG
                                </a>
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-success">
                                    DATA PEMINJAMAN 
                                </a>
                            </div>
                        </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">NAMA</th>
                                <th scope="col">KELAS</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswa as $siswas)
                                <tr>
                                    <td>{{ $siswas->nama }}</td>
                                    <td>{{$siswas->kelas}}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('siswa.destroy', $siswas->id) }}" method="POST">
                                            <a href="{{ route('siswa.edit', $siswas->id) }}"
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
                    {{ $siswa->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">TAMBAH SISWA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="nama">
                        <div class="form-group my-1">
                            <label class="font-weight-bold">Nama</label>
                            <input type="text" class="form-control" name="nama" value=""
                                placeholder="Masukkan Nama Siswa">
                            <!-- error message untuk title -->
                        </div>
                        <div class="form-group my-1 mt-3">
                            <label class="font-weight-bold">Kelas</label>
                            <select class="form-control" name="kelas">
                                <option value="X PPLG">X PPLG </option>
                                <option value="XI PPLG">XI RPL </option>
                                <option value="XII PPLG">XII RPL </option>
                            </select>
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
