<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasAdminController extends Controller
{
    public function index()
    {
        $kelas = Kelas::orderBy('kelas', 'asc')->get();

        $data = [
            'active' => 'kelas',
            'kelas' => $kelas
        ];

        return view('admin.kelas.index', $data);
    }

    public function create()
    {

        $data = [
            'active' => 'kelas',
        ];

        return view('admin.kelas.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required',
            'rombel' => 'required'
        ], [
            'kelas.required' => 'Kelas harus diisi',
            'rombel.required' => 'Rombel harus diisi'
        ]);

        $namaKelas = $request->kelas . $request->rombel;

        $kelas = Kelas::where('kelas', $namaKelas)->exists();

        if ($kelas) {
            return redirect()->back()->with('error', 'Kelas ' . $namaKelas . ' Sudah Ada. Anda Tidak Dapat Menambah Kelas Yang Sama')->withInput();
        }

        Kelas::create([
            'kelas' => $namaKelas
        ]);

        return redirect()->back()->with('success', 'Berhasil menambah kelas');
    }

    public function destroy($id)
    {
        try {
            $kelas = Kelas::findOrFail($id);

            // Temukan semua siswa yang memiliki kelas ID yang sama dengan ID kelas yang akan dihapus
            $siswaToDelete = Siswa::where('kelas', $kelas->kelas)->get();

            // Hapus semua siswa yang terkait dengan kelas ini
            foreach ($siswaToDelete as $siswa) {
                $siswa->delete();
            }

            $kelas->delete();

            return response()->json([
                'message' => 'Berhasil Menghapus Data',
                'code' => 200,
                'error' => false
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal Menghapus Data' . $e->getMessage(),
                'code' => 500,
                'error' => $e->getMessage()
            ]);
        }
    }
}
