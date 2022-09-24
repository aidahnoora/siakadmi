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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Data Siswa</h2>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <a href="/siswa" class="btn btn-success">Kembali</a>
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
                            <form action="{{ route('siswa/save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nomor_induk">Nomor Induk</label>
                                            <input type="text" name="nomor_induk" class="form-control" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="nis">NISN</label>
                                                <input type="text" name="nis" class="form-control" autofocus required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kelas_id">Kelas</label>
                                            <select class="form-control" id="kelas_id" name="kelas_id" autofocus required>
                                                <option value="" selected>-- Pilih Kelas --</option>
                                                @foreach ($kelass as $kelas)
                                                <option value="{{ $kelas->id }}" {{ old('id') == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_siswa">Nama Lengkap</label>
                                            <input type="text" name="nama_siswa" class="form-control" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="foto">Upload Foto</label>
                                            <input type="file" name="foto" class="form-control" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tmpt_lahir">Tempat Lahir</label>
                                            <input type="text" name="tmpt_lahir" class="form-control" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tahun_masuk">Tahun Masuk</label>
                                            <input type="text" name="tahun_masuk" class="form-control" autofocus required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jns_kelamin">Jenis Kelamin</label>
                                            <select name="jns_kelamin" class="form-control" autofocus required>
                                                <option value="" selected>-- Pilih Jenis Kelamin --</option>
                                                <option value="Perempuan">Perempuan</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select name="agama" class="form-control" autofocus required>
                                                <option value="" selected>-- Pilih Agama --</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Khatolik">Khatolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Kong Hu Cu">Khong Hu Cu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" class="form-control" autofocus required> </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama_ortu">Nama Orang Tua</label>
                                            <input type="text" name="nama_ortu" class="form-control" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="no_telp">Nomor Telepon</label>
                                            <input type="text" name="no_telp" class="form-control" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <select name="pekerjaan" class="form-control" autofocus required>
                                                <option value="" selected>-- Pilih Pekerjaan Orang Tua --</option>
                                                <option value="PNS">PNS</option>
                                                <option value="Wiraswasta">Wiraswasta</option>
                                                <option value="Swasta">Swasta</option>
                                                <option value="Petani">Petani</option>
                                                <option value="Pedagang">Pedagang</option>
                                            </select>
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
