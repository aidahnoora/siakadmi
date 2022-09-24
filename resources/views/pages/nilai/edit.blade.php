@extends('layouts.main')

@section('title', 'Nilai Siswa')

@section('css')

@endsection

@section('breadcrumbs')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nilai Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/nilai">Nilai Siswa</a></li>
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
                            <h2 class="card-title">Nilai Siswa</h2>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <a href="/nilai" class="btn btn-success">Kembali</a>
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
                            <form action="{{ route('nilai/update', $nilais->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="siswa_id">Nama Siswa</label>
                                            <input type="text" name="siswa_id" class="form-control" readonly value="{{ $nilais->siswa->nama_siswa }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kelas_id">Kelas</label>
                                            <input type="text" name="kelas_id" id="input" class="form-control" readonly value="{{ $nilais->kelas->nama_kelas }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="tugas">Nilai Tugas</label>
                                            <input type="number" id="tugas" name="tugas" class="form-control @error('tugas') is-invalid @enderror" value="{{ $nilais->tugas }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="rata_uh">Nilai Rata-rata UH</label>
                                            <input type="number" name="rata_uh" class="form-control @error('rata_uh') is-invalid @enderror" value="{{ $nilais->rata_uh }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mapel_id">Mata Pelajaran</label>
                                            <input type="text" name="mapel_id" id="input" class="form-control" readonly value="{{ $nilais->mapel->nama_mapel }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="uts">Nilai UTS</label>
                                            <input type="number" name="uts" class="form-control @error('uts') is-invalid @enderror" value="{{ $nilais->uts }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="uas">Nilai UAS</label>
                                            <input type="number" name="uas" class="form-control @error('uas') is-invalid @enderror" value="{{ $nilais->uas}}">
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
