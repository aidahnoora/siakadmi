@extends('layouts.main')

@section('title', 'Absensi Siswa')

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
                    <h1 class="m-0">Tambah Absensi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/absensi">Absensi Siswa</a></li>
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
                            <h2 class="card-title">Tambah Absensi Kelas {{ $kelass->nama_kelas }}</h2>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <a href="{{ route('absensi') }}" class="btn btn-success">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('absensi/save') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nomor Induk</th>
                                            <th>NISN</th>
                                            <th>Nama Siswa</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($siswas as $item)
                                            @php
                                                $tgl = false;
                                            @endphp

                                            @forelse ($absensis as $absen)
                                                @php
                                                    if ($item->nis == $absen->siswa_nis) {
                                                        $tgl = true;
                                                        break;
                                                    }
                                                @endphp
                                            @empty
                                                @php
                                                    $tgl = $item->nis == $item->siswa_nis;
                                                @endphp
                                            @endforelse

                                            <tr>
                                                <th scope="row" class="text-center">{{ $loop->iteration }}.</th>
                                                <td>{{ $item->nomor_induk }}</td>
                                                <td>
                                                    {{ $item->nis }}
                                                </td>
                                                <td>{{ $item->nama_siswa }}</td>
                                                <td class="text-center">
                                                    @if ($tgl == false)
                                                        {{-- hidden id --}}
                                                        <input type="hidden" name="siswa_nis[]"
                                                            value="{{ $item->nis }}">
                                                        <input type="hidden" name="kelas_id[]"
                                                            value="{{ $item->kelas_id }}">

                                                        <input type="checkbox" value="Hadir" id="Hadir"
                                                            name="keterangan[]">
                                                        <label for="Hadir" style="margin-right: 10px">Hadir</label>

                                                        <input type="checkbox" value="Sakit" id="Sakit"
                                                            name="keterangan[]">
                                                        <label for="Sakit" style="margin-right: 10px">Sakit</label>

                                                        <input type="checkbox" value="Izin" id="Izin"
                                                            name="keterangan[]">
                                                        <label for="Izin" style="margin-right: 10px">Izin</label>

                                                        <input type="checkbox" value="Alfa" id="Alfa"
                                                            name="keterangan[]">
                                                        <label for="Alfa">Alfa</label>
                                                    @else
                                                        <span class="badge badge-warning">Sudah generate presensi</span>
                                                    @endif
                                                </td>
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
