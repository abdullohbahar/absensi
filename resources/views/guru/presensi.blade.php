@extends('guru.layout.app')

@section('title')
@endsection

@push('addons-css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('dashboard-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0"> Presensi Kelas {{ $kelas }} | Tanggal : <?= date('d-m-Y') ?></h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered table-striped" id="table1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($siswa as $siswa)
                                                    <tr>
                                                        <td>{{ $siswa->nomor_absensi }}</td>
                                                        <td>{{ $siswa->nama_siswa }}</td>
                                                        <td>
                                                            @if (!$siswa->hasOneAbsensi)
                                                                Belum Presensi
                                                            @else
                                                                Sudah Presensi
                                                                @if ($siswa->hasOneAbsensi->masuk)
                                                                    <b class="keterangan">Masuk</b>
                                                                @elseif ($siswa->hasOneAbsensi->ijin)
                                                                    <b class="keterangan">Izin</b>
                                                                @elseif($siswa->hasOneAbsensi->sakit)
                                                                    <b class="keterangan">Sakit</b>
                                                                @elseif($siswa->hasOneAbsensi->alpha)
                                                                    <b class="keterangan">Alpha</b>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (!$siswa->hasOneAbsensi)
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-6 col-lg-3 mt-2">
                                                                        <a href="javascript:void(0)"
                                                                            data-id="{{ $siswa->id }}"
                                                                            data-namasiswa="{{ $siswa->nama_siswa }}"
                                                                            data-keterangan="masuk" class="btn btn-success"
                                                                            id="btnAbsensi" style="width:100%">Masuk</a>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-6 col-lg-3 mt-2">
                                                                        <a href="javascript:void(0)"
                                                                            data-id="{{ $siswa->id }}"
                                                                            data-namasiswa="{{ $siswa->nama_siswa }}"
                                                                            data-keterangan="ijin" id="btnAbsensi"
                                                                            class="btn btn-info" style="width:100%">Izin</a>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-6 col-lg-3 mt-2">
                                                                        <a href="javascript:void(0)"
                                                                            data-id="{{ $siswa->id }}"
                                                                            data-namasiswa="{{ $siswa->nama_siswa }}"
                                                                            data-keterangan="sakit" class="btn btn-warning"
                                                                            id="btnAbsensi" style="width:100%">Sakit</a>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-6 col-lg-3 mt-2">
                                                                        <a href="javascript:void(0)"
                                                                            data-id="{{ $siswa->id }}"
                                                                            data-namasiswa="{{ $siswa->nama_siswa }}"
                                                                            data-keterangan="alpha" class="btn btn-danger"
                                                                            id="btnAbsensi" style="width:100%">Alpha</a>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <button class="btn btn-secondary btn-sm" id="btnChange"
                                                                    data-id="{{ $siswa->hasOneAbsensi->id }}"
                                                                    data-namasiswa="{{ $siswa->nama_siswa }}"
                                                                    style="width: 100%"
                                                                    @if ($siswa->hasOneAbsensi->masuk) data-keterangan="Masuk"
                                                                @elseif ($siswa->hasOneAbsensi->ijin)
                                                                    data-keterangan="Izin"
                                                                @elseif($siswa->hasOneAbsensi->sakit)
                                                                    data-keterangan="Sakit"
                                                                @elseif($siswa->hasOneAbsensi->alpha)
                                                                    data-keterangan="Alpha" @endif>
                                                                    Ubah</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalUbah" tabindex="-1" aria-labelledby="modalUbahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUbahLabel">Ubah Presensi <span id="namaSiswa"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('guru.update.absensi.siswa') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="absensi_id" id="siswaID">
                        <div class="row">
                            <div class="col-12">
                                <p>Presensi : <b id="absensi-sebelumnya"></b></p>
                            </div>
                            <div class="col-12">
                                <label for="">Presensi</label>
                                <select name="keterangan" id="" class="form-control" required>
                                    <option value="">-- Pilih Presensi --</option>
                                    <option value="masuk">Masuk</option>
                                    <option value="izin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="alpha">Alpha</option>
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-success" style="width: 100%">Ubah</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addons-js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('dashboard-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard-assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $("#table1").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
        });

        var token = $('meta[name="csrf-token"]').attr('content');


        // destroy anak asuh
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        $("body").on("click", "#btnAbsensi", function() {
            var id = $(this).data("id");
            var keterangan = $(this).data("keterangan");
            var namaSiswa = $(this).data("namasiswa");

            Swal.fire({
                text: `Apakah anda yakin bahwa ${namaSiswa} ${keterangan} ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/absensi/' + id + '/' + keterangan,
                        type: 'POST',
                        success: function(response) {
                            if (response.code == 200) {
                                Swal.fire(
                                    'Berhasil!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    location
                                        .reload(); // Refresh halaman setelah mengklik OK
                                });
                            } else if (response.code == 500) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: response.message,
                                })
                            }
                        }
                    })
                }
            })
        })

        $("body").on("click", "#btnChange", function() {
            $("#modalUbah").modal("show")

            var nama = $(this).data("namasiswa")
            var siswaID = $(this).data("id")
            var keterangan = $(this).data("keterangan")

            $("#namaSiswa").text(nama)
            $("#siswaID").val(siswaID)
            $("#absensi-sebelumnya").text(keterangan)
        })
    </script>
@endpush
