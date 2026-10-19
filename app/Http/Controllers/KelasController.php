<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    private function rules(): array
    {
        return [
            'nama_kelas' => 'required|string|max:255',
            'tingkat' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:20',
        ];
    }

    public function index()
    {
        $kelas = Kelas::withCount('siswas')->orderBy('nama_kelas')->get();

        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        Kelas::create($request->validate($this->rules()));

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kela)
    {
        return view('kelas.edit', ['kelas' => $kela]);
    }

    public function update(Request $request, Kelas $kela)
    {
        $kela->update($request->validate($this->rules()));

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kela)
    {
        try {
            $kela->delete();
        } catch (QueryException $e) {
            return redirect()->route('kelas.index')
                ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki data siswa.');
        }

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
