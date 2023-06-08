@extends('layouts.main')

@section('title', 'Nilai Siswa')

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
                    <h1 class="m-0">Detail Nilai Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/nilai">Nilai Siswa</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                            <h2 class="card-title">
                                <table>
                                    <tr>
                                        <td>Nama Lengkap</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
                                        <td>{{ $siswas->nama_siswa }}</td>
                                    </tr>
                                    <tr>
                                        <td>NISN</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
                                        <td>{{ $siswas->nis }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Induk</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
                                        <td>{{ $siswas->nomor_induk }}</td>
                                    </tr>

                                    <tr>
                                        <td>Kelas</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
                                        <td>{{ $siswas->kelas->nama_kelas }}</td>
                                    </tr>

                                    <tr>
                                        <td>Semester</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                            </h2>
                            <div class="card-tools">
                                <a href="{{ route('nilai/add/semester1', $siswas->nis) }}"
                                    class="btn btn-icon btn-primary">
                                    <i class="fas fa-plus"></i> Tambah
                                </a>
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
                                        <th>Mata Pelajaran</th>
                                        <th>Tugas</th>
                                        <th>UH</th>
                                        <th>UTS</th>
                                        <th>UAS</th>
                                        <th>Total Nilai</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilaiSemester1 as $item)
                                        <tr id="index_{{ $item->id }}">
                                            <th scope="row" class="text-center">{{ $loop->iteration }}.</th>
                                            <td>{{ $item->nama_mapel }}</td>
                                            <td class="text-right">{{ $item->tugas }}</td>
                                            <td class="text-right">{{ $item->rata_uh }}</td>
                                            <td class="text-right">{{ $item->uts }}</td>
                                            <td class="text-right">{{ $item->uas }}</td>
                                            <td class="text-right">
                                                @php
                                                    $tugas = $item->tugas;
                                                    $uh = $item->rata_uh;
                                                    $uts = $item->uts;
                                                    $uas = $item->uas;

                                                    $total = $tugas + $uh + $uts + $uas;
                                                @endphp
                                                {{ $total }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('nilai/edit', $item->id) }}"
                                                    class="btn btn-icon btn-sm btn-warning">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                {{-- <a href="{{ route('nilai/delete', $item->id) }}" class="btn btn-icon btn-sm btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </a> --}}
                                                <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-danger"
                                                    id="delete-confirm" data-id="{{ $item->id }}">
                                                    <i class="fas fa-times"></i>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('body').on('click', '#delete-confirm', function() {
            let post_id = $(this).data('id');
            let token = $("meta[name='csrf-token']").attr("content");

            swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('oke');

                    $.ajax({
                        url: `/nilai/delete/${post_id}`,
                        type: "DELETE",
                        cache: false,
                        data: {
                            "_token": token
                        },
                        success: function(response) {
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: `${response.message}`,
                                showConfirmButton: true,
                                timer: 3000
                            });

                            $(`#index_${post_id}`).remove();
                        }
                    });
                }
            })
        });
    </script>

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
