@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                            data-bs-target="#exampleModale">
                            TAMBAH PEMINJAMAN
                        </button>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('siswa.index') }}" class="btn btn-success mb-3 mx-1">
                                DATA SISWA
                            </a>
                            <a href="{{ route('barang.index') }}" class="btn btn-success mb-3">
                                DATA BARANG
                            </a>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">NAMA</th>
                                <th scope="col">BARANG PINJAM </th>
                                <th scope="col">TANGGAL PINJAM </th>
                                <th scope="col">TANGGAL KEMBALI </th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peminjaman as $peminjamans)
                                <tr>
                                    <td>{{ $peminjamans->siswa->nama ?? 'Nama Not Available' }}</td>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/posts/') . $peminjamans->barang->gambar }}"
                                            class="rounded" style="max-width: 75px; max-height: 75px;">
                                    </td>


                                    <td>{{ $peminjamans->tgl_pinjam }}</td>
                                    <td>{{ $peminjamans->tgl_kembali }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('peminjaman.destroy', $peminjamans->id) }}" method="POST">
                                            <a href="{{ route('peminjaman.edit', $peminjamans->id) }}"
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
                    {{ $peminjaman->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="exampleModale" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">TAMBAH PEMINJAMAN</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="id_siswa"> --}}

                        {{-- <div class="form-group">
                            <label class="font-weight-bold">Nama Siswa</label>
                            <select class="form-control" name="id_siswa" id="id_siswa">
                                <option value="">Select Nama Siswa</option>
                                @foreach ($data as $siswa)
                                    <option value="{{ $siswa->id }}">{{ $siswa->nama }} ({{ $siswa->kelas }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Pilih Barang</label>
                            <div class="custom-dropdown">
                                <div class="selected-option">Pilih Barang</div>
                                <ul class="dropdown-list">
                                    @foreach ($datagambar as $barang)
                                        <li data-value="{{ $barang->id }}">
                                            <img src="{{ Storage::url('public/posts/') . $barang->gambar }}"
                                                class="rounded" style="width: 50px;">({{ $barang->nama_barang }})
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <input type="hidden" name="id_barang" id="selected-gambar">
                        </div>
                        <label class="font-weight-bold">Tanggal Pinjam</label>
                        <div class="form-group">
                            <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam">
                        </div>
                        <label class="font-weight-bold">Tanggal Kembali</label>
                        <div class="form-group">
                            <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali">
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-md btn-primary mx-1">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning mx-1">RESET</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="exampleModale" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="id_siswa"> --}}

                        <div class="form-group">
                            <label class="font-weight-bold">Nama Siswa</label>
                            <select class="form-control" name="id_siswa" id="id_siswa">
                                <option value="">Select Nama Siswa</option>
                                @foreach ($data as $siswa)
                                    <option value="{{ $siswa->id }}">{{ $siswa->nama }} ({{ $siswa->kelas }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Pilih Barang</label>
                            <div class="custom-dropdown">
                                <div class="selected-option">Pilih Barang</div>
                                <ul class="dropdown-list">
                                    @foreach ($datagambar as $barang)
                                        <li data-value="{{ $barang->id }}">
                                            <img src="{{ Storage::url('public/posts/') . $barang->gambar }}"
                                                class="rounded" style="width: 50px;">({{ $barang->nama_barang }})
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <input type="hidden" name="id_barang" id="selected-gambar">
                        </div>
                        <label class="font-weight-bold">Tanggal Pinjam</label>
                        <div class="form-group">
                            <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam">
                        </div>
                        <label class="font-weight-bold">Tanggal Kembali</label>
                        <div class="form-group">
                            <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali">
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-md btn-primary mx-1">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning mx-1">RESET</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .custom-dropdown {
            position: relative;
            display: inline-block;
            width: 100%;
            /* Sesuaikan lebar dengan form-group */
        }

        .selected-option {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            /* Sesuaikan lebar dengan form-group */
        }

        .dropdown-list {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ced4da;
            border-top: none;
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
            list-style: none;
            margin: 0;
            padding: 0;
            width: 100%;
            /* Sesuaikan lebar dengan form-group */
            z-index: 1;
        }

        .dropdown-list li {
            padding: 10px;
            cursor: pointer;
            width: 100%;
            /* Sesuaikan lebar dengan form-group */
        }

        .dropdown-list li:hover {
            background-color: #f8f9fa;
        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const customDropdown = document.querySelector('.custom-dropdown');
            const selectedOption = document.querySelector('.selected-option');
            const dropdownList = document.querySelector('.dropdown-list');
            const hiddenInput = document.getElementById('selected-gambar');

            customDropdown.addEventListener('click', function() {
                dropdownList.style.display = dropdownList.style.display === 'none' ? 'block' : 'none';
            });

            dropdownList.addEventListener('click', function(event) {
                if (event.target.tagName === 'LI') {
                    selectedOption.textContent = event.target.textContent;
                    hiddenInput.value = event.target.getAttribute('data-value');
                    dropdownList.style.display = 'none';
                }
            });

            document.addEventListener('click', function(event) {
                if (!customDropdown.contains(event.target)) {
                    dropdownList.style.display = 'none';
                }
            });
        });
    </script>
@endsection
