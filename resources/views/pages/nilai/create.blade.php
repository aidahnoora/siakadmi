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
                    <h1 class="m-0">Tambah Nilai Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/nilai">Nilai Siswa</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
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
                            <h2 class="card-title">Tambah Nilai : {{ $siswas->nama_siswa }}</h2>
                            <div class="card-tools">
                                <a href="{{ route('nilai') }}" class="btn btn-success">
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('nilai/save') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-responsive-md">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No.</th>
                                            <th style="width: 30%">Mata Pelajaran</th>
                                            <th>Tugas</th>
                                            <th>UH</th>
                                            <th>UTS</th>
                                            <th>UAS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mapels as $item)
                                            <tr>
                                                <th scope="row" class="text-center">{{ $loop->iteration }}.</th>
                                                <td>
                                                    {{ $item->nama_mapel }}
                                                    <input type="hidden" name="mapel_id[]" class="form-control" value="{{ $item->id }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="tugas[]" class="form-control" required>
                                                </td>
                                                <td>
                                                    <input type="number" name="rata_uh[]" class="form-control" required>
                                                </td>
                                                <td>
                                                    <input type="number" name="uts[]" class="form-control" required>
                                                </td>
                                                <td>
                                                    <input type="number" name="uas[]" class="form-control" required>
                                                </td>
                                                <input type="hidden" value="{{ $siswas->kelas_id }}" name="kelas_id">
                                                <input type="hidden" value="{{ $siswas->nis }}" name="nis">
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                                <div style="margin-top: 20px">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('js')

@endsection
