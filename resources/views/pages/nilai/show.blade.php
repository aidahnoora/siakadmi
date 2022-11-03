@extends('layouts.main')

@section('title', 'Nilai Siswa')

@section('css')
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.cs') }}">
@endsection

@section('breadcrumbs')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nilai Siswa Kelas {{ $kelass->nama_kelas }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/nilai">Nilai Siswa</a></li>
                        <li class="breadcrumb-item active">Kelas {{ $kelass->nama_kelas }}</li>
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
                            <h2 class="card-title">Nilai Siswa Kelas {{ $kelass->nama_kelas }}</h2>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                                    Tambah Data
                                </button>
                                <a href="{{ route('nilai') }}" class="btn btn-success">
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No.</th>
                                        <th>NISN</th>
                                        <th>Nama Siswa</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $item)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->iteration }}.</th>
                                            <td>{{ $item->nis }}</td>
                                            <td>{{ $item->nama_siswa }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('nilai/siswa/mapel', $item->nis) }}"
                                                    class="btn btn-icon btn-sm btn-primary">
                                                    <i class="fas fa-search-plus"></i>
                                                </a>
                                                {{-- <a href="{{ route('nilai/edit', $item->id) }}" class="btn btn-icon btn-sm btn-warning">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="{{ route('nilai/delete', $item->id) }}" class="btn btn-icon btn-sm btn-danger">
                                                <i class="fas fa-times"></i>
                                            </a> --}}
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
                    <h4 class="modal-title">Tambah Nilai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('nilai/save') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="siswa_nis">Nama Siswa</label>
                                    <select id="siswa_nis" name="siswa_nis"
                                        class="form-control @error('siswa_nis') is-invalid @enderror select2bs4">
                                        <option value="" selected>-- Pilih Siswa --</option>
                                        @foreach ($siswas as $siswa)
                                            <option value="{{ $siswa->nis }}" data-kelas="{{ $siswa->kelas->id }}">
                                                {{ $siswa->nama_siswa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelas_id">Kelas</label>
                                    <input type="text" name="kelas_id" id="input" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tugas">Nilai Tugas</label>
                                    <input type="number" id="tugas" name="tugas"
                                        class="form-control @error('tugas') is-invalid @enderror">
                                </div>
                                <div class="form-group">
                                    <label for="rata_uh">Nilai Rata-rata UH</label>
                                    <input type="number" name="rata_uh"
                                        class="form-control @error('rata_uh') is-invalid @enderror">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mapel_id">Mata Pelajaran</label>
                                    <select id="mapel_id" name="mapel_id"
                                        class="form-control @error('mapel_id') is-invalid @enderror select2bs4">
                                        <option value="" selected>-- Pilih Mata Pelajaran --</option>
                                        @foreach ($mapels as $mapel)
                                            <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="uts">Nilai UTS</label>
                                    <input type="number" name="uts"
                                        class="form-control @error('uts') is-invalid @enderror">
                                </div>
                                <div class="form-group">
                                    <label for="uas">Nilai UAS</label>
                                    <input type="number" name="uas"
                                        class="form-control @error('uas') is-invalid @enderror">
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

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "excel", "pdf", "print"]
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
        $(document).ready(function() {
            $('#siswa_nis').on('change', function() {
                const selected = $(this).find('option:selected');
                const jab = selected.data('kelas');

                $("#input").val(jab);
            });
        });
    </script>
@endsection
