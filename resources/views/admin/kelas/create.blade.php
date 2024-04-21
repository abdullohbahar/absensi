@extends('admin.layout.app')

@section('title')
    Tambah Kelas
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
                        <h1 class="m-0">Tambah Kelas</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Kelas</li>
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
                                <a href="{{ route('admin.kelas') }}" class="btn btn-info">Kembali</a>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.store.kelas') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <label for="">Kelas</label>
                                            <select name="kelas" class="form-control @error('kelas') is-invalid @enderror"
                                                id="kelas">
                                                <option value="">-- Pilih Kelas --</option>
                                                @for ($i = 7; $i < 10; $i++)
                                                    <option {{ old('kelas') == $i ? 'selected' : '' }}
                                                        value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            @error('kelas')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="">Rombongan Belajar</label>
                                            <select name="rombel"
                                                class="form-control @error('rombel') is-invalid @enderror" id="rombel">
                                                <option value="">-- Pilih Rombongan Belajar --</option>
                                                @foreach (range('A', 'H') as $rombel)
                                                    <option {{ old('rombel') == $rombel ? 'selected' : '' }}
                                                        value="{{ $rombel }}">{{ $rombel }}</option>
                                                @endforeach
                                            </select>
                                            @error('rombel')
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
