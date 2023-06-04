@extends('layouts.main')

@section('title', 'Absensi Siswa')

@section('css')

@endsection

@section('breadcrumbs')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Absensi Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/absensi">Absensi Siswa</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Absensi Siswa</h2>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <a href="/absensi" class="btn btn-success">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('absensi/update', $absensis->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="siswa_nis">Nama Siswa</label>
                                            <input type="text" name="siswa_nis" class="form-control" readonly value="{{ $absensis->siswa->nama_siswa }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="input" class="form-control" value="{{ $absensis->tanggal }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kelas_id">Kelas</label>
                                            <input type="text" name="kelas_id" id="input" class="form-control" readonly value="{{ $absensis->kelas->nama_kelas}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <select name="keterangan" class="form-control" autofocus required>
                                                <option value="" selected>-- Pilih Keterangan --</option>
                                                <option value="hadir" {{ $absensis->keterangan == 'hadir'? 'selected': ''}}>Hadir</option>
                                                <option value="sakit" {{ $absensis->keterangan == 'sakit'? 'selected': ''}}>Sakit</option>
                                                <option value="izin" {{ $absensis->keterangan == 'izin'? 'selected': ''}}>Izin</option>
                                                <option value="alfa" {{ $absensis->keterangan == 'alfa'? 'selected': ''}}>Alfa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
