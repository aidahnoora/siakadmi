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
                                    <i class="fas fa-arrow-left"></i> Kembali
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
                                            @php
                                                $tugas = false;
                                                $rataUh = false;
                                                $uts = false;
                                                $uas = false;
                                            @endphp

                                            @foreach ($nilais as $nilai)
                                                @if (isset($nilai->mapel_id))
                                                    @php
                                                        if ($item->id == $nilai->mapel_id) {
                                                            $tugas = true;
                                                            $rataUh = true;
                                                            $uts = true;
                                                            $uas = true;
                                                            break;
                                                        }
                                                    @endphp
                                                @endif
                                            @endforeach
                                            {{-- @php
                                                    $tugas = $item->id == $item->mapel_id;
                                                    $rataUh = $item->id == $item->mapel_id;
                                                    $uts = $item->id == $item->mapel_id;
                                                    $uas = $item->id == $item->mapel_id;
                                                @endphp
                                            @endforelse --}}

                                            <tr>
                                                <th scope="row" class="text-center">{{ $loop->iteration }}.</th>
                                                <td>
                                                    {{ $item->nama_mapel }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($tugas == false || count($nilais) <= 0)
                                                        <input type="number" name="tugas[]" class="form-control" required>
                                                        {{-- <input type="hidden" value="{{ $item->id }}" name="mapel_id[]"> --}}
                                                    @else
                                                        <span class="badge badge-warning">Sudah generate nilai</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($rataUh == false || count($nilais) <= 0)
                                                        <input type="number" name="rata_uh[]" class="form-control" required>
                                                        {{-- <input type="hidden" value="{{ $item->id }}" name="mapel_id[]"> --}}
                                                    @else
                                                        <span class="badge badge-warning">Sudah generate nilai</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($uts == false || count($nilais) <= 0)
                                                        <input type="number" name="uts[]" class="form-control" required>
                                                        {{-- <input type="hidden" value="{{ $item->id }}" name="mapel_id[]"> --}}
                                                    @else
                                                        <span class="badge badge-warning">Sudah generate nilai</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($uas == false || count($nilais) <= 0)
                                                        <input type="number" name="uas[]" class="form-control" required>
                                                        {{-- <input type="hidden" value="{{ $item->id }}" name="mapel_id[]"> --}}
                                                    @else
                                                        <span class="badge badge-warning">Sudah generate nilai</span>
                                                    @endif
                                                </td>

                                                <input type="hidden" value="{{ $siswas->kelas_id }}" name="kelas_id">
                                                <input type="hidden" value="{{ $siswas->nis }}" name="nis">
                                                <input type="hidden" value="{{ $item->id }}" name="mapel_id[]">
                                            </tr>
                                        @endforeach
                                    </tbody>
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
