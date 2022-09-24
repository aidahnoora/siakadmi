@extends('layouts.main')

@section('title', 'Jadwal')

@section('css')
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.cs') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/toastr/toastr.min.css') }}">
@endsection

@section('breadcrumbs')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Jadwal</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Jadwal</h2>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Kelas</th>
                                        <th>Lihat Jadwal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelass as $item)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->iteration }}.</th>
                                            <td>{{ $item->nama_kelas }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('jadwal/detail', $item->id) }}" class="btn btn-icon btn-sm btn-primary">
                                                    <i class="fas fa-search-plus"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jadwal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jadwal/save') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hari_id">Hari</label>
                                    <select id="hari_id" name="hari_id"
                                        class="form-control @error('hari_id') is-invalid @enderror select2bs4">
                                        <option value="" selected>-- Pilih Hari --</option>
                                        @foreach ($haris as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_hari }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelas_id">Kelas</label>
                                    <select id="kelas_id" name="kelas_id"
                                        class="form-control @error('kelas_id') is-invalid @enderror select2bs4">
                                        <option value="" selected>-- Pilih Kelas --</option>
                                        @foreach ($kelass as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="mapel_id">Mata Pelajaran</label>
                                    <select id="mapel_id" name="mapel_id"
                                        class="form-control @error('mapel_id') is-invalid @enderror select2bs4">
                                        <option value="" selected>-- Pilih Mata Pelajaran --</option>
                                        @foreach ($mapels as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jam_mulai">Jam Mulai</label>
                                    <input type="time" id="jam_mulai" name="jam_mulai"
                                        class="form-control @error('jam_mulai') is-invalid @enderror"
                                        placeholder='JJ:mm:dd'>
                                </div>
                                <div class="form-group">
                                    <label for="jam_selesai">Jam Selesai</label>
                                    <input type="time" id="jam_selesai" name="jam_selesai"
                                        class="form-control @error('jam_selesai') is-invalid @enderror"
                                        placeholder='JJ:mm:dd'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('js')
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('AdminLTE/plugins/toastr/toastr.min.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
