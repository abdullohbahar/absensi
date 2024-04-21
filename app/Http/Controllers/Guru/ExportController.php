<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index()
    {
        return view('guru.export.index');
    }

    public function pilihKelas($kelas)
    {
        return view('guru.export.pilih-kelas');
    }
}
