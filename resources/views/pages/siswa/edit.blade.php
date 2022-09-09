@extends('layouts.main')

@section('title', 'Data Siswa')

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
                        <li class="breadcrumb-item"><a href="/siswa">Data Siswa</a></li>
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
                            <h2 class="card-title">Data Siswa</h2>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <a href="/siswa" class="btn btn-primary">Kembali</a>
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
                            <form action="{{ route('siswa/update', $siswas->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nis">NIS</label>
                                            <input type="text" name="nis" class="form-control" value="{{ $siswas->nis }}" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenis_perempuan">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control" autofocus required>
                                                <option value="Laki-laki" {{ $siswas->jenis_kelamin == 'Laki-laki'? 'selected': ''}}>Laki-laki</option>
                                                <option value="Perempuan" {{ $siswas->jenis_kelamin == 'Perempuan'? 'selected': ''}}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kelas_id">Kelas</label>
                                            <select class="form-control" id="kelas_id" name="kelas_id">
                                                @foreach ($kelass as $kelas)
                                                <option value="{{ $kelas->id }}" {{ $siswas->kelas_id == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_siswa">Nama Lengkap</label>
                                            <input type="text" name="nama_siswa" class="form-control" value="{{ $siswas->nama_siswa}}" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="foto">Upload Foto</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img src="{{ asset($siswas->foto) }}" width="100" height="auto">
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="file" accept="image/*" name="foto" class="form-control" autofocus>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tmpt_lahir">Tempat Lahir</label>
                                            <input type="text" name="tmpt_lahir" class="form-control" value="{{ $siswas->tmpt_lahir }}" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control" value="{{ $siswas->tgl_lahir }}" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tahun_masuk">Tahun Masuk</label>
                                            <input type="text" name="tahun_masuk" class="form-control" value="{{ $siswas->tahun_masuk }}" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select name="agama" class="form-control" autofocus required>
                                                <option value="Islam" {{ $siswas->agama == 'Islam'? 'selected': ''}}>Islam</option>
                                                <option value="Kristen" {{ $siswas->agama == 'Kristen'? 'selected': ''}}>Kristen</option>
                                                <option value="Khatolik" {{ $siswas->agama == 'Khatolik'? 'selected': ''}}>Khatolik</option>
                                                <option value="Hindu" {{ $siswas->agama == 'Hindu'? 'selected': ''}}>Hindu</option>
                                                <option value="Buddha" {{ $siswas->agama == 'Buddha'? 'selected': ''}}>Buddha</option>
                                                <option value="Kong Hu Cu" {{ $siswas->agama == 'Kong Hu Cu'? 'selected': ''}}>Khong Hu Cu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" class="form-control"> {{ $siswas->alamat }} </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama_ortu">Nama Orang Tua</label>
                                            <input type="text" name="nama_ortu" class="form-control" value="{{ $siswas->nama_ortu }}" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="no_telp">Nomor Telepon</label>
                                            <input type="text" name="no_telp" class="form-control" value="{{ $siswas->no_telp }}" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <select name="pekerjaan" class="form-control" autofocus required>
                                                <option value="PNS" {{ $siswas->pekerjaan == 'PNS'? 'selected': ''}}>PNS</option>
                                                <option value="Wiraswasta" {{ $siswas->pekerjaan == 'Wiraswasta'? 'selected': ''}}>Wiraswasta</option>
                                                <option value="Swasta" {{ $siswas->pekerjaan == 'Swasta'? 'selected': ''}}>Swasta</option>
                                                <option value="Petani" {{ $siswas->pekerjaan == 'Petani'? 'selected': ''}}>Petani</option>
                                                <option value="Pedagang" {{ $siswas->pekerjaan == 'Pedagang'? 'selected': ''}}>Pedagang</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit">Update</button>
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
