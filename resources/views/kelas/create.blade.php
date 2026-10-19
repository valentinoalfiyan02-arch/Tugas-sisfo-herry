@extends('layouts.main')

@section('title', 'Tambah Data Kelas')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-door-open mr-2 text-primary"></i>Tambah Data Kelas</h1>
        <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Data Kelas</h6>
        </div>
        <div class="card-body">
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_kelas" class="font-weight-bold">Nama Kelas <span class="text-danger">*</span></label>
                <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas') }}" class="form-control @error('nama_kelas') is-invalid @enderror" required placeholder="Contoh: XI RPL 1">
                @error('nama_kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="tingkat" class="font-weight-bold">Tingkat <span class="text-danger">*</span></label>
                <input type="text" name="tingkat" id="tingkat" value="{{ old('tingkat') }}" class="form-control @error('tingkat') is-invalid @enderror" required placeholder="Contoh: XI">
                @error('tingkat')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="jurusan" class="font-weight-bold">Jurusan <span class="text-danger">*</span></label>
                <input type="text" name="jurusan" id="jurusan" value="{{ old('jurusan') }}" class="form-control @error('jurusan') is-invalid @enderror" required placeholder="Contoh: Rekayasa Perangkat Lunak">
                @error('jurusan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="tahun_ajaran" class="font-weight-bold">Tahun Ajaran <span class="text-danger">*</span></label>
                <input type="text" name="tahun_ajaran" id="tahun_ajaran" value="{{ old('tahun_ajaran') }}" class="form-control @error('tahun_ajaran') is-invalid @enderror" required placeholder="Contoh: 2025/2026">
                @error('tahun_ajaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <hr>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
            <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
        </form>
        </div>
    </div>
@endsection
