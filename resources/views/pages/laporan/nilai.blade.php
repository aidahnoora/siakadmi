@extends('layouts.main')

@section('title', 'Laporan Nilai Siswa')

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
                    <h1 class="m-0">Laporan Nilai Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/laporan/nilai">Laporan</a></li>
                        <li class="breadcrumb-item active">Nilai Siswa</li>
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
                            <h2 class="card-title">Laporan Nilai Siswa</h2>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <form method="GET">
                                <div class="container">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label for="" class="col-form-label">Siswa</label>
                                                    <select name="siswa_nis" id="siswa_nis" class="form-control">
                                                        <option value="" selected>Semua Siswa</option>
                                                        @foreach ($siswas as $item)
                                                            <option value="{{ $item->nis }}" {{ request('siswa_nis')==$item->nis?'selected':'' }}>{{ $item->nama_siswa }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="" class="col-form-label">Mapel</label>
                                                    <select name="mapel_id" id="mapel_id" class="form-control">
                                                        <option value="" selected>Semua Mata Pelajaran</option>
                                                        @foreach ($mapels as $item)
                                                            <option value="{{ $item->id }}" {{ request('mapel_id')==$item->id?'selected':'' }}>{{ $item->nama_mapel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="" class="col-form-label">Semester</label>
                                                    <select name="semester" id="semester" class="form-control">
                                                        <option value="" selected>Semua Semester</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="" class="col-form-label">Filter</label>
                                                    <button type="submit" class="btn btn-icon btn-primary form-control" name="search" title="Search" width="20">
                                                        <i class="fas fa-search"></i> Cari
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomor Induk</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Mapel</th>
                                        <th>Tugas</th>
                                        <th>UH</th>
                                        <th>UTS</th>
                                        <th>UAS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilais as $item)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $loop->iteration }}.</th>
                                        <td>{{ $item->siswa->nomor_induk }}</td>
                                        <td>{{ $item->siswa->nis }}</td>
                                        <td>{{ $item->siswa->nama_siswa }}</td>
                                        <td>{{ $item->mapel->nama_mapel }}</td>
                                        <td>{{ $item->tugas }}</td>
                                        <td>{{ $item->rata_uh }}</td>
                                        <td>{{ $item->uts }}</td>
                                        <td>{{ $item->uas }}</td>
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
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
