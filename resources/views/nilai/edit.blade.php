@extends('layouts.main')

@section('title', 'Edit Nilai Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-star mr-2 text-primary"></i>Edit Nilai Siswa</h1>
        <a href="{{ route('nilai.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Nilai Siswa</h6>
        </div>
        <div class="card-body">
        <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="siswa_id" class="font-weight-bold">Pilih Siswa <span class="text-danger">*</span></label>
                <select name="siswa_id" id="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach ($siswas as $s)
                        <option value="{{ $s->id }}" {{ old('siswa_id', $nilai->siswa_id) == $s->id ? 'selected' : '' }}>{{ $s->nama }} ({{ $s->kelas->nama_kelas ?? '-' }})</option>
                    @endforeach
                </select>
                @error('siswa_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="mapel_id" class="font-weight-bold">Pilih Mata Pelajaran <span class="text-danger">*</span></label>
                <select name="mapel_id" id="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach ($mapels as $m)
                        <option value="{{ $m->id }}" {{ old('mapel_id', $nilai->mapel_id) == $m->id ? 'selected' : '' }}>{{ $m->nama_mapel }} (KKM {{ $m->kkm }})</option>
                    @endforeach
                </select>
                @error('mapel_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="nilai_tugas" class="font-weight-bold">Nilai Tugas (30%) <span class="text-danger">*</span></label>
                <input type="number" name="nilai_tugas" id="nilai_tugas" value="{{ old('nilai_tugas', $nilai->nilai_tugas) }}" class="form-control @error('nilai_tugas') is-invalid @enderror" required min="0" max="100" step="0.01">
                @error('nilai_tugas')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="nilai_uts" class="font-weight-bold">Nilai UTS (30%) <span class="text-danger">*</span></label>
                <input type="number" name="nilai_uts" id="nilai_uts" value="{{ old('nilai_uts', $nilai->nilai_uts) }}" class="form-control @error('nilai_uts') is-invalid @enderror" required min="0" max="100" step="0.01">
                @error('nilai_uts')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="nilai_uas" class="font-weight-bold">Nilai UAS (40%) <span class="text-danger">*</span></label>
                <input type="number" name="nilai_uas" id="nilai_uas" value="{{ old('nilai_uas', $nilai->nilai_uas) }}" class="form-control @error('nilai_uas') is-invalid @enderror" required min="0" max="100" step="0.01">
                @error('nilai_uas')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <p class="small text-muted">Nilai akhir dihitung otomatis: (Tugas × 30%) + (UTS × 30%) + (UAS × 40%). Keterangan ditentukan berdasarkan KKM mata pelajaran.</p>

            <hr>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
            <a href="{{ route('nilai.index') }}" class="btn btn-secondary">Batal</a>
        </form>
        </div>
    </div>
@endsection
