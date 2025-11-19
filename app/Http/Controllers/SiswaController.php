<?php

namespace App\Http\Controllers;

use App\Exports\SiswaCsvExport;
use App\Exports\SiswaExport;
use App\Models\Siswa;
use App\Models\Lembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    // ================================
    // 1. INDEX + DATATABLES + FILTER
    // ================================
   public function index(Request $request)
    {
        $lembagas = Lembaga::all();

        $query = Siswa::query()->with('lembaga');

        // FILTER LEMBAGA
        if ($request->lembaga_id) {
            $query->where('lembaga_id', $request->lembaga_id);
        }

        // FILTER SEARCH
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nis', 'LIKE', "%$search%")
                ->orWhere('nama', 'LIKE', "%$search%");
            });
        }

        $siswa = $query->orderBy('id', 'DESC')->get();

        return view('index', compact('siswa', 'lembagas'));
    }


    // ================================
    // 2. CREATE FORM
    // ================================
    public function create()
    {
        $lembagas = Lembaga::all();
        return view('create', compact('lembagas'));
    }

    // ================================
    // 3. STORE DATA
    // ================================
    public function store(Request $request)
    {
        $request->validate([
            'lembaga_id' => 'required',
            'nis' => 'required|numeric|unique:siswas,nis',
            'nama' => 'required|string',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpg,png|max:100',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')
                ->store('foto_siswa', 'public');
        }

        Siswa::create([
            'lembaga_id' => $request->lembaga_id,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'email' => $request->email,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    // ================================
    // 4. EDIT FORM
    // ================================
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $lembagas = Lembaga::all();

        return view('edit', compact('siswa', 'lembagas'));
    }

    // ================================
    // 5. UPDATE DATA
    // ================================
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'lembaga_id' => 'required',
            'nis' => 'required|numeric|unique:siswas,nis,' . $siswa->id,
            'nama' => 'required|string',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpg,png|max:100',
        ]);

        $fotoPath = $siswa->foto;

        if ($request->hasFile('foto')) {
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }

            $fotoPath = $request->file('foto')
                ->store('foto_siswa', 'public');
        }

        $siswa->update([
            'lembaga_id' => $request->lembaga_id,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'email' => $request->email,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui');
    }

    // ================================
    // 6. DELETE SISWA
    // ================================
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        if ($siswa->foto) {
            Storage::disk('public')->delete($siswa->foto);
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus');
    }

    // ================================
    // 7. EXPORT EXCEL (NANTI DIBUAT)
    // ================================
    public function export(Request $request)
    {
        $filters = [
            'lembaga_id' => $request->get('lembaga_id'),
            'search' => $request->get('search'),
        ];

        $file = SiswaCsvExport::generate($filters);

        return response()->download($file)->deleteFileAfterSend(true);
    }



}
