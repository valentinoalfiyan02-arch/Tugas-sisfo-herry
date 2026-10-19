<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NilaiController extends Controller
{
    private function rules(?Nilai $nilai = null): array
    {
        return [
            'siswa_id' => 'required|exists:siswas,id',
            'mapel_id' => [
                'required',
                'exists:mapels,id',
                // satu siswa hanya boleh punya satu nilai per mata pelajaran
                Rule::unique('nilais', 'mapel_id')
                    ->where('siswa_id', request('siswa_id'))
                    ->ignore($nilai?->id),
            ],
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
        ];
    }

    private function messages(): array
    {
        return ['mapel_id.unique' => 'Nilai untuk siswa dan mata pelajaran tersebut sudah ada.'];
    }

    /** Hitung nilai akhir (30% tugas, 30% UTS, 40% UAS) dan keterangan berdasarkan KKM. */
    private function hitung(array $data): array
    {
        $akhir = round(($data['nilai_tugas'] * 0.3) + ($data['nilai_uts'] * 0.3) + ($data['nilai_uas'] * 0.4), 2);
        $kkm = Mapel::findOrFail($data['mapel_id'])->kkm;

        $data['nilai_akhir'] = $akhir;
        $data['keterangan'] = $akhir >= $kkm ? 'Lulus' : 'Tidak Lulus';

        return $data;
    }

    public function index()
    {
        $nilais = Nilai::with(['siswa.kelas', 'mapel'])->latest()->get();

        return view('nilai.index', compact('nilais'));
    }

    public function create()
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.create', compact('siswas', 'mapels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->messages());
        Nilai::create($this->hitung($data));

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil ditambahkan.');
    }

    public function edit(Nilai $nilai)
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.edit', compact('nilai', 'siswas', 'mapels'));
    }

    public function update(Request $request, Nilai $nilai)
    {
        $data = $request->validate($this->rules($nilai), $this->messages());
        $nilai->update($this->hitung($data));

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil dihapus.');
    }
}
