<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaAdminController extends Controller
{
    public function index()
    {
        $siswa = Siswa::orderBy('nama_siswa', 'asc')->get();

        $data = [
            'active' => 'siswa',
            'siswa' => $siswa
        ];

        return view('admin.siswa.index', $data);
    }

    public function create()
    {
        $kelas = Kelas::orderBy('kelas', 'asc')->get();

        $data = [
            'active' => 'siswa',
            'kelas' => $kelas
        ];

        return view('admin.siswa.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'nomor_absensi' => 'required',
            'kelas' => 'required'
        ], [
            'nama_siswa.required' => 'Nama siswa harus diisi',
            'nomor_absensi.required' => 'Nomor absensi harus diisi',
            'kelas.required' => 'Kelas harus diisi'
        ]);

        Siswa::create([
            'nama_siswa' => $request->nama_siswa,
            'nomor_absensi' => $request->nomor_absensi,
            'kelas' => $request->kelas
        ]);

        return redirect()->back()->with('success', 'Berhasil menambah siswa');
    }

    public function edit($id)
    {
        $siswa = Siswa::findorfail($id);
        $kelas = Kelas::orderBy('kelas', 'asc')->get();

        $data = [
            'active' => 'siswa',
            'siswa' => $siswa,
            'kelas' => $kelas
        ];

        return view('admin.siswa.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'nomor_absensi' => 'required',
            'kelas' => 'required'
        ], [
            'nama_siswa.required' => 'Nama siswa harus diisi',
            'nomor_absensi.required' => 'Nomor absensi harus diisi',
            'kelas.required' => 'Kelas harus diisi'
        ]);

        Siswa::where('id', $id)->update([
            'nama_siswa' => $request->nama_siswa,
            'nomor_absensi' => $request->nomor_absensi,
            'kelas' => $request->kelas
        ]);

        return redirect()->back()->with('success', 'Berhasil mengubah siswa');
    }

    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);

            $siswa->delete();

            return response()->json([
                'message' => 'Berhasil Menghapus Data',
                'code' => 200,
                'error' => false
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal Menghapus Data',
                'code' => 500,
                'error' => $e->getMessage()
            ]);
        }
    }
}
