@extends('layouts.main')

@section('title', 'Data Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-graduate mr-2 text-primary"></i>Data Siswa</h1>
        <a href="{{ route('siswa.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Siswa
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th width="5%">No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge badge-secondary">{{ $s->nis }}</span></td>
                                <td><span class="font-weight-bold">{{ $s->nama }}</span></td>
                                <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                                <td><span class="badge badge-{{ $s->jenis_kelamin == 'L' ? 'primary' : 'danger' }}">{{ $s->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</span></td>
                                <td>{{ $s->no_hp ?? '-' }}</td>
                                <td>{{ $s->alamat ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('siswa.show', $s->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('siswa.edit', $s->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus siswa ini? Nilai siswa ikut terhapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
