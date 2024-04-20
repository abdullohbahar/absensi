@extends('admin.layout.app')

@section('title')
    Tambah Siswa
@endsection

@push('addons-css')
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Siswa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Siswa</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('admin.siswa') }}" class="btn btn-info">Kembali</a>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.store.siswa') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 mt-2">
                                            <label for="">Nama Siswa</label>
                                            <input type="text" name="nama_siswa"
                                                class="form-control @error('nama_siswa') is-invalid @enderror"
                                                id="nama_siswa" value="{{ old('nama_siswa') }}">
                                            @error('nama_siswa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-md-6 mt-2">
                                            <label for="">Nomor Absensi</label>
                                            <input type="number" name="nomor_absensi"
                                                class="form-control @error('nomor_absensi') is-invalid @enderror"
                                                id="nomor_absensi" value="{{ old('nomor_absensi') }}">
                                            @error('nomor_absensi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-md-6 mt-2">
                                            <label for="">Kelas</label>
                                            <select name="kelas" class="form-control @error('kelas') is-invalid @enderror"
                                                id="kelas">
                                                <option value="">-- Pilih Kelas --</option>
                                                @foreach ($kelas as $kelas)
                                                    <option {{ old('kelas') == $kelas->kelas ? 'selected' : '' }}
                                                        value="{{ $kelas->kelas }}">{{ $kelas->kelas }}</option>
                                                @endforeach
                                            </select>
                                            @error('kelas')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-3">
                                            <button class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection

@push('addons-js')
@endpush
