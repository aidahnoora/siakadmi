@extends('layouts.main')

@section('title', 'Nilai')

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
                    <h1 class="m-0">Nilai</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Nilai</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Nilai</h2>
            </div>
            <div class="card-body">
                <div class="card-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Mata Pelajaran</th>
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
