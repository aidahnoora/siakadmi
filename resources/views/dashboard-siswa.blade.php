@extends('layouts.main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        {{-- <li class="breadcrumb-item active">Starter Page</li> --}}
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Profilku</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nama_siswa" class="col-sm-4 control-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_siswa" class="form-control" value="{{ Auth::user()->siswa->nama_siswa }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="siswa_nis" class="col-sm-4 control-label">NIS</label>
                            <div class="col-sm-8">
                                <input type="text" name="siswa_nis" class="form-control" value="{{ Auth::user()->siswa_nis }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nomor_induk" class="col-sm-4 control-label">Nomor Induk</label>
                            <div class="col-sm-8">
                                <input type="text" name="nomor_induk" class="form-control" value="{{ Auth::user()->siswa->nomor_induk }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_kelas" class="col-sm-4 control-label">Kelas</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_kelas" class="form-control" value="{{ Auth::user()->siswa->kelas->nama_kelas }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('siswa.dashboard-absensi')
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection
