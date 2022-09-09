@extends('layouts.main')

@section('title', 'Data Guru')

@section('css')

@endsection

@section('breadcrumbs')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/guru">Data Guru</a></li>
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
                            <h2 class="card-title">Data Guru</h2>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <a href="/guru" class="btn btn-primary">Kembali</a>
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
                            <form action="{{ route('guru/update', $gurus->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input type="text" name="nip" class="form-control" value="{{ $gurus->nip }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="foto">Upload Foto</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img src="{{ asset($gurus->foto) }}" width="100" height="auto">
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="file" accept="image/*" name="foto" class="form-control" autofocus>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_guru">Nama Lengkap</label>
                                            <input type="text" name="nama_guru" class="form-control" value="{{ $gurus->nama_guru }}" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select name="agama" class="form-control" autofocus required>
                                                <option value="Islam" {{ $gurus->agama == 'Islam'? 'selected': ''}}>Islam</option>
                                                <option value="Kristen" {{ $gurus->agama == 'Kristen'? 'selected': ''}}>Kristen</option>
                                                <option value="Khatolik" {{ $gurus->agama == 'Khatolik'? 'selected': ''}}>Khatolik</option>
                                                <option value="Hindu" {{ $gurus->agama == 'Hindu'? 'selected': ''}}>Hindu</option>
                                                <option value="Buddha" {{ $gurus->agama == 'Buddha'? 'selected': ''}}>Buddha</option>
                                                <option value="Kong Hu Cu" {{ $gurus->agama == 'Kong Hu Cu'? 'selected': ''}}>Khong Hu Cu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tmpt_lahir">Tempat Lahir</label>
                                            <input type="text" name="tmpt_lahir" class="form-control" value="{{ $gurus->tmpt_lahir }}" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control" value="{{ $gurus->tgl_lahir }}" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_telp">Nomor Telepon</label>
                                            <input type="text" name="no_telp" class="form-control" value="{{ $gurus->no_telp }}" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ $gurus->email }}" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pangkat_golongan">Pangkat/Golru</label>
                                            <input type="text" name="pangkat_golongan" class="form-control" value="{{ $gurus->pangkat_golongan }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" class="form-control">{{ $gurus->alamat }}"</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
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
