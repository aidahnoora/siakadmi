@extends('layouts.main')

@section('title', 'Data User')

@section('css')

@endsection

@section('breadcrumbs')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/user">Data User</a></li>
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
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Data User</h2>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <a href="/user" class="btn btn-success">
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
                            <form action="{{ route('user/update', $users->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $users->name }}" autocomplete="name" autofocus required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $users->email }}" autocomplete="email" autofocus required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                    <span style="font-size: 12px">*Kosongi jika tidak ingin merubah password</span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">Konfirmasi Password</label>
                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" autocomplete="new-password">
                                    <span style="font-size: 12px; font-color: red;">*Kosongi jika tidak ingin merubah password</span>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control" autofocus disabled>
                                        <option value="admin" {{ $users->role == 'admin'? 'selected': ''}}>Admin</option>
                                        <option value="guru" {{ $users->role == 'guru'? 'selected': ''}}>Guru</option>
                                        <option value="siswa" {{ $users->role == 'siswa'? 'selected': ''}}>Siswa</option>
                                        <option value="kepsek" {{ $users->role == 'kepsek'? 'selected': ''}}>Kepala Sekolah</option>
                                    </select>
                                </div>
                                <div class="form-group" id="siswa_nis" style="display: none">
                                    <label for="siswa_nis">NIS</label>
                                    <input type="text" name="siswa_nis" class="form-control @error('siswa_nis') is-invalid @enderror" value="{{ $users->siswa_nis }}" autocomplete="siswa_nis">
                                    @error('siswa_nis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
    <input type="hidden" id="tipe_role" value="{{ $users->role }}">
@endsection

@section('js')
<script>
    $(document).ready(function() {
        if( $('#tipe_role').val() == 'siswa'){
            $("#siswa_nis").show();
        }else{
            $("#siswa_nis").hide();
        }

        $('#role').change(function(){
            if($(this).val() == 'siswa'){
                $("#siswa_nis").show();
            }else{
                $("#siswa_nis").hide();
            }
        });
    });
</script>
@endsection
