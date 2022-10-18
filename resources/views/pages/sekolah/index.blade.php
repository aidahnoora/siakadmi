@extends('layouts.main')

@section('title', 'Profil Sekolah')

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
                    <h1 class="m-0">Profil Sekolah</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Profil Sekolah</li>
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
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Profil Sekolah</h2>
                        </div>
                        <div class="card-body">
                            @foreach ($sekolahs as $item)
                            <div class="form-group">
                                <label for="npsn">NPSN</label>
                                <input type="text" name="npsn" class="form-control" value="{{ $item->npsn }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nama_sekolah">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control" value="{{ $item->nama_sekolah }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ $item->alamat }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <input type="text" name="kabupaten" class="form-control" value="{{ $item->kabupaten }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="text" name="kode_pos" class="form-control" value="{{ $item->kode_pos }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ Storage::url('public/logo/').$item->logo }}" width="100" height="auto">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" accept="image/*" name="foto" class="form-control" autofocus disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_kepsek">Nama Kepala Sekolah</label>
                                <input type="text" name="nama_kepsek" class="form-control" value="{{ $item->nama_kepsek }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="no_telp">Nomor Telepon</label>
                                <input type="text" name="no_telp" class="form-control" value="{{ $item->no_telp }}" disabled>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('sekolah/edit', $item->id) }}" class="btn btn-icon btn-primary">Update Data</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('js')

@endsection
