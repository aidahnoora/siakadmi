@extends('layouts.main')

@section('title', 'Data Guru')

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
                    <h1 class="m-0">Data Guru</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Data Guru</li>
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
                            <h2 class="card-title">Data Guru</h2>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <a href="/guru/add" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Foto</th>
                                        <th>NIP</th>
                                        <th>Nama Guru</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gurus as $item)
                                        <tr id="index_{{ $item->nip }}">
                                            <th scope="row" class="text-center">{{ $loop->iteration }}.</th>
                                            <td><img src="{{ Storage::url('public/foto/') . $item->foto }}" width="50"
                                                    height="auto"></td>
                                            <td>{{ $item->nip }}</td>
                                            <td>{{ $item->nama_guru }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('guru/edit', $item->nip) }}"
                                                    class="btn btn-icon btn-sm btn-warning">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                {{-- <a href="{{ route('guru/delete', $item->nip) }}" class="btn btn-icon btn-sm btn-danger">
                                                <i class="fas fa-times"></i>
                                            </a> --}}
                                                <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-danger"
                                                    id="delete-confirm" data-id="{{ $item->nip }}">
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
                        url: `/guru/delete/${post_id}`,
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
    </script>
@endsection
